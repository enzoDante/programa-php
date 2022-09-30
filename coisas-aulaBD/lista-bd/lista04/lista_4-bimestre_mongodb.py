#=================2HID - Enzo Dante Mícoli - 50210203 ======================================
import pymongo
cliente = pymongo.MongoClient("mongodb://localhost:27017/")
meu_banco = cliente['banco_de_dados']

colecao = meu_banco['lista4']
'''valores = [
    {"id":1, "artigo":"texto do artigo1", "data":"30/09/2022", "horas":10},
    {"id":2, "artigo":"texto do artigo2", "data":"20/08/2022", "horas":12},
    {"id":3, "artigo":"texto do artigo3", "data":"12/05/2022", "horas":20},
    {"id":4, "artigo":"texto do artigo4", "data":"11/09/2022", "horas":1},
    {"id":5, "artigo":"texto do artigo5", "data":"3/03/2022", "horas":6},
    {"id":6, "artigo":"texto do artigo6", "data":"6/02/2022", "horas":13},
    {"id":7, "artigo":"texto do artigo7", "data":"30/09/2022", "horas":17},
    {"id":8, "artigo":"texto do artigo8", "data":"24/09/2022", "horas":10},
    {"id":9, "artigo":"texto do artigo9", "data":"30/09/2022", "horas":10},
    {"id":10, "artigo":"texto do artigo10", "data":"5/02/2022", "horas":10}
]
colecao.insert_many(valores)'''
total = 0
meiodia = list()
doze_treze_16 = list()
antesdas16 = list()
aposas16 = list()
todosmenos12e17 = list()
#linha 68 possui outra forma de executar!!!
#===============método compactado para buscar os dados pedidos============
for i in colecao.find():
    total += 1
    if i['horas'] == 12:
        meiodia.append(i)
    if i['horas'] == 12 or i['horas'] == 13 or i['horas'] == 16:
        doze_treze_16.append(i)
    if i['horas'] < 16:
        antesdas16.append(i)
    if i['horas'] > 16:
        aposas16.append(i)
    if i['horas'] != 12 and i['horas'] != 17:
        todosmenos12e17.append(i)
print(f'Total de posts: [{total}] ')
print(f'posts meio dia:')
for i in meiodia:
    print(i)
print('\n')
print(f'posts 12h, 13h e 16h: ')
for i in doze_treze_16:
    print(i)
print('\n')

print(f'antes das 16h:\n ')
for i in antesdas16:
    print(i)
print('\n')

print(f'Apos as 16h: ')
for i in aposas16:
    print(i)
print('\n')

print(f'todos menos 12h e 17h:\n ')
for i in todosmenos12e17:
    print(i)
meiodia.clear()
doze_treze_16.clear()
antesdas16.clear()
aposas16.clear()
todosmenos12e17.clear()
#==========método usando mais comandos do mongodb======================
print("meio dia:\n")
for i in colecao.find({'horas': 12}):
    print(i)
print('\n 12h, 13h e 16h:\n')
for i in colecao.find({'horas': {"$in": [12, 13, 16]}}):
    print(i)
print('\nantes da 16h\n')
for i in colecao.find({'horas': {"$lt" : 16}}):
    print(i)
print('\napós as 16\n')
for i in colecao.find({'horas':{"$gt": 16}}):
    print(i)
print('\ntodos menos 12h e 17h\n')
for i in colecao.find({'horas': {'$nin': [12,17]}}):
    print(i)