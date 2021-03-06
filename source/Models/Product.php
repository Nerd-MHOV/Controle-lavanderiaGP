<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\DataLayer\Connect;
use PDO;

class Product extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product", ["status", "id_department", "id_product_type", "id_product_service", "product", "size", "unitary_value"]);
    }

    public function productType()
    {
        return (new ProductType())->findById($this->id_product_type);
    }

    public function productService()
    {
        return (new ProductService())->findById($this->id_product_service);
    }

    public function department()
    {
        return (new Department())->findById($this->id_department);
    }

    public function inInventory(): ?int
    {
        return ((new Inventory())
                ->find("id_product = :product", "product={$this->id}")
                ->fetch())->amount ?? 0;
    }

    public function inOutput(): ?int
    {
        $num = (new Output())->find("id_product = :product", "product={$this->id}")->fetch(true);
        $valor = 0;
        if (!empty($num)) {
            foreach ($num as $n) {
                $valor = $valor + $n->amount;
            }
        }
        return $valor;
    }

    public function amountOutInv(): ?int
    {
        return ($this->inInventory() + $this->inOutput());
    }

    public function search(string $search)
    {
        $connect = Connect::getInstance(DATA_LAYER_CONFIG);
        $products = $connect->query("
        SELECT p.id, p.size, p.product, pt.product_type, ps.service, d.department, p.status, p.unitary_value
        FROM product AS p 
        INNER JOIN product_type AS pt ON p.id_product_type = pt.id 
        INNER JOIN product_service AS ps ON p.id_product_service = ps.id      
        INNER JOIN department AS d ON p.id_department = d.id
        WHERE p.product LIKE '%{$search}%'
        OR pt.product_type LIKE '%{$search}%'
        OR ps.service LIKE '%{$search}%'
        OR d.department LIKE '%{$search}%'
        OR p.size LIKE '%{$search}%'
        OR p.unitary_value LIKE '%{$search}%'
        ");
        $return = ($products->fetchAll(PDO::FETCH_OBJ));

        return $return;
    }

    public function searchOutputsCollaborator(string $search)
    {
        $connect = Connect::getInstance(DATA_LAYER_CONFIG);
        $products = $connect->query("
        SELECT o.id, o.created_at, c.collaborator, d.department, p.product, p.size, pt.product_type, ps.service
        FROM output o 
        INNER JOIN collaborator c ON o.id_collaborator = c.id 
        INNER JOIN department d on o.id_department = d.id
        INNER JOIN product p on o.id_product = p.id
        INNER JOIN product_type pt on p.id_product_type = pt.id
        INNER JOIN product_service ps on p.id_product_service = ps.id
        WHERE o.id_collaborator != 0
        AND (o.created_at LIKE '%{$search}%'
        OR c.collaborator LIKE '%{$search}%'
        OR d.department LIKE '%{$search}%'
        OR p.product LIKE '%{$search}%'
        OR p.size LIKE '%{$search}%'
        OR pt.product_type LIKE '%{$search}%'
        OR ps.service LIKE '%{$search}%')
        ");
        $return = ($products->fetchAll(PDO::FETCH_OBJ));

        return $return;
    }

    public function searchOutputsDepartment(string $search)
    {
        $connect = Connect::getInstance(DATA_LAYER_CONFIG);
        $products = $connect->query("
        SELECT o.id, o.created_at, o.amount, c.collaborator, d.department, p.product, p.size, pt.product_type, ps.service
        FROM output o 
        INNER JOIN collaborator c ON o.id_collaborator = c.id 
        INNER JOIN department d on o.id_department = d.id
        INNER JOIN product p on o.id_product = p.id
        INNER JOIN product_type pt on p.id_product_type = pt.id
        INNER JOIN product_service ps on p.id_product_service = ps.id
        WHERE o.id_collaborator = 0
        AND (o.created_at LIKE '%{$search}%'
        OR c.collaborator LIKE '%{$search}%'
        OR d.department LIKE '%{$search}%'
        OR p.product LIKE '%{$search}%'
        OR p.size LIKE '%{$search}%'
        OR pt.product_type LIKE '%{$search}%'
        OR ps.service LIKE '%{$search}%')
        ");
        $return = ($products->fetchAll(PDO::FETCH_OBJ));

        return $return;
    }
}