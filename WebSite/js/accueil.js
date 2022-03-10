    $(document).ready(function() {  
        $.ajax({  
            url: 'url: `http://localhost/GameAdvice/WebSite/api/games`,',  
            type: 'GET',  
            dataType: 'json',  
            success: function(data, textStatus, xhr) {  

                console.log(data);  
            },  
            error: function(xhr, textStatus, errorThrown) {  
                console.log('Error in Database');  
            }  
        });  
    });  