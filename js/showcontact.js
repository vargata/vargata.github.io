const hiddencontact = document.querySelector(".hidden_contact");
const hcc = document.querySelector(".hcc");

function showContact(){
	if(hiddencontact.style.maxHeight == "")
		hiddencontact.style.maxHeight = (hcc.clientHeight + 20) + "px";
	else
		hiddencontact.style.maxHeight = null;
}