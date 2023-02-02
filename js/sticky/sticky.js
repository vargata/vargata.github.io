const header = document.querySelector('.main_header');

header.addEventListener('mouseover', function(){
	if(id) clearTimeout(id);
});

header.addEventListener('mouseleave', function(){	
	if(window.scrollY > 206) id = setTimeout(hideSticky, 2000);
});

let lastScroll = 0;
let id = null;

document.addEventListener('scroll', function(){
	var scroll = window.scrollY;
	if(lastScroll > scroll && scroll > 206)
		showSticky();
	if(lastScroll < scroll && scroll > 206)
		hideSticky();
	if(scroll == 0)
		removeSticky();
		
	lastScroll = scroll;
	
	if(id) clearTimeout(id);
	if(scroll > 206) id = setTimeout(hideSticky, 2000);
});

function showSticky(){
	if(!header.classList.contains('stickyshow')){
		header.classList.remove('stickyhide');
		header.classList.add('stickyshow');
	}
}

function hideSticky(){
	if(header.classList.contains('stickyshow')){
		header.classList.remove('stickyshow');
		header.classList.add('stickyhide');
	}
}

function removeSticky(){
	if(header.classList.contains('stickyshow') || header.classList.contains('stickyhide')){
		header.classList.remove('stickyshow');
		header.classList.remove('stickyhide');
	}
};