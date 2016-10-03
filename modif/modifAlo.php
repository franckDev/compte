<?php
	
	// connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=comptes', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }

    // Si l'id est posté on appelle une sélection
    if(isset($_POST['id'])){
    	// On stocke l'id sécurisée
	    $id = htmlspecialchars(addslashes($_POST['id']));

	    // On prépare la requête de sélection
		$requete = "SELECT a.montantBrut,a.montantNet,a.dateVersement,a.paiementTiers,e.RaisonSociale,e.TypePresta,e.IdEtablissement 
					FROM allocations AS a
					INNER JOIN etablissement AS e ON a.IdEtablissement=e.IdEtablissement
					WHERE IdAllocation='$id'";

		// On exécute la requête
		$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
		// On lit le résultat
		$response = $resultat->fetch();

		// On ferme la requête
		$resultat->closeCursor();

	    echo json_encode($response);

	// Si l'idSup on appelle une suppression 
    }elseif(isset($_POST['idSup'])){

		// On stocke l'id sécurisée
	    $id = htmlspecialchars(addslashes($_POST['idSup']));

	    // On prépare la requête de sélection
		$requete = "DELETE FROM allocations WHERE IdAllocation='$id'";

		// On exécute la requête
		$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

		echo json_encode($resultat);

		// On ferme la requête
		$resultat->closeCursor();
    }
    
    
?>