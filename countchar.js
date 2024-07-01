$(document).ready(function(){
	$('#msg').on('keyup', function(){
		$('#charcount').text($('#msg').val().length+'/500');
	});
});