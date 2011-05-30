/*
 * Script per template.
 * (c) TruePixel.it
 */

	
function cambia(num){
	
	ele = document.getElementsByClassName("description")[num];
	
		
	if(!(ele.getAttribute("style")))
		mostra(ele);
	else
		nascondi(ele);
	if(ele.getAttribute("style") == "display: none")
		mostra(ele);
	
}

function mostra(ele){
	ele.setAttribute("style", "display: block");
}

function nascondi(ele){
	ele.setAttribute("style", "display: none");
}