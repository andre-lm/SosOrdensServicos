$(document).ready(function(){
    var validator = $("#formOS").validate(
      {
        errorElement:"span",
        submitHandler: function(form){
          form.submit();
        },
        rules:{
            numero:{ //exemplo
                required:true,
                number: true,
                maxlength:15
            },
            descrição: {
                required: true,
                minlength: 10,
                maxlength: 200,
            },
            nome_autor: {
                required: true,
                minlength: 5,
                maxlength: 100,
            },
            atribuido_tecnico: {
                required: true,
            },
            equipamento: {
                required: true,
                minlength: 5,
                maxlength: 50
            },
            titulo: {
                required: true,
                minlength:5,
                maxlength: 60
            }
        },
        messages:{
            numero:{ //exemplo
                required:"Esse campo não pode ser vazio",
                number:"Este campo é numerico",
                maxlength:"apenas 15 caracteres"
            },
            descrição:{
                required:"Esse campo não pode ser vazio",
                minlength: "Obrigatório pelo menos 10 caracteres"
            },
            nome_autor: {
                required: "Esse campo não pode ser vazio",
                minlength:"Obrigatório pelo menos 5 caracteres",
                maxlength: "Apenas até 100 caracteres"
            },
            atribuido_tecnico: {
                required: "Esse campo não pode ser vazio",
            },
            equipamento: {
                required: "Esse campo não pode ser vazio",
                minlength:"Obrigatório pelo menos 5 caracteres",
                maxlength: "Apenas até 50 caracteres"
            },
            titulo: {
                required: "Esse campo não pode ser vazio",
                minlength:"Obrigatório pelo menos 5 caracteres",
                maxlength: "Apenas até 60 caracteres"
            }
        }
  
      }
    )

    $("#formAd").validate(
        {
            errorElement:"span",
            submitHandler: function(form){
            form.submit();
            },
            rules:{
                requerente:{
                    required: true,
                    minlength: 5,
                    maxlength: 100,
                },
                descrição:{
                    required: true,
                    minlength: 10,
                    maxlength: 200,
                }
            },
            messages:{
                requerente: {
                    required: "Esse campo não pode ser vazio",
                    minlength:"Obrigatório pelo menos 5 caracteres",
                    maxlength: "Apenas até 100 caracteres"
                },
                descrição: {
                    required:"Esse campo não pode ser vazio",
                    minlength: "Obrigatório pelo menos 10 caracteres",
                    maxlength: "Apenas até 200 caracteres"
                }
            }
        }
    )
})