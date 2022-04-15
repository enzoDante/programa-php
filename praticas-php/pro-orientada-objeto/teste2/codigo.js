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