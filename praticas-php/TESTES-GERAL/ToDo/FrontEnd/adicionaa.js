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

    let delet = document.createElement("button")
    delet.innerHTML = "X"
    delet.setAttribute("class", "deletar")

    valor.appendChild(texto)
    valor.appendChild(marc)
    valor.appendChild(delet)
    div.appendChild(valor)
}



//=====================
function fazGet(url){
    let request = new XMLHttpRequest()
    request.open("GET", url, false)
    request.send()
    return request.responseText
}
function carregar(){

    let x = fazGet('../BackEnd/getToDo.php')
    console.log(x)
    let data = JSON.parse(x)
    console.log(data)

    let div = document.getElementById("todo")
    data.forEach(element => {
        let objeto = JSON.parse(element)
        let val = criardadostodo(objeto)
        div.appendChild(val)
    });

    // const xhttp = new XMLHttpRequest()
    // xhttp.open("GET", "../BackEnd/getToDo.php", false)

    // xhttp.onreadystatechange = function(){
    //     console.log("tesss")
    //     let x = this.responseText
    //     let data = JSON.parse(x)
        
    //     console.log(data)
    //     // console.log(data[0].texto)
    //     let div = document.getElementById("todo")
    //     data.forEach(element => {
    //         let val = criardadostodo(element)
    //         div.appendChild(val)
    //     });
    // }
    // xhttp.send()
}

function criardadostodo(e){
    let d = document.createElement("div")
    d.setAttribute("class", 'todos')
    d.setAttribute("id", e.id)

    let p = document.createElement("p")
    p.innerHTML = e.texto

    let c = document.createElement("input")
    c.setAttribute("type", 'checkbox')

    let delet = document.createElement("button")
    delet.innerHTML = "X"
    delet.setAttribute("class", "deletar")
    delet.setAttribute("id", e.id)
    // delet.addEventListener("click", deletar)

    delet.addEventListener("click", () => {
        // console.log("teaaaa")
        // console.log(e.id)
        let remover = document.getElementById(e.id)
        remover.parentNode.removeChild(remover)
        // function p deletar com ajax
    })
    
    if(e.feito != 0){
        c.checked = true
    }

    d.appendChild(p)
    d.appendChild(c)
    d.appendChild(delet)
    return d
}

// function deletar(e){
//     console.log('teste abaixo')
//     console.log(e)
// }