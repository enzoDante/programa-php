import imp
from flask import Flask
from flask import request
from flask import render_template

app = Flask(__name__)
@app.route('/ex4.html')
def inicio():
    return render_template('ex4.html')

@app.route('/calcular', methods=['GET'])
def calcular():
    n = request.args.get('nota')
    if n == '':
        return render_template('ex4.html', valor='Digite um número no campo acima!!!')
    n = float(n)
    if n < 0 or n > 10:
        return render_template('ex4.html', valor='Digite um valor válido!!!')
    else:
        msg = ''
        if n == 10 or n == 9:
            msg = 'A'
        elif n == 8 or n == 7:
            msg = 'B'
        elif n == 6 or n == 5:
            msg = 'C'
        else:
            msg = 'D'
        return render_template('ex4.html', valor=f"Conceito é: {msg}")

app.run()