# Email Sending API

## Overview

This API allows clients to send emails via a RESTful interface using PHP 7.3. It features OAuth2 authentication, message queuing, and PostgreSQL for storing sent messages.

## System Design

- **Client**: Application or service sending API requests.
- **API Server**: PHP application handling requests.
- **Database**: PostgreSQL to store email messages.
- **Message Queue**: Handles email sending asynchronously.
- **Authentication**: Simple OAuth2 for secure access.

## System Diagram
+--------------------+
|     Client         |
| (API Requests)     |
+--------+-----------+
         |
         v
+--------+-----------+
|   API Server       |
| (PHP Application) |
+--------+-----------+
         |
         v
+--------+-----------+     +----------------+
| PostgreSQL         |<--->|    Message     |
| Database           |     |     Queue      |
+--------------------+     +----------------+
                                 |
                                 v
                         +------------------+
                         | Email Sending    |
                         | Worker/Service   |
                         +------------------+


## Installation

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/tegar-manthofani/repo.git
    cd repo
    ```

2. **Install Dependencies:**

    ```bash
    composer install
    ```

3. **Set Up PostgreSQL Database:**

    ```bash
    psql -U your_user -d email_db -f migrations/create_emails_table.sql
    ```

4. **Start RabbitMQ (or your message broker).**
    
    ```bash
    php worker.php
    ```

6. **Start the PHP Server:**

    ```bash
    php -S localhost:8000 -t public
    ```

## API Usage

- **Method**:
    - `Post`
-**Endpoint**:
    -`http://localhost:8000/api.php`

- **Function**:
    -`Send an email.`

- **Headers**: 
  - `Authorization: Bearer <your-oauth2-token>`

- **Body** (JSON):
  ```json
  {
    "recipient": "email@example.com",
    "subject": "Subject of the email",
    "body": "Body of the email"
  }


- **Response Sample**:
    - 200 OK
        ```json
        {
        "success": "Email scheduled"
        }
    - 400 Bad Request
        ```json
        {
        "error": "Invalid input"
        }
    - 401 Unauthorized
        ```json
        {
        "error": "Unauthorized"
        }
    - 405 Method not allowed
        ```json
        {
        "error": "Method not allowed"
        }



