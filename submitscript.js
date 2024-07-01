$(document).ready(function(){
    $("form").on("submit", function(event){
        event.preventDefault();
 
        var formValues= $(this).serialize();
 
        $.post("check.php", formValues, function(data){
            $("#resultdiv").html(data);
		
			if ($("#resultdiv:contains('success')").length > 0){
				$("input").attr('disabled', 'disabled');
				$("select").attr('disabled', 'disabled');				
				$("textarea").attr('disabled', 'disabled');
			}
			
			if ($("#resultdiv:contains('phone')").length > 0){
				$("#phone").addClass('error');
			} else {
				$("#phone").removeClass('error');
			}
			
			if ($("#resultdiv:contains('email')").length > 0){
				$("#email").addClass('error');
			} else {
				$("#email").removeClass('error');
			}
        });
    });
});