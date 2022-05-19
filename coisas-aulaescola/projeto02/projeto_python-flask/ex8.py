from flask import Flask
from flask import request
from flask import render_template

app = Flask(__name__)
@app.route('/ex8.html')
def inicio():
    return render_template('ex8.html')

def maior(n):
    maiorn = 0
    alunomelhor = ''
    for i in range(0, 10):
        if n[i][1] > maiorn:
            maiorn = n[i][1]
            alunomelhor = n[i][0]
    msg = f'Melhor aluno: {alunomelhor} Nota: {maiorn} '
    return msg

def ordem(n):
    for i in range(0, 9):
        for x in range(0, 9):
            if n[x][1] > n[x+1][1]:
                aux = n[x][1]
                aux2 = n[x][0]
                n[x][1] = n[x+1][1]
                n[x][0] = n[x+1][0]
                n[x+1][1] = aux
                n[x+1][0] = aux2
    tabela = '<table id="tabela">'
    tabela += '<tr><td><p>Maior nota para menor nota</p></td></tr>'
    for i in range(0, 10):
        tabela += f'<tr><td><p>{n[i][0]}</p></td><td><p>{n[i][1]}</p></td></tr>'
    tabela += '</table>'
    return tabela

@app.route('/calcular', methods=['GET'])
def calcular():
    nomesn = list()
    valor = list()
    for i in range(0, 10):
        nome = str(request.args.get(f'nome{i}'))
        nota = float(request.args.get(f'nota{i}'))
        if nota < 0 or nota > 10:
            return render_template('ex8.html', valor='Digite uma nota válida!!!')
        else:
            valor.append(nome)
            valor.append(nota)

            nomesn.append(valor[:])
            valor.clear()
    
    v = maior(nomesn)
    v2 = ordem(nomesn)
    tudo = f"{v} <br> {v2}"
    return render_template('ex8.html', valor=tudo)

app.run()