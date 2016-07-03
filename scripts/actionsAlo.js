/*******************************************************************************************/
/***********************SCRIPTS Modification & Suppression**********************************/
/*******************************************************************************************/


// Affichage du formulaire des allocations en mode modification
$('.modAlo').click(function(event){
    // On annule le comportement par défaut du lien
    event.preventDefault();
    $('#formNew2').css('display', 'block'); // On active le formulaire
    $('.button2').html('Fermer la modification'); // modifie le titre du bouton 
    $('#fenetreForm4 h3').html('Modification d\'une allocation'); // modifie le titre du formulaire
    $('#modeAlo').val('modification'); // On passe en modif
    $('#modeAlo').attr('name','modification');
    $('#valideAlo').val('Mettre à jour'); // On change le nom du bouton
    var idAlo = $(this).attr("href"); // On récupère l'id sélectionnée
    $('#hideId').attr('value', idAlo); // On ajoute l'id dans le formulaire

    $.ajax({
        url: 'modif/modifAlo.php',
        type: 'POST',
        dataType: 'json',
        data: {id: idAlo},
        success: function(data){
            $('#EtabChoix option[value="'+data[6]+'"]').prop('selected', true);
            $('.champs2[name=MontantBrutAll]').val(data[0]);
            $('.champs2[name=MontantNetAll]').val(data[1]);
            $('.champs2[name=DateVers]').val(data[2]);

            if(data[3] == 0){
                
                $('input:radio[name=Tiers]:nth(1)').click(); // value="0" NON
            }
            else{
               
                $('input:radio[name=Tiers]:nth(0)').click(); // value="1" OUI
            }
        },
    });
    
});

// Suppression d'une allocation depuis la liste
$('.supAlo').click(function(event) {
    // On annule le comportement par défaut du lien
    event.preventDefault();

    var idAlo = $(this).attr("href"); // On récupère l'id sélectionnée

    // On surligne la ligne en question
    $('.cible'+idAlo).css({
        'background-color': '#d40b0b',
        'color': 'white'
    });

    // Test de confirmation
    var test = confirm("Etes-vous sur de vouloir supprimer cette allocation ?");

    // Si oui on lance la suppression
    if (test) {

        $.ajax({
            url: 'modif/modifAlo.php',
            type: 'POST',
            dataType: 'json',
            data: {idSup: idAlo},
            success: function(data){
                $("div#scroll2").load("reload/tableAll.php"); // On recharge le tableau des allocations
                alert("Suppression effectuée avec succès !");
            },
        });

    }else{

        // On réinitialise le css
        $('.cible'+idAlo).css({
            'background-color': '',
            'color': ''
        });
        alert("OUF ! Vous avez eu chaud :)");
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

