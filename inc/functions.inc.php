<?php


function secu($var)
{
	//$var = htmlentities( trim( $var, " \0" ), ENT_NOQUOTES );
    //$var = mysql_real_escape_string( $var );
    return mysql_real_escape_string(htmlspecialchars($var));
}

function numtable($table)
{
$query = 'SELECT id FROM ' . $table . ' ORDER BY id DESC;';
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
return mysql_num_rows($sql);
}

function numladder($table, $withMJ, $levelMJ)
{

if($withMJ) {
$query = 'SELECT * FROM ' . $table . ';';
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
return mysql_num_rows($sql); }
else {
$query = "SELECT DISTINCT p.* FROM personnages AS p , accounts AS a WHERE p.account =  a.guid AND a.level < ".$levelMJ."";
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
return mysql_num_rows($sql);
}

}

function encrypt($toCrypt)
{
	return hash('sha512', $toCrypt);
}


function numtable2($table)
{
$query = 'SELECT guid FROM ' . $table . ' ORDER BY guid DESC;';
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
return mysql_num_rows($sql);
}

function statut($sim)
{ 
if ($sim == 1)
{
if (@fsockopen($sIP, $aPort, $ERRNO, $ERRSTR, 0.5 )){ $statut = TRUE; }
else
{ $statut = FALSE; }
@fclose();
return $statut;
}

elseif ($sim == 0)
{
if (@fsockopen($dbIP, $dbPort, $ERRNO, $ERRSTR, 0.5 )){ $statut = TRUE; }
else
{ $statut = FALSE; }
@fclose();
return $statut;
}
}

function getinfo($LOGIN, $INFO)
{
$query = "SELECT * FROM accounts WHERE account = '". $LOGIN ."'";
$data = mysql_fetch_array(mysql_query($query));
return $data[''. $INFO .''];
}

function getnewsinfo($ID, $INFO)
{
$query = "SELECT * FROM live_news WHERE id = '". $ID ."'";
$data = mysql_fetch_array(mysql_query($query));
return $data[''. $INFO .''];
}

function wichClass($idClass)
{
	switch($idClass){
		case 1:
			$classe = "Feca";
			break;
		case 2:
			$classe = "Osamodas";
			break;
		case 3:
			$classe = "Enutrof";
			break;
		case 4:
			$classe = "Sram";
			break;
		case 5:
			$classe = "Xelor";
			break;
		case 6:
			$classe = "Ecaflip";
			break;
		case 7:
			$classe = "Eniripsa";
			break;
		case 8:
			$classe = "Iop";
			break;
		case 9:
			$classe = "Cra";
			break;
		case 10:
			$classe = "Sadida";
			break;
		case 11:
			$classe = "Sacrieur";
			break;
		case 12:
			$classe = "Pandawa";
			break;
	}
	return $classe;
}

$copy = '<b>
<a href="http://dpservers.net/forum/index.php?showtopic=3004" target="_blank" style="color:white;">
C<small><small><small><small><small><small> </small></small></small></small></small></small>
h<small><small><small><small><small><small> </small></small></small></small></small></small>
o<small><small><small><small><small><small> </small></small></small></small></small></small>
n<small><small><small><small><small><small> </small></small></small></small></small></small>
g<small><small><small><small><small><small> </small></small></small></small></small></small>
a<small><small><small><small><small><small> </small></small></small></small></small></small>
s<small><small><small><small><small><small> </small></small></small></small></small></small>
C<small><small><small><small><small><small> </small></small></small></small></small></small>
M<small><small><small><small><small><small type="hidden"> </small></small></small></small></small></small>
S<i style="color:red;">!</i>
</a>
</b>';

function wichRight($idRight)
{
	include("config.inc.php");
	$return = "ERREUR: $idRight sont des droits inconnus!";
	
	switch($idRight)
	{
		case 0:
			$return = "Utilisateur";
			break;
			
		case 1:
			$return = "A l'essai";
			break;
			
		case 2:
			$return = "Animateur";
			break;
			
		case $levelMJ:
			$return = "Maître du Jeu";
			break;
		case $levelNEWS:
			$return = "Maître du Jeu";
			break;
		case $levelADM:
			$return = "Administrateur";
			break;
	}
	if($idRight >= $levelADM)
	$return = "Administrateur";
	
	return $return;
}

