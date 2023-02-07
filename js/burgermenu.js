const page = document.querySelector('.page_container');
const sidemenu = document.querySelector('.sidemenu_container');

document.querySelector('.hamburger').addEventListener('click', function(){
	if(this.classList.contains('is-active')) {
		this.classList.remove('is-active');
		page.style.transform = null;
	} else {
		this.classList.add('is-active');	
		page.style.transform = 'translateX(-275px)';
	}
})