$('#montant_total, #montant_total_modif').attr('readonly', true);

$(document).on('keyup', '#prix, #nbr_tete, #prix_modif, #nbr_tete_modif', function() {
    if(!isNaN($('#prix, #prix_modif').val()) && !isNaN($('#nbr_tete, #nbr_tete_modif').val())) {
        $('#montant_total, #montant_total_modif').val($('#prix, #prix_modif').val() * $('#nbr_tete, #nbr_tete_modif').val());
    }
});