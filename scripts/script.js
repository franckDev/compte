/*******************************************************************************************/
/****************************************SCRIPTS********************************************/
/*******************************************************************************************/

$(document).ready(function(){

	// Gestion de tous les formulaires de la page
	$("form").submit(function(){ // Dès que l'on soumet un formulaire
		
		var choix = $(this).attr("id");

		$.post("Form.php",$(this).serialize(),function(texte){ // On créé une variable contenant le formulaire sérialisé
		
			if (choix == "fenetreForm2") {  /********** Enregistrer un nouvel etablissement ********/
                if(texte == "Enregistrement effectué avec succès !"){
                    $("p#message2").css('display', 'block'); // On active le message
                    $("p#message2").empty(); // On vide le message
                    $("p#message2").append(texte); // Affiche le résultat dans le message
                    $("#EtabChoix").load("reload/selectEtab.php"); // On recharge le selecteur
                    $("#fond2").fadeOut(1500,"linear"); // On referme le fond du pop-up
                    $("#fenetreForm2").fadeOut(1500,"linear"); // Et la fenêtre
                }else{
                    $("p#message2").css('display', 'block'); // On active le message
                    $("p#message2").empty(); // On vide le message
                    $("p#message2").append(texte); // Affiche le résultat dans le message
                }
			}else if (choix == "fenetreForm3") {  /********** Enregistrer un salaire ***************/
                if(texte == "Enregistrement effectué avec succès !"){
                    $("p#message3").css('display', 'block'); // On active le message
                    $("p#message3").empty(); // On vide le message
                    $("p#message3").append(texte); // Affiche le résultat dans le message
                    $("div#scroll").load("reload/tableSal.php"); // On recharge le tableau des salaires
                }else{
                    $("p#message3").css('display', 'block'); // On active le message
                    $("p#message3").empty(); // On vide le message
                    $("p#message3").append(texte); // Affiche le résultat dans le message
                }
			}else if (choix == "fenetreForm") {  /******* Enregistrer un nouvel employeur *********/
                if(texte == "Enregistrement effectué avec succès !"){
                    $("p#message").css('display', 'block'); // On active le message
                    $("p#message").empty(); // On vide le message
                    $("p#message").append(texte); // Affiche le résultat dans le message
                    $("#EmpChoix").load("reload/selectEmp.php"); // On recharge le selecteur
                    $("#fond").fadeOut(1500,"linear"); // On referme le fond du pop-up
                    $("#fenetreForm").fadeOut(1500,"linear"); // Et la fenêtre 
                }else{
                    $("p#message").css('display', 'block'); // On active le message
                    $("p#message").empty(); // On vide le message
                    $("p#message").append(texte); // Affiche le résultat dans le message
                }
			}else if (choix == "fenetreForm4") {  /********** Enregistrer une allocation ***************/
                if(texte == "Enregistrement effectué avec succès !"){
                    $("p#message4").css('display', 'block'); // On active le message
                    $("p#message4").empty(); // On vide le message
                    $("p#message4").append(texte); // Affiche le résultat dans le message
                    $("div#scroll2").load("reload/tableAll.php"); // On recharge le tableau des allocations
                }else if (texte == "Mise à jour effectuée avec succès !"){
                    $("p#message4").css('display', 'block'); // On active le message
                    $("p#message4").empty(); // On vide le message
                    $("p#message4").append(texte); // Affiche le résultat dans le message
                    $("div#scroll2").load("reload/tableAll.php"); // On recharge le tableau des allocations
                }else{
                    $("p#message4").css('display', 'block'); // On active le message
                    $("p#message4").empty(); // On vide le message
                    $("p#message4").append(texte); // Affiche le résultat dans le message
                }
			}else if (choix == "rechForm") {   /********** Recherche multi-critères ***************/

				$("div#result").css('display', 'block'); // On active champs conteneur
				$("div#result").empty(); // On le vide 
				$("div#result").append(texte); // Affiche le résultat
			}
		});
		return false;
	});

    // Affichage d'une rubrique
    $('#rubrique li a').click(function(event) {

        event.preventDefault();

        var direction = $(this).attr('dir');

        if(direction == "acc"){

            $('#choixAlloc').css('display', 'none');
            $('#choixSalaire').css('display', 'none');
            $('#choixRech').css('display', 'none');

        }else if(direction == "sal"){

            $('#choixSalaire').css('display', 'block');
            $('#choixAlloc').css('display', 'none');
            $('#choixRech').css('display', 'none');

        }else if(direction == "allo"){

            $('#choixAlloc').css('display', 'block');
            $('#choixSalaire').css('display', 'none');
            $('#choixRech').css('display', 'none');

        }else if(direction == "rech"){

            $('#choixRech').css('display', 'block');
            $('#choixSalaire').css('display', 'none');
            $('#choixAlloc').css('display', 'none');

        }
        
    });

    // Affichage du formulaire des salaires en mode modification
    $('.modSal').click(function(event){
        event.preventDefault();
        $('#formNew').css('display', 'block');
        $('.button').html('Fermer le formulaire');
        var idSal = $(this).attr("href"); // On récupère l'id sélectionnée
        // $('#formNew').load("modif/modifSal.php",{ "id[]": [idSal, ""] });
    });

    // Affichage / Masquage des formulaires salaires 
    $('button.button').click(function(){

        if($('#formNew').css('display') == 'none'){
            $('#scroll').css('overflow-y','hidden');
            $('#formNew').css('display', 'block');
            $('.button').html('Fermer le formulaire');

        }else{
            $('#scroll').css('overflow-y','auto');
            $('#formNew').css('display', 'none');
            $('.button').html('Enregistrer un salaire');
        }
    });

    // Affichage / Masquage des formulaires allocations
    $('button.button2').click(function(){

        if($('#modeAlo').val() == 'modification'){
            
            $('#modeAlo').val('enregistrement');
            $('#modeAlo').attr('name','enregistrement');
            $('#fenetreForm4 h3').html('Formulaire d\'enregistrement');
            $('#valideAlo').val('Enregistrer'); // On change le nom du bouton
            // On réinitialise le formulaire
            $('#resetAlo').click();
            $('#hideId').attr('value',''); // On retire l'id du formulaire

            $('#formNew2').css('display', 'none');
            $('.button2').html('Enregistrer une allocation');

        }else if ($('#modeAlo').val() == 'enregistrement'){
            
            if($('#formNew2').css('display') == 'none'){
                $('#scroll2').css('overflow-y','hidden');
                $('#formNew2').css('display', 'block');
                $('.button2').html('Fermer le formulaire');

            }else{
                $('#scroll2').css('overflow-y','auto');
                $('#formNew2').css('display', 'none');
                $('.button2').html('Enregistrer une allocation');
            }
        }
        
    });

    // Ouvre une fenetre pour enregistrer un nouvel employeur
    $('select').click(function(){
    	if($('.champs option:selected').val() == 'enregNew'){
    		$('.champs option[value="choix"]').attr('selected', true);
    		$('#fond').css('display', 'block');
    		$('#fenetreForm').css('display', 'block');

    	}else if ($('.champs2 option:selected').val() == 'enregNewEtab') {
    		$('.champs2 option[value="choix2"]').attr('selected', true);
    		$('#fond2').css('display', 'block');
    		$('#fenetreForm2').css('display', 'block');
    	}
    });

    // Refermer la fenêtre de création d'un employeur
    $('#fermFenetreForm').click(function(){
    	$('#fond').css('display', 'none');
    	$('#fenetreForm').css('display', 'none');
    	$('.champs option[value="choix"]').attr('selected', true);
    });

    // Refermer la fenêtre de création d'un etablissement
    $('#fermFenetreForm2').click(function(){
    	$('#fond2').css('display', 'none');
    	$('#fenetreForm2').css('display', 'none');
    	$('.champs2 option[value="choix2"]').attr('selected', true);
    });

    // Nettoyer le Post
    $(':reset').click(function(){
    	$('#message').css('display', 'none');
    	$('#message2').css('display', 'none');
    	$('#message3').css('display', 'none');
    	$('#message4').css('display', 'none');
    	$('#message5').css('display', 'none');
        $("div#result").css('display', 'none');
    });

    // Affichage en plein ecran du tableau de salaire
    $('#loupe').click(function() {
    	
    	if($('#scroll').height() > 416){

    		$('#scroll').css({
	    		height: '416',
	    		'overflow-y': 'scroll'
	    	});

    	}else{

    		$('#scroll').css({
	    		height: 'auto',
	    		'overflow-y': 'hidden'
	    	});
    	}
    });

        // Affichage en plein ecran du tableau des allocations
    $('#loupe2').click(function() {
        
        if($('#scroll2').height() > 416){

            $('#scroll2').css({
                height: '416',
                'overflow-y': 'scroll'
            });

        }else{

            $('#scroll2').css({
                height: 'auto',
                'overflow-y': 'hidden'
            });
        }
    });
	    
});