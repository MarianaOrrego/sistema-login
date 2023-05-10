$(document).on("submit", ".form_registro", function(event){
    event.preventDefault();
    let $form = $(this);
   
    let data_form = {
        email: $("input[type='email']",$form).val(),
        password: $("input[type='password']", $form).val() 
    }
    if(data_form.email.length < 6 ){
        $("#msg_error").text("Tu email no es valido.").show();
        return false;        
    }else if(data_form.password.length < 8){
        $("#msg_error").text("Tu contraseña debe ser minimo de 8 caracteres.").show();
        return false;   
    }
    $("#msg_error").hide();
    let url_php = 'http://localhost/sistema-login/ajax/procesar_registro.php';

    $.ajax({
        type:'POST',
        url: url_php,
        data: data_form,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       console.log(res); 
       if(res.error !== undefined){
            $("#msg_error").text(res.error).show();
            return false;
       } 

       if(res.redirect !== undefined){
        window.location = res.redirect;
    }
    })
    .fail(function ajaxError(e){
        console.log(e);
    })
    .always(function ajaxSiempre(){
        console.log('Final de la llamada ajax.');
    })
    return false;
});

$(document).on("submit", ".form_login", function(event){
    event.preventDefault();
    let $form = $(this);
   
    let data_form = {
        email: $("input[type='email']",$form).val(),
        password: $("input[type='password']", $form).val() 
    }
    if(data_form.email.length < 6 ){
        $("#msg_error").text("Necesitamos un email valido.").show();
        return false;        
    }else if(data_form.password.length < 8){
        $("#msg_error").text("Tu password debe ser minimo de 8 caracteres.").show();
        return false;   
    }
    $("#msg_error").hide();
    let url_php = 'http://localhost/sistema-login/ajax/procesar_login.php';

    $.ajax({
        type:'POST',
        url: url_php,
        data: data_form,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(res){
       console.log(res); 
       if(res.error !== undefined){
            $("#msg_error").html(res.error).show();
            return false;
       } 
       if(res.redirect !== undefined){
           window.location = res.redirect;
       }
    })
    .fail(function ajaxError(e){
        console.log(e);
    })
    .always(function ajaxSiempre(){
        console.log('Final de la llamada ajax.');
    })
    return false;
});

