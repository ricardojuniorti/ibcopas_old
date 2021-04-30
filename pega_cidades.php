<?php
require_once ("conexao.php");
require_once ("funcoes.php");
header("Content-type: text/html; charset=utf-8");

$pega_cidades = $dbh->query("SELECT ID,
							  NOME	
							  FROM TB_CIDADES
							  WHERE ESTADO = '".$_POST['id']."' 
							  ORDER BY NOME");

foreach($pega_cidades as $pega_cidade){
	echo '<option value="'.$pega_cidade['ID'].'">'.$pega_cidade['NOME'].'</option>';
}

?>