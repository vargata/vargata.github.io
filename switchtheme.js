$(document).ready(function(){
	$('#light').click(function() {
    	$('#theme').attr('href', 'light.css');
		document.cookie="dark=false";
	});

	$('#dark').click(function() {
    	$('#theme').attr('href', 'dark.css');
		document.cookie="dark=true";
	});
});