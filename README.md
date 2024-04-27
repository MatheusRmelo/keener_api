# Keener Desafio

## Tecnologias
Laravel (Framework)
PHP (Linguagem)
MySQL (Database)

## Docker
Configure as variaveis do projeto em `.env`, copie do `env.example` caso não exista <br>
Configurações do banco e WEATHER API e Firebase<br>
````
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=weather
DB_USERNAME=root
DB_PASSWORD=
OPEN_WEATHER_API_KEY=1c60f80547b66975469fe900a4da19d8
FIREBASE_PROJECT_ID=kenner-632d0
````
<br>

Execute o comando para iniciar o build e os containers `docker compose up -d ` <br>
Após isso configure o APP_KEY executando `docker exec -it app php artisan key:generate` <br>
Rode as migrations com o comando `docker exec -it app php artisan migrate` <br>
Gere o swagger `docker exec -it app php artisan l5-swagger:generate` <br>
E por fim rode o cron `docker exec -it app php artisan schedule:work` <br>

## Instalação manual

# Instalação dos pacotes
Após instalar o PHP e o composer <br>
instale as dependências `composer install` <br>

Configure o .env caso não exista copiando do .env.example<br>
Se APP_KEY do .env estiver vazio rode `php artisan key:generate` <br>
Coloque os dados do MySQL no .env<br>
````
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=NOME_DO_BANCO_CRIADO
DB_USERNAME=USUARIO_DO_SERVER_MYSQL
DB_PASSWORD=SENHA_DO_SERVER_MYSQL
OPEN_WEATHER_API_KEY=1c60f80547b66975469fe900a4da19d8
FIREBASE_PROJECT_ID=kenner-632d0
````
para criar tabelas `php artisan migrate` <br>
para gerar o swagger `php artisan l5-swagger:generate` <br>
rodar servidor ```php artisan serve```<br>
Em um terminal separado rode  `php artisan schedule:work`


