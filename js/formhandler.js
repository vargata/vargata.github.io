$(document).ready(function(){
    $("form").on("submit", function(event){
        event.preventDefault();
 
        var formValues = $(this).serialize();
 
        $.post("formhandler.php", formValues, function(data){
            $("#resultdiv").html(data);
        });
    });
});