<?php
if (!defined('SECU'))
	{
		die();
	}
	
if (isset($_POST['logon']))
{
	if ($_POST['hidden'] == "log")
	{
			
			$sql   = "SELECT account FROM accounts WHERE account = '". secu($_POST['login']) ."'";
            $sql   = mysql_query($sql);
            $sql   = mysql_num_rows($sql);
            if ($sql != NULL)
			{
				$donnees = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE account = '".secu($_POST['login'])."'"));
				if (encrypt(secu($_POST['passlog'])) == $donnees['pass'])
				{
					$logOK = FALSE;
					$_SESSION['login'] = $donnees['account'];
					$_SESSION['level'] = getinfo($_SESSION['login'], "level");
					$_SESSION['alloLastCode'] = "";
					$_SESSION['guid'] = $donnees['guid'];
				?><meta http-equiv="refresh" content="0; URL=./index.php?page=home">
				<?php
				}
				else
				{
				$logERR = TRUE;
				$logERRMSG = "<b>ERRO:</b> SENHA INCORRETA!<br/><p><small><b>VOCÊ SERÁ REDIRECIONADO PARA A PÁGINA INICIAL EM <i style='color:red;'>5 SEGUNDOS</i>.</b></small><meta http-equiv='refresh' content='5; URL=./index.php?page=home'></p>";
				}
			}
			else
			{
			$logERR = TRUE;
			$logERRMSG = "<b>ERRO:</b> NOME DE USUÁRIO INVÁLIDO!<br/><p><small><b>VOCÊ SERÁ REDIRECIONADO PARA A PÁGINA INICIAL EM <i style='color:red;'>5 SEGUNDOS</i>.</b></small><meta http-equiv='refresh' content='5; URL=./index.php?page=home'></p>";
			}
		
		
	}
	else
	{
	$logERR = TRUE;
	$logERRMSG = "<b>ERRO:</b> USE O SISTEMA DE LOGIN AO LADO ESQUERDO!<br/><p><small><b>VOCÊ SERÁ REDIRECIONADO PARA A PÁGINA INICIAL EM <i style='color:red;'>5 SEGUNDOS</i>.</b></small><meta http-equiv='refresh' content='5; URL=./index.php?page=home'></p>";
	}
}
?>
<tr><td id="not_title">Cenectando-se, aguarde...</td></tr>
		<?php if(isset($logOK)) { ?>
	
	<?php } ?>
		<?php if(isset($logERR)) 
		{ 
		echo '<td id="not_content">' . $logERRMSG . '</td>'; } ?>