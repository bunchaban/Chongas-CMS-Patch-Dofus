<?php

function SockAddObject($idPerso,$idItem,$max,$nombre)
{	
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = ($max)? "ZO:21:$nombre:$idItem:$idPerso;" : "ZO:20:$nombre:$idItem:$idPerso;";
		fwrite($sock, $toSend);
	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}

function SockAddXp($idPerso,$nbxp)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:2:$nbxp:$idPerso;";
		fwrite($sock, $toSend);
	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function SockAddKamas($idPerso,$nbkamas)
{

	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:3:$nbkamas:$idPerso;";
		fwrite($sock, $toSend);
            mysql_query('UPDATE personnages SET kamas=kamas+1000000 WHERE  guid='.$idPerso);
		echo mysql_error();

	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function SockAddCapital($idPerso,$nbcapital)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:4:$nbcapital:$idPerso;";
		fwrite($sock, $toSend);
	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function SockAddSpellPoint($idPerso,$nbspell)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:5:$nbspell:$idPerso;";
		fwrite($sock, $toSend);
	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function SockLevelUp($idPerso)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:1:1:$idPerso;";
		fwrite($sock, $toSend);
	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function SockRestat($idPerso)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:22:1:$idPerso;";
		fwrite($sock, $toSend);
	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function SockAddPa($idPerso)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:7:1:$idPerso;";
		fwrite($sock,$toSend);
		mysql_query('UPDATE personnages SET pa=pa+1 WHERE  guid='.$idPerso);
		echo mysql_error();
	}
	else
	{
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function SockAddPm($idPerso)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:8:1:$idPerso;";
		fwrite($sock,$toSend);
		mysql_query('UPDATE personnages SET pm=pm+1 WHERE  guid='.$idPerso);
		echo mysql_error();
	}
	else
	{
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
function parcho($idPerso, $parcho)
{
	include('config.inc.php');
	if ($sock = fsockopen($sIP, $aPort, $ERRNO, $ERRSTR ))
	{
		$toSend = "ZA:23:$parcho:$idPerso;";
		fwrite($sock, $toSend);
	}
	else
	{ 
		fclose($sock);
		return $ERRSTR;
	}
	
	fclose($sock);
	return TRUE;
}
?>