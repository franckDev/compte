<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Salaire & Allocations</title>
		<link rel="stylesheet" href="style/style.css" />
		<link rel="stylesheet" href="style/jcalculator.css" />
		<!-- /**********************************SCRIPTS JQUERY****************************************************/ -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="scripts/script.js"></script>
		<script src="scripts/jcalculator.js"></script>
	</head>
	<body>
		<?php
			// connexion à la base de données
		    try {
		        $bdd = new PDO('mysql:host=localhost;dbname=comptes', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		    } catch(Exception $e) {
		        exit('Impossible de se connecter à la base de données.');
		    }
		?>
<!-- /****************************************SELECTION D UNE RUBRIQUE**********************************************/ -->
		<p id="rubrique">
			<select name="choixRubrique" id="choix">
				<option value="ChoixRub">Choisissez une rubrique à afficher</option>
				<option value="Salaires">Salaires</option>
				<option value="Allocations">Allocations</option>
				<option value="Recherche">Effectuer une recherche</option>
			</select>
		</p>
<!-- /****************************************SALAIRES**********************************************/ -->
		<div id="choixSalaire">
			<h1>Liste des salaires</h1>
			<div id="scroll">
			<div id="bandeau"><img id="loupe" src="images/loupe.png" alt="Loupe" title="Pour agrandir cliquez ici" /></div>
				<table>
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
			</div>
			<div class="container">
				<button class="button">Enregistrer un salaire</button>
				<div id="formNew">
					<form id="fenetreForm3" action="Form.php" method="post">
						<fieldset>
							<h3>Formulaire d'enregistrement</h3>
							<p>
								<label for="nomEmployeur">Sélectionnez un employeur</label>
								<select id="EmpChoix" class="champs" name="listEmployeur">
									<option value="choix">Choisissez</option>
									<?php
										// On sélectionne la liste des employeurs
										$requeteEmpl = "SELECT * FROM employeur ORDER BY RaisonSociale";
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
								</select>
							</p>
							<p>
								<label for="dateDebut">Date de début</label>
								<input class="champs" type="date" name="DateDeb" value="" />
								<input type="hidden" name="Salaire" />
							</p>
							<p>
								<label for="dateFin">Date de fin</label>
								<input class="champs" type="date" name="DateFin" value="" />
							</p>
							<p>
								<label for="datePaie">Date de paie</label>
								<input class="champs" type="date" name="DatePaie" value="" />
							</p>
							<p>
								<label for="montantBrut">Montant Brut</label>
								<input class="champs" type="number" step="0.01" name="MontantBrut" value="" />
							</p>
							<p>
								<label for="montantNet">Montant Net</label>
								<input class="champs" type="number" step="0.01" name="MontantNet" value="" />
							</p>
							<p>
								<label for="montantNetImp">Montant Net Imposable</label>
								<input class="champs" type="number" step="0.01" name="MontantNetImp" value="" />
							</p>
							<p>
								<label for="nbreHeureMois">Nombre d'heures travaillées dans le mois</label>
								<input class="champs" type="number" step="0.01" name="NbreHeureMois" value="" />
							</p>
							<p>
								<label for="nbreHeureTotal">Cumul d'heures travaillées de l'année</label>
								<input id="cumul" class="champs" type="number" step="0.01" name="NbreHeureTotal" value="" />
							</p>
								<p id="message3"></p>
								<input class="valide" type="submit" value="Enregistrer">
								<input class="reset" type="reset" value="Effacer">		
						</fieldset>
					</form>
				</div>
			</div>
			<!-- Script de calculatrice -->
			<script>
				$(document).ready(function(){
					$('#cumul').calculator();
					$('#cumul').css('float', 'none');
					$('.jcalculator_wrap').css('float', 'right');
					$('.jcalculator.material').css({
						left: '235px',
						bottom: '0px'
					});
					$('.eq').click(function() {
						$('.jcalculator.material').hide();
					});
				});
			</script>
			<!-- Pop up formulaire nouvel employeur -->
			<div id="fond"></div>
			<form id="fenetreForm" action="Form.php" method="post">
				<img id="fermFenetreForm" src="images/fermeture.png" alt="fermer" title="Fermer la fenêtre"><br><br>
				<fieldset>
					<legend>Saisissez les informations du nouvel employeur</legend>
					<p>
						<label for="RaisonSoc">Raison Sociale *</label>
						<input type="text" name="Raisoc" value="" />
						<input type="hidden" name="Employeur" />
					</p>
					<p>
						<label for="Adresse">Adresse *</label>
						<input type="text" name="Adresse" value="" />
					</p>
					<p>
						<label for="CodePostal">Code Postal *</label>
						<input type="text" name="CodePost" value="" />
					</p>
					<p>
						<label for="Ville">Ville *</label>
						<input type="text" name="Ville" value="" />
					</p>
				</fieldset>
				<p>
					<p id="message"></p>
					<input class="valide" title="Envoyer le formulaire" type="submit" value="Envoyer">
					<input class="reset" title="Réinitialiser le formulaire" type="reset" value="Effacer">		
				</p>
			</form>
		</div> <!--Fin du choix-->
<!-- /****************************************ALLOCATIONS**********************************************/ -->
		<div id="choixAlloc">
			<h1>Liste des revenus d'allocations</h1>
			<div id="scroll2">
			<div id="bandeau2"><img id="loupe2" src="images/loupe.png" alt="Loupe" title="Pour agrandir cliquez ici" /></div>
				<table>
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
				?>
				</table>
				<script src="scripts/actionsAlo.js"></script>
			</div>
			<div class="container2">
				<button class="button2">Enregistrer une allocation</button>
				<div id="formNew2">
					<form id="fenetreForm4" action="Form.php" method="post">
						<fieldset>
							<h3>Formulaire d'enregistrement</h3>
							<input id="modeAlo" type="hidden" name="enregistrement" value="enregistrement" />
							<p>
								<label for="nomEtablissement">Sélectionnez un etablissement</label>
								<select id="EtabChoix" class="champs2" name="listEtablissement">
									<option value="choix2">Choisissez</option>
									<?php
										// On sélectionne la liste des employeurs
						    			$requeteEtab = "SELECT * FROM etablissement ORDER BY RaisonSociale";
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
								</select>
							</p>
							<p>
								<label for="montantBrut">Montant Brut</label>
								<input class="champs2" type="number" step="0.01" name="MontantBrutAll" value="" />
								<input id="hideId" type="hidden" name="Allocation">
							</p>
							<p>
								<label for="montantNet">Montant Net</label>
								<input class="champs2" type="number" step="0.01" name="MontantNetAll" value="" />
							</p>
							<p>
								<label for="dateDeVersement">Date de Versement</label>
								<input class="champs2" type="date" name="DateVers" value="" />
							</p>
							<p>
								<label for="PaieTiers">Paiement à un tiers</label>
								<p>
									<input class="champs2" type="radio" name="Tiers" value="1" />
									<label for="PaieTiersOui">Oui</label>
								</p>
								<p>
									<input class="champs2" type="radio" name="Tiers" value="0" />
									<label for="PaieTiersNon">Non</label>
								</p>
							</p>
							<p id="message4"></p>
								<input id="valideAlo" class="valide" type="submit" value="Enregistrer">
								<input id="resetAlo" class="reset" type="reset" value="Effacer">		
						</fieldset>
					</form>
				</div>
			</div>
			<!-- Pop up formulaire nouvel etablissement -->
			<div id="fond2"></div>
			<form id="fenetreForm2" method="post" action="Form.php">
				<img id="fermFenetreForm2" src="images/fermeture.png" alt="fermer" title="Fermer la fenêtre"><br><br>
				<fieldset>
					<legend>Saisissez les informations du nouvel etablissement</legend>
					<p>
						<label for="RaisonSoc">Raison Sociale *</label>
						<input id="RaisocEtab" type="text" name="RaisocEtab" />
						<input type="hidden" name="Etablissement" />
					</p>
					<p>
						<label for="TypePresta">Type de prestation *</label>
						<select id="typeDePresta" name="typeDePresta">
							<option value="Aucune">Choisissez une prestation</option>
							<option value="Logement">Allocation Logement</option>
							<option value="Famille">Allocation Familiale</option>
							<option value="Chomage ARE">Allocation Chomage (ARE)</option>
							<option value="Chomage ASS">Allocation Chomage (ASS)</option>
						</select>
					</p>
				</fieldset>
				<p>
					<p id="message2"></p>
					<input class="valide" title="Envoyer le formulaire" type="submit" value="Envoyer">
					<input class="reset" title="Réinitialiser le formulaire" type="reset" value="Effacer">		
				</p>
			</form>
		</div><!--Fin du choix-->
<!-- /****************************************RECHERCHE**********************************************/ -->
		<div id="choixRech">
			<h1>Recherche</h1>
			<!-- Formulaire de recherche multi-critères -->
			<form id="rechForm" action="Rech.php" method="post">
				<fieldset>
					<legend>Effectuez une recherche multi-critères</legend>
					<p>
						<label for="choixRub">Choix de la rubrique</label>
						<select name="rubList" id="">
							<option value="lesDeux">Salaires & Allocations</option>
							<option value="Rechsal">Salaires</option>
							<option value="Rechalloc">Allocations</option>
						</select>
					</p>
					<p>
						<label for="dateDebut">Date de début</label>
						<input class="champs2" type="date" name="DateDebRech" value="" />
						<input type="hidden" name="Recherche">
					</p>
					<p>
						<label for="dateFin">Date de fin</label>
						<input class="champs2" type="date" name="DateFinRech" value="" />
					</p>
						<input class="valide" type="submit" value="Rechercher">
						<input class="reset" type="reset" value="Effacer">
				</fieldset>
			</form>
			<div id="result"></div>
		</div><!--Fin du choix-->
	</body>
</html>