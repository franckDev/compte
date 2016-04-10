<?php
	// connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=comptes', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }
	// On sélectionne la liste des employeurs
	$requeteEtab = "SELECT * FROM etablissement ORDER BY IdEtablissement DESC";
	// exécution de la requête
	$resultat = $bdd->query($requeteEtab) or die(print_r($bdd->errorInfo()));
	// On affiche la liste des employeurs
	while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
?>
<option value="<?php echo $donnees['IdEtablissement'] ?>"> <?php echo $donnees['RaisonSociale']."(".$donnees['TypePresta'].")"; ?></option>";
<?php
	}
?>
<option id="choixEtablissement" value="enregNewEtab">Enregistrer un nouvel etablissement</option>