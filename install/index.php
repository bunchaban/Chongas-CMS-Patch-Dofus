<?php

require ('../inc/db.inc.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="aWCA15ScxrD76iI99t0EBJa7w6FKsnQg0h0d9jSnvz8=" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Instalação &raquo; Etapa 1</title>

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
    <link rel="stylesheet" type="text/css" href="style.css"/>
    
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
<div style="margin: 250px 0px 0px 30px;"><center><big><big><big>

<?php

mysql_query("

CREATE TABLE IF NOT EXISTS `live_action` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerID` int(11) NOT NULL,
  `Action` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_query("

CREATE TABLE IF NOT EXISTS `live_commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(40) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `incommento` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_query("

CREATE TABLE IF NOT EXISTS `live_config` (
  `titulo` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `link` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dofus_link` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `config_link` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `vote_link` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `user` VARCHAR( 255 ) NOT NULL,
  `pass` VARCHAR( 255 ) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_query("

CREATE TABLE IF NOT EXISTS `live_gb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_query("

CREATE TABLE IF NOT EXISTS `live_news` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(30) DEFAULT NULL,
  `titre` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contenu` text NOT NULL,
  `icon` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_query("

CREATE TABLE IF NOT EXISTS `live_publicidade` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `titre` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contenu` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `icon` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_query("

CREATE TABLE IF NOT EXISTS `live_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `lu` int(1) NOT NULL,
  `repondu` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_query("

CREATE TABLE IF NOT EXISTS `live_tracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) DEFAULT NULL,
  `mapid` int(6) DEFAULT NULL,
  `cellid` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

") or die ("<b style='font-family:arial;'>Todas as tabelas ja foram criadas<i style='color:red;'>!</i><br/><a href='install.php' style='color:yellow; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>");

mysql_close();
echo "<b style='font-family:arial;'>Tabelas criadas com sucesso<i style='color:red;'>!</i><br/><a href='install.php' style='color:orange; text-decoration:none;'>Ir para a proxima etapa &raquo;</a></b>";

?>

</big></big></big></div></center>
</table>
</td>
</tr>
</body>
</html>