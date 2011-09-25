<?php
if (!defined('SECU'))
	{
		die();
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
} ?>

<tr><td id="not_title">CONTATO</td></tr>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">

<form name="form1" method="post" action="">

<small><b>NOME:
<input class="input_contato" name="nome" type="text" id="nome" value="<?php echo $pseudo; ?>" size="40"><br/><br/>

E-MAIL:
<input class="input_contato" name="email" type="text" id="email" value="<?php echo $mail; ?>" size="40"><br/><br/>

ASSUNTO:
<input class="input_contato" name="cidade" type="text" id="cidade" size="40"><br/><br/>

MENSAGEM:</b></small>
<textarea class="textarea_contato" name="pedido"></textarea>

<input class="botoes_input" type="submit" name="Submit" value="Enviar Recado">&nbsp;
&nbsp;<input name="reset" class="botoes_input" value=" Limpar " type="reset">

</form>

<?php

if(isset($_POST['Submit']))
{
        $name = safeText($_POST['nome']);
        $email = safeText($_POST['email']);
        $town = safeText($_POST['cidade']);
        $state = safeText($_POST['estado']);
        $request = safeText($_POST['pedido']);
        
        if(createRequest($name, $town, $state, $email, $request))
		
                echo('<br/><br/><td id="not_content" class="comment" style="background: #d2ffd7;"><b><small style="color:#00710d;">MENSAGEM ENVIADA COM SUCESSO!</small></b></td>');
        else
                echo('<br/><br/><td id="not_content" class="comment" style="background: #ffd2d2;"><b><small style="color:#710000;">ERRO AO ENVIAR SUA MENSAGEM!</small></b></td>');
}

?>

</table></td></tr>