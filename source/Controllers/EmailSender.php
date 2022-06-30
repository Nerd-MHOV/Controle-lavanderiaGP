<?php

namespace Source\Controllers;

use CoffeeCode\DataLayer\Connect;
use Source\Models\DepartmentHead;
use Source\Models\Output;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PDO;
use PDOException;

class EmailSender extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function emailSender(array $data) //AUTOMAÇÃO
    {
        $daysDue =(isset($data["days"])) ? (int)$data["days"] : 5;
        $dueDate = date('Y-m-d H:i:s', strtotime("-{$daysDue} days"));
        $checkPendencies = ((new Output())->find("created_at < '{$dueDate}' AND id_collaborator != 0 AND validate != 1"));
        $pendencies = $checkPendencies->group("id_department")->fetch(true);


        if (!empty($pendencies)) {

            foreach ($pendencies as $pendency) {
                $tablePendencies = "";

                // SELECIONA COLLABORADORES RELACIONADOS COM AS PENDENCIAS E SETORES
                $connect = Connect::getInstance(DATA_LAYER_CONFIG);
                $itemsPendencies = $connect->query("
                SELECT c.collaborator, o.amount, pt.product_type, o.created_at, p.product, ps.service, p.size
                FROM output AS o 
                INNER JOIN collaborator c ON o.id_collaborator = c.id
                INNER JOIN product p on o.id_product = p.id    
                INNER JOIN product_type pt on p.id_product_type = pt.id
                INNER JOIN product_service ps on p.id_product_service = ps.id
                WHERE o.id_collaborator != 0
                AND o.created_at < '{$dueDate}'
                AND c.id_department LIKE {$pendency->id_department}
                AND validate != 1
                ");
                $itemsPendencies = ($itemsPendencies->fetchAll(PDO::FETCH_OBJ));

                // As pendencias do setor não são dos collaboradores do setor, então sem tabela!
                if (empty($itemsPendencies))
                    continue;

                // GERADOR DE LINHAS TABELA
                foreach ($itemsPendencies as $item) {
                    $outputDate = date("d/m H:i", strtotime($item->created_at));
                    $tablePendencies .= "
                        <tr>
                            <td style='padding: 10px'>{$item->collaborator}</td>    
                            <td style='padding: 10px'>{$item->amount}</td> 
                            <td style='padding: 10px'>{$item->product_type} {$item->product} {$item->service} {$item->size}</td>
                            <td style='padding: 10px'>{$outputDate}</td>
                        </tr>";
                }

                // Corpo do email
                $body = "
                    <hr>
                        <h2>Pendencias Vencidas (a mais de {$daysDue} dias) - {$pendency->department()->department}</h2>
                    <hr>
                    <table>
                       <thead style='background: black; color: white'>
                       <tr>
                            <th>Colaborador</th>
                            <th>Quantidade</th>
                            <th>Item</th>
                            <th>Retirado em</th>
                        </tr>    
                       </thead>
                       <tbody>
                            {$tablePendencies}
                       </tbody> 
                    </table>
                ";

                echo $body;
                echo "<hr>";

                // Enviar Email
                if(isset($data["enviar"]) && $data["enviar"] == "enviar"){
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'email-ssl.com.br';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'controlelavanderia@peraltas.com.br';
                        $mail->Password   = 'Grupo2355@';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;
                        $mail->setFrom('controlelavanderia@peraltas.com.br');

                        $departmentHead = (new DepartmentHead())->find("id_department LIKE '{$pendency->id_department}'")->fetch(true);
                        if(!empty($departmentHead)){
                            foreach ($departmentHead as $head) {
                                $mail->addAddress($head->email, $head->first_name);
                                echo '<b>'.$head->email." ".$head->first_name.'</b>';
                            }
                        }


                        $mail->isHTML(true);
                        $mail->Subject = 'Pendencias Lavanderia';
                        $mail->Body    = $body;
                        $mail->AltBody = strip_tags($body);

                        //$mail->send();
                        echo "EMAIL ENVIADO!<hr>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }

        }


    }
}