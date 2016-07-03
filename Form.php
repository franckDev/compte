<?php
/********************************************************************************************************************/
/************************************Enregistrement des formulaires**************************************************/
/********************************************************************************************************************/

	// connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=comptes', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }

    /********Procedure d'enregistrement d'une allocation*********/

	if(isset($_POST['Allocation']) && isset($_POST['enregistrement'])){ // Validation d'un enregistrement demandée

		
		// On vérifie si un etablissement a été sélectionné
		if($_POST['listEtablissement']!="choix2" && $_POST['listEtablissement']!="enregNewEtab"){

			// on sécurise les données
			$idEtablissement = $_POST['listEtablissement'];
			$montantBrutAll = htmlspecialchars(addslashes($_POST['MontantBrutAll']));
			$montantNetAll = htmlspecialchars(addslashes($_POST['MontantNetAll']));
			$dateVers = htmlspecialchars(addslashes($_POST['DateVers']));
			$tiers = htmlspecialchars(addslashes($_POST['Tiers']));

			// On vérifie si elle n'a pas déjà été enregistrée
			$requete = "SELECT COUNT(*) FROM allocations WHERE dateVersement='$dateVers' AND montantNet='$montantNetAll'";
			// On exécute la requête
			$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
			// On lit le résultat
			$response = $resultat->fetch();

			// On compare le résultat
			if($response[0] == 0){

				// Requête d'enregistrement d'une nouvelle allocation
				$requete = "INSERT INTO allocations (IdAllocation , IdEtablissement , montantBrut , montantNet , dateVersement , paiementTiers , Created , idUtilisateur)
						    VALUES ('' , '$idEtablissement' , '$montantBrutAll' , '$montantNetAll' , '$dateVers' , '$tiers' , NOW() , '1')";

				// On exécute la requête
				$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

				// On ferme la requête
				$resultat->closeCursor();

				echo "Enregistrement effectué avec succès !";

			}else{

				// On ferme la requête
				$resultat->closeCursor();

				echo "L'allocation que vous venez de saisir existe déjà !";
			}
		}else{

			echo "Vous devez sélectionner un établissement !";
		}

	}elseif(isset($_POST['Allocation']) && isset($_POST['modification'])){ // Validation d'une mise à jour demandée
					
		// on sécurise les données
		$IdAllocation = htmlspecialchars(addslashes($_POST['Allocation']));
		$idEtablissement = htmlspecialchars(addslashes($_POST['listEtablissement']));
		$montantBrutAll = htmlspecialchars(addslashes($_POST['MontantBrutAll']));
		$montantNetAll = htmlspecialchars(addslashes($_POST['MontantNetAll']));
		$dateVers = htmlspecialchars(addslashes($_POST['DateVers']));
		$tiers = htmlspecialchars(addslashes($_POST['Tiers']));

		// Requête de mise à jour de l'allocation
		$requete = "UPDATE allocations SET IdEtablissement='$idEtablissement',montantBrut='$montantBrutAll',montantNet='$montantNetAll',dateVersement='$dateVers',paiementTiers='$tiers' WHERE IdAllocation='$IdAllocation'";

		// On exécute la requête
		$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

		// On ferme la requête
		$resultat->closeCursor();

		echo "Mise à jour effectuée avec succès !";
	}

	/****Procedure d'enregistrement d'un nouvel etablissement***/

	if(isset($_POST['Etablissement'])){ // Validation demandée

		// On vérifie si les champs sont remplis
		if(!empty($_POST['RaisocEtab'] AND $_POST['typeDePresta']!="Aucune")){
			
			// on sécurise les données
			$raisoc = htmlspecialchars(addslashes($_POST['RaisocEtab']));
			$typPresta = htmlspecialchars(addslashes($_POST['typeDePresta']));

			// On prépare la requête
			$requete = "INSERT INTO etablissement (IdEtablissement , RaisonSociale , TypePresta , Created)
					    VALUES ('' , '$raisoc' , '$typPresta' , NOW())";

			// On l'exécute
			$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

			// On ferme la requête
			$resultat->closeCursor();

			echo "Enregistrement effectué avec succès !";

		}else{
			echo "Tous les champs sont obligatoires !";
		}
	}


	/***********Procedure d'enregistrement d'un salaire***********/

	if(isset($_POST['Salaire'])){

		if($_POST['listEmployeur']!="choix" && $_POST['listEmployeur']!="enregNew"){

			// on commence l'enregistrement
			$idEmployeur = $_POST['listEmployeur'];
			$dateDeb = htmlspecialchars(addslashes($_POST['DateDeb']));
			$dateFin = htmlspecialchars(addslashes($_POST['DateFin']));
			$datePaie = htmlspecialchars(addslashes($_POST['DatePaie']));
			$montantBrut = htmlspecialchars(addslashes($_POST['MontantBrut']));
			$montantNet = htmlspecialchars(addslashes($_POST['MontantNet']));
			$montantNetImp = htmlspecialchars(addslashes($_POST['MontantNetImp']));
			$nbreHeureMois = htmlspecialchars(addslashes($_POST['NbreHeureMois']));
			$nbreHeureTotal = htmlspecialchars(addslashes($_POST['NbreHeureTotal']));

			// On vérifie si il n'a pas déjà été enregistré
			$requete = "SELECT COUNT(*) FROM salaires WHERE datePaie='$datePaie' AND montantNet='$montantNet'";
			// On exécute la requête
			$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
			// On lit le résultat
			$response = $resultat->fetch();

			// On compare le résultat
			if($response[0] == 0){

				// Requête d'enregistrement d'un nouveau contact
				$requete = "INSERT INTO salaires (IdSalaire , IdEmployeur , dateDebut , dateFin , datePaie , montantBrut , montantNet , montantNetImp , nbreHeureMois , nbreHeureTotal , divers , Created, idUtilisateur)
						    VALUES ('' , '$idEmployeur' , '$dateDeb' , '$dateFin' , '$datePaie' , '$montantBrut' , '$montantNet' , '$montantNetImp' , '$nbreHeureMois' , '$nbreHeureTotal' , '' , NOW() , '1')";

				//exécution de la requête
				$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
				// On ferme la requête
				$resultat->closeCursor();

				echo "Enregistrement effectué avec succès !";

			}else{

				// On ferme la requête
				$resultat->closeCursor();

				echo "Le salaire que vous venez de saisir existe déjà !";
			}

		}else{
			echo "Vous devez choisir un employeur !";
		}
	}
			

	/****Procedure d'enregistrement d'un nouvel employeur***/

	if(isset($_POST['Employeur'])){ // Validation demandée

		// On vérifie si les champs sont remplis
		if(!empty($_POST['Raisoc'])){

			if(!empty($_POST['Adresse'])){

				if(!empty($_POST['CodePost'])){

					if(!empty($_POST['Ville'])){

						// on commence l'enregistrement
						$raisoc = htmlspecialchars(addslashes($_POST['Raisoc']));
						$adress = htmlspecialchars(addslashes($_POST['Adresse']));
						$CodePost = htmlspecialchars(addslashes($_POST['CodePost']));
						$ville = htmlspecialchars(addslashes($_POST['Ville']));

						//Requête d'enregistrement d'un nouveau contact
						$requete = "INSERT INTO employeur (IdEmployeur , RaisonSociale , Adresse , CodePostal , Ville , Created)
								    VALUES ('' , '$raisoc' , '$adress' , '$CodePost' , '$ville' , NOW())";

						//exécution de la requête
						$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
						// On ferme la requête
						$resultat->closeCursor();
						
						echo "Enregistrement effectué avec succès !";

					}else{
						echo "Vous devez saisir une ville !";
					}
				}else{
					echo "Vous devez saisir un code postal !";
				}
			}else{
				echo "Vous devez saisir une adresse !";
			}
		}else{
			echo "Vous devez saisir une raison sociale !";
		}
	}


	/********************************************************************************************************************/
	/***************************************Recherche multi-critères*****************************************************/
	/********************************************************************************************************************/

	if(isset($_POST['Recherche'])){ // Validation demandée

		if(!empty($_POST['DateDebRech']) && !empty($_POST['DateFinRech'])){

			// Initialisation des variables
		    $total=0;
			$dateDebut = $_POST['DateDebRech'];
			$dateFin = $_POST['DateFinRech'];
			$choix = $_POST['rubList'];
			
			// $dateDebut = new DateTime($dateDebut);
			// $dateDebut = $dateDebut->format('Ymd');
			// $dateFin = new DateTime($dateFin);
			// $dateFin = $dateFin->format('Ymd');

			// Tableau des mois
			$moisTab = array("1"=>"Janvier",
							 "2"=>"Février",
							 "3"=>"Mars",
							 "4"=>"Avril",
							 "5"=>"Mai",
							 "6"=>"Juin",
							 "7"=>"Juillet",
							 "8"=>"Août",
							 "9"=>"Septembre",
							 "10"=>"Octobre",
							 "11"=>"Novembre",
							 "12"=>"Décembre");

			if($choix == "lesDeux"){ // Recherche sur les deux critères
				// On prepare l'entête du tableau
				$content ="<table>
							<tr>
								<th>Type de revenu</th>
								<th>Période</th>
								<th>Montant net imposable</th>
								<th>Cumul</th>
							</tr>";

		    	/****************Chargement des salaires***************/

		    	// On prépare la requête des salaires
		    	$requete1 = "SELECT IdSalaire,montantNetImp,datePaie
		    				 FROM salaires
		    				 WHERE dateDebut>='$dateDebut' and dateFin<='$dateFin'
		    				 ORDER BY datePaie";

		    	// On exécute la requête
		    	$resultat1 = $bdd->query($requete1) or die(print_r($bdd->errorInfo()));

		    	// On stocke les données issus de cette requête
		    	while($donnees1 = $resultat1->fetch(PDO::FETCH_ASSOC)) {
		    			
		    			// Variables Salaire
		    			$typedeRevenu = "Salaire";
		    			$datev = date_create($donnees1['datePaie']);
		    			$periode = $moisTab[date_format($datev, "n")]." / ".date_format($datev, "Y");
		    			$montantNet = $donnees1['montantNetImp'];

		    			$total+=$montantNet; // On ajoute le montant

						$content.='<tr>
									  <td class="orange">'.$typedeRevenu.'</td>
									  <td class="orange">'.$periode.'</td>
									  <td class="orange">'.$montantNet.'</td>
									  <td class="orange">'.$total.'</td>
								  </tr>';
				}

				// On ferme la requête
				$resultat1->closeCursor();

		    	/**************Chargement des allocations**************/

		    	// On prépare la requête des allocations
		    	$requete2 = "SELECT IdAllocation,montantNet,dateVersement
		    				 FROM allocations
		    				 WHERE dateVersement>='$dateDebut' and dateVersement<='$dateFin'
		    				 ORDER BY dateVersement";

		    	// On exécute la requête
		    	$resultat2 = $bdd->query($requete2) or die(print_r($bdd->errorInfo()));

		    	// On stocke les données issus de cette requête
		    	while($donnees2 = $resultat2->fetch(PDO::FETCH_ASSOC)) {

		    			// Variables Allocation
		    			$typedeRevenu = "Allocation";
		    			$datev = date_create($donnees2['dateVersement']);
		    			$periode = $moisTab[date_format($datev, "n")]." / ".date_format($datev, "Y");
		    			$montantNet = $donnees2['montantNet'];

		    			$total+=$montantNet; // On ajoute le montant

						$content.='<tr>
									  <td class="brown">'.$typedeRevenu.'</td>
									  <td class="brown">'.$periode.'</td>
									  <td class="brown">'.$montantNet.'</td>
									  <td class="brown">'.$total.'</td>
								  </tr>';

						
		    	}

		    	// On ferme la requête
				$resultat2->closeCursor();

						$content.='<tr><td></td></tr>';

		    	/***************On finalise le tableau******************/
		    	$dateDebut = date_create($dateDebut);
		    	$dateFin = date_create($dateFin);

		    			$content.='<tr>
				    				  <td colspan="3"><b>Total des revenus et salaires pour la période du '.date_format($dateDebut,"j").' '.$moisTab[date_format($dateDebut,"n")].' '.date_format($dateDebut,"Y").' au '.date_format($dateFin,"j").' '.$moisTab[date_format($dateFin,"n")].' '.date_format($dateFin,"Y").' </b></td>
									  <td colspan="1" class="red"><b>'.$total.'</b></td>
								   <tr>
								</table>';
						// On affiche
		   				echo $content;
		   

			}elseif($_POST['rubList'] == "Rechsal"){ // Recherche sur les salaires

				// On prepare l'entête du tableau
				$content ="<table>
							<tr>
								<th>Type de revenu</th>
								<th>Période</th>
								<th>Montant net imposable</th>
								<th>Cumul</th>
							</tr>";

		    	/****************Chargement des salaires***************/

		    	// On prépare la requête des salaires
		    	$requete1 = "SELECT IdSalaire,montantNetImp,datePaie
		    				 FROM salaires
		    				 WHERE dateDebut>='$dateDebut' and dateFin<='$dateFin'
		    				 ORDER BY datePaie";

		    	// On exécute la requête
		    	$resultat1 = $bdd->query($requete1) or die(print_r($bdd->errorInfo()));

		    	// On stocke les données issus de cette requête
		    	while($donnees1 = $resultat1->fetch(PDO::FETCH_ASSOC)) {
		    			
		    			// Variables Salaire
		    			$typedeRevenu = "Salaire";
		    			$datev = date_create($donnees1['datePaie']);
		    			$periode = $moisTab[date_format($datev, "n")]." / ".date_format($datev, "Y");
		    			$montantNet = $donnees1['montantNetImp'];

		    			$total+=$montantNet; // On ajoute le montant

						$content.='<tr>
									  <td class="orange">'.$typedeRevenu.'</td>
									  <td class="orange">'.$periode.'</td>
									  <td class="orange">'.$montantNet.'</td>
									  <td class="orange">'.$total.'</td>
								  </tr>';
				}

				// On ferme la requête
				$resultat1->closeCursor();

						$content.='<tr><td></td></tr>';

		    	/***************On finalise le tableau******************/
		    	$dateDebut = date_create($dateDebut);
		    	$dateFin = date_create($dateFin);

		    			$content.='<tr>
				    				  <td colspan="3"><b>Total des revenus et salaires pour la période du '.date_format($dateDebut,"j").' '.$moisTab[date_format($dateDebut,"n")].' '.date_format($dateDebut,"Y").' au '.date_format($dateFin,"j").' '.$moisTab[date_format($dateFin,"n")].' '.date_format($dateFin,"Y").' </b></td>
									  <td colspan="1" class="red"><b>'.$total.'</b></td>
								   <tr>
								</table>';
				// On affiche
   				echo $content;


			}elseif ($_POST['rubList'] == "Rechalloc"){ // Recherche sur les allocations

				// On prepare l'entête du tableau
				$content ="<table>
							<tr>
								<th>Type de revenu</th>
								<th>Période</th>
								<th>Montant net imposable</th>
								<th>Cumul</th>
							</tr>";

				/**************Chargement des allocations**************/

		    	// On prépare la requête des allocations
		    	$requete2 = "SELECT IdAllocation,montantNet,dateVersement
		    				 FROM allocations
		    				 WHERE dateVersement>='$dateDebut' and dateVersement<='$dateFin'
		    				 ORDER BY dateVersement";

		    	// On exécute la requête
		    	$resultat2 = $bdd->query($requete2) or die(print_r($bdd->errorInfo()));

		    	// On stocke les données issus de cette requête
		    	while($donnees2 = $resultat2->fetch(PDO::FETCH_ASSOC)) {

		    			// Variables Allocation
		    			$typedeRevenu = "Allocation";
		    			$datev = date_create($donnees2['dateVersement']);
		    			$periode = $moisTab[date_format($datev, "n")]." / ".date_format($datev, "Y");
		    			$montantNet = $donnees2['montantNet'];

		    			$total+=$montantNet; // On ajoute le montant

						$content.='<tr>
									  <td class="brown">'.$typedeRevenu.'</td>
									  <td class="brown">'.$periode.'</td>
									  <td class="brown">'.$montantNet.'</td>
									  <td class="brown">'.$total.'</td>
								  </tr>';

						
		    	}

		    	// On ferme la requête
				$resultat2->closeCursor();

						$content.='<tr><td></td></tr>';

		    	/***************On finalise le tableau******************/
		    	$dateDebut = date_create($dateDebut);
		    	$dateFin = date_create($dateFin);

		    			$content.='<tr>
				    				  <td colspan="3"><b>Total des revenus et salaires pour la période du '.date_format($dateDebut,"j").' '.$moisTab[date_format($dateDebut,"n")].' '.date_format($dateDebut,"Y").' au '.date_format($dateFin,"j").' '.$moisTab[date_format($dateFin,"n")].' '.date_format($dateFin,"Y").' </b></td>
									  <td colspan="1" class="red"><b>'.$total.'</b></td>
								   <tr>
								</table>';
						// On affiche
		   				echo $content;

			}

		}elseif((!empty($_POST['DateDebRech']) && !empty($_POST['DateFinRech'])) && ($_POST['DateDebRech'] > $_POST['DateFinRech'])){

			echo '<p class="red">Vous devez choisir une date de début incohérente avec la date de fin !</p>';
			
		}else{
	   		echo '<p class="red">Vous devez choisir une date de début et une date de fin !</p>';
	   	}


	} // Fin de Validation
	

	

?>