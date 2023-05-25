<?php

/**
 * Classe feita para manipulação do objeto Usuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte
 */

namespace app3s\dao;

use PDO;
use PDOException;
use app3s\model\Usuario;

class UsuarioDAO extends DAO
{
    public function update(Usuario $usuario)
    {
        $id = $usuario->getId();


        $sql = "UPDATE users
                SET
                name = :nome,
                email = :email,
                login = :login,
                password = :senha,
                role = :nivel,
                division_id = :idSetor
                WHERE users.id = :id;";
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $login = $usuario->getLogin();
        $senha = $usuario->getSenha();
        $nivel = $usuario->getNivel();
        $idSetor = $usuario->getIdSetor();

        try {

            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
            $stmt->bindParam(":nivel", $nivel, PDO::PARAM_STR);
            $stmt->bindParam(":idSetor", $idSetor, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function fillById(Usuario $usuario)
    {

        $id = $usuario->getId();
        $sql = "SELECT users.id,
                users.name,
                users.email,
                users.login,
                users.password,
                users.role,
                users.division_id FROM users
                WHERE users.id = :id
                 LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);

            if (!$stmt) {
                echo "<br>Mensagem de erro retornada: " . $this->connection->errorInfo()[2] . "<br>";
            }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $usuario->setId($row['id']);
                $usuario->setNome($row['name']);
                $usuario->setEmail($row['email']);
                $usuario->setLogin($row['login']);
                $usuario->setSenha($row['password']);
                $usuario->setNivel($row['nivel']);
                $usuario->setIdSetor($row['id_setor']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $usuario;
    }
}
