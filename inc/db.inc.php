<?php

$user = 'root';							// NOME DE USUÀRIO SQL (Padrão: root)
$pass = '';							// SENHA SQL (Padrão:  )
$ancestra_other = 'dofuslinos';				// NOME DO BANCO DE DADOS "OTHER"
$dbSTATIC = 'dofuslinos2';						// NOME DO BANCO DE DADOS "STATICS"

// ================================================================================================

$host = 'localhost';			// ENDEREÇO DO BANCO DE DADOS (Padrão: localhost)
$port = "444";					// PORTA DO SERVIDOR

// ================================================================================================

/* NÂO ALTERE ABAIXO */
$connect = TRUE;
$dbLOG = mysql_connect( $host, $user, $pass );
$dbON = mysql_select_db( $ancestra_other, $dbLOG );

?>