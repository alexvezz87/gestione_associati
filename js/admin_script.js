/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function($){
    $('button.scaduta, button.in-scadenza').click(function(){
        //visualizzo il loader
        $('.loader-container').show(); 
        
       //ottengo i valori di id e mode
       var mode =  null;
       if($(this).hasClass('in-scadenza')){
           mode = 1;
       }
       else if($(this).hasClass('scaduta')){
           mode = 2;
       }
       
       var id = $(this).data('id');
       
       var $button = $(this);
       
       $.ajax({
            type: 'POST',
            dataType: 'json',
            url: $('input[name=ajax-url]').val(),
            data: {
                action: 'invia_mail',
                mode: mode,
                id: id               
            },
            success: function(data){
                $('.loader-container').hide();
                if(data === true){
                    $button.hide();
                    alert('Email inviata correttamente!');
                }
                else{
                    alert('Errore nell\'invio della mail');
                }
            },
            error: function(){
                alert('error');
                $('.loader-container').hide();
            }
        });
       
    });
    
    
});