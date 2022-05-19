from flask import Flask
from flask import request
from flask import render_template

app = Flask(__name__)
@app.route('/ex7.html')
def inicio():
    return render_template('ex7.html')

def imcc(imc):
    msg = ''
    if imc < 20:
        msg = 'IMC abaixo de 20 --- abaixo do peso'
    elif imc >= 20 and imc < 25:
        msg = 'IMC de 20 até 25 --- peso normal'
    elif imc >= 25 and imc < 30:
        msg = 'IMC de 25 até 30 --- sobre peso'
    elif imc >= 30 and imc < 40:
        msg = 'IMC de 30 até 40 --- obeso'
    else:
        msg = 'IMC de 40 e acima --- obeso mórbido'
    return msg

def ideal(a):
    ihomens = (72.7 * a) - 58
    imulheres = (62.1 * a) - 44.7
    msg = f'peso ideal para homens: {ihomens:.1f}\npeso ideal para mulheres: {imulheres:.1f} '
    return msg

@app.route('/calcular', methods=['GET'])
def calcular():
    peso = float(request.args.get('peso'))
    altura = float(request.args.get('altura'))
    if peso <= 0 or altura <= 0:
        return render_template('ex7.html', valor='Digite valores acima de 0')
    else:
        imc = peso / (altura * altura)
        v = imcc(imc)
        v2 = ideal(altura)
        msg = f'{v}\n{v2}'
        return render_template('ex7.html', valor=msg)

app.run()