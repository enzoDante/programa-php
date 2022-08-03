function compartilhar(){
    let url = document.getElementById("copiar")
    url.select()
    url.setSelectionRange(0, 99999)
    navigator.clipboard.writeText(url.value)
    alert("Link copiado" + url.value)
}