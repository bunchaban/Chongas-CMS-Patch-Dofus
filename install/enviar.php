<?php
session_start();
require_once('../inc/config.inc.php');
require_once('../inc/functions.inc.php');
require_once('../inc/online.inc.php');
require_once('../inc/socket.inc.php');
$statutSERV = statut(1);
$statutDB = statut(0);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="aWCA15ScxrD76iI99t0EBJa7w6FKsnQg0h0d9jSnvz8=" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Instalação &raquo; Etapa Final</title>

    <meta name="generator" content="©ChongasCMS!" />
    <meta name="keywords" content="chongas, cms, chongascms, dpservers, dofus, dofusbr, br, website, dps, private" />
    <meta name="author" content="Chongas" />
    <meta name="Audience" content="all" />
    <meta name="revisit-after" content="1 days" />
    <meta name="language" content="pt-BR" />
    <meta name="rating" content="general" />
    <meta name="robots" content="ALL, follow" />
    <meta name="googlebot" content="ALL" />
    <meta name="classification" content="Game, Jogos, Downloads, Diversão" />
    <meta name="distribution" content="global" />
    <meta name="expires" content="0" />
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
    <meta http-equiv="reply-to" content="suporte.nfx@gmail.com" />
    
	<link rel="shortcut icon" href="../imagens/favicon.ico">
    <link rel="stylesheet" type="text/css" href="style3.css"/>
    <link rel="stylesheet" href="../css/lightbox.css" type="text/css" media="screen" />
    
	<script type="text/javascript" src="../js/switcher.js"></script>
    <script type="text/javascript" src="../js/boxtext.js"></script>
	<script type="text/javascript" src="../js/prototype.js"></script>
	<script type="text/javascript" src="../js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="../js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="../js/lightbox.js"></script>
	
</head>

<body>
<tr>
<td id="not_content" class="comment" >
<table border="0" cellpadding="0" cellspacing="1" width="689">
<div style="float: left; margin: 255px 0px 0px 480px;"><center><big><big><big>

<?php

	
if(isset($_POST['ok'])) 
{
$nome_do_servidor = mysql_real_escape_string(htmlspecialchars(trim($_POST['nome_do_servidor']) ) );
$usuario_admincp = mysql_real_escape_string(htmlspecialchars(trim($_POST['usuario_admincp']) ) );
$senha_admincp = mysql_real_escape_string(htmlspecialchars(trim($_POST['senha_admincp']) ) );
$senha2_admincp = mysql_real_escape_string(htmlspecialchars(trim($_POST['senha2_admincp']) ) );
$email_admincp = mysql_real_escape_string(htmlspecialchars(trim($_POST['email_admincp']) ) );
$dofus_link = mysql_real_escape_string(htmlspecialchars(trim($_POST['dofus_link']) ) );
$config_link = mysql_real_escape_string(htmlspecialchars(trim($_POST['config_link']) ) );
$vote_link = mysql_real_escape_string(htmlspecialchars(trim($_POST['vote_link']) ) );
$url_do_servidor = mysql_real_escape_string(htmlspecialchars(trim($_POST['link']) ) );
$pergunta = mysql_real_escape_string(htmlspecialchars(trim($_POST['pergunta']) ) );
$resposta = mysql_real_escape_string(htmlspecialchars(trim($_POST['resposta']) ) );

if ($senha_admincp != $senha2_admincp)
{
echo ("As senhas digitadas não são iguais.<br/>Tente novamente, <a href='install.php' style='color:#000; text-decoration:none;'>Voltar</a>.");
}
else if (!$_POST['nome_do_servidor'] || !$_POST['usuario_admincp'] || !$_POST['senha_admincp'] || !$_POST['senha2_admincp'] || !$_POST['email_admincp'])
{
echo ("Preencha todos os campos corretamente.<br/>Tente novamente, <a href='install.php' style='color:#000; text-decoration:none;'>Voltar</a>.");
}

else
{
echo ("ChongasCMS foi instalado com sucesso!<br>Delete, mova ou renomeie a pasta <span style='color:red;'>Install</span><br/><br/><a href='../index.php?page=home' style='color:#000; text-decoration:none;'><small><small>VISUALIZAR WEBSITE</small> &raquo;</small></a>");

mysql_query("INSERT INTO live_config 
(
titulo, link, dofus_link, config_link, vote_link, user, pass
) 
VALUES 
(
'$nome_do_servidor', '$url_do_servidor', '$dofus_link', '$config_link', '$vote_link', '$usuario_admincp', '$senha_admincp'
)") or die (mysql_error() );

mysql_query("

INSERT INTO accounts 
(
account, pass, email, question, reponse, level
) 
VALUES 
(
'".secu($_POST['usuario_admincp'])."', '".encrypt(secu($_POST['senha_admincp']))."', '".secu($_POST['email_admincp'])."', '".secu($_POST['pergunta'])."', '".secu($_POST['resposta'])."', '4'
)

") or die (mysql_error() );



}
}
?>

</big></big></big></div></center>
</table>
</td>
</tr>
</body>
</html>