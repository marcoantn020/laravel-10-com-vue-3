Crie o Arquivo .env
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```


rode as migracoes
```sh
php artisan migrate
```
##
 Instale as dependecias do frontend
```sh
cd frontend
npm install
```

rode o projeto frontend
```sh
npm run serve
```

### Acesse o projeto: http://localhost:8080

##
### caso queira ver o endpoints no postman
- basta importar a collection [Orders.postman_collection.json] que se encontra na raiz do projeto no postman  

# OBS:
    - EM breve o frontend tambem estara em docker, mas por enquanto é necessario ter o node instalado 
