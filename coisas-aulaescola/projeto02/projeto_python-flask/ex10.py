from flask import Flask
from flask import request
from flask import render_template
from datetime import date

app = Flask(__name__)
@app.route('/ex10.html')
def inicio():
    return render_template("ex10.html")


def criar(x, b, msg):
    if b == True:
        arquivo = open(x, 'a') #a irá escrever no arquivo mas n apagará oq ja estava no arquivo!
        arquivo.writelines(msg)
        arquivo.close()
        return 'Arquivo criado com sucesso!'

@app.route('/calcular', methods=['GET'])
def calcular():
    nome = str(request.args.get('nome'))
    email = str(request.args.get('email'))
    tel = str(request.args.get('telefone'))
    emp = str(request.args.get('empresa'))
    titulo = str(request.args.get('assunto'))
    ms = str(request.args.get('msg'))
    if nome == '' or email == '' or tel == '' or emp == '' or titulo == '' or ms == '':
        return render_template('ex10.html', valor='Preencha os campos acima!!!')
    
    data = date.today()
    nome_arquivo = 'D:\\codigo-vsCode\\programa-php\\coisas-aulaescola\\projeto02\\projeto_python-flask\\templates\\'
    
    msg = f'Nome: {nome}\nEmail: {email}\nTel: {tel}\nEmpresa: {emp}\n\nAssunto: {titulo}\nMensagem:\n{ms}\n\n'
    nome_arquivo += f'arquivos\\{data.day}-{data.month}-{data.year}_{email}.txt'
    b = True
    v = criar(nome_arquivo, b, msg)

    return render_template('ex10.html', valor=f' {v} ')


app.run()