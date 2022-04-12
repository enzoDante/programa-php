function impede(){
    let form = document.getElementById("ff")
    event.preventDefault()

    let n = document.getElementById("nome").value 
    let i = document.getElementById("idade").value 
    
    if(n == "" || isNaN(i)){
        alert("Digite valores no campo!!!")
    }else{
        form.submit()
    }

}