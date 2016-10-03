<?php 
	// connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=comptes', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }
?>
<div id="bandeau"><img id="loupe" src="images/loupe.png" alt="Loupe" title="Pour agrandir cliquez ici" /></div>
<table class="table">
	<tr>
		<th>Employeur</th>
		<th>Date de début</th>
		<th>Date de fin</th>
		<th>Date de paie</th>
		<th>Montant Net</th>
		<th>Montant Net Imposable</th>
		<th>Heures du mois</th>
		<th>Heures cumul</th>
		<th>Action</th>
	</tr>
<?php 
	// On sélectionne tout ce qu'il y a dans la table des salaires avec les employeurs correspondants
    $requete = "SELECT * FROM salaires, employeur where salaires.IdEmployeur=employeur.IdEmployeur ORDER BY datePaie DESC";
    // On exécute la requête
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
?>
<tr>
	<td><?php echo $donnees['RaisonSociale']; ?></td>
	<td><?php $dated=date_create($donnees['dateDebut']); echo date_format($dated, "d/m/Y"); ?></td>
	<td><?php $datef=date_create($donnees['dateFin']);echo date_format($datef, "d/m/Y"); ?></td>
	<td><?php $datep=date_create($donnees['datePaie']);echo date_format($datep, "d/m/Y"); ?></td>
	<td><?php echo $donnees['montantNet']; ?> €</td>
	<td><?php echo $donnees['montantNetImp']; ?> €</td>
	<td><?php echo $donnees['nbreHeureMois']; ?></td>
	<td><?php echo $donnees['nbreHeureTotal']; ?></td>
	<td><a class="modSal" href="<?php echo $donnees['IdSalaire']; ?>"><img src="images/modifier.png" alt="Modifier"></a></td>
</tr>
<?php    	
    }
?>
</table>