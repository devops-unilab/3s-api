<?php
/**
 * 
 * @author Jefferson Uchoa Ponte
 * Ferramenta para programador para facilitar manipulação de banco de dados postgres. 
 *
 */
class AdminPG{
	public static function main(){
		

		$dao = new DAO();
		$conexao = $dao->getConexao();
		
		$sql = "SELECT schemaname AS esquema, tablename AS tabela, tableowner AS dono 
				FROM pg_catalog.pg_tables
				WHERE schemaname NOT IN ('pg_catalog', 'information_schema', 'pg_toast')
				ORDER BY schemaname, tablename";
		$result = $conexao->query($sql);
		
		foreach($result as $linha){
		
		
			$nomeDaTabela =  $linha['tabela'];
			echo '<h1>'.$nomeDaTabela.'</h1>';
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
			$resultDasColunas = $dao->getConexao()->query($sqlColunas);
			foreach ($resultDasColunas as $linhaDasColunas){
				echo $linhaDasColunas['column'].' | '.$linhaDasColunas['datatype'].'<br>';
			}
			$n = 30;
		
			echo '<br>'.$n.' primeiros dados<br>';
			$sqlPrimeirosDados = "SELECT * FROM $nomeDaTabela LIMIT $n";
			$resultPrimeirosDados = $dao->getConexao()->query($sqlPrimeirosDados);
			$i = 0;
			echo '<table border=1>';
			foreach ($resultPrimeirosDados as $linhaPrimeirosDados){
		
				if(!$i){
					echo '<tr>';
					foreach ($linhaPrimeirosDados as $chave => $valor){
						if(!is_int($chave))
							echo '<th>'.$chave.'</th>';
					}
					echo '</tr>';
					$i++;
		
				}
				echo '<tr>';
				foreach ($linhaPrimeirosDados as $chave => $valor){
					if(!is_int($chave))
						echo '<td>'.$valor.'</td>';
				}
				echo '</tr>';
		
			}
			echo '</table>';
		
			echo '<hr>';
		
		
		
		}
		
		echo '<br><br>';
		
	}	
}
?>