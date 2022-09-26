# Desafio Cuco Health

API HTTP responsável pelo gerenciamento de clientes.

## Dependências

### Docker
- **[Docker](https://docs.docker.com/install/)**
- **[Docker Compose](https://docs.docker.com/compose/install/)**
- **[Docker](https://git-scm.com/downloads)**

### Server
- **[Laravel 9.0](https://laravel.com/)**
- **[PHP 8.0](http://php.net/)**
- **[Composer](https://getcomposer.org/)**
- SQLlite

## Instalação
- Copiando o projeto
```sh
git clone https://github.com/widouglas/challenge-cuco.git 
```

- Trabalhando na pasta do projeto
```sh
cd challenge-cuco
```

- Criando o arquivo .env
```sh
cp .env.example .env
```

- Remova essas variáveis de ambiente do arquivo .env
```sh
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

- Atualize essas variáveis de ambiente do arquivo .env
```sh
APP_NAME="Challenge Cuco"
APP_URL=http://localhost:8989

DB_CONNECTION=sqlite
```

- Rodando o Docker
```sh
docker-compose up -d --build
```

- Acessando o container
```sh
docker-compose exec app bash
```

- Instalando as dependências 
```sh
composer install 
```

- Adicionando chave do Laravel
```sh
php artisan key:generate
```

- Criando o arquivo database
```sh
touch database/database.sqlite
```

- Dando permissão para escrita no arquivo database
```sh
chmod 777 database/ -R
```

- Criando a database
```sh
php artisan migrate
```

## API
https://localhost:8989/api/customers

## Documentação Postman
- Importar collection no Postman
https://www.getpostman.com/collections/448a45fe433b83867366
