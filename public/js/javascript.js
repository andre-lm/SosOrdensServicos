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

$(document).on('click', '.js-del', function(){
    botao = this;
    $.confirm({
        title: 'Atenção !',
        content: 'Você tem certeza que deseja realizar esta ação ?',
        buttons: {
            confirmar: function () {
                delElement(botao)
            },
            cancelar: function () {
              $.alert('Ação cancelada!');
            },
        }
    });
})

async function delElement(element){
    if($(botao).parents('div.col-6').find('.os_id').val() > 0){
        id=$(botao).parents('div.col-6').find('.os_id').val()
        rota = "/os/";
    }else if($(botao).parents('div.acomp').find('.acomp_id').val() > 0){
        id=$(botao).parents('div.acomp').find('.acomp_id').val()
        rota = "/acompanhamento/";
    }else if($(botao).parents('div.sol').find('.sol_id').val() > 0){
        id=$(botao).parents('div.sol').find('.sol_id').val()
        rota = "/solucao/";
    }
    let token =  $("[name=_token]").val()
    let url = window.location.origin + rota+ id;

    const mudanca = realizarMudanca();
    getResult = await mudanca.destroy(id, token, url);
    console.log(getResult)

    if(getResult.status!='erro'){ 
        reloadSuccess( getResult, element)
        setTimeout(function(){
            $(element).parents('tr').find('td').remove()
        }, 2000);
    }else{
        reloadError( getResult.msg)
    }
}

function realizarMudanca() {
    return { 
      destroy(id, token, url){
        return new Promise((resolve, reject) => {
          $.ajax({
            type: 'DELETE',
            url: url,
            data: {
                "_token": token,
                "id": id
            },
            success: function(response){
              resolve(response)
            }
          })
        })
      }
    }
}

function reloadSuccess( result, element){
    $(".alert").remove();
    $('main').prepend(' <div class="alert alert-success alert-test" style="margin: 0 6em;">'+result.msg+'</div>')
    $('.alert-test').fadeTo(2000, 500).slideUp(500)
    $(element).parents('div.collapse').slideUp();
    if(result.os_status && result.os_status!=""){
        if(result.os_status=="Em aberto"){
            $(element).parents('.card-body').find('button.acompanhamento').remove()
            $(element).parents('.card-body').find('.os_status').attr('class', 'os_status badge badge-success')
        }else if(result.os_status=="Em atendimento"){
            $(element).parents('.card-body').find('button.solucao').remove()
            $(element).parents('.card-body').find('.os_status').attr('class', 'os_status badge badge-warning')
        }
        $(element).parents('.card-body').find('.os_status').text(result.os_status)
    }else{
        window.location.href = window.location.origin;
    }
}
function reloadError(msg){
    $(".alert").remove();
    $('main').prepend(' <div class="alert alert-danger alert-test" style="margin: 0 6em;">'+msg+'</div>')
    $('.alert-test').fadeTo(2000, 500).slideUp(500)
}