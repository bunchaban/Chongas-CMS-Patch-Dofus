<?php

$okBool = FALSE;
$okMSG = "Initialized";
$errBool = FALSE;
$errMSG = "Initialized";
$retour = FALSE;
$cutted = FALSE;
$classe = FALSE;

if (!defined('SECU'))
{
die();
}

if (isset($_POST['change']))
{
$donnees = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE account = '".secu($_SESSION['login'])."'"));
if($_POST['pass'] == $_POST['passconf'])
{
if(encrypt($_POST['oldpass']) == $donnees['pass'])
{
$sql = mysql_query("UPDATE accounts SET pass = '".secu(encrypt($_POST['pass']))."' WHERE account = '".secu($_SESSION['login'])."'"); //Envoie de la requete de l'update du PASS
if ($sql)
{
$okBool = TRUE;
$okMSG = "&nbsp;&nbsp;<b><big style='color:green;'>OK!</big></b>";
}
else
{

$errBool = TRUE;
$errMSG = mysql_error();
}
}
else
{
$errMSG = "&nbsp;&nbsp;<b><big style='color:red;'>ERRO!</big></b>";
}
}
else
{
$errBool = TRUE;
$errMSG = "&nbsp;&nbsp;<b><big style='color:red;'>ERRO!</big></b>";
}
}

if(isset($_SESSION['login']) AND isset($_SESSION['level']))
{
$donnees = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE account = '".secu($_SESSION['login'])."'"));
$login = $_SESSION['login'];
$mail = getinfo($_SESSION['login'], "email");
$pseudo = getinfo($_SESSION['login'], "pseudo");
$ask = getinfo($_SESSION['login'], "question");
$rep = getinfo($_SESSION['login'], "reponse");
$point = getinfo($_SESSION['login'], "points");
$retour = mysql_query('SELECT personnages.* FROM personnages,accounts WHERE accounts.account="'.secu($_SESSION['login']).'" AND personnages.account=accounts.guid ORDER BY personnages.level DESC');
}
else
{
die();
}

?>
<tr><td id="not_title">MINHAS INFORMAÇÕES</td></tr>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<b style="color:red;">Nome de Usuário:</b> <?php echo $login; ?><br/>
<b style="color:red;">Endereço de E-mail:</b> <?php echo $mail; ?><br/>
<b style="color:red;">Apelido:</b> <?php echo $pseudo; ?><br/>
<b style="color:red;">Pergunta Secreta:</b> <?php echo stripslashes($ask); ?><br/>
<b style="color:red;">Resposta Secreta:</b> <?php echo stripslashes($rep); ?><br/>
</table></td></tr>

<tr><td id="not_title"><br/>ALTERAR MINHA SENHA</td></tr>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<form action="" method="post">
<b style="color:red;">Senha Atual:</b><br>
<input  name="oldpass"  type="password" value=""/><br>

<b style="color:red;">Nova senha:</b><br>
<input  name="pass"  type="password" value=""/><br>

<b style="color:red;">Confirmar Nova Senha:</b><br>
<input  name="passconf"  type="password" value=""/><br>

<br/>
<input class="botoes_input" name="change" type="submit" value="Alterar Senha">
<?php if($okBool == TRUE) { echo '' .  $okMSG . ''; } ?>
<?php if($errBool == TRUE) { echo '' .  $errMSG . ''; } ?>
</form>
</table></td></tr>

<?php if(mysql_num_rows($retour) != 0){ ?>
<tr><td id="not_title"><br/>MEUS PERSONAGENS</td></tr>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<table style="font-size:10pt; border-collapse:inherit">
<tr>
<th style="color:red;">#</th>
<td>&nbsp;&nbsp;</td><td></td>
<th style="color:red;">Nome</th>
<td>&nbsp;&nbsp;</td><td></td>
<th style="color:red;">Classe</th>
<td>&nbsp;&nbsp;</td><td></td>
<th style="color:red;">Nivel</th>
<td>&nbsp;&nbsp;</td><td></td>
<th style="color:red;">Alinhamento</th>
<td>&nbsp;&nbsp;</td><td></td>
<th style="color:red;">Honra</th>
<td>&nbsp;&nbsp;</td><td></td>
<th style="color:red;">Kamas</th>

</tr>
<?php
while($donnees = mysql_fetch_array($retour) AND mysql_num_rows($retour) != 0)
{
$pos = mysql_fetch_row(mysql_query('SELECT COUNT(*) FROM personnages WHERE xp >= '.$donnees['xp'].''));


?>
<tr style="color:black;">
<td><?php echo $pos[0];?></td>
<td>&nbsp;&nbsp;</td><td></td>
<td><?php echo $donnees['name']?></td>
<td>&nbsp;&nbsp;</td><td></td>
<td><?php echo '<img src="./imagens/'.wichClass($donnees['class']).'.png" title="'.wichClass($donnees['class']).'">'?></td>
<td>&nbsp;&nbsp;</td><td></td>
<td><?php echo $donnees['level']?></td>
<td>&nbsp;&nbsp;</td><td></td>
<td><?php echo '<img src="./imagens/'.$donnees['alignement'].'.png">'?></td>
<td>&nbsp;&nbsp;</td><td></td>
<td><?php echo $donnees['honor'] ?></td>
<td>&nbsp;&nbsp;</td><td></td>
<td><?php echo $donnees['kamas'] ?></td>
</tr>
<?php } ?>
</table>
</table></td></tr>
<?php } ?>