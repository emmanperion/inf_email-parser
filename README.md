# inf_email-parser
Inflektion Email Parser as part of the Engineering Assessment.

## Pre-requisites
- Docker Desktop

## Running the project
Make sure you have Docker installed on your machine. and then follow the steps below.

1. Setup the .env file
Create a `.env` file in the root directory of the project and copy the content from `/deploy/envfile` file.

2. Build the project
```bash
docker compose -f deploy/docker-compose.yml --env-file ./.env up --build -d
```

3. Database Migration
### Running the migrations
```bash
docker exec -t laravel php artisan migrate
```

4. Database Seeding
### Running the seeder
```bash
docker exec -t laravel php artisan db:seed
```

---

## Accessing the project
```bash
http://localhost:8080
```

---

## Accessing the API
For easy access, you can use the Postman collection and environment file located at `/postman` directory.

The following sample requests are using `curl` to demonstrate how to interact with the API. 
You can use any other tool of your preference.

### Creating a token
For the purpose of this demonstration, we are using the user with the ID of `1` that is created when seeding the database.
```bash
curl --location --request POST 'http://localhost:8080/api/v1/tokens'
```
Use the token in the header `Authorization: Bearer <token>`
If you are using the `postman collection`, Update the `token` field on the `inflektion environment`.

---

## API Endpoints

### Get all (Method: `GET`)
```bash
curl --location 'http://localhost:8080/api/v1/successful-emails' \
--header 'Authorization: Bearer <token>'
```

### Store (Method: `POST`)
```bash
curl --location 'http://localhost:8080/api/v1/successful-emails' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer <token>' \
--data-raw '{
    "affiliate_id": 1001,
    "envelope": "{\"to\":[\"recipient@example.com\"],\"from\":\"sender@example.com\"}",
    "from": "sender@example.com",
    "subject": "Welcome to Our Service",
    "dkim": "pass",
    "SPF": "pass",
    "spam_score": 0.1,
    "email": "Return-Path: <sender@example.com>\r\nReceived: by 2002:a9d:58c:: with SMTP id n28csp12345iob;\r\n        Fri, 22 Sep 2024 08:15:12 -0700 (PDT)\r\nFrom: Sender <sender@example.com>\r\nTo: Recipient <recipient@example.com>\r\nSubject: Welcome to Our Service\r\nDate: Fri, 22 Sep 2024 08:15:11 -0700\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\nHello,\n\nThank you for signing up with us. We are thrilled to have you.\n\nBest,\nCustomer Service",
    "sender_ip": "192.168.1.1",
    "to": "[\"recipient@example.com\"]",
    "timestamp": 1695401711
}'
```

### Get by ID (Method: `GET`)
```bash
curl --location 'http://localhost:8080/api/v1/successful-emails/1' \
--header 'Authorization: Bearer <token>' \
--data ''
```

### Update (Method: `PUT`)
```bash
curl --location --request PUT 'http://localhost:8080/api/v1/successful-emails/1' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer <token>' \
--data-raw '{
    "affiliate_id": 1001,
    "envelope": "{\"to\":[\"recipient@example.com\"],\"from\":\"sender@example.com\"}",
    "from": "sender@example.com",
    "subject": "Welcome to Our Updated Service",
    "dkim": "pass",
    "SPF": "pass",
    "spam_score": 0.1,
    "email": "Return-Path: <sender@example.com>\r\nReceived: by 2002:a9d:58c:: with SMTP id n28csp12345iob;\r\n        Fri, 22 Sep 2024 08:15:12 -0700 (PDT)\r\nFrom: Sender <sender@example.com>\r\nTo: Recipient <recipient@example.com>\r\nSubject: Welcome to Our Service\r\nDate: Fri, 22 Sep 2024 08:15:11 -0700\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\nHello,\n\nThank you for signing up with us. We are thrilled to have you.\n\nBest,\nCustomer Service",
    "sender_ip": "192.168.1.1",
    "to": "[\"recipient@example.com\"]",
    "timestamp": 1695401711
}'
```

### Delete by ID (Method: `DELETE`)
```bash
curl --location --request DELETE 'http://localhost:8080/api/v1/successful-emails/1' \
--header 'Authorization: Bearer <token>' \
--data ''
```
