
# API de Gerenciamento de Lugares

Esta é uma API simples desenvolvida com o Laravel 12 para gerenciar lugares. Ela permite criar, editar, listar, excluir e obter detalhes de um lugar específico, além de permitir a filtragem de lugares pelo nome, cidade e estado.

## Funcionalidades
- Criar um lugar

- Editar um lugar

- Obter um lugar específico

- Listar lugares e filtrá-los por nome

## Tecnologias Utilizadas
- PHP: Linguagem de programação

- Laravel 12: Framework PHP

- PostgreSQL: Banco de dados relacional

- Faker: Biblioteca para gerar dados fictícios

## Pré-requisitos
Antes de começar, você precisará de:

- PHP 8.1 ou superior

- Composer (gerenciador de dependências PHP)

- PostgreSQL ou outro banco de dados relacional

- Postman ou qualquer cliente HTTP para testar os endpoints (opcional)

## Instalação
Siga os passos abaixo para configurar e rodar a API em seu ambiente local.

### Passo 1: Clonar o repositório
Clone o repositório para sua máquina local:
```bash
  git clone https://github.com/seu-usuario/places-api.git
  cd places-api
```

### Passo 2: Instalar as dependências
caso for usar no docker
```bash
  docker-compose up -d
  docker-compose exec app bash
```
Instale as dependências do projeto usando o Composer:
```bash
  composer install
```
### Passo 3: Configuração do ambiente
Crie um arquivo .env copiando o arquivo .env.example:
```bash
  cp .env.example .env
```

No arquivo .env, configure as credenciais do seu banco de dados:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

No arquivo .env, configure as credenciais do seu banco de dados caso for usar o docker:
```bash
DB_CONNECTION=pqsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=desafio_backend
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

### Passo 4: Gerar a chave da aplicação
Execute o comando para gerar a chave da aplicação:
```bash
  php artisan key:generate
```

### Passo 5: Rodar as Migrations
Execute as migrations para criar as tabelas no banco de dados:
```bash
  php artisan migrate
```

### Passo 6: Popular o banco de dados (opcional)
Para popular o banco de dados com 30 lugares fictícios, rode o seeder:
```bash
  php artisan db:seed --class=PlaceSeeder
```

### Passo 7: Roda o teste

configuração no phpunit.xml
```bash
      <php>
        <env name="APP_ENV" value="testing"/>
        <env name="APP_MAINTENANCE_DRIVER" value="file"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="CACHE_STORE" value="array"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="PULSE_ENABLED" value="false"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
    </php>
```

Para Roda os test de Feature:
```bash
  php artisan test --filter=PlaceApiTest
```

## Endpoints da API
Abaixo estão os detalhes dos endpoints disponíveis na API.

### 1. Criar um Lugar
- URL: /api/places

- Método: POST

- Autenticação: Não necessária

- Corpo da requisição (JSON):
```bash
  {
    "name": "Central Park",
    "city": "New York",
    "state": "NY"
  }
```
- Resposta de sucesso (Status 201):
```bash
  "message": "place successfully created"
```

#### Campos:

- name: Nome do lugar (obrigatório)

- slug: Slug gerado automaticamente

- city: Cidade onde o lugar está localizado (obrigatório)

- state: Estado onde o lugar está localizado (obrigatório)

### 2. Listar Lugares
- URL: /api/places

- Método: GET

- Autenticação: Não necessária

- Parâmetros de consulta (opcional[name,city,state]):

Filtro de pesquisa pelo name,city e state

- Exemplo de requisição:
```bash
  GET /api/places?filter=Park
```
- Resposta de sucesso (Status 200):
```bash
  {
        "name": "Central Park",
        "slug": "central-park",
        "city": "New York",
        "state": "NY",
        "created_at": "2025-04-09",
        "updated_at": "2025-04-09"
    }
```

### 3. Obter um Lugar Específico
- URL: /api/places/{slug}

- Método: GET

- Autenticação: Não necessária

- Parâmetro de URL:

- {slug}: O slug do lugar que você deseja buscar.

- Exemplo de requisição:
```bash
  GET /api/places/central-park
```
- Resposta de sucesso (Status 200):
```bash
  {
    "name": "Central Park",
    "slug": "central-park",
    "city": "New York",
    "state": "NY",
    "created_at": "2025-04-09",
    "updated_at": "2025-04-09"
  }
```
- Resposta de erro (Status 404):
```bash
  "message": "Place not found"
```
### 4. Editar um Lugar
- URL: /api/places/{slug}

- Método: PUT

- Autenticação: Não necessária

- Parâmetro de URL:

- {slug}: O slug do lugar que você deseja editar.

- Corpo da requisição (JSON):
```bash
  {
    "name": "Central Park Updated",
    "city": "New York",
    "state": "NY"
  }
```
- Resposta de sucesso (Status 200):
```bash
   "message": "place successfully updated"
```
- Resposta de erro (Status 404):
```bash
    "message": "Place not found"
```

### 5. Excluir um Lugar
- URL: /api/places/{slug}

- Método: DELETE

- Autenticação: Não necessária

- Parâmetro de URL:

- {slug}: O slug do lugar que você deseja excluir.

- Resposta de sucesso (Status 200):
```bash
   "message": "Place deleted successfully"
```
- Resposta de erro (Status 404):
```bash
    "message": "Place not found"
```
