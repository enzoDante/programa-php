function carregar1(event){
    let img = document.getElementById("perfil1")
    img.src = URL.createObjectURL(event.target.files[0])
}
function carregar2(event){
    let img = document.getElementById("perfil2")
    img.src = URL.createObjectURL(event.target.files[0])
}
function carregar3(event){
    let img = document.getElementById("imgpostar")
    img.src = URL.createObjectURL(event.target.files[0])
}