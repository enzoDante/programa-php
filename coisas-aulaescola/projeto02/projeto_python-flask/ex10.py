from flask import Flask
from flask import request
from flask import render_template
from datetime import date

'''
NÃO FOI ENSINADO A COMO CRIAR ARQUIVO!!! ESTUDANDO PARA O PROGRAMA FUNCIONAR!!!
'''

app = Flask(__name__)
@app.route('/ex10.html')
def inicio():
    return render_template("ex10.html")

@app.route('/arquivos')
def criar(x, b):
    if b == True:
        arquivo = open(x, 'w')
        arquivo.write('teste')
        return 'deu?'
    else:
        return 'hm'

@app.route('/calcular', methods=['GET'])
def calcular():
    nome = str(request.args.get('nome'))
    email = str(request.args.get('email'))
    tel = str(request.args.get('telefone'))
    emp = str(request.args.get('empresa'))
    titulo = str(request.args.get('assunto'))
    ms = str(request.args.get('msg'))
    
    data = date.today()
    nome_arquivo = f'arquivos/{data.day}-{data.month}-{data.year}_{email}.txt'
    b = True
    v = criar(nome_arquivo, b)

    return render_template('ex10.html', valor=f'Criou? nn sei... {v} ')
    #return render_template('ex10.html', valor=nome_arquivo)


app.run()