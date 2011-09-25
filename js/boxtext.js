 function movein(which,html){
 if (document.getElementById)
 document.getElementById("boxdescription").innerHTML=html
 else
 boxdescription.innerHTML=html
 }
 
 function moveout(which){
 if (document.getElementById)
 document.getElementById("boxdescription").innerHTML='&nbsp;'
 else
 boxdescription.innerHTML='&nbsp;'
 }