$(document).ready(function(){
    $("#contentdiv").load('start.php')
	if(document.cookie.split(";")[0].split("=")[1] == "true"){
    	$('#theme').attr('href', 'dark.css');
	}
});