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
<title>Instalação &raquo; Parte 2</title>

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
    <link rel="stylesheet" type="text/css" href="style2.css"/>
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
<div style="float: left; margin: 100px 0px 50px 375px;">

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<td><form id="registrar" action="enviar.php" method="post"><big><big>

	<b style="color:#000; font-family:arial;"><label><br/><br/><br/><br/>NOME DO SERVIDOR:</label></b>
	<div class="r-esquerda">
	<input class="input_contato" type="text" name="nome_do_servidor" value="Digite aqui o nome do seu servidor."/>
	</div><br/>
	
	<b style="color:#000; font-family:arial;"><label>DOMINIO DO SITE:</label></b>
	<div class="r-esquerda">
	<input class="input_contato" type="text" name="link" value="Digite aqui o url ou ip de acesso ao site."/>
	</div><br/><br/>
	
	<b style="color:#000; font-family:arial;"><label>NOME DE USUÁRIO:</label></b>
	<div class="r-esquerda">
	<input class="input_contato2" type="text" name="usuario_admincp" value="Digite aqui um nome de usuário que tera acesso a todo o painel de administração."/>
	</div><br/>

	<b style="color:#000; font-family:arial;"><label>SENHA:</label></b>
	<div class="r-esquerda">
	<input class="input_contato2" type="text" name="senha_admincp" value="Digite aqui uma senha do usuário que tera acesso a todo o painel de administração."/>
	</div><br/>
	
	<b style="color:#000; font-family:arial;"><label>CONFIRMAR SENHA:</label></b>
	<div class="r-esquerda">
	<input class="input_contato2" type="text" name="senha2_admincp" value="Digite aqui novamente a senha do usuário que tera acesso a todo o painel de administração."/>
	</div><br/>
	
	<b style="color:#000; font-family:arial;"><label>ENDEREÇO DE EMAIL:</label></b>
	<div class="r-esquerda">
	<input class="input_contato2" type="text" name="email_admincp" value="Digite aqui um email valido do usuário que tera acesso a todo o painel de administração."/>
	</div><br/>
	
	<b style="color:#000; font-family:arial;"><label>PERGUNTA SECRETA:</label></b>
	<div class="r-esquerda">
	<input class="input_contato2" type="text" name="pergunta" value="Digite aqui uma pergunta secreta que sera usada para mudar senha e deletar personagens."/>
	</div><br/>
	
	<b style="color:#000; font-family:arial;"><label>RESPOSTA SECRETA:</label></b>
	<div class="r-esquerda">
	<input class="input_contato2" type="text" name="resposta" value="Digite aqui a resposta para a pergunta secreta."/>
	</div><br/><br/>
	
	<b style="color:#000; font-family:arial;"><label>VOTE LINK:</label></b>
	<div class="r-esquerda">
	<input class="input_contato3" type="text" name="vote_link" value="Digite aqui o link para votar no seu servidor no TOP DPServers."/>
	</div><br/>
	
	<b style="color:#000; font-family:arial;"><label>DOFUS LINK:</label></b>
	<div class="r-esquerda">
	<input class="input_contato3" type="text" value="http://www.4shared.com/file/JtgGG5Ys/Dofus_Installer_129.html" name="dofus_link"/>
	</div><br/>
	
	<b style="color:#000; font-family:arial;"><label>CONFIG LINK:</label></b>
	<div class="r-esquerda">
	<input class="input_contato3" type="text" name="config_link" value="Digite aqui o link ou diretorio de download do arquivo config.xml"/>
	</div><br/>
	
	
	<input class="botoes_input" type="submit" value="PROXIMA ETAPA" name="ok">
	
</big></big><br/><br/><small><p><b></p></small></form></td>

</div>
</table>
</td>
</tr>
</body>
</html>