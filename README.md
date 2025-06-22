
# 📝 To-Do List API – Laravel 10

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?logo=laravel)
![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue?logo=php)
![Status](https://img.shields.io/badge/status-Finalizado-brightgreen)
![Build](https://img.shields.io/badge/testes-PASSING-success)

API RESTful desenvolvida em Laravel para gerenciar tarefas pessoais com autenticação, validações, testes e documentação Swagger.

---

## ⚙️ Como configurar o projeto

1. Clone o repositório:

```bash
git clone https://github.com/carlosvasco16/to-do-list.git
cd to-do-list
```

2. Copie o arquivo de ambiente:

```bash
cp .env.example .env
```

3. Configure o banco de dados no `.env`:

```
DB_DATABASE=to_do_list
DB_USERNAME=root
DB_PASSWORD=
```

4. Instale as dependências:

```bash
composer install
```

5. Gere a chave da aplicação:

```bash
php artisan key:generate
```

---

## 🗃️ Como rodar as migrations

```bash
php artisan migrate
```

Ou para recriar tudo:

```bash
php artisan migrate:fresh
```

---

## 🚀 Como executar o servidor local

```bash
php artisan serve
```

A aplicação estará disponível em:

```
http://127.0.0.1:8000
```

---

## 🧪 Como testar a API

Você pode usar Postman ou `curl`.

### 📌 Registro
`POST /api/register`

```json
{
  "name": "Carlos",
  "email": "carlos@email.com",
  "password": "123456",
  "password_confirmation": "123456"
}
```

### 🔐 Login
`POST /api/login`

```json
{
  "email": "carlos@email.com",
  "password": "123456"
}
```

> Copie o token retornado e use no cabeçalho:  
`Authorization: Bearer {TOKEN}`

### 📋 Criar Tarefa
`POST /api/tasks`

```json
{
  "title": "Estudar Laravel",
  "description": "Finalizar desafio"
}
```

### 📃 Listar Tarefas
`GET /api/tasks`

### 🎯 Atualizar Status
`PATCH /api/tasks/{id}/status`

```json
{
  "status": "completed"
}
```

### 🗑️ Deletar Tarefa
`DELETE /api/tasks/{id}`

---

## 📚 Documentação Swagger

Gere com:

```bash
php artisan l5-swagger:generate
```

Acesse em:  
[http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)

---

## ✅ Funcionalidades implementadas

- Autenticação com Laravel Sanctum
- Cadastro/Login/Logout
- CRUD de Tarefas
- Filtro por status
- Testes automatizados com PHPUnit
- Documentação com Swagger

---

## 👨‍💻 Autor

Desenvolvido por **Carlos Vasco**  
📌 Angola · 💻 Laravel · 🔐 Backend APIs
