## Teste
Para testar o sistem aprecisa de docker
Na raiz do projeto rodar o comando
#Passo: 1
```shell
docker-compose -p testelaravel up -d --build
```
#Passo: 2
Logo após do comando rodar acessar o conatiner
```shell
docker exec -it api.testelaravel.test sh
```

#Passo: 3
Logo após do comando rodar acessar o conatiner
```shell
cd testelaravel
```

#Passo: 4
Logo após do comando rodar acessar o conatiner
```shell
php artisan migrate
```

#Passo: 5
Logo após do comando rodar acessar o conatiner
```shell
npm install
```

#Passo: 6
Logo após do comando rodar acessar o conatiner
```shell
npm rum dev
```
