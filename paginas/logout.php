<?php

if (!defined('SECU'))
	{
		die();
	}
   if(isset($_SESSION['login']) OR isset($_SESSION['level']))
    {
	session_unset();
	session_destroy();
	$_SESSION['lastcomment'] = time();
	$out = TRUE; ?>
	<meta http-equiv="refresh" content="0; URL=./index.php?page=home">
	<?php }
	else
	{
	$out = FALSE;
	}
?>
<tr><td id="not_title">Desconectando-se, aguarde...</td></tr>