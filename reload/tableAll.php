<?php 
	// connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=comptes', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }
?>
<div id="bandeau2"><img id="loupe2" src="images/loupe.png" alt="Loupe" title="Pour agrandir cliquez ici" /></div>
<table class="table">
	<tr>
		<th>Etablissement</th>
		<th>Type de prestation</th>
		<th>Date de versement</th>
		<th>Montant Net</th>
		<th>Paiement à un tiers</th>
		<th>Actions</th>
	</tr>
<?php 
	// On sélectionne tout ce qu'il y a dans la table des allocations avec les etablissements correspondants
    $requete = "SELECT * FROM allocations, etablissement where allocations.IdEtablissement=etablissement.IdEtablissement ORDER BY dateVersement DESC";
    // On exécute la requête
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {

echo '<tr class="cible'.$donnees['IdAllocation'].'">';

?>
	<td><?php echo $donnees['RaisonSociale']; ?></td>
	<td><?php echo $donnees['TypePresta']; ?></td>
	<td><?php $datev=date_create($donnees['dateVersement']); echo date_format($datev, "d/m/Y"); ?></td>
	<td><?php echo $donnees['montantNet']; ?> €</td>
	<td><?php if ($donnees['paiementTiers']) echo "Oui"; else echo "Non"; ?></td>
	<td><a class="modAlo" href="<?php echo $donnees['IdAllocation']; ?>"><img src="images/modifier.png" title="Modifier" alt="Modifier"></a></td>
	<td><a class="supAlo" href="<?php echo $donnees['IdAllocation']; ?>"><img src="images/supprimer.png" title="Supprimer" alt="Supprimer"></a></td>
</tr>
<?php    	
    }

    // On ferme la requête
	$resultat->closeCursor();

?>
</table>
<script src="scripts/actionsAlo.js"></script>