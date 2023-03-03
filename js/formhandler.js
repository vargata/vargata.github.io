$(document).ready(function(){
    $("#contact_form").on("submit", function(event){
        event.preventDefault();
        addLoadEffect();
 
        var formValues = $(this).serialize();
 
        $.post("formhandler.php", formValues, function(data){
            $("#resultdiv").html(data);
            
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
			
			if ($("#resultdiv:contains('name')").length > 0){
				$("#name").addClass('error');
			} else {
				$("#name").removeClass('error');
			}
			
			if ($("#resultdiv:contains('company')").length > 0){
				$("#company").addClass('error');
			} else {
				$("#company").removeClass('error');
			}
			
			if ($("#resultdiv:contains('subject')").length > 0){
				$("#subject").addClass('error');
			} else {
				$("#subject").removeClass('error');
			}
			
			if ($("#resultdiv:contains('message')").length > 0){
				$("#msg").addClass('error');
			} else {
				$("#msg").removeClass('error');
			}
			
			if ($("#resultdiv:contains('success')").length > 0){
				$("#name").val("");
				$("#company").val("");
				$("#email").val("");
				$("#phone").val("");
				$("#subject").val("");
				$("#msg").val("");
				$("#marketing").prop("checked", false);
			}

        	removeLoadEffect();
			location.href="#resultdiv";
        });
    });
});

const btnSubmit = document.querySelector("#submit");
const animSubmit = document.querySelector("#submit ~ span");

function addLoadEffect(){
	btnSubmit.style.paddingRight = "45px";
	animSubmit.classList.add("loading");
}

function removeLoadEffect(){
	btnSubmit.style.paddingRight = null;
	animSubmit.classList.remove("loading");
}