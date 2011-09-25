<?php
if (!defined('SECU'))
{
die();
}
if(!(isset($_SESSION['login'])))
{
echo '
<tr><td id="not_title">Você deve estar logado para poder visualizar esta página!</td></tr>
<td id="not_content" class="comment">Você será redirecionado à página inicial em <i style="color:red;">5 Segundos</i>...</td>
<meta http-equiv="refresh" content="5; URL=./index.php?page=home">
';
die();
}




if(isset($_POST['sendbug']) AND isset($_SESSION['login']))
{
if(empty($_SESSION['lastbug']) OR (time() - $_SESSION['lastbug']) >= 300)
{

$exe = 'INSERT INTO live_ticket VALUES("", "'.$_SESSION['login'].'","'.secu($_POST['bug']).'","'.date("Y-m-d H:i:s").'","0","0")';
mysql_query($exe) or die('Erreur SQL !'.$exe.'<br />'.mysql_error());
$_SESSION['lastbug'] = time();
$tick = TRUE;
}
else 
{ $comerror = "<b><small>VOCÊ DEVE AGUARDA <i style='color:red;'>5 MINUTOS</i> ANTES DE REPORTAR OUTRO BUG!</small></b>"; }
}




if (isset($_POST['cellid']) AND $_POST['cellid'] != "" AND isset($_POST['mapid']) AND $_POST['mapid'] != "")
{
    $mapid = secu($_POST['mapid']);
    $cellid = secu($_POST['cellid']);
$pseudo = $_SESSION['login'];
    mysql_query("INSERT INTO live_tracker VALUES('', '" . $pseudo . "', '" . $mapid . "','" . $cellid . "')") or die('Erreur lors de la requête');
$add_ok = TRUE;
}

?>
<tr><td id="not_title">REPORTAR BUG</td></tr>

<?php 
if(isset($comerror)) echo $comerror;
 
if(isset($cellid) || isset($tick))
{ ?>

<b>Obrigado por ter nos avisado sobre o problema.<br/>Verificaremos o problema e veremos oque pode ser feito.</b><br/><br/>

<?php
}

  if(empty($_GET['typebug'])) {?>
  
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<b><span style="color:red;">&nbsp; Selecione uma categoria:</span><p>
&nbsp; + <a href="index.php?page=bugreporter&typebug=1">Impossível iniciar uma luta.<br>
&nbsp; + <a href="index.php?page=bugreporter&typebug=2">Ao mudar de mapa, nada acontece.</a><br>
&nbsp; + <a href="index.php?page=bugreporter&typebug=3">Mapa com nome de "Undefined".</a><br>
&nbsp; + <a href="index.php?page=bugreporter&typebug=4">Outros bugs não citados acima.</a></p>
</b>
</table></td></tr>

<?php }





elseif($_GET['typebug']== 4)
{ ?>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<b><span style="color:red;">&nbsp; Categoria:</span> Outros Bugs<p>
&nbsp; - Seja claro e nitido para que possamos ajudalo.<br>
&nbsp; - Volte aqui para ver a resposta sobre o problema assim que um administrador respodela.</b></p>
<form action="index.php?page=bugreporter&typebug=4" method="post">
<textarea name="bug" cols="78" rows="3"></textarea><br>
<input class="botoes_input" type="submit" name="sendbug" value="Enviar Mensagem" style="">
</form>
</table></td></tr>
<?php

$query = "SELECT * FROM live_ticket WHERE login = '".$_SESSION['login']."' ORDER BY date DESC";
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
while($ticket = mysql_fetch_array($sql))
{
$lu = "";
if($ticket['lu'] == 2)
{$author = 'Você';}
elseif($ticket['lu'] == 1)
{
$author = $_SESSION['login'];
$lu = '';
}
elseif($ticket['lu'] == 0)
{$author = $_SESSION['login'];}

sscanf($ticket['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
echo '<p class="comment"><big><b style="text-transform:capitalize;">'.$author.'</b> diz:<br>';
echo ''.$ticket['message'].'</big><br><br>';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
echo '
<small>
<b class="comment">
ENVIADO DIA: '.$jour.'/'.$mois.'/'.$an.' ÀS '.$heure.':'.$min.'hrs
</b>
</small>
';
//echo '<a href="index.php?page=admbugtrack&rep='.$_GET['rep'].'&del='.$ticket['id'].'"><font style="color:red;"><small>EXCLUIR</small></font></a>';
if(isset($lu)) echo $lu;
      echo '</p>';
}  

 }



elseif($_GET['typebug']== 3)
{ ?>
<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<b>
<span style="color:red;">&nbsp; Categoria:</span> Mapa com nome de "Undefined"
<p>
&nbsp;SOLUÇÕES:<br/><br/>
- Certifique-se de que o arquivo <font style="color:red;"><small>CONFIG.XML</small></font> é o mais recente;<br/>
&nbsp;&nbsp;<small>BAIXE OS ARQUIVOS MAIS RECENTES NA PÁGINA DE DOWNLOADS.</small><br/><br/>

- Deslogue sua conta, e em seguida limpe o cach do jogo;<br/>
&nbsp;&nbsp;<small>PARA LIMPAR O CACHE VÁ EM: OPÇÕES > LIMPAR CACHE.</small><br/><br/>

- Caso já tenha feito os procedimentos acima e o erro ainda continuar, entre com contato com um administrador. &nbsp; &nbsp;
</p>
</b>
</table></td></tr>
      
<?php }



elseif($_GET['typebug']== 2)
{ ?>

<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<b>
<span style="color:red;">&nbsp; Categoria:</span> Ao mudar de mapa, nada acontece
<p>

&nbsp; &nbsp;Fique sobre o icone de mudança de mapa e em seguida digite no chat do jogo os comandos: <font style="color:red;">/mapid</font> e <font style="color:red;">/cellid</font> &nbsp; &nbsp;

<form method="post" action="index.php?page=bugreporter">
&nbsp; &nbsp;Digite o <font style="color:red;">MapID</font> gerado aqui:<br>&nbsp; &nbsp;<input name="mapid" /><br>
&nbsp; &nbsp;Digite o <font style="color:red;">CellID</font> gerado aqui:<br>&nbsp; &nbsp;<input name="cellid" /><br>
&nbsp; &nbsp;<input class="botoes_input" type="submit" value="Reportar" />
</form>

</p>
</b>
</table></td></tr>

<?php }

else if($_GET['typebug']== 1)
{ ?>

<tr><td id="not_content"><table border="0" cellpadding="0" cellspacing="1" width="689">
<b>
<span style="color:red;">&nbsp; Categoria:</span> Impossível iniciar um combate
<p>

&nbsp; &nbsp;Vá para o mapa onde não é possivel iniciar uma luta e em seguida digite no chat do jogo o comando: <font style="color:red;">/mapid</font> &nbsp; &nbsp;

<form method="post" action="index.php?page=bugreporter">
&nbsp; &nbsp;Digite o <font style="color:red;">MapID</font> gerado aqui:<br>&nbsp; &nbsp;<input name="mapid" /><br>
<input type="HIDDEN" name="cellid" value="999">
&nbsp; &nbsp;<input class="botoes_input" type="submit" value="Reportar" />
</form>

</p>
</b>
</table></td></tr>

<?php } ?>