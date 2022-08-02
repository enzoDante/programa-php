var objDiv = document.getElementById("msgs");
objDiv.scrollTop = objDiv.scrollHeight;


function acharlink(event){
    event.preventDefault()
    
    var
    reURL = /((?:http(s)?:\/\/)?(?:www(\d)?\.)?([\w\-]+\.\w{2,})\/?((?:\?(?:[\w\-]+(?:=[\w\-]+)?)?(?:&[\w\-]+(?:=[\w\-]+)?)?))?(#(?:[^\s]+)?)?)/g,

    text = document.getElementById("imsg").value,

    html = text.replace(reURL, '<a target="_blank" href="http$2://www$3.$4$5$6">$1</a>');
    //document.getElementById("imsg").value = html
    document.getElementById('iimsg').value = html

    //document.getElementById('testando').innerHTML = html
    //acima o testando fica do jeito certo, ent qr ver como fica o php ja q ele vai receber o value do iimsg
    document.getElementById("chatbate").submit()
}