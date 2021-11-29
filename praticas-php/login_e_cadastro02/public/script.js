function validarl(){
    let form = document.getElementById("form")
    event.preventDefault()
    let nome = document.getElementById("nome").value 
    let senha = document.getElementById("senha").value 

    if(nome == '' || senha == ''){
        alert("preencha todos os campos abaixo!!!")
    }else{
        form.submit()
    }
}

function validarc(){
    let form = document.getElementById("formc")
    event.preventDefault()

    let nome = document.getElementById("nome").value 
    let email = document.getElementById("email").value 
    let senha = document.getElementById("senha").value 
    let rsenha = document.getElementById("rsenha").value 
    let caixa = document.getElementById("aceita")

    if(nome == '' || email == '' || senha == '' || rsenha == ''){
        alert("preencha todos os campos!!!")

    }else{
        if(email.indexOf("@") <= -1 || email.indexOf("@.com") > -1 || email.indexOf(".com") <= -1){
            alert("digite o email corretamente!!!")
        }else{
            if(senha != rsenha){
                alert("digite a senha corretamente!!!")
            }else{
                if(caixa.checked == false){
                    alert("aceite os termos!")
                }else{
                    form.submit()

                }
            }
        }
    }
}

function validarm(){
    event.preventDefault()
    let form = document.getElementById("form")
    let nome = document.getElementById("nome").value 
    let email = document.getElementById("email").value 
    let senhao = document.getElementById("senhao").value 
    let senhan = document.getElementById("senhan").value 

    if(nome == '' || email == ''){
        alert("não deixe os campos vazios!!!")
    }else{
        if(email.indexOf("@") <= -1 || email.indexOf("@.com") > -1 || email.indexOf(".com") <= -1){
            alert("digite um email válido!!!")

        }else{
            if(senhao != 'senhaaqui' && senhan == ''){
                alert("digite uma senha válida!!!")
            }else{
                if(senhan != ''){
                    form.submit()

                }else{
                    form.submit()

                }
            }
            
        }
    }
}