from flask import Flask
from flask import render_template
from flask import request

app = Flask(__name__)

@app.route('/ex2.html')
def inicio():
    return render_template('ex2.html')

@app.route('/calcular', methods=['GET'])
def calcular():
    num = request.args.get('num')
    if num == '':
        return render_template('ex2.html', valor='Digite um valor no campo acima!!!')
    num = float(num)
    if num <= 0:
        return render_template('ex2.html', valor='Digite os valores corretamente!')
    else:
        m1 = num * 0.28
        m2 = num * 0.45
        soma = num + m1 + m2
        return render_template('ex2.html', valor=f"{soma}")

app.run()