from asyncio.windows_events import NULL
import math
from flask import Flask
from flask import request
from flask import render_template

app = Flask(__name__)
@app.route('/ex6.html')
def inicio():
    return render_template('ex6.html')


def delta(a, b, c):
    d = (b*b) - (4 * a * c)
    d = math.sqrt(d)
    return d
def x1(a, b, d):
        v1 = (-b + d) / (2 * a)
        return v1
def x2(a, b, d):
    v2 = (-b - d) / (2 * a)
    return v2

@app.route('/calcular', methods=['GET'])
def calcular():
    a=  int(request.args.get('a'))
    b = int(request.args.get('b'))
    c = int(request.args.get('c'))
    if a == 0 or b == 0 or c == 0:
        return render_template('ex6.html', valor='Digite valores nos campos acima!!!')
    else:
        d = delta(a, b, c)
        v1 = x1(a, b, d)
        v2 = x2(a, b, d)
        msg = f"{v1} e {v2}"
        return render_template('ex6.html', valor=f"raízes = {msg} ")




app.run()