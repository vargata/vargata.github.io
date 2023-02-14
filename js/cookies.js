document.addEventListener('DOMContentLoaded', function(){
	let cookie = document.cookie;
	
	if (!cookie.split(';').some((item) => item.trim().startsWith('cookies='))) {
		document.querySelector('.cookie_container').style.display = "flex";
	}
})

const cookie_button = document.querySelector('.cookie_button');

cookie_button.addEventListener('click', function(){
	let now = new Date();
	document.cookie = "cookies=accepted; expires=" +  new Date(now.setDate(now.getDate() + 30)).toUTCString() + "path=/netmatters/";
	document.querySelector('.cookie_container').style.display = "none";
})