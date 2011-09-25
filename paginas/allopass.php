<?php
if(!(isset($_SESSION['login']) AND $wALLO == true))
{
	echo '<h2 style="color: #DF0101">Você precisa estar logado para visualizar esta página</h2>';
	echo '<a href="index.php?page=home">Vorta para Inicio</a>';
	die();
}

?>
<h1>comprar shop pontos </h2>
		<br><br>
		<p><center><?php require_once('inc/allopass.inc.php'); ?></center></p>