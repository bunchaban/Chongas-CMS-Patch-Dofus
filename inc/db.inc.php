<?php

$user = 'root';							// NOME DE USU�RIO SQL (Padr�o: root)
$pass = '';							// SENHA SQL (Padr�o:  )
$ancestra_other = 'dofuslinos';				// NOME DO BANCO DE DADOS "OTHER"
$dbSTATIC = 'dofuslinos2';						// NOME DO BANCO DE DADOS "STATICS"

// ================================================================================================

$host = 'localhost';			// ENDERE�O DO BANCO DE DADOS (Padr�o: localhost)
$port = "444";					// PORTA DO SERVIDOR

// ================================================================================================

/* N�O ALTERE ABAIXO */
$connect = TRUE;
$dbLOG = mysql_connect( $host, $user, $pass );
$dbON = mysql_select_db( $ancestra_other, $dbLOG );

?>