$('.hide_mdp').hide();
$('.mdp, .mdp_modif, .mdp_conf_modif').hide();
$('.mdp input, .mdp_modif input, .mdp_conf_modif input').attr('disabled', true);

$(document).on('click', '.change_mdp', function(event) {
    event.preventDefault();
    $(this).hide();
    $('.mdp, .mdp_modif, .mdp_conf_modif').fadeIn();
    $('.mdp input, .mdp_modif input, .mdp_conf_modif input').attr('disabled', false);
    $('.hide_mdp').show();
});

$(document).on('click', '.hide_mdp', function(event) {
    event.preventDefault();
    $(this).hide();
    $('.mdp, .mdp_modif, .mdp_conf_modif').hide();
    $('.mdp input, .mdp_modif input, .mdp_conf_modif input').attr('disabled', true);
    $('.change_mdp').show();
});