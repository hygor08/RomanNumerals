//run $ global variable in a private scope to avoid any possible conflicts elsewhere.
$(document).ready(function(){
     $('#searchForm').submit(function(){
        if($('#entryItem').val() !== ''){
          $.ajax({
            type: 'POST',
            dataType: "json",
            data: {q : $('#entryItem').val()},
            url: 'ajax.php',
            
            //contentType: 'application/json; charset=utf-8',
                       
            success: function(data){
                var json_return = data;
                if(json_return['inputType'] == 'roman'){
                    $('#integerOutput .resultText span').text(json_return['result']);                    
                    $('#integerOutput').show();
                    $('#integerOutput').animate({ height: 400 }, { duration: 2500});
                    $('#romanOutput').animate({ height: 0 }, { duration: 2500, complete: function () { $('#romanOutput').hide(); $('#romanOutput .resultText span').text('');}});
                }
                if(json_return['inputType'] == 'integer'){
                    $('#romanOutput .resultText span').text(json_return['result']);                    
                    $('#romanOutput').show(); 
                    $('#romanOutput').animate({ height: 400 }, { duration: 2500 });
                    $('#integerOutput').animate({ height: 0 }, { duration: 2500, complete: function () { $('#integerOutput').hide(); $('#integerOutput .resultText span').text(''); }});
                    
                }
            }
         });
        }
        return false;
     });
     $('#hint').show();
     $('#info').hide();
     $('#hint').hover(function(){         
         $('#info').toggle();
     });
});

