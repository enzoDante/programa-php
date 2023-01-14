function adicionar(e){
    e.preventDefault()

    let texto = document.getElementById("txt").value

    if(texto.length <= 0){
        document.getElementById("error").style.display = 'block'
    }else{
        document.getElementById("error").style.display = 'none'
        document.getElementById("txt").value = ''
        enviardado(texto)
    }

}

function enviardado(texto){
    // const data = new FormData()
    // data.append("tt", texto)
    // data.append('x', 2)

    const local = '../BackEnd/index.php'
    // fetch(local,{
    //     method: "POST",
    //     body: data
    // }).then((e) => {
    //     console.log(e)
    // })

    const xhttp = new XMLHttpRequest()
    xhttp.onload = function() {
        let valor = this.responseText
        mostrar(valor)
    }

    xhttp.open("POST", local) //true false nn sei
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhttp.send(`text=${texto}&x=2`)
}

function mostrar(ab){
    console.log(ab)
    console.log('teste')
    let div = document.getElementById("todo")

    let valor = document.createElement("div")
    valor.setAttribute("class", 'todos')

    let texto = document.createElement("p")
    texto.innerHTML = ab

    let marc = document.createElement("input")
    marc.setAttribute("type", 'checkbox')

    valor.appendChild(texto)
    valor.appendChild(marc)
}



//=====================
function fazGet(url){
    const xhttp = new XMLHttpRequest()
    xhttp.open("GET", url, false)
    xhttp.send()
    return this.responseText
}
function carregar(){
    let valor = fazGet("../BackEnd/getToDo.php")
    console.log(valor)
}