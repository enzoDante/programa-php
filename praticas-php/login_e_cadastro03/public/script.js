//criar uma conta---------------------------------------------------------

function valcadastro(){
    let form = document.getElementById("formulario")
    event.preventDefault()

    let nome = document.getElementById("nome").value 
    let email = document.getElementById("email").value 
    let senha = document.getElementById("senha").value 
    let rsenha = document.getElementById("rsenha").value 
    let caixa = document.getElementById("aceita")

    if(nome == '' || email == '' || senha == '' || rsenha == ''){
        alert("preencha todos os campos!!!")
    }else{
        if(email.indexOf('@') <= -1 || email.indexOf('@.com') >-1 || email.indexOf('.com') <=-1){
            alert("digite o email corretamente!")
        }else{
            if(senha != rsenha){
                alert("digite a senha corretamente!!!")
            }else{
                if(caixa.checked == false){
                    alert("aceite os termos de contrato!")
                }else{
                    form.submit()
                }            
            }
        }
    }
}

//login na conta-----------------------------------------------------------

function vallogin(){
    let form = document.getElementById("formulario")
    event.preventDefault()

    let nome = document.getElementById("nomee").value 
    let senha = document.getElementById("senha").value 
    if(nome == '' || senha == ''){
        alert("preencha todos os campos!!!")
    }else{
        form.submit()
    }
}

//mudar nome, email e senha-------------------------------------------------

function valperfil(){
    let form = document.getElementById("formulario")
    event.preventDefault()

    let nome = document.getElementById("nome").value 
    let email = document.getElementById("email").value 
    let senoriginal = document.getElementById("senoriginal").value 
    let sennova = document.getElementById("sennova").value 
    let sennova2 = document.getElementById("sennova2").value 

    if(nome == '' || email == ''){
        alert("preencha os campos!!!")
    }else{
        if(email.indexOf("@") <= -1 || email.indexOf("@.com") >-1 || email.indexOf(".com") <=-1){
            alert("digite um email válido!!!")
        }else{
            if(senoriginal == '' && sennova == '' && sennova2 == ''){
                form.submit()

            }else{
                
                if(senoriginal !='' && sennova != '' && sennova == sennova2){
                    form.submit()
                }else{
                    alert("preencha corretamente os campos de senhas!!!")
                }
            }
        }
    }
}