function fazGet(url){
    const request = new XMLHttpRequest()
    request.open("GET", url, false)
    request.send()

    return request.responseText
}
// ====

function validar(){
    
}