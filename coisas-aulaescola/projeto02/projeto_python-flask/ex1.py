from flask import Flask
from flask import render_template
from flask import request

app = Flask(__name__)

@app.route('/ex1.html')
def inicial():
    return render_template('ex1.html')


@app.route('/lugarPython', methods=['GET'])
def lugarPython():
    salario_bruto = request.args.get("salario-bruto")
    horas = request.args.get('horas')
    v_horas = request.args.get('valorHoras')
    if salario_bruto == '' or horas == '' or v_horas == '':
        return render_template('ex1.html', aq='Digite valores nos campos acima!!!')
    salario_bruto = float(salario_bruto)
    horas = float(horas)
    v_horas = float(v_horas)
    
    if salario_bruto <= 0 or horas <=0 or v_horas <=0:
        return render_template('ex1.html', aq='Digite valores corretamente!')
    else:
        total = horas * v_horas
        salario_liquido = (salario_bruto + total) - 0.08
        return render_template('ex1.html', aq=f"salário liquido = {salario_liquido}")

    #return render_template('index.html', aq=x)



app.run() #serve p rodar o flask, no meu caso, o flask run nn funciona, mas o app.run deu certo :)
