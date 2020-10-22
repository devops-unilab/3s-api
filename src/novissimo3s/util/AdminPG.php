<?php

namespace novissimo3s\util;
use PDO;

/**
 * 
 * @author Jefferson Uchoa Ponte
 * Ferramenta para programador para facilitar manipulação de banco de dados postgres. 
 *
 */
class AdminPG
{

    private $conexao;

    public static function main(PDO $conexao)
    {
        $adminPG = new AdminPG();
        $adminPG->aplicacao($conexao);
    }

    public function comandos()
    {
        $consulta = "";
        if(isset($_POST['consulta'])){
            $consulta = $_POST['consulta'];    
        }
        
        echo '<br>
            <form action="" method="post">
                <div class="form-group">
                    <label for="consulta">Consulta</label><br>
                    <textarea class="form-control" id="consulta" name="consulta" rows="3">'.$consulta.'</textarea>
                </div>
                
                <input type="submit" class="btn btn-primary" name="enviar">
            </form><hr>';
        if (! isset($_POST['consulta'])) {
            return;
        }
        $consulta = $_POST['consulta'];
        $comandos = explode(";", $consulta);
        
        if(count($comandos) == 0){
            return;
        }
        foreach($comandos as $comando){
            $this->comandoSql($comando);
        }
        echo "<hr>";
    }

    public function comandoSql($comando){
        $comando = trim($comando);
        if(strlen($comando) == 0){
            return;
        }

        
        if(strtolower(substr($comando, 0, 4)) == 'drop'){
            $this->selecao($comando);
            return;
        }
        if(strtolower(substr($comando, 0, 5)) == 'alter'){
            echo "Altert";
            $this->execucao($comando);
            return;
        }
        if(strtolower(substr($comando, 0, 5)) == 'delet'){
            $this->execucao($comando);
            return;
        }
        if(strtolower(substr($comando, 0, 6)) == 'select'){
            $this->selecao($comando);
            return;
        }
        if(strtolower(substr($comando, 0, 6)) == 'create'){
            $this->execucao($comando);
            return;
        }
        if(strtolower(substr($comando, 0, 6)) == 'insert'){
            $this->execucao($comando);
            return;
        }
        if(strtolower(substr($comando, 0, 6)) == 'update'){
            $this->execucao($comando);
            return;
        }
        
        

    }
    public function execucao($statement){
        echo '<br><p>Execucao: '.$statement.'</p>';
        echo $this->conexao->exec($statement);
        echo '<br>';
        if($this->conexao->errorInfo()[2] != null){
            echo "Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<br>";  
            echo "<br>";
        }
        echo '<hr>';
        
    }
    public function selecao($statement)
    {
        
        echo '<p>Consulta: '.$statement.'</p>';
        $i = 0;
        $result = $this->conexao->query($statement);
        if($this->conexao->errorInfo()[2] != null){
            echo "Mensagem de erro retornada: ".$this->conexao->errorInfo()[2]."<hr>";  
            return;
        }
        
        echo '<table border=1>';
        foreach ($result as $linha) {
            if ($i == 0) {
                echo '<tr>';
                foreach ($linha as $chave => $valor) {
                    if (!is_int($chave)){
                        echo '<th>' . $chave . '</th>';
                    }
                }
                echo '</tr>';
                $i++;
            }
            echo '<tr>';
            foreach ($linha as $chave => $valor) {
                if (! is_int($chave)){
                    echo '<td>' . $valor . '</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '<hr>';
    }

    
    public function aplicacao(PDO $conexao)
    {
        $this->conexao = $conexao;
        $this->comandos();
        $sql = "SELECT schemaname AS esquema, tablename AS tabela, tableowner AS dono 
				FROM pg_catalog.pg_tables
				WHERE schemaname NOT IN ('pg_catalog', 'information_schema', 'pg_toast')
				ORDER BY schemaname, tablename";
        $result = $conexao->query($sql);

        foreach ($result as $linha) {

            $nomeDaTabela = $linha['tabela'];
            echo '<h1>' . $nomeDaTabela . '</h1>';
            $sqlColunas = "select
			c.relname,
			a.attname as column,
			pg_catalog.format_type(a.atttypid, a.atttypmod) as datatype
		
			from pg_catalog.pg_attribute a
			inner join pg_stat_user_tables c on a.attrelid = c.relid
			WHERE
			c.relname = '$nomeDaTabela' AND
			a.attnum > 0
			AND NOT a.attisdropped
			";
            $resultDasColunas = $conexao->query($sqlColunas);
            foreach ($resultDasColunas as $linhaDasColunas) {
                echo $linhaDasColunas['column'] . ' | ' . $linhaDasColunas['datatype'] . '<br>';
            }

            $sqlPK = "SELECT a.attname AS chave_pk
            FROM pg_class c
              INNER JOIN pg_attribute a ON (c.oid = a.attrelid)
              INNER JOIN pg_index i ON (c.oid = i.indrelid)
            WHERE
              i.indkey[0] = a.attnum AND
              i.indisprimary = 't' AND
              c.relname = '$nomeDaTabela'";

            $resultPK = $conexao->query($sqlPK);
            foreach ($resultPK as $linhaPK) {
                echo '<p>PK: <b>' . $linhaPK['chave_pk'] . '</b></p>';
            }

            $sqlChaves = "SELECT   
            a.attname AS atributo,   
            clf.relname AS tabela_ref,   
            af.attname AS atributo_ref   
            FROM pg_catalog.pg_attribute a   
            JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')
            JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)   
            JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND   
            ct.confrelid != 0 AND ct.conkey[1] = a.attnum)   
            JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND clf.relkind = 'r')
            JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace)   
            JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND   
            af.attnum = ct.confkey[1])   
            WHERE   
            cl.relname = '$nomeDaTabela'";
            $resultChaves = $conexao->query($sqlChaves);
            foreach ($resultChaves as $linhaChaves) {
                echo '<p>FK: <b>' . $linhaChaves['atributo'] . ' - ' . $linhaChaves['tabela_ref'] . '(' . $linhaChaves['atributo_ref'] . ')' . '</b></p>';
            }