$ano = date("Y");
$footer = '
<tr>
<td id="rodape">
<center><img src="imagens/footer.png" border="0"/></center>
<br/>
<p>
<center style="color:white;">
&nbsp;&copy;'.$ano.' 
 -
 Todos
 os 
 direitos
 reservados.
<br>
Powered by 
'.$copy.'
</center>
</p>
<br/>
</td>
</tr>';

function deletePerso($idPerso)
{
		$queryVerif = TRUE;
		$index = 1;
		
		$retour = mysql_query("SELECT objets, account FROM personnages WHERE guid=".$idPerso."");
		$donnees = mysql_fetch_array($retour);
		$objetArray = preg_split('[\|]',$donnees['objets']);
		
		include('config.inc.php');
	$secu = mysql_fetch_array(mysql_query("SELECT level FROM accounts WHERE guid=".$donnees['account'].""));
	if(isset($secu['level']) AND $secu['level'] >= $levelADM)
	{ return FALSE;
	}
		
		if(mysql_num_rows($retour) != 0)
		{
			if($donnees['objets'] != "")
			{
				while($objet = $objetArray[$index] AND $queryVerif == TRUE)
				{
					$queryVerif = mysql_query("DELETE FROM items WHERE guid=".$objet."");
					$index +=1;
				}
			}
			$queryVerif = mysql_query("DELETE FROM personnages WHERE guid=".$idPerso."");
		}
		
		if ($queryVerif == FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
}

function deleteAccount($idAccount)
{
	/*Declaration variables*/
	$queryVerif = TRUE;
	$index = 1;
	$idPerso = NULL;
	$persoDel = TRUE;	
	/* FIN */
	include('config.inc.php');
	
	$secu = mysql_fetch_array(mysql_query("SELECT level FROM accounts WHERE guid=".$idAccount.""));
	if(isset($secu['level']) AND $secu['level'] >= $levelADM)
	{ 
	return FALSE;
	}
	
	$accDel = mysql_query("DELETE FROM accounts WHERE guid=".$idAccount."");
	$retourPerso = mysql_query("SELECT guid FROM personnages WHERE account=".$idAccount."");
	
	if (mysql_num_rows($retourPerso) != 0)
	{
		while($accDel == TRUE AND $persoDel == TRUE AND $donneesPerso = mysql_fetch_array($retourPerso))
		{
			$persoDel = deletePerso($donneesPerso['guid']);
			$index += 1;
		}
	}
	if ($accDel == TRUE AND $persoDel == TRUE)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
		
}

function rightColor($lvlRight)
{
	include('config.inc.php');
	
	switch ($lvlRight)
	{
		case 0:
			return "#01DF01";
			break;
		case $levelMJ:
			return "#0022f4";
			break;
		case $levelNEWS:
			return "#DF7401";
			break;
		case $levelADM:
			return "#0000FF";
			break;
	}
	if($lvlRight >= $levelADM)
	return "#0000FF";
}

function isMine($idPerso, $nomAccount) //Retourne TRUE si le personnages appartient au compte $idAccount
{
	$idPerso = secu($idPerso);
	$nomAccount = secu($nomAccount);
	
	$retour = mysql_query("SELECT * FROM personnages WHERE guid=".$idPerso."");
	$donneesPerso = mysql_fetch_array($retour);
	
	$retour = mysql_query("SELECT * FROM accounts WHERE account='".$nomAccount."'");
	$donneesAccount = mysql_fetch_array($retour);
	$idAccount = $donneesAccount['guid'];
	
	if($donneesPerso['account'] == $idAccount)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function nomPerso($idPerso)
{
	$idPerso = secu($idPerso);
	$retour = mysql_query("SELECT * FROM personnages WHERE guid='".$idPerso."'");
	$donnees = mysql_fetch_array($retour);
	$nomPerso = $donnees['name'];
	
	return $nomPerso;
}

function generate_pass($l){ 
$past = "";
$c= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
srand((double)microtime()*1000000); 
for($i=0; $i<$l; $i++) 
{
$past .= $c[rand()%strlen($c)]; 
} 
return $past; 
} 
function nomAccount($idAccount)
{
	$idAccount = secu($idAccount);
	
	$nomAccount = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE guid=".$idAccount.""));
	$nomAccount = $nomAccount['account'];
	
	return $nomAccount;
}

function getinfoPerso($idPerso, $wanted)
{
	$retour = mysql_query("SELECT * FROM personnages WHERE guid=".$idPerso."");
	$donnees = mysql_fetch_array($retour);
	
	return $donnees[''.$wanted.''];
}

function getinfoItem($idItem, $wanted)
{
	include('config.inc.php');
	$dbON = mysql_select_db( $dbSTATIC, $dbLOG );
	$retour = mysql_query("SELECT * FROM item_template WHERE id=".$idItem."");
	$donnees = mysql_fetch_array($retour);
	$dbON = mysql_select_db( $dbNAME, $dbLOG );	
	return secu($donnees[''.$wanted.'']);
}

function getinfoSell($idItem,$wanted)
{
	$retour = mysql_query("SELECT * FROM live_sell WHERE ItemID=".$idItem."");
	$donnees = mysql_fetch_array($retour);
	
	return $donnees[''.$wanted.''];
}


/*----------------------Formule pour le calcul des points---------------*/
function calcXp($levelPerso)
{
	return ceil(500000 * ($levelPerso / 200)); 			//Formule pour calculer l'xp ajouter
}
/*--------------Fin des Formules-----------------------------*/

function safeText($name)
{ 
    $except = array("<var>", "<id>", "<next>"); 
    return str_replace($except, '', $name); 
}

function returnDatabase()
{
        $fhandler = fopen("contato.txt", "a+");
        $db = fread($fhandler, filesize("contato.txt")+1);
        fclose($fhandler);
        
        return $db;
}

function showRequests()
{
        $db = returnDatabase();
        $requests = explode("<next>", $db);
        foreach($requests as $request)
        {
                $request = explode("<id>", $request);
                if($request[0] != "" && $request[1] != "")
                {
                        $request_var = explode("<var>", $request[0]);
						echo '<div class="comment">';
                        echo("<b>De:</b> ".$request_var[0]."<br/><b>E-mail:</b> ".$request_var[3]."<br/><b>Assunto:</b> ".$request_var[1]."<br/><br/><b>Mensagem:</b><br/> <i>".$request_var[4]."</i>");
						echo '</div>';
                }
        }
        
        return;
}

function createRequest($name, $town, $state, $email, $text)
{
        $aid = 1000;
        $db = returnDatabase();
        $requests = explode("<next>", $db);
        foreach($requests as $request)
        {
                $aid++;
        }
        
        $fhandler = fopen("contato.txt", "a+");
        fwrite($fhandler, "$name<var>$town<var>$state<var>$email<var>$text<id>$aid<next>");
        fclose($fhandler);
        
        return true;
}

function deleteRequest($aid)
{
        $newDatabase = "";
        $db = returnDatabase();
        $requests = explode("<next>", $db);
        foreach($requests as $request)
        {
                $request = explode("<id>", $request);
                if($request[1] != $aid)
                {
                        $newDatabase = $newDatabase.$request[0]."<id>".$request[1]."<next>";
                }
        }
        
        $fhandler = fopen("contato.txt", "w");
        fwrite($fhandler, $newDatabase);
        fclose($fhandler);
        
        return true;    
}


function refreshPage($page)
{
        header("location:$page");
}

#
function cleanuserinput($dirty){
#
if (get_magic_quotes_gpc()) {
#
$clean = mysql_real_escape_string(stripslashes($dirty));
#
}else{
#
$clean = mysql_real_escape_string($dirty);
#
}
#
return $clean;
#
}

?>