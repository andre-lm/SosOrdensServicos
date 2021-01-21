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

$('.icheck').click(function(){
    this_id = $(this).attr('id');
    $(this).parents('#roles').find('input').each(function(){
        if($(this).attr('id') > this_id){
            $(this).click();
        }
    })
})