            $n = 10;

            echo '<br>' . $n . ' primeiros dados<br>';
            $sqlPrimeirosDados = "SELECT * FROM $nomeDaTabela LIMIT $n";
            $resultPrimeirosDados = $conexao->query($sqlPrimeirosDados);
            $i = 0;
            echo '<table border=1>';
            foreach ($resultPrimeirosDados as $linhaPrimeirosDados) {

                if (! $i) {
                    echo '<tr>';
                    foreach ($linhaPrimeirosDados as $chave => $valor) {
                        if (! is_int($chave))
                            echo '<th>' . $chave . '</th>';
                    }
                    echo '</tr>';
                    $i ++;
                }
                echo '<tr>';
                foreach ($linhaPrimeirosDados as $chave => $valor) {
                    if (! is_int($chave))
                        echo '<td>' . $valor . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';

            echo '<hr>';
        }

        echo '<br><br>';
    }

    public function exportarDados()
    {
        $sequencias = array();
        
        $conexao = $this->conexao;

        $sql = "SELECT schemaname AS esquema, tablename AS tabela, tableowner AS dono
				FROM pg_catalog.pg_tables
				WHERE schemaname NOT IN ('pg_catalog', 'information_schema', 'pg_toast')
				ORDER BY schemaname, tablename";
        $result = $conexao->query($sql);

        foreach ($result as $linha) {

            $nomeDaTabela = $linha['tabela'];
            $sqlColunas = "select
			c.relname,
			a.attname as column,
			pg_catalog.format_type(a.atttypid, a.atttypmod) as datatype
			
			from pg_catalog.pg_attribute a
			inner join pg_stat_user_tables c on a.attrelid = c.relid
			WHERE
			c.relname = '$nomeDaTabela' AND
			a.attnum > 0
			AND NOT a.attisdropped
			";
            $resultDasColunas = $this->conexao->query($sqlColunas);
            foreach ($resultDasColunas as $linhaDasColunas) {
                // echo $linhaDasColunas['column'].' | '.$linhaDasColunas['datatype'].'<br>';
            }

            $sqlPK = "SELECT a.attname AS chave_pk
            FROM pg_class c
              INNER JOIN pg_attribute a ON (c.oid = a.attrelid)
              INNER JOIN pg_index i ON (c.oid = i.indrelid)
            WHERE
              i.indkey[0] = a.attnum AND
              i.indisprimary = 't' AND
              c.relname = '$nomeDaTabela'";

            $resultPK = $this->conexao->query($sqlPK);
            foreach ($resultPK as $linhaPK) {
                $pk = $linhaPK['chave_pk'];
            }

            $sqlChaves = "SELECT
            a.attname AS atributo,
            clf.relname AS tabela_ref,
            af.attname AS atributo_ref
            FROM pg_catalog.pg_attribute a
            JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')
            JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)
            JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND
            ct.confrelid != 0 AND ct.conkey[1] = a.attnum)
            JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND clf.relkind = 'r')
            JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace)
            JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND
            af.attnum = ct.confkey[1])
            WHERE
            cl.relname = '$nomeDaTabela'";
            $resultChaves = $this->conexao->query($sqlChaves);
            foreach ($resultChaves as $linhaChaves) {
                // echo '<p>FK: <b>'.$linhaChaves['atributo'].' - '.$linhaChaves['tabela_ref'].'('.$linhaChaves['atributo_ref'].')'.'</b></p>';
            }

            $n = 2000;

            $sqlPrimeirosDados = "SELECT * FROM $nomeDaTabela ORDER BY $pk ASC LIMIT $n";
            $resultPrimeirosDados = $this->conexao->query($sqlPrimeirosDados);

            echo "\n\n\n";

            foreach ($resultPrimeirosDados as $linhaPrimeirosDados) {

                echo "INSERT INTO $nomeDaTabela VALUES (";
                $lista = array();
                foreach ($linhaPrimeirosDados as $chave => $valor) {

                    if (! is_int($chave)) {
                        if ($valor == null) {
                            $lista[] = "NULL";
                        } else if (! is_numeric($valor)) {
                            $lista[] = "'$valor'";
                        } else {
                            $lista[] = "$valor";
                        }
                    }
                    $ultimoPK = $linhaPrimeirosDados[$pk];
                }
                $teste = implode(', ', $lista);
                echo $teste . ");\n";
            }

            $ultimoPK ++;
            $sequencias[] = "ALTER SEQUENCE " . $nomeDaTabela . "_" . $pk . "_seq RESTART WITH $ultimoPK;";
        }
        echo "\n\n\n";
        echo implode("\n", $sequencias);
    }

    public function criarTabelas($strFileSql)
    {

        $arquivo = fopen($strFileSql, 'r');
        $conteudo = "";
        while (! feof($arquivo)) {
            $conteudo .= fgets($arquivo, 1024);
        }

        $lista = explode(";", $conteudo);
        foreach ($lista as $sql) {
            if ($sql != "") {
                echo $sql . '<br><hr>';
            }
            if ($this->conexao->exec($sql)) {
                echo "Sucesso";
            } else {
                echo "Fracasso";
            }
        }
        fclose($arquivo);
    }
}