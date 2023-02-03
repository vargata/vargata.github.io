const container = document.querySelector('.sticky_container');
const header = document.querySelector('.main_header');

let containerHeight = 0;

window.addEventListener('load', function() {
	containerHeight = parseFloat(getComputedStyle(header).height);
	container.style.height = containerHeight.toString() + "px";
	
	let lastScroll = 0;
	let id = null;
	
	header.addEventListener('mouseover', function(){
		if(id) clearTimeout(id);
	});
	
	header.addEventListener('mouseleave', function(){	
		if(window.scrollY > containerHeight) id = setTimeout(hideSticky, 2000);
	});
	
	document.addEventListener('scroll', function(){
		var scroll = window.scrollY;
		if(lastScroll > scroll && scroll > containerHeight)
			showSticky();
		if(lastScroll < scroll && scroll > containerHeight)
			hideSticky();
		if(scroll == 0)
			removeSticky();
			
		lastScroll = scroll;
		
		if(id) clearTimeout(id);
		if(scroll > containerHeight) id = setTimeout(hideSticky, 2000);
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
	}

});

window.addEventListener('resize', function() {
	containerHeight = parseFloat(getComputedStyle(header).height);
	container.style.height = containerHeight.toString() + "px";
});