const page = document.querySelector('.page_container');
const sidemenu = document.querySelector('.sidemenu_container');
const overlay = document.querySelector('.overlay');
const hamburger = document.querySelector('.hamburger');


hamburger.addEventListener('click', function(){
	hamburger.classList.add('is-active');	
	page.style.transform = 'translateX(-275px)';
	overlay.style.display = 'block';
})

overlay.addEventListener('click', function(){
	hamburger.classList.remove('is-active');
	overlay.style.display = 'none';
	page.style.transform = null;
})