function impede(){
    let form = document.getElementById("formu")

    event.preventDefault();
    let n = document.getElementById("nome").value 
    let e = document.getElementById("email").value
    let s = document.getElementById("senha").value
    let cs = document.getElementById("confsenha").value 
    
    if(n == "" || e == "" || s == "" || cs == ""){
        alert("Digite valores no campo!!!")
    }else{
        if(s != cs){
            alert("senhas diferentes nos campos !!!!")
        }else{
            form.submit()

        }
    }
}

function impedenome(){
    let form = document.getElementById("formu")

    event.preventDefault();
    let n = document.getElementById("nome").value 
    
    if(n == ""){
        alert("Digite valores no campo!!!")
    }else{
        form.submit()        
    }
}


function impedeemail(){
    let form = document.getElementById("formu")
    event.preventDefault();

    let e = document.getElementById("email").value
    if(e == ""){
        alert("Digite valores no campo!!!")
    }else{
        form.submit()
    }
}

function impedesenha(){
    let form = document.getElementById("formu")
    event.preventDefault()

    let s = document.getElementById("senha").value 
    let cs = document.getElementById("csenha").value

    if(s == "" || cs == ""){
        alert("Digite valores no campo!!!")
    }else{
        if(s != cs){
            alert("senhas diferentes!!!")
        }else{
            form.submit()
        }
    }
}