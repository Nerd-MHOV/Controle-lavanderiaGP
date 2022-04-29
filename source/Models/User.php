<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

/**
 * Class User
 * @property mixed|string|null $first_name
 * @property mixed|string|null $last_name
 * @property mixed|string|null $email
 * @property mixed|string|null $user
 * @property false|mixed|string|null $passwd
 * @package Source\Models
 */
class User extends DataLayer
{
    /**
     * User constructor
     */
    public function __construct()
    {
        parent::__construct("users", ["first_name","last_name","email","user","passwd"]);
    }

    public function save(): bool
    {
        if(

            !$this->validateEmail()
            || !$this->validateUser()
            || !$this->validatePassword()
            || !parent::save()
        ){
            return false;
        }

        return true;
    }

    protected function validateUser(): bool
    {
        if(empty($this->user) || !filter_var($this->user, FILTER_DEFAULT)){
            $this->fail = new Exception("Informe um usuario válido");
            return false;
        }

        $userByUser = null;
        if (!$this->id) {
            $userByUser = $this->find("user = :user", "user={$this->user}")->count();
        } else {
            $userByUser = $this->find("user = :user AND id != :id", "user={$this->user}&id={$this->id}")->count();
        }

        if ($userByUser) {
            $this->fail = new Exception("O usuario informado já está em uso");
            return false;
        }

        return true;
    }

    protected function validateEmail(): bool
    {
        if(empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->fail = new Exception("Informe um e-mail válido");
            return false;
        }

        $userByEmail = null;
        if (!$this->id) {
            $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("O e-mail informado já está em uso");
            return false;
        }

        return true;
    }

    protected function validatePassword(): bool
    {
        if (empty($this->passwd) || strlen($this->passwd) < 5) {
            $this->fail = new Exception("Informe uma senha com pelo menos 5 caracteres");
            return false;
        }

        if (password_get_info($this->passwd)["algo"]) {
            return true;
        }

        $this->passwd = password_hash($this->passwd, PASSWORD_DEFAULT);
        return true;
    }


}