<?php
session_start();
require_once('inc/config.inc.php');
require_once('inc/functions.inc.php');
require_once('inc/online.inc.php');
require_once('inc/socket.inc.php');
$statutSERV = statut(1);
$statutDB = statut(0);
?>
<html>
<head>
<meta name="verify-v1" content="aWCA15ScxrD76iI99t0EBJa7w6FKsnQg0h0d9jSnvz8=" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php 
if($wTITRE != NULL)
{
echo $wTITRE;
}
else
{
echo "Titulo";
}
?>
 </title>
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
<link rel="shortcut icon" href="imagens/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/switcher.js"></script>
<script type="text/javascript" src="js/boxtext.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td id="topsite" align="right" valign="bottom"><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" id="switch-color">
<?php
include('inc/db.inc.php');

$retour = mysql_query('SELECT * FROM live_publicidade ORDER BY id DESC LIMIT 0, 1') or die(mysql_error());
while ($donnees = mysql_fetch_array($retour))
{

echo''.$donnees['contenu'].'';

}
?>
</td>
</tr>
</table></td>
</tr>
<tr>
<td><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="menu_home"><a href="?page=home">&nbsp;</a></td>
<td id="menu_registro"><a href="?page=register">&nbsp;</a></td>
<td id="menu_downloads"><a href="?page=downloads">&nbsp;</a></td>
<td id="menu_doacao"><a href="?page=vip">&nbsp;</a></td>
<td id="menu_ranking"><a href="?page=ladder">&nbsp;</a></td>
<td id="menu_contato"><a href="?page=contato">&nbsp;</a></td>
<td id="menu_branco"><a>&nbsp;</a></td>
<?php if ($statutSERV == TRUE) { echo '<td id="menu_on">&nbsp;</td>'; } else { echo '<td id="menu_off">&nbsp;</td>';}?>
</tr>
</table></td>
</tr>
<tr>
<td id="fullsite"><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top">
<table width="190" border="0" cellspacing="0" cellpadding="0">
<?php
if(isset($_SESSION['login']) AND isset($_SESSION['level']))
{ ?>
<tr>
<td id="menu-cinza2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - <small style="text-transform:capitalize; color:black;"><?php echo ''.$_SESSION['login'].''; ?></small></b></td>
</tr>
<tr>
<td id="menu-cinza"><a href="?page=infos">Minhas Informações</a></td>
</tr>
<tr>
<td id="menu-cinza"><a href="?page=bugreporter">Reportar Bug</a></td>
</tr>
<!-- NEWS -->
<?php if($_SESSION['level'] >= $levelNEWS){ ?>
<tr>
<td id="menu-cinza"><a href="?page=news&amp;add">Adicionar Notícia</a></td>
</tr>
<tr>
<td id="menu-cinza"><a href="?page=news">Gerênciar Notícias</a></td>
</tr>
<?php  } ?>
<!-- ADMIN -->
<?php if($_SESSION['level'] >= $levelADM) { ?>
<tr>
<td id="menu-cinza"><a href="?page=publicidade">Gerenciar Publicidade</a></td>
</tr>
<tr>
<td id="menu-cinza"><a href="?page=admbugtrack">Verificar Bugs</a></td>
</tr>
<tr>
<td id="menu-cinza"><a href="?page=ver_contato">Verificar Contato</a></td>
</tr>
<?php } ?>
<tr>
<td id="menu-branco"><a href="?page=logout">Sair</a><br/></td>
</tr>
<?php
}
else
{
?>
<tr>
<td id="menu-cinza2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
</tr>
<tr>
<td id="login">
<b>
<form action="?page=login" method="post" style="float:right; padding-right:17px;">
<span style="float:left; padding-top:3px; color:black;">USUÁRIO:</span>
<input name="login" type="text" class="connectcase" value=""/>
<span style="float:left; padding-top:7px; color:black;">SENHA:</span>
<input name="passlog" type="password" class="connectcase" value=""/>
<input name="hidden" type="hidden" value="log"/>
<input name="logon" type="submit" value=" " id="enviar_login" style="float:left; padding-bottom:20px; border:0;"/><a href="index.php?page=register" style="color: #000; float:right; padding-right:3px; padding-top:7px;">REGISTRE-SE <big>&raquo;</big></a>
</form>
</b>
<br/></td>
</tr>
<?php } ?>
</table>
<table width="190" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="menu-cinza2_tofu"><b>&nbsp;</b></td>
</tr>
<tr>
<td id="menu-cinza3">Contas Criadas: <?php $nb_comptes=mysql_num_rows(mysql_query("select * FROM accounts")); echo $nb_comptes;?></td>
</tr>
<tr>
<td id="menu-branco2">Personagens Criados: <?php $nb_persos=mysql_num_rows(mysql_query("select * FROM personnages")); echo $nb_persos; ?></td>
</tr>
</table>
<br/>
<table width="190" border="0" cellspacing="0" cellpadding="0">
<tr>
<td id="menu-cinza2_esquilo"><b>&nbsp;</b></td>
</tr>
<tr>
<td id="vote"><a href="vote.php" target="_blank"></a></td>
</tr>
</table>
</td>
<td id="pontilhado_pe">&nbsp;</td>
<!-- //// [INICIO] CONTEÚDO //// -->
<div id="rank_limitador">
<td valign="top"><table border="0" cellspacing="0" cellpadding="0">
<?php
define('SECU', true);
if(isset($_GET['page'])){
$_GET['page'] = secu($_GET['page']);}
if (isset($_GET['page']) && file_exists('paginas/'.$_GET['page'].'.php'))
{

include('paginas/'.$_GET['page'].'.php');
}
else{
include('paginas/home.php');
}
?>

</table></td>
<!-- //// [FIM] CONTEÚDO //// -->
</div>
</tr>
</table>
</td>
</tr>
</table>
<?php echo $footer; ?>
</body>
</html>