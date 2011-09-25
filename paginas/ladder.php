<?php
$tPerso = numladder("personnages",  $withMJ, $levelMJ);
$PAGENB = ceil($tPerso / $wladder);

if (isset($_GET['p']))
{
$p = $_GET['p'];
}
else{ $p = 1;}

$NBpage = ($p - 1)  * $wladder;


if(isset($_POST['sorting']) AND $_POST['sorting'] == "guilde" )
{
$retour = mysql_query("SELECT * FROM guilds ORDER BY xp DESC LIMIT 0, 20");
}

if ($withMJ)
{
	if(isset($_POST['sorting']) AND $_POST['sorting'] == "xp" OR (!(isset($_POST['sorting']))))
	{
		$retour = mysql_query("SELECT * FROM personnages ORDER BY xp DESC LIMIT ".$NBpage.", ".$wladder."");
	}
	elseif(isset($_POST['sorting']) AND $_POST['sorting'] == "kamas")
	{
		$retour = mysql_query("SELECT * FROM personnages ORDER BY kamas DESC LIMIT ".$NBpage.", ".$wladder."");
	}
		elseif(isset($_POST['sorting']) AND $_POST['sorting'] == "honor")
	{
		$retour = mysql_query("SELECT * FROM personnages ORDER BY honor DESC LIMIT ".$NBpage.", ".$wladder."");
	}
}
else
{
	
	if(isset($_POST['sorting']) AND $_POST['sorting'] == "xp" OR (!(isset($_POST['sorting']))))
	{
		$retour = mysql_query("SELECT DISTINCT p.* FROM personnages AS p , accounts AS a WHERE p.account =  a.guid AND a.level < ".$levelMJ." ORDER BY p.xp DESC LIMIT ".$NBpage.", ".$wladder."");
	}
	elseif(isset($_POST['sorting']) AND $_POST['sorting'] == "kamas")
	{
		$retour = mysql_query("SELECT DISTINCT p.* FROM personnages AS p , accounts AS a WHERE p.account =  a.guid AND a.level < ".$levelMJ." ORDER BY p.kamas DESC LIMIT ".$NBpage.", ".$wladder."");
	}
	elseif(isset($_POST['sorting']) AND $_POST['sorting'] == "honor")
	{
		$retour = mysql_query("SELECT DISTINCT p.* FROM personnages AS p , accounts AS a WHERE p.account =  a.guid AND a.level < ".$levelMJ." ORDER BY p.honor DESC LIMIT ".$NBpage.", ".$wladder."");
	}
}

$iPosition = 1;
?>

<tr><td id="not_title">RANKING</td></tr>
<tr><td id="not_content"><table border="0" width="100%">
		
<tr>
<th>#</th>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
<th>Personagem</th>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
<th>Classe</th>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
<th>Nível</th>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
<th>Alinhamento</th>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
<th>Honra</th>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
<th>Kamas</th>
</tr>

<?php
while($donnees = mysql_fetch_array($retour) AND mysql_num_rows($retour) != 0)
{ ?>

					<tr>
						<td><?php echo ''.(($p - 1)* $wladder) + $iPosition.'';?></td>
						<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
						<td><?php echo $donnees['name']?></td>
						<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
						<td><?php echo '<img src="imagens/'.wichClass($donnees['class']).'.png" title="'.wichClass($donnees['class']).'">'?></td>
						<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
						<td><?php echo $donnees['level']?></td>
						<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
						<td><?php echo '<img src="imagens/'.$donnees['alignement'].'.png">'?></td>
						<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
						<td><?php echo $donnees['honor'] ?></td>
						<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
						<td><?php echo $donnees['kamas'] ?></td>
					</tr>
					
<?php $iPosition++; 
}
?>

</table><b>
<?php if($tPerso > $wladder) { ?>
Páginas:
<?php for ($i = 1 ; $i <= $PAGENB ; $i++) { ?>
<a href="index.php?page=ladder&amp;p=<?php echo'' . $i . ''; ?>" style="color:red;"> <?php echo'' . $i . ''; ?> </a>
<?php } } ?></b>
</td></tr>