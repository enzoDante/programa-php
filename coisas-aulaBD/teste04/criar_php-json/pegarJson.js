//aq mostra os dados e traduz o json p poder manipular esses dados
function olhar(dados){
    let usuarios = JSON.parse(dados)
    console.log(usuarios)

    let div = document.getElementById("dados")
    if(usuarios){
        usuarios.forEach(element => {
            console.log(element)
            console.log(element.nome)

            div.appendChild(mostrar(element))
        });
    }
}
//requisição do arquivo com seus dados transformados em json
function getd(url, ver){
    let xhttp = new XMLHttpRequest()
    xhttp.open("GET", url, true)
    xhttp.send()
    //ao carregar a requisição, ao enviar
    xhttp.onload = function(){
        //como ver é usuarios, será chamado o procedimento e passado como param, os dados obtidos da requisição
        if(ver == 'usuarios')
            olhar(this.responseText)
    }
}
//ao carregar página irá fazer a requisição e mandar "usuarios" p mostrar qual função será chamada
function carregar(){
    getd("valoresjson.php", "usuarios")
}
//cria elementos para ser adicionado na div dados do index.html
function mostrar(valor){
    let div = document.createElement("div")

    let nome = document.createElement("h2")
    nome.innerHTML = valor.nome
    div.appendChild(nome)

    let email = document.createElement("p")
    email.innerHTML = valor.email
    div.appendChild(email)

    let cpf = document.createElement("p")
    cpf.innerHTML = valor.cpf
    div.appendChild(cpf)

    let nascimento = document.createElement("p")
    nascimento.innerHTML = valor.nascimento
    div.appendChild(nascimento)

    let salario = document.createElement("p")
    salario.innerHTML = "R$ "+valor.salario
    div.appendChild(salario)

    let serasa = document.createElement("p")
    serasa.innerHTML = valor.serasa
    div.appendChild(serasa)

    return div
}