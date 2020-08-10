/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var idIntervalVerificaSesion=0; ///contiene el el id del setInterval que verifica si la sesion del usuario ha expirado o no. 
                                ///Se usa para parar el set interval
var intervalUsoAplicacion=0;                                


 function obtenerMenuUsuarioAjax(perfiluser_id) {

        var bandejasFlujo = "";
        
            $.ajax({
                type: 'POST',
                dataType: 'html',
                async: false,
                url: $('#url-proyecto').val() + 'cloudmenus/obtenermenuajax',
                data: {perfiluser_id: perfiluser_id},
                success: function (data) {
                    bandejasFlujo = data;
                }
            });

            return bandejasFlujo;
    }
    
    /**
     * Verifica si la sesion del usuario ha expirado
     * @returns {undefined}
     */
    var verificarSesion =function(){       
        ////Si no esta en la pagina de loggin se hace la validacion de sesion. 
        if($("#isLogin").length<=0){
            $.post(
                 $('#url-proyecto').val() + 'comets/index',            
                 function(data){
                    if(!data.success){                        
                        ///Si la sesion esta inactiva se detiene el setInterval y se direcciona a la pantalla de loggin
                        clearInterval(idIntervalVerificaSesion);                        
//                        bootbox.alert(
//                            "La sesion ha expirado, por favor ingrese de nuevo.",
//                            function(){
                                location.href=$('#url-proyecto').val() + 'usuarios/logout';   
//                            }
//                        );                                                              
                    }
                 },"json"
            ).fail(function(data){
                clearInterval(idIntervalVerificaSesion);
//                bootbox.alert(
//                    "La sesion ha expirado, por favor ingrese de nuevo.",
//                    function(){
                        location.href=$('#url-proyecto').val() + 'usuarios/logout';                
//                    }
//                );
                
            });
        }else{
            ///Si esta en la pantalla de loggin se cancela el setInterval
            clearInterval(idIntervalVerificaSesion);
        }
    }
    
    //var verificarUsoAplicacion = function(){
    //    if($("#isLogin").length<=0){
    //        $.ajax({
    //            type: 'POST',
    //            dataType: 'html',
    //            async: false,
    //            url: $('#url-proyecto').val() + 'usuarios/registraractividad',
    //            data: {},
    //            success: function (data) {
//  //                  alert(data);
    //            }
    //        });
    //        clearInterval(intervalUsoAplicacion);
    //    }
    //}
    
    
    function verificarSesionIntervaloTiempo(){
        ///Se verifica si la sesion ha expirado, se pone en milisegundos el mismo tiempo q expira la sesion configurado en el cakephp mas 1 segundo y medio
        idIntervalVerificaSesion=setInterval(
                verificarSesion,1201500
//              61500
        );
    }
    
    //function validarusoaplicacion(){
    //    intervalUsoAplicacion=setInterval(
    //            verificarUsoAplicacion,1000
    //    );
    //} 
    
    $(document).ready(function () {   
       
        //validarusoaplicacion();
        verificarSesionIntervaloTiempo();

        if ($("#user-id").length > 0 && $("#user-id").val() != "") {
                var menuVert = obtenerMenuUsuarioAjax($("#perfiluser_id").val());
                $("#menuUsr").html(menuVert);
            }            
    });



