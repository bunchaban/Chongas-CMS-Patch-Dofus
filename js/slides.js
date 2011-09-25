// JavaScript para destaques
var index = 1;
var menu_time = 5000;
var anterior = 5;
var timer = setTimeout('trocaMsg()',menu_time); 

function trocaMsg(){
	index = index % 5 +1;	
	change_noticia(index);
	tempo();
}
function tempo(){
	clearTimeout(timer);
	timer = setTimeout("trocaMsg()",menu_time);
}

function change_noticia(id){
	index = id;
	document.getElementById("destaque_" + anterior).className= "destaque_menu_numeros";
	document.getElementById("destaque_" + id).className = "destaque_menu_numeros_over";
	document.getElementById('mostradest').innerHTML = document.getElementById('dest' + id).innerHTML;
	document.getElementById('container').style.display = 'none';
	anterior = id;
}

function change_img(id, out){
	if(out == 1){		
		clearTimeout(timer);
		change_noticia(id);
	}
	else{
		tempo();
	}
}
change_noticia(1);