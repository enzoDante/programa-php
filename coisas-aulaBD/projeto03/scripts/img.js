function carregar1(event){
    let img = document.getElementById("perfil")
    img.src = URL.createObjectURL(event.target.files[0])
}