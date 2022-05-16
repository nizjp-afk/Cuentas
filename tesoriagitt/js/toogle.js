// JavaScript Document

function toggle_listar(elemento) {

  if(elemento.value=="1")
   {
	   
      document.getElementById("exp").style.display = "block";
	   
	  document.getElementById("doc").style.display = "none";
	  document.getElementById("nota").style.display = "none"; 
	  
   }
   else if(elemento.value=="2")
    {
		
     document.getElementById("exp").style.display = "none";
	
	  document.getElementById("doc").style.display = "block";
	  document.getElementById("nota").style.display = "none"; 
	}
	
	else if(elemento.value=="3")
    {
		 document.getElementById("nota").style.display = "block";  
     document.getElementById("exp").style.display = "none";
	 
	  document.getElementById("doc").style.display = "none";
	 
	}
else if(elemento.value=="N" ) 
  {
	  
	   document.getElementById("exp").style.display = "none";
	   
	  document.getElementById("doc").style.display = "none";
	  document.getElementById("nota").style.display = "none"; 
  }
}
