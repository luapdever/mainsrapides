$('.c-option').hide();
$('.c-option input, .c-option select').attr('disabled', true);

var natures = document.querySelectorAll('.nature, .nature_modif');


$(document).on('click', '#nature, #nature_modif', function() {
    for(let i=0; i<natures.length; i++) {
        if(natures[i].selected === true) {
            $('.' + natures[i].id).fadeIn();
            $('.' + natures[i].id + ' input, .' + natures[i].id + ' select').attr('disabled', false);
        } else {
            $('.' + natures[i].id).hide();
            $('.' + natures[i].id + ' input, .' + natures[i].id + ' select').attr('disabled', true);
        }
    }
});