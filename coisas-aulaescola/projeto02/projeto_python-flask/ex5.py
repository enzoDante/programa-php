from asyncio.windows_events import NULL
import re
from flask import Flask
from flask import request
from flask import render_template

app = Flask(__name__)
@app.route('/ex5.html')
def inicio():
    return render_template('ex5.html')

@app.route('/calcular', methods=['GET'])
def calcular():
    n = request.args.get('num')
    if n == '':
        return render_template('ex5.html', valor='Digite um número no campo acima!!!')
    n = int(n)
    if n <= 0:
        return render_template('ex5.html', valor='Digite um valor positivo!!')
    else:
        if n % 2 == 0:
            return render_template('ex5.html', valor=f'Número par {n} ')
        else:
            return render_template('ex5.html', valor=f'Número impar {n} ')

app.run()