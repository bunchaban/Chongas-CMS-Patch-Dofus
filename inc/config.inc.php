<?php

include ('db.inc.php');

$retour = mysql_query('SELECT * FROM live_config') or die(mysql_error());

while($donnees = mysql_fetch_array($retour))



$wTITRE = ''.$donnees['titulo'].'';
$link = ''.$donnees['link'].'';
$votelink = ''.$donnees['vote_link'].'';
$lDOFUS = ''.$donnees['dofus_link'].'';
$lCONFIGXML = ''.$donnees['config_link'].'';

/* ================================================== INICIO DAS CONFIGURAÇÕES ================================================== */


/* BASICO */
$vCONFIGXML = '0.1b';								// VERSÃO DO ARQUIVO CONFIG.XML OU PATCH
$tCONFIGXML = '356KB';								// TAMANHO DO ARQUIVO CONFIG.XML OU PATCH

/* INFORMAÇÕES */
$sIP = '127.0.0.1';									// IP DO SERVIDOR
$sPort = '444';										// PORTA DO SERVIDOR
$rXP2 = '20';										// EXP DO SERVIDOR [RATE]
$rDP2 = '5';										// DROP DO SERVIDOR [RATE]
$rKAMAS2 = '20';									// KAMAS DO SERVIDOR [RATE (DROP)]
$rHONOR = '5';										// PONTOS DE HONRA [RATE]
$rHONOR2 = '3';										// PONTOS DE HONRA [RATE]
$rPROF = '15';										// EXP PROFISSÃO [RATE]
$rPROF2 = '20';										// EXP PROFISSÃO [RATE]

$aPort = '5555';									// PORTA DE AÇÃO DO SERVIDOR. (Obs.: Mude apenas caso seja nescesario!)

/* CONFIGURAÇÕES DO SITE */
$startingPoint = 2;									// NÚMERO DE CASH ADQUIRIDO AO SE REGISTRAR
$wREGIP = 2;										// NÚMERO DE REGISTROS POR IP

$wNEWS = 14;										// NÚMERO DE NOTÍCIAS NA PÁGINA INICIAL
$wladder = 20;										// NUMERO DE PERSONAGENS ACADA PÁGINA DO RANKING

$levelUSER = 0;										// USUÁRIO
$levelVIP = 1;										// VIP
$levelMJ = 2;										// GM
$levelNEWS = 3;										// JORNALISTA
$levelADM = 4;										// ADMINISTRADOR


/* ================================================== FIM DAS CONFIGURAÇÕES ================================================== */
/* ================================================= NÃO ALTERE NADA A BAIXO ================================================= */



$withMJ = FALSE;
$wREG = TRUE;
$TOup = 3;
$TOxp = 10;
$TOkamas = 1;
$TOcapital = 1;
$TOspell = 1;
$TOrestat = 0;
$TOpa = 15;
$TOpm = 15;
$parcho = 120;
$TOparcho = 4;
$spell = 1;
$kamas = 10000;
$maxpab = 1;
$maxpmb = 1;
$wBoutique = TRUE;
$wLvlUp = TRUE;
$wXp = TRUE;
$wKamas = TRUE;
$wCapital = TRUE;
$wSpellPoint = TRUE;
$wObject = TRUE;
$wRestat = TRUE;
$wParcho = TRUE;
$wPa = TRUE;
$wPm = TRUE;
$alloPoint = 50;
$wALLO = false;
$alloIdentifiant = '';

?>