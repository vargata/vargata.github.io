document.addEventListener('DOMContentLoaded', function(){
	let cookie = document.cookie;
	
	if (!cookie.split(';').some((item) => item.trim().startsWith('cookies='))) {
		document.querySelector('.cookie_container').style.display = "block";
	}
})

const cookie_button = document.querySelector('.cookie_button');

cookie_button.addEventListener('click', function(){
	let expDate = new Date();
	expDate.setDate(expDate.getDate() + 30);
	document.cookie = "cookies=accepted; expires=" + expDate + "; path=/";
	document.querySelector('.cookie_container').style.display = "none";
})