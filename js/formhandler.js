$(document).ready(function(){
    $("#contact_form").on("submit", function(event){
        event.preventDefault();
        addLoadEffect();
 
 		if(validate()){
	        var formValues = $(this).serialize();
	 
	        $.post("formhandler.php", formValues, function(data){
	            showReturn(data);
	        });
        }
        
    	removeLoadEffect();
		location.href="#resultdiv";
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

function showReturn(data){
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
}

function validate(){
	const namereg = /^(?![\- ])(?!.*  )[ \-'\p{L}]+ [ \-'\p{L}]{2,}(?<![\- ])$/u;
	const coreg = /^(?! )(?!.*  )[ \d\p{P}\p{S}\p{L}]+(?<![\- ])$/u;
	const subreg = /^(?! )(?!.*  )[ \d\p{P}\p{S}\p{L}]+(?<![\- ])$/u
	const msgreg = /^(?!\s)(?!.*  )(?!.*\s\s\s)[\s\d\p{P}\p{S}\p{L}]+(?<![\s\-])$/u
	const emailreg = /^(?!\.)[\p{L}0-9\*\+\-\.!#$%&'/=?^_`{|}~]+(?<!\.)@(?![0-9\-])[\p{L}0-9\-]{2,}\.\p{L}{2,}$/u;
	const shortpreg = /^0[0-9]{10}$/;
	const longpreg = /^\+44[0-9]{10}$/
	
	let error = "";
	let retval = true;
	
	if(!namereg.test($("#name").val())){
		error += "<label class='msglabel'>Invalid name!</label>";
		retval = false;
	}
	if(!coreg.test($("#company").val()) && $("#company").val() != ""){
		error += "<label class='msglabel'>Invalid company!</label>";
		retval = false;
	}
	if(!subreg.test($("#subject").val())){
		error += "<label class='msglabel'>Invalid subject!</label>";
		retval = false;
	}
	if(!msgreg.test($("#msg").val())){
		error += "<label class='msglabel'>Invalid message!</label>";
		retval = false;
	}
	if(!emailreg.test($("#email").val())){
		error += "<label class='msglabel'>Need a valid email address.</label>";
		retval = false;
	}
	if(!shortpreg.test($("#phone").val()) && !longpreg.test($("#phone").val())){
		error += "<label class='msglabel'>Not a valid phone number</label>";
        error += "<label class='msglabel'>has to have a format of 0xxxxxxxxxx</label>";
        error += "<label class='msglabel'>or +44xxxxxxxxxx</label>";
		retval = false;
	}
	
	if(!retval){
		error = "<div class='error'>" + error + "</div>";
		showReturn(error);
	}
	
	return retval;
}