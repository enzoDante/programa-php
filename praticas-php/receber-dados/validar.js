function verificar(){
    event.preventDefault()
    let form = document.getElementById("ff")
    let nome = document.getElementById("nome").value 
    let email = document.getElementById("email").value 
    let senha = document.getElementById("senha").value 
    let rsenha = document.getElementById("rsenha").value 

    if(nome == '' || email == '' || senha == '' || rsenha == ''){
        alert("preencha todos os campos!!!")

    }else if(email.indexOf("@") > -1 && email.indexOf("@.com") <= -1 && email.indexOf(".com") > -1){
        if(senha != rsenha){
            alert("digite as senhas corretamentes!!!")
        }else{
            form.submit()
        }

    }else{
        alert("digite o email corretamente!!!")
    }

}