<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

/**
 * @property string|null $id_department
 * @property string|null collaborator
 * @property string|null cpf
 * @property string|null id_type
 */
class Collaborator extends DataLayer
{
    public function __construct()
    {
        parent::__construct("collaborator", ["id_department", "id_type", "collaborator", "cpf"]);
    }

    public function department(): ?string
    {
        return ((new Department())->findById($this->id_department))->department;
    }

    public function type(): ?string
    {
        return ((new CollaboratorType())->findById((int)$this->id_type))->type;
    }

    public function amountPendencies(): ?int
    {
        return ((new Output())->find("id_collaborator LIKE {$this->id}")->count());
    }

    public function save(): bool
    {
        if (
            !$this->validateCPF()
            || !$this->validateCollaborator()
            || !parent::save()
            )
            return false;

        return true;
    }

    public function validateCPF(): bool
    {

        $cpf = $this->cpf;

        // Extrair somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se tem os 11 digitos:
        if (strlen($cpf) != 11) {
            $this->fail = new \PDOException("Necessário 11 dígitos para um CPF valido!");
            return false;
        }

        // Verificação para não haver numeros repetidos EX: 111.111.111-00
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $this->fail = new \PDOException("Números Repetido não vão te levar a lugar nem um!");
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $this->fail = new \PDOException("O CPF não é valido");
                return false;
            }
        }

        return true;

    }

    public function validateCollaborator(): bool
    {
        if(empty($this->collaborator)){
            $this->fail = new \PDOException("Informe um nome válido");
            return false;
        }

        $userByUser = $this->find("collaborator = :collaborator AND id_department = :dpt", "collaborator={$this->collaborator}&dpt={$this->id_department}")->count();
        if ($userByUser) {
            $this->fail = new \PDOException("O colaborador informado já está em uso");
            return false;
        }

        return true;
    }
}