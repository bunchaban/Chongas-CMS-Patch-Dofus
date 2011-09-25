<?php
if(!(isset($_SESSION['login']) AND $_SESSION['level'] >= $levelNEWS))
{
	echo '<tr><td id="not_title">Sem Permissão!</td></tr><meta http-equiv="refresh" content="2; URL=./index.php?page=home">';
	die();
}

if(isset($_GET['del']))
{
	$done = mysql_query("DELETE FROM live_tracker WHERE ID=".secu($_GET['del'])."");
	$doneMSG = "Objet supprimé";
}
if(isset($_GET['lu']))
{
mysql_query("UPDATE live_ticket SET lu = '1' WHERE id='".$_GET['lu']."'");

}


//POSTER
if(isset($_POST['mess']))
{
$author = urldecode($_GET['rep']);
$query = 'INSERT INTO live_ticket VALUES("","'.$author.'","'.secu($_POST['mess']).'","'.date("Y-m-d H:i:s").'", 2, 0)';
mysql_query($query);
}


//CONVERSATION AVEC UN REPORTER
if(isset($_GET['rep']))
{ 
$author = urldecode($_GET['rep']);
?>
<h1><?php echo $author; ?></h1>

<form action="index.php?page=admbugtrack&rep=<?php echo urlencode($author);?>" method="post">
			
		<input type="hidden" name="auteur" value="<?php echo $author;?>">
		<textarea name="mess" cols="80" rows="3"></textarea><br>
		<input class="botoes_input" type="submit" name="send" value="Responder" style="">
		</form>


<?php

$query = "SELECT * FROM live_ticket WHERE login = '".$author."' ORDER BY date DESC";
$sql = mysql_query($query) or die(''.$query.'<br />'.mysql_error());
while($ticket = mysql_fetch_array($sql))
{
sscanf($ticket['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
echo '<p class="comment">Le '.$jour.'/'.$mois.'/'.$an.' à '.$heure.'h'.$min.' par '.$author.' :<br>';
echo ''.$ticket['message'].'';
echo '<br><a href="index.php?page=admbugtrack&rep='.$_GET['rep'].'&del='.$ticket['id'].'">Supprimer</a>';








}
}

//TRAITEMENT DES BUGS
else{
				$retourObj = mysql_query("SELECT * FROM live_tracker WHERE cellid != 999 ORDER BY id");
				if(mysql_num_rows($retourObj) != 0)
				{ ?>
				<tr><td id="not_title">Impossivel Mudar de Mapa</td></tr>
			<td id="not_content"><table>
				<tr>
					<th>MapID</th>
					<th>&nbsp;&nbsp;</th>
					<th>CellID</th>
					<th>&nbsp;&nbsp;</th>
					<th>Por</th>
					<th>&nbsp;&nbsp;</th>
					<th>#</th>
				</tr>
		<?php
				while($donneesObj = mysql_fetch_array($retourObj)) { ?>	<!-- Boucle d'affichage des objet déjà dans la BD -->
					<tr>
						<td><?php echo $donneesObj['mapid'];?></td>
						<th>&nbsp;&nbsp;</th>
						<td><?php echo $donneesObj['cellid'];?></td>
						<th>&nbsp;&nbsp;</th>
						<td><?php echo $donneesObj['pseudo'];?></td>
						<th>&nbsp;&nbsp;</th>
						<td><?php echo '<a href="index.php?page=admbugtrack&amp;del='.$donneesObj['id'].'" title="Excluir"><img src="imagens/excluir.png"/></a>'?></td>
						
					</tr>
				<?php } ?>
					</table></td>
				<?php } ?>
				
				 <!-- Fin de la boucle -->
		
			
					
				<?php 
				$retourObj = mysql_query("SELECT * FROM live_tracker WHERE cellid = 999 ORDER BY id");
				if(mysql_num_rows($retourObj) != 0)
				{
				?>
				
<tr><td id="not_title">Impossivel Iniciar Combate</td></tr>
<td id="not_content">
<table>
<tr>
<th>MapID</th>
<th>&nbsp;&nbsp;</th>
<th>Por</th>
<th>&nbsp;&nbsp;</th>
<th>#</th>
</tr>
<?php
while($donneesObj = mysql_fetch_array($retourObj)) { ?>	<!-- Boucle d'affichage des objet déjà dans la BD -->
<tr>
<td><?php echo $donneesObj['mapid'];?></td>
<th>&nbsp;&nbsp;</th>
<td><?php echo $donneesObj['pseudo'];?></td>
<th>&nbsp;&nbsp;</th>
<td><?php echo '<a href="index.php?page=admbugtrack&amp;del='.$donneesObj['id'].'" title="Excluir"><img src="imagens/excluir.png"/></a>'?></td>

</tr>
			<?php } ?>
</table>
</td>
				<?php } 
				
				
			$sqlbug = mysql_query("SELECT * FROM live_ticket WHERE lu = 0 ORDER BY date");
			if(mysql_num_rows($sqlbug) != 0) { ?>
			<tr><td id="not_title">Mensagens</td></tr>
			<td id="not_content">
			<table style="width:99%"><center>
			<th width="10%">Data</th>
			<th>&nbsp;&nbsp;</th>
			<th width="10%">Por</th>
			<th>&nbsp;&nbsp;</th>
			<th width="70%">Mensagem</th>
			<th>&nbsp;&nbsp;</th>
			<th width="5%">#</th>
			<th>&nbsp;&nbsp;</th>
			<th width="5%">#</th>
			<?php
		while($buginfo = mysql_fetch_array($sqlbug)) {
		
		
		sscanf($buginfo['date'], "%4s-%2s-%2s %2s:%2s:%2s", $an, $mois, $jour, $heure, $min, $sec);
		echo '<tr><td>'.$jour.'/'.$mois.'/'.$an.' às '.$heure.'h'.$min.'</td>';
		echo '<th>&nbsp;&nbsp;</th>';
		echo "<td>".$buginfo['login']."</td>";
		echo '<th>&nbsp;&nbsp;</th>';
		echo "<td>".$buginfo['message']."</td>";
		echo '<th>&nbsp;&nbsp;</th>';
		echo '<td><a href="index.php?page=admbugtrack&lu='.$buginfo['id'].'"><small style="color:green;"><b>OK!</b></small></a></td>';
		echo '<th>&nbsp;&nbsp;</th>';
		echo '<td><a href="index.php?page=admbugtrack&rep='.urlencode($buginfo['login']).'"><small style="color:red;"><b>RESPONDER</b></small></a></b></td></tr>';
} ?></center></table></td>

			<?php } 
			}
			?>