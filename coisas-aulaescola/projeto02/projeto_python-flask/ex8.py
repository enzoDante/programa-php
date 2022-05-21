from flask import Flask
from flask import request
from flask import render_template
'''
NÃO FOI POSSÍVEL CRIAR TAGS HTML COM O PYTHON FLASK
'''

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
    msg = f'Melhor aluno: {alunomelhor} Nota: {maiorn}\n||||'
    return msg

def ordem(n):
    for i in range(0, 9):
        for x in range(0, 9):
            if n[x][1] < n[x+1][1]:
                aux = n[x][1]
                aux2 = n[x][0]
                n[x][1] = n[x+1][1]
                n[x][0] = n[x+1][0]
                n[x+1][1] = aux
                n[x+1][0] = aux2
    return n
    tabela = ''
    '''#tabela = <table id="tabela">
    #<tr><td><p>Maior nota para menor nota</p></td></tr>
    #
    for i in range(0, 10):
        tabela += f' Aluno: {n[i][0]} nota: {n[i][1]} || \n '
    #tabela += '</table>'
    return tabela'''

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
    #tudo = f"{v} \n\n\n<br> {v2}"
    return render_template('ex8.html', melhora=v,
        a1=f'Aluno: {v2[0][0]} Nota: {v2[0][1]}',
        a2=f'Aluno: {v2[1][0]} Nota: {v2[1][1]}',
        a3=f'Aluno: {v2[2][0]} Nota: {v2[2][1]}',
        a4=f'Aluno: {v2[3][0]} Nota: {v2[3][1]}',
        a5=f'Aluno: {v2[4][0]} Nota: {v2[4][1]}',
        a6=f'Aluno: {v2[5][0]} Nota: {v2[5][1]}',
        a7=f'Aluno: {v2[6][0]} Nota: {v2[6][1]}',
        a8=f'Aluno: {v2[7][0]} Nota: {v2[7][1]}',
        a9=f'Aluno: {v2[8][0]} Nota: {v2[8][1]}',
        a10=f'Aluno: {v2[9][0]} Nota: {v2[9][1]}'
    )

app.run()