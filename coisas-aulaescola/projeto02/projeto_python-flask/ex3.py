from flask import Flask
from flask import render_template
from flask import request

app = Flask(__name__)
@app.route('/ex3.html')
def inicio():
    return render_template('ex3.html')

@app.route('/calcular', methods=['GET'])
def calcular():
    n1 = request.args.get('num1')
    n2 = request.args.get('num2')
    eq = int(request.args.get('op_aritmeticos'))
    if n1 == '' or n2 == '':
        return render_template('ex3.html', valor='Digite algum número nos campos!!!')
    else:
        n1 = int(n1)
        n2 = int(n2)

        resp = 0
        if eq == 1:
            resp = n1 + n2
        elif eq == 2:
            resp = n1 - n2
        elif eq == 3:
            resp = n1 * n2
        else:
            resp = n1 / n2
        return render_template('ex3.html', valor=f"valor = {resp}")


app.run()