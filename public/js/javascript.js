$(document).on('click', '.solucao', function(){
    if($('.show-acomp').hasClass('show')){
        $('.acompanhamento').click();
    }
})
$(document).on('click', '.acompanhamento', function(){
    if($('.show-solucao').hasClass('show')){
        $('.solucao').click();
    }
})