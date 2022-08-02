function buscar() {
    var input, filter, div, elementos, a, i;  
    input = document.getElementById("ibusca");
    filter = input.value.toUpperCase();
    div = document.getElementById("comentarios");
    
    if(filter != ''){
        
    
      //elementos = div.getElementsByTagName("li");
      //elementos = div.getElementById("publicar");
      elementos = div.getElementsByTagName("div");
      for (i = 0; i < elementos.length; i++) {
        a = elementos[i].getElementsByTagName("a")[1];
        //a = a.getElementsByTagName("a")[1];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            elementos[i].style.display = "flex";
            div.style.display = "block";
        } else {
            elementos[i].style.display = "none";
        }
      }
    
    
    }else{
        div.style.display = "none";
    }
    
    
  }