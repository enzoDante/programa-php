let div = document.getElementById('form')
let i = 0
document.getElementById("inputImagem2").style.display = 'none'
function imagem(){
    
    var res = document.getElementById("res")
    //document.getElementById("inputImagem1").style.display = 'none'
    //document.getElementById("inputImagem2").style.display = 'block'

    if(document.getElementById("inputImagem1").value == '')
        document.getElementById("inputImagem1").style.display = 'block'
    else{
        if(document.getElementById("inputImagem2").value == ''){
            document.getElementById("inputImagem1").style.display = 'none'
            document.getElementById("inputImagem2").style.display = 'block'
        }else{
            document.getElementById("inputImagem2").style.display = 'none'
        }
    }

    //document.getElementById("inputImagem1").style.display = 'none' ou isso
    //form.removeChild(document.getElementById("inputImagem1")) e tem esse
    i++
    //if(i <= 2){
        //if(i == 2)
            //document.getElementById("inputImagem2").style.display = 'none'
    if(this.files && this.files[0]){
        var arquivo = new FileReader()
        arquivo.onload = function(e){
            var img = document.createElement("img")
            img.setAttribute("src", e.target.result)
            img.setAttribute("name","inputImagem"+i)
            img.setAttribute("onclick","fechar(this, 'inputImagem"+i+"')")
            img.setAttribute("aceppt","image/*")

            res.appendChild(img)
            //document.getElementById("img").src = e.target.result


        }
        arquivo.readAsDataURL(this.files[0])
        

    }
    

    
}
document.getElementById("inputImagem1").addEventListener("change", imagem, false)
document.getElementById("inputImagem2").addEventListener("change", imagem, false)
//document.querySelector(".in").addEventListener("change", imagem, false)

function fechar(x, y){
    alert(y)
    x.outerHTML = ''
    document.getElementById(y).value = ''
    //document.getElementById(y).style.display = 'block'
    //i--
    if(document.getElementById("inputImagem1").value == ''){
        document.getElementById("inputImagem1").style.display = 'block'
        i = 0
    }
    else{
        if(document.getElementById("inputImagem2").value == ''){
            document.getElementById("inputImagem1").style.display = 'none'
            document.getElementById("inputImagem2").style.display = 'block'
            i = 1
        }else{
            document.getElementById("inputImagem2").style.display = 'none'
            i = 2
        }
    }
}