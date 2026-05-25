# E-shop Simple API

Simple e-commerce API build with Laravel

## Installation

git clone https://github.com/Developer33331111/eshop_simple.git

cd eshop_simple

## Environment setup

cd .env.example .env

php artisan key:generate

Set Database

DB_DATABASE=eshop_simple
DB_USERNAME=root
DB_PASSWORD=

php artisan migrate --seed

## Endpoints

<b>POST /api/login</b>

```json
{
    "email": "",
    "password": "",
    "device_name" : ""
}
```

<b>POST /api/register</b>

```json
{
    "name": "",
    "email": "",
    "password": "",
    "password_confirmation" : ""
}
```

<b>GET /api/products</b>

<b>POST /api/products</b>

```json
{
    "code": "PRD-12334",
    "name": "Test",
    "seo_url": "test",
    "price": 100,
    "description": "Text",
}
```

<b>PUT /api/products/{id}</b>

```json
{
    "code": "PRD-12334",
    "name": "Test",
    "seo_url": "test",
    "price": 100,
    "description": "Text",
}
```

<b>DELETE /api/products/{id}</b>
