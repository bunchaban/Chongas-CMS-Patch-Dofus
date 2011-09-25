<?php
if (!defined('SECU'))
{
die();
}


$tNEWS = numtable("live_news");
if($tNEWS >= 1)
{
$nPAGES  = ceil($tNEWS / $wNEWS);
}
if (isset($_GET['p']))
{
        $p = secu($_GET['p']);
}
else 
{
        $p = 1; 
}
$fMTS = ($p - 1) * $wNEWS;
?>

<?php
if(isset($_SESSION['login']) AND isset($_GET['delcom']))
{
$sql = mysql_fetch_array(mysql_query("SELECT author FROM live_commentaire WHERE id = '".$_GET['delcom']."';"));

if($_SESSION['login'] == $sql['author'] OR $_SESSION['level'] >= $levelNEWS)
mysql_query("DELETE FROM live_commentaire WHERE id = '".$_GET['delcom']."'");
}
?>

<?php
if(isset($_POST['comment']) AND isset($_SESSION['login']))
{
if(empty($_SESSION['lastcomment']) OR (time() - $_SESSION['lastcomment']) >= 30)
{
$exe = 'INSERT INTO live_commentaire VALUES("", "'.$_SESSION['login'].'","'.nl2br(secu($_POST['comment'])).'","'.$_POST['incommento'].'","'.date("Y-m-d H:i:s").'")';
mysql_query($exe) or die('Erreur SQL !'.$exe.'<br />'.mysql_error());
$_SESSION['lastcomment'] = time();
}
else 
{
$comerror = "<br/><center><b><small class='comment'>VOCÊ DEVE ESPERAR <i style='color:red;'>30 SEGUNDOS</i> ANTES DE POSTAR UM NOVO COMENTÁRIO.</small></b></center><br/>"; }
}
?>

<?php
if(isset($_GET['com']))
{
$query = 'SELECT auteur, titre, date, contenu, icon FROM live_news WHERE id = '.$_GET['com'].';';
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
$data = mysql_fetch_array($sql);
sscanf($data['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
$auteur = $data['auteur'];
?>





<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





<!--  [INICIO] NOTICIAS COMPLETAS  -->

<tr><td id="not_title">
<?php echo'' , stripslashes(trim($data['titre'])) , ''; ?>
</td></tr>
<td id="not_content">
<?php echo '' , nl2br(stripslashes($data['contenu'])) , ''; ?>
<p></td>

<!--  [FIM] NOTICIAS COMPLETAS  -->





<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





<?php
$query = "SELECT id, author, message, incommento, date FROM live_commentaire WHERE incommento = '".$_GET['com']."' ORDER BY id DESC;";
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());

if(mysql_num_rows($sql) != 0)
?>

<table width="699" border="0" cellspacing="0" cellpadding="0"><td id="not_title">Comentários</td></table>

<?php
if(isset($_SESSION['login'])){
?>





<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





<!--  [INICIO] CAIXA PARA DEIXAR COMENTARIO  -->

<form action="index.php?page=home&com=<?php echo $_GET['com'];?>" method="post" class="comment">
<input type="hidden" name="incommento" value="<?php echo $_GET['com'];?>">
<textarea name="comment" cols="80"></textarea><br>
<input type="submit" name="sendcomm" value=" " id="enviar_comentario" align="left" style="border:0;"></input>
</form>

<?php

if(isset($comerror))  { echo $comerror;}
}

?>

<!--  [FIM] CAIXA PARA DEIXAR COMENTARIO  -->





<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





<!--  [INICIO] COMENTÁRIOS  -->

<?php

while ($data = mysql_fetch_array($sql)) 
{

$donnees = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE account = '".$data['author']."'"));
$email = ''.$donnees['email'].'';
$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "";

sscanf($data['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
$auteur = $data['author'];

$retour = mysql_query("SELECT * FROM accounts WHERE account = '".$data['author']."'") or die(mysql_error());
while ($donnees = mysql_fetch_array($retour))
{

echo '<p class="comment">';
?>
<img src="<?php echo $grav_url; ?>" height="35" widht="35" align="left"/>
<?php
if(isset($_SESSION['login']) AND ($_SESSION['login'] == $auteur OR $_SESSION['level'] >= $levelNEWS))
{ ?>
[<a href="index.php?page=home&com=<?php echo''.$_GET['com'].'&delcom='.$data['id'].'';?>" title="Excluir Comentário"><small><b style="color:red;">X</b></small></a>]
<?php } ?>
<b style="text-transform:capitalize;"><?php echo ''.$donnees['pseudo'].''; ?></b> diz:<br>
<?php echo ''.$data['message'].''; ?>
</p>

<?php }} ?>

<!--  [FIM] COMENTÁRIOS  -->





<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





<!--  [INICIO] SEM NOTÍCIAS  -->

<?php
mysql_free_result($sql);



}
elseif($tNEWS == 0){ 
?>
  
<tr>
<td id="semnot">&nbsp;</td>
</tr>

<!--  [FIM] SEM NOTÍCIAS  -->





<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->





<!--  [INICIO] MINI-NOTICIAS  -->

<?php
}
else
{
?>

<tr>
<td id="topnot">&nbsp;</td>
</tr>

<tr>
<td>
<table border="0" cellspacing="0" cellpadding="0">

<?php
$query = 'SELECT id, auteur, titre, date, contenu, icon FROM live_news ORDER BY id DESC LIMIT ' . $fMTS . ', ' . $wNEWS .';';
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
while ($data = mysql_fetch_array($sql)) 
{
sscanf($data['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
$auteur = $data['auteur'];
?>

<tr>
<td id="not_date">
<?php echo''.$jour.'.'.$mois.'.'.$an.''; ?>
</td>

<td id="not_contents">
<b><a href="index.php?page=home&com=<?php echo''.$data['id'].''; ?>" style="color:#4a2f00;">
<?php echo'' , stripslashes(trim($data['titre'])) , ''; ?>
</a></b>
</td>
</tr>

<?php } ?>

</table><img src="imagens/ne_footer.png" border="0"/>
</td>
</tr>

<?php } ?>

<!--  [FIM] MINI-NOTICIAS  -->