<?php
if(!(isset($_SESSION['login']) AND $_SESSION['level'] >= $levelADM))
{
	echo '<h2 style="color: #DF0101">Você deve estar logado e ter os direitos necessários para visualizar esta página</h2>';
	die();
}
$done = NULL;
$doneMSG = NULL;
$max=0;

$nomValue = "";
$idValue = "";
$costValue = "";
$maxcostValue = "";
$maxableValue = "";
$packValue = 1;

if(isset($_GET['del']))
{
	$done = mysql_query("DELETE FROM live_sell WHERE ID=".secu($_GET['del'])."");
	$doneMSG = "Objeto excluído";
}

if(isset($_GET['modId']))
{
	
	$idItem = secu($_GET['modId']);
	$donneesModif = mysql_fetch_array(mysql_query("SELECT * FROM live_sell WHERE ItemID=".$idItem.""));
	
	$nomValue = $donneesModif['ItemName'];
	$idValue = $donneesModif['ItemID'];
	$costValue = $donneesModif['Cost'];
	$packValue = $donneesModif['Nombre'];
	

	if($donneesModif['Maxable'] == 1)
	{
		$maxcostValue = $donneesModif['MaxCost'];
		$maxableValue = 'checked="checked"';
	}
}


if(isset($_POST['add']) AND $_POST['id'] != "" AND $_POST['cost'] != "")
{
	$idItem = secu($_POST['id']);
	$cost = secu($_POST['cost']);
	
	mysql_query("DELETE FROM live_sell WHERE ItemID=".$idItem."");
	
	if(isset($_POST['maxable']) AND $_POST['maxable'] == TRUE)
	{
		if(isset($_POST['maxcost']) AND $_POST['maxcost'] != "")
		{
			$maxCost = secu($_POST['maxcost']);
			$done = mysql_query("INSERT INTO live_sell VALUES('','".$idItem."','".secu($_POST['nom'])."','".getinfoItem($idItem,"level")."','".$cost."','1','".$maxCost."','".$_POST['packof']."')");
			if($done)$doneMSG="O objeto foi adicionada com êxito."; else $doneMSG="ERREUR!".mysql_error()."";
		}else {$done=FALSE; $doneMSG="Você deve definir o restante da opção MAX";}
	}
	else
	{
		$done = mysql_query("INSERT INTO live_sell VALUES('','".$idItem."','".secu($_POST['nom'])."','".getinfoItem($idItem,"level")."','".$cost."','0','0','".$_POST['packof']."')");
		if($done)$doneMSG="Objet Acrescentado!"; else $doneMSG="ERREUR!".mysql_error()."";
	}
	
	if($done)
	{
		$_GET['id'] = "";
		$_POST['cost'] = "";
		$_POST['maxcost'] = "";
		$_POST['maxable'] = NULL;
		$_POST['nom'] = NULL;
	}
	
} elseif(isset($_POST['add'])) {$done = FALSE; $doneMSG = "Você deve completar os 3 primeiros campos";}
$retourObj = mysql_query("SELECT * FROM live_sell ORDER BY ID");

if(isset($_GET['id']) AND $_GET['id'] != NULL)
{ 
	$nomValue = getinfoItem($_GET['id'],"name");
}
if(isset($_GET['id']))
{
	$idValue = secu($_GET['id']);
}
if(isset($_POST['add']))
{ 
	$costValue = secu($_POST['cost']);
}
if(isset($_POST['add']))
{
	$maxcostValue = secu($_POST['maxcost']);
}
if(isset($_POST['packof']))
{
	$packValue = secu($_POST['packof']);
}
?>
		<?php if($done == TRUE) { echo '<p class="OK">' .  $doneMSG . '</p>'; } ?> <!-- Si la variable de controle du succÃ¨s est a true : affiche une confirmation -->
		<?php if($done == FALSE AND isset($doneMSG)) { echo '<p class="ERROR">' .  $doneMSG . '</p>'; } ?> <!-- Si la variable de controle d'erreur est a true : affiche un message d'erreur -->
		<form action="" method="post">
			<h1>Adicione um item para a loja</h1>
			<center><p style="font-size:13pt"><a href="index.php?page=object">>> Busca a identificação de um objeto<<</a></p>
			
			<table><p>
				<tr><td>Nome: <input type="text" name="nom" id="nom" value="<?php echo $nomValue ?>"/></td>
				<td>ID: <input type="text" name="id" id="id" value="<?php echo $idValue ?>"/></td></tr>
				<tr><td>Preço:<input type="text" name="cost" id="cost" value="<?php echo $costValue ?>"/></td>
				<td>Por pacote: <input type="text" name="packof" id="cost" value="<?php echo $packValue ?>"/></td></tr>
				<tr><td><input type="checkbox" name="maxable" id="maxable" <?php echo $maxableValue ?>/>Jet Perfeito</td>
				<td>Custo Extra: <input type="text" name="maxcost" id="maxcost" value="<?php echo $maxcostValue ?>"/></td></tr>
				<table> <!-- Nouveau tableau contenant le bouton de confirmation -->
					<tr>
						<td><center><input name="add" type="submit" style="padding-left: 50px; padding-right: 50px;" value="Aplicar"></center></td>
					</tr>
				</table> <!-- Fin du tableau du bouton -->
		
			</p>
		</form></center>
		<h1>Assunto para a loja</h1><br>
		<?php if(mysql_num_rows($retourObj) != 0) { ?>
			<center><table>
				<tr>
					<th>Nome</th>
					<th>Nivel</th>
					<th>Custo</th>
					<th>Max?</th>
					<th>Excedente Max</th>
					<th>Remover</th>
				</tr>
				<?php while($donneesObj = mysql_fetch_array($retourObj)) { ?>	<!-- Boucle d'affichage des objet dÃ©jÃ  dans la BD -->
				<?php $nombreItem = getinfoSell($donneesObj['ItemID'],"Nombre");
				if ($nombreItem > 1) $nombreItem = "".$nombreItem."x "; else $nombreItem = "" ?>
					<tr>
						<td><?php echo '<a href="index.php?page=adminobj&amp;modId='.$donneesObj['ItemID'].'">'.$nombreItem.''.$donneesObj['ItemName'].'</a>'; ?></td>
						<td><?php echo $donneesObj['ItemLevel']; ?></td>
						<td><?php echo $donneesObj['Cost']; ?></td>
						<td><?php if($donneesObj['Maxable'] == 1) echo "Oui"; else echo "Non"; ?></td>
						<td><?php if($donneesObj['MaxCost'] == 0) echo ""; else echo $donneesObj['MaxCost']; ?></td>
						<td><?php echo '<a href="index.php?page=adminobj&amp;del='.$donneesObj['ID'].'">Remover</a>'?></td>
					</tr>
				<?php } ?> <!-- Fin de la boucle -->
			</table></center>
		<?php }else echo "<p>Não há itens na loja!</p>" ?>