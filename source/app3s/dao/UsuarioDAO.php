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


        $sql = "UPDATE usuario
                SET
                nome = :nome,
                email = :email,
                login = :login,
                senha = :senha,
                nivel = :nivel,
                id_setor = :idSetor
                WHERE usuario.id = :id;";
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
        $sql = "SELECT usuario.id,
                usuario.nome,
                usuario.email,
                usuario.login,
                usuario.senha,
                usuario.nivel,
                usuario.id_setor FROM usuario
                WHERE usuario.id = :id
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
                $usuario->setNome($row['nome']);
                $usuario->setEmail($row['email']);
                $usuario->setLogin($row['login']);
                $usuario->setSenha($row['senha']);
                $usuario->setNivel($row['nivel']);
                $usuario->setIdSetor($row['id_setor']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $usuario;
    }
}
