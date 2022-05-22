from flask import Flask
from flask import request
from flask import render_template

app = Flask(__name__)
@app.route('/ex9.html')
def inicio():
    return render_template('ex9.html')

def fatorial(n):
    f = 1
    msg = ''
    for i in range(1, n+1):
        f *= i
        msg += f'{i}'
        if i < n:
            msg += '*'
    msg = f'{f} = {msg}'
    return msg

@app.route('/calcular', methods=['GET'])
def calcular():
    n = request.args.get('num')
    if n == '':
        return render_template('ex9.html', valor='Digite um número no campo acima!!!')
    n = int(n)
    if n < 0:
        return render_template('ex9.html', valor='Digite um número positivo!')
    else:
        fat = fatorial(n)
    return render_template('ex9.html', valor=f'Fatorial de {n} é {fat} ')

app.run()