?>
<script type="text/javascript">
	$('#choix option[value="Salaires"]').prop('selected' , true);
	$('#choixSalaire').css('display', 'block');
	$("#fond").css('display', 'block');
	$("#fenetreForm").css('display', 'block');
	$("#message").css('display', 'block');
	$("#message").html('Vous devez saisir une ville !');
</script>
<?php
?>
<script type="text/javascript">
	$('#choix option[value="Salaires"]').prop('selected' , true);
	$('#choixSalaire').css('display', 'block');
	$("#fond").css('display', 'block');
	$("#fenetreForm").css('display', 'block');
	$("#message").css('display', 'block');
	$("#message").html('Vous devez saisir un code postal !');
</script>
<?php
?>
<script type="text/javascript">
	$('#choix option[value="Salaires"]').prop('selected' , true);
	$('#choixSalaire').css('display', 'block');
	$("#fond").css('display', 'block');
	$("#fenetreForm").css('display', 'block');
	$("#message").css('display', 'block');
	$("#message").html('Vous devez saisir une adresse !');
</script>
<?php
?>
<script type="text/javascript">
	$('#choix option[value="Salaires"]').prop('selected' , true);
	$('#choixSalaire').css('display', 'block');
	$("#fond").css('display', 'block');
	$("#fenetreForm").css('display', 'block');
	$("#message").css('display', 'block');
	$("#message").html('Vous devez saisir une raison sociale !');
</script>
<?php

// On sélectionne tout ce qu'il y a dans la table des allocations avec les etablissements correspondants
	$requete = "SELECT * FROM allocations, etablissement where allocations.IdEtablissement=etablissement.IdEtablissement ORDER BY dateVersement DESC";
	    // On exécute la requête
	    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

	    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
	?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php    	
	    }
	?>
	</table>