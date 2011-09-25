<h1>Pedir uma nova senha</h1><br>
<center>
<?php
if(isset($_POST['login']))
{ 
$quest = getinfo($_POST['login'],"question");

if(isset($_POST['reponse']) AND isset($_POST['gogo']))
{

$rep = getinfo($_POST['login'],"reponse");
if($rep == $_POST['reponse'])
{

$pass = generate_pass(10);
$epass = encrypt($pass);

$retour = mysql_query("UPDATE accounts SET pass = '".$epass."' WHERE account='".$_POST['login']."'");

}
}


?>

<form action="" method="post">
        <table style="margin-left: 75px;" border="0">
			<tr>
				<td>Login</td>
				<td><input name="login" type="text" value="<?php echo $_POST['login']; ?>"/></td>
			</tr>
			<tr>
				<td>Pergunta Secreta :<br> <?php echo $quest; ?></td>
				<td><p>Resposta : <input  name="reponse"  type="text" value=""/></td>
			</tr>
			<tr>
			<td> <input name="gogo" type="submit" style="padding-left: 50px; padding-right: 50px;" value="Validar"></td>
			</tr>
		</table>
       </center>
		</form>
		<?php if(isset($pass)){ ?>
<p>Sua nova senha é : <?php echo '<b>'.$pass.'<b><br>'; ?>
Obrigado pela nota em algum lugar. Você pode mudá-lo depois de Entrar"Minhas Informaçoes".</p>
<?php
}
}
else
{ ?>
		<form action="" method="post">
        <table style="margin-left: 75px;" border="0">
			<tr>
				<td>Login</td>
				<td><input  name="login"  type="text" value=""/></td>
			</tr>
			<tr>
			<td> <input name="valider" type="submit" style="padding-left: 50px; padding-right: 50px;" value="Validar"></td>
			</tr>
		</table>
       </center>
		</form>
		<?php } ?>