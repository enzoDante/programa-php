function carregar1(event){
    let img = document.getElementById("img1")
    img.src = URL.createObjectURL(event.target.files[0])
    img.setAttribute("onclick","fechar1(this)")
}
function carregar2(event){
    let img = document.getElementById("img2")
    img.src = URL.createObjectURL(event.target.files[0])
    img.setAttribute("onclick", "fechar2(this)")
}

function fechar1(e){
    //e.outerHTML = ''
    e.src = ''
    document.getElementById("inputImagem1").value = ''
}
function fechar2(e){
    e.src = ''
    document.getElementById("inputImagem2").value = ''
}