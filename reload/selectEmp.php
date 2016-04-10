<?php
	// connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=comptes', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }
	// On sélectionne la liste des employeurs
	$requeteEmpl = "SELECT * FROM employeur ORDER BY IdEmployeur DESC";
	// exécution de la requête
	$resultat = $bdd->query($requeteEmpl) or die(print_r($bdd->errorInfo()));
	// On affiche la liste des employeurs
	while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
?>
<option value="<?php echo $donnees['IdEmployeur'] ?>"> <?php echo $donnees['RaisonSociale'] ?></option>";
<?php
	}
?>
<option id="choixEmployeur" value="enregNew">Enregistrer un nouvel employeur</option>