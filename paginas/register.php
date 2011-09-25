<?php
$errorPASS = FALSE;
$okREG = FALSE;
$okMSGREG = FALSE;
$error = FALSE;
$gmlvl = '0';
if (!defined('SECU'))
{
die();
}

if($wREG == TRUE)
{
if (isset($_POST['register']))
{

if($_POST['login'] == NULL OR $_POST['pass'] == NULL OR $_POST['pass2'] == NULL OR $_POST['mail'] == NULL OR $_POST['pseudo'] == NULL OR $_POST['ask'] == NULL OR $_POST['rep'] == NULL)
{
$error = TRUE;
$errorMSG = "Preencha todos os campos.";
}
elseif ($_POST['pass'] == $_POST['pass2'])
{
$sql    = "SELECT account FROM accounts WHERE account = '".secu($_POST['login'])."'";
$sql   = mysql_query($sql);
$sql   = mysql_num_rows($sql);
if ($sql == 0)
{
  $sql  = "SELECT pseudo FROM accounts WHERE pseudo = '".secu($_POST['pseudo'])."'";
  $sql   = mysql_query($sql);
  $sql   = mysql_num_rows($sql);
  if ($sql == 0)
   {
$sql =  "INSERT INTO accounts (guid,account,pass,level,email,lastIP,lastConnectionDate,question,reponse,pseudo,banned,reload_needed,bankKamas,bank,friends,stable) VALUES ('','".secu($_POST['login'])."','".encrypt(secu($_POST['pass']))."','0','".secu($_POST['mail'])."','0','0','".secu($_POST['ask'])."','".secu($_POST['rep'])."','".secu($_POST['pseudo'])."','0','0','0','0','0','0')";


$sql    = mysql_query( $sql );

if ($sql)
{
$okREG = TRUE;
$okMSGREG = "Usuário registrado com sucesso!";
$_SESSION['login'] = secu($_POST['login']);
$_SESSION['level'] = getinfo($_SESSION['login'], "level");
}
else
{

$error = TRUE;
$errorMSG = mysql_error();
}
  }
  else
  {
$error = TRUE;
$errorMSG = "Nome de usuário já existe.";
  }
}
else
{
$error = TRUE;
$errorMSG = "Apelido já existe.";
}



}
elseif ($_POST['pass'] != $_POST['pass2'])
{
$errorPASS = TRUE;
$errorMSG = "As senhas são diferentes.";
$login = $_POST['login'];
$mail = $_POST['mail'];
$pseudo = $_POST['pseudo'];
$ask = $_POST['ask'];
$rep = $_POST['rep'];
}
}

}
else
{
}

?> 
<tr><td id="not_title">REGISTRO</td></tr>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<?php if($errorPASS == TRUE or $error == TRUE) { echo '<font color="red">' .  $errorMSG . '</font><br/><br/>'; } ?>
<?php if($okREG == TRUE) { echo '<font color="green">' .  $okMSGREG . '</font><meta http-equiv="refresh" content="3; URL=./index.php?page=home"><br/><br/>';
} 
elseif ($wREG == TRUE) { ?>

<form action="" method="post"><b>

NOME DE USUÁRIO:<br/>
<input class="input_contato"  name="login"  type="text" value="<?php if($errorPASS == TRUE) { echo $login; }?>"/><br/><br/>

SENHA:<br/>
<input class="input_contato"  name="pass"  type="password" value=""/><br/><br/>

CONFIRMAR SENHA:<br/>
<input class="input_contato" name="pass2" type="password" value=""/><br/><br/>

ENDEREÇO DE EMAIL:<br/>
<input class="input_contato" name="mail" type="text" value="<?php if($errorPASS == TRUE) { echo $mail; }?>" /><br/><br/><br/>

APELIDO:<br/>
<input class="input_contato" name="pseudo" type="text" value="<?php if($errorPASS == TRUE) { echo $pseudo; }?>" /><br/><br/>

PERGUNTA SECRETA:<br/>
<input class="input_contato" name="ask" type="text"  value="<?php if($errorPASS == TRUE) { echo $ask; }?>" /><br/><br/>

RESPOSTA SECRETA:<br/>
<input class="input_contato" name="rep" type="text" value="<?php if($errorPASS == TRUE) { echo $rep; }?>" /><br/><br/>

<input name="register" type="submit" class="botoes_input" value="Registrar">

</b></form>
<?php
if ($error == TRUE OR $errorPASS == TRUE)
{
$error = FALSE;
$errorPASS = FALSE;
$errorMSG = NULL;
$login = NULL;
$mail = NULL;
$pseudo = NULL;
$ask = NULL;
$rep = NULL;
}

}
elseif ($wREG == FALSE)
{
echo '<p class="ERROR">As inscrições estão fechadas a esta hora.</p>';
}
else
{
echo '<p class="ERROR">parâmetro errado no arquivo de configuração</p>';
}
?>

</table></td></tr>