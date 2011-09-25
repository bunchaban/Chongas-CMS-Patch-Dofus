<?php
/*DÃ©claration de diffÃ©rentes variables*/
$errorNEWS = FALSE;
$okNEWS = FALSE;
$okMSGNEWS = FALSE;
$NEWSauteur = "";
$NEWStitre = "";
$NEWSnews = "";
date_default_timezone_set('America/Maceio');
/*FIN*/
if (!defined('SECU'))
{
die();
}

if(!isset($_SESSION['login']) OR !isset($_SESSION['level']))
{
  die();
}

if($_SESSION['level'] < $levelNEWS)
  {
   die();
  }
  
 if(isset($_GET['add']))
{
 $formulaireNEWS = TRUE;
 
 if (isset($_POST['NEWSgo']) && $_POST['NEWSgo']=='Publicar') {
 
 $NEWSauteur = $_POST['NEWSauteur'];
 $NEWStitre = $_POST['NEWStitre'];
 $NEWSnews = $_POST['NEWSnews'];

if (!isset($_POST['NEWSauteur']) || !isset($_POST['NEWStitre']) || !isset($_POST['NEWSnews'])) {
$errorNEWS = TRUE;
$erreurMSG = 'Use o formulario para adicionar uma nova noticia.';
}
else {
if (empty($_POST['NEWSauteur']) || empty($_POST['NEWStitre']) || empty($_POST['NEWSnews'])) {
$errorNEWS = TRUE;
$erreurMSG = 'Preencha todos os campos!';
}
// si tout est bon, on peut commencer l'insertion dans la base
else {
// lancement de la requÃªte d'insertion
$sql = 'INSERT INTO live_news VALUES("", "'.mysql_escape_string($_POST['NEWSauteur']).'", "'.mysql_escape_string($_POST['NEWStitre']).'", "'.date("Y-m-d H:i:s").'", "'.mysql_escape_string($_POST['NEWSnews']).'", "'.mysql_escape_string($_POST['icon']).'")';

// on lance la requÃªte (mysql_query) et on impose un message d'erreur si la requÃªte ne se passe pas bien (or die)
mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
$okNEWS = TRUE;
$okMSGNEWS = 'Notícia publicada com sucesso!';
$formulaireNEWS = NULL;
}
}
}
 
  }
  
  if (isset($_GET['del'])) // Si on demande de supprimer une news
{

    $_GET['del'] = secu($_GET['del']);
    mysql_query('DELETE FROM live_news WHERE id=\'' . $_GET['del'] . '\'');
}

if (isset($_GET['edit'])) // Si on demande de modifier une news
{
    $_GET['edit'] = addslashes($_GET['edit']);
$formulaireNEWS = TRUE;
$NEWSauteur = stripslashes(trim(getnewsinfo($_GET['edit'], "auteur")));
$NEWStitre = stripslashes(trim(getnewsinfo($_GET['edit'], "titre")));
$NEWSnews = getnewsinfo($_GET['edit'], "contenu");

if (isset($_POST['NEWSgo']) && $_POST['NEWSgo']=='Publicar') {
 
 $NEWSauteur = $_POST['NEWSauteur'];
 $NEWStitre = $_POST['NEWStitre'];
 $NEWSnews = $_POST['NEWSnews'];

if (!isset($_POST['NEWSauteur']) || !isset($_POST['NEWStitre']) || !isset($_POST['NEWSnews'])) {
$errorNEWS = TRUE;
$erreurMSG = 'Use o formulario para adicionar uma nova noticia.';
}
else {
if (empty($_POST['NEWSauteur']) || empty($_POST['NEWStitre']) || empty($_POST['NEWSnews'])) {
$errorNEWS = TRUE;
$erreurMSG = 'Preencha todos os campos!';
}
// si tout est bon, on peut commencer l'insertion dans la base
else {
// lancement de la requÃªte d'insertion
$sql = "UPDATE live_news SET auteur='" . secu($_POST['NEWSauteur']) . "', titre='" . secu($_POST['NEWStitre']) . "', date='" . date("Y-m-d H:i:s") . "', contenu='" . $_POST['NEWSnews'] . "', icon='" . secu($_POST['icon']) . "' WHERE id='" . $_GET['edit'] . "'";

// on lance la requÃªte (mysql_query) et on impose un message d'erreur si la requÃªte ne se passe pas bien (or die)
mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
$okNEWS = TRUE;
$okMSGNEWS = 'Notícia atualizada com sucesso!';
$formulaireNEWS = NULL;
}
}
}
}
?>

<tr><td id="not_title">GERÊNCIADOR DE NOTÍCIAS</td></tr>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">

<table style="width: 98%" border="0">
<?php
if(isset($formulaireNEWS))
{?>


<?php if(isset($_GET['edit'])){ echo '<form action="index.php?page=news&amp;edit=' . $_GET['edit'] . '" method="post">'; } elseif(isset($_GET['add'])) { echo '<form action="index.php?page=news&amp;add" method="post">'; } ?>

<input type="hidden" name="NEWSauteur" size="50" value="<?php $pseudo = getinfo($_SESSION['login'], "account"); echo $pseudo; ?>">

<td>
<b style="color:red;">TITULO: *</b><br/>
<input type="text" name="NEWStitre" maxlength="50" size="50" value="<?php if (isset($NEWStitre)) echo stripslashes(trim($NEWStitre)); ?>">

<br/><br/>

<b style="color:red;">DESCRIÇÃO: *</b><br/>
</td>

 <!-- TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "cirkuit",
		language : "en",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "newdocument,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,blockquote,link,unlink,image,code,emotions,media,forecolor,fontsizeselect,preview",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<tr><td colspan="2"><textarea name="NEWSnews" cols="50" rows="11"><?php if (isset($NEWSnews)) echo $NEWSnews; ?></textarea></td></tr>
<tr>
<td align="right">
<b style="padding:0px 450px 0px 0px; color:red;"><?php if($errorNEWS == TRUE) { echo '' .  $erreurMSG . ''; } ?></b>
<input class="botoes_input" type="submit" name="NEWSgo" value="Publicar">
</td>
</tr>

</table></td></tr>

<?php
}
else
{
?>

<tr><td id="not_content">
<center>
<?php if($okNEWS == TRUE) { echo '<b>' .  $okMSGNEWS . '<br/><br/><br/></b>'; } ?>
</center>
<table style="width:100%">
<tr>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<th>Título</th>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<th>Data</th>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<th>#</th>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<th>#</th>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
</tr>

<?php
$retour = mysql_query('SELECT * FROM live_news ORDER BY id DESC');
while ($donnees = mysql_fetch_array($retour))
{
?>
<tr>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<td><?php echo stripslashes(trim($donnees['titre'])); ?></td>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<td><?php sscanf($donnees['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec); echo $jour.'/'.$mois.'/'.$an.''; ?></td>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<td><a href="index.php?page=news&amp;edit=<?php echo '' . $donnees['id'] . ''; ?>" title="Editar"><img src="imagens/editar.png"/></a></td>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
<td><a href="index.php?page=news&amp;del=<?php echo '' . $donnees['id'] . ''; ?>" title="Excluir"><img src="imagens/excluir.png"/></a></td>
<td></td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td><td></td><td>&nbsp;&nbsp;</td>
</tr>

<?php
}
?>

</table>
</td></tr>

<?php
}
?>
