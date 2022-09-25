import pymongo

cliente = pymongo.MongoClient("mongodb://localhost:27017/")
meu_banco = cliente['banco_de_dados']
#Este print apenas mostra a conexão e o banco criado mas não salvo
#print(meu_banco)

colecao = meu_banco['cientistas']

valor = {"id":2,"nome":"teste 2","idade":22}
#c = colecao.insert_one(valor)
#print(c)
colecao.insert_one(valor)