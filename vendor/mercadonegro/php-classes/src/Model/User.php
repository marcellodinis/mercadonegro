<?php

namespace Mercadonegro\Model;

use \Mercadonegro\DB\Sql;
use \Mercadonegro\Model;

class User extends Model{ //Definir getters e setters para este model.

    const SESSION = "User";

        public static function login($login, $password)
        {

            $sql = new Sql();

            $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
                ":LOGIN"=>$login

            ));

            if (count($results) === 0)
            {
                throw new \Exception("O utilizador ou password não existe.");
            }
        
            $data = $results[0];

            if (password_verify($password, $data["despassword"]) === true)
            {
                $user = new User();

                $user->setData($data);

                $_SESSION[User::SESSION] = $user->getValues();

                return $user;

            } else {

                throw new \Exception("O utilizador ou password não existe.");

            }
        }

        public static function verifyLogin($inadmin = true)
        {
            if (

                !isset($_SESSION[User::SESSION])
                ||
                !$_SESSION[User::SESSION]
                ||
                !(int)$_SESSION[User::SESSION]["iduser"] > 0
                ||
                (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin

            ){
                header("Location: /mandachuva/login");
                exit;
        }
    }

    public static function logout()
    {
        $_SESSION[User::SESSION] = NULL;
    }
}
?>