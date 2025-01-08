# Todo Management Backend (Laravel)

## Descrição

Backend do sistema de gerenciamento de tarefas desenvolvido com Laravel, fornecendo APIs RESTful para gerenciamento de projetos e tarefas.

## Requisitos

- PHP 8.1+
- Composer
- PostgreSQL 16

## Instalação

1. Clonar o repositório

bash

```bash
git clone https://github.com/ebagabee/todo_management_api.git
cd todo_management_backend
```

2. Instalar dependências

```bash
composer install
```

3. Copiar configurações

```bash
cp .env.example .env
```

4. Gerar chave da aplicação

```bash
php artisan key:generate
```

## Configuração do Banco de Dados

1. Criar banco de dados
2. Configurar `.env`

```env
DB_CONNECTION=pgsql

DB_HOST=127.0.0.1

DB_PORT=5432

DB_DATABASE=todo_management

DB_USERNAME=postgres

DB_PASSWORD=sua_senha
```

3. Executar migrações

```bash
php artisan migrate
```
## Executar Servidor

```bash
php artisan serve
# Servidor rodará em http://localhost:8000
```

## Rotas Principais

- `GET /api/projects`: Listar projetos

- `GET /api/projects/{id}/tasks`: Listar tarefas de um projeto

- `POST /api/tasks`: Criar nova tarefa

- `PUT /api/tasks/{id}`: Atualizar tarefa
