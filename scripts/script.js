/*******************************************************************************************/
/****************************************SCRIPTS********************************************/
/*******************************************************************************************/

$(document).ready(function(){

	// Gestion de tous les formulaires de la page
	$("form").submit(function(){ // Dès que l'on soumet un formulaire
		
		var choix = $(this).attr("id");

		$.post("Form.php",$(this).serialize(),function(texte){ // On créé une variable contenant le formulaire sérialisé
		
			if (choix == "fenetreForm2") {  /********** Enregistrer un nouvel etablissement ********/

				$("p#message2").css('display', 'block'); // On active le message
				$("p#message2").empty(); // On vide le message
				$("p#message2").append(texte); // Affiche le résultat dans le message

			}else if (choix == "fenetreForm3") {  /********** Enregistrer un salaire ***************/

				$("p#message3").css('display', 'block'); // On active le message
				$("p#message3").empty(); // On vide le message
				$("p#message3").append(texte); // Affiche le résultat dans le message
				
			}else if (choix == "fenetreForm") {  /******* Enregistrer un nouvel employeur *********/

				$("p#message").css('display', 'block'); // On active le message
				$("p#message").empty(); // On vide le message
				$("p#message").append(texte); // Affiche le résultat dans le message
				
			}else if (choix == "fenetreForm4") {  /********** Enregistrer une allocation ***************/

				$("p#message4").css('display', 'block'); // On active le message
				$("p#message4").empty(); // On vide le message
				$("p#message4").append(texte); // Affiche le résultat dans le message
				
			}else if (choix == "rechForm") {   /********** Recherche multi-critères ***************/

				$("div#result").css('display', 'block'); // On active champs conteneur
				$("div#result").empty(); // On le vide 
				$("div#result").append(texte); // Affiche le résultat
				
			}
		});
		return false;
	});


	// Affichage d'une rubrique
	$('#rubrique,select').change(function() {
		if($('#choix option:selected').val() == 'Salaires'){

    		$('#choixSalaire').css('display', 'block');
    		$('#choixAlloc').css('display', 'none');
    		$('#choixRech').css('display', 'none');

    	}else if ($('#choix option:selected').val() == 'Allocations') {

    		$('#choixAlloc').css('display', 'block');
    		$('#choixSalaire').css('display', 'none');
    		$('#choixRech').css('display', 'none');

    	}else if ($('#choix option:selected').val() == 'ChoixRub') {

    		$('#choixAlloc').css('display', 'none');
    		$('#choixSalaire').css('display', 'none');
    		$('#choixRech').css('display', 'none');

    	}else if ($('#choix option:selected').val() == 'Recherche') {

    		$('#choixRech').css('display', 'block');
    		$('#choixSalaire').css('display', 'none');
    		$('#choixAlloc').css('display', 'none');
    	}
	});

	// Affichage / Masquage des formulaires salaires 
    $('button.button').click(function(){
 
    	if($('#formNew').css('display') == 'none'){

    		$('#formNew').css('display', 'block');
        	$('#enreg').css('display', 'none');
        	$('.button').html('Fermer le formulaire');

    	}else{

    		$('#formNew').css('display', 'none');
        	$('#enreg').css('display', 'block');
        	$('.button').html('Enregistrer un salaire');
        }
    });

    // Affichage / Masquage des formulaires allocations
    $('button.button2').click(function(){

        if($('#formNew2').css('display') == 'none'){

    		$('#formNew2').css('display', 'block');
        	$('#enreg2').css('display', 'none');
        	$('.button2').html('Fermer le formulaire');

    	}else{

    		$('#formNew2').css('display', 'none');
        	$('#enreg2').css('display', 'block');
        	$('.button2').html('Enregistrer une allocation');
        }
        
    });

    // Ouvre une fenetre pour enregistrer un nouvel employeur
    $('select,.champs').change(function(){
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
    	
    	if($('#scroll').height() > 170){

    		$('#scroll').css({
	    		height: '170',
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
    	
    	if($('#scroll2').height() > 170){

    		$('#scroll2').css({
	    		height: '170',
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