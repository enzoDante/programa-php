function videom(){
    let ifram = document.getElementById("ifra").value 
    let div = document.getElementById("video-aq")

    if(ifram != ''){
        div.innerHTML = ifram
    }
}
function publicar(){
    let form = document.getElementById("postar")
    event.preventDefault()

    let titulo = document.getElementById("titu").value 
    //let ifram = document.getElementById("ifra").value 
    //let div = document.getElementById("video-aq")
    let coment = document.getElementById("coment").value
    
    if(titulo == '' || coment == ''){
        alert("preencha pelo menos o campo titulo e digite um texto")
    }else{
        form.submit()
    }

}