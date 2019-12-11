## Installation

-   Run this in your cmd folder path in htdocs: git clone https://github.com/sydummy/ride-to-go-prod.git
-   In cmd, go to the folder "ride-to-go-prod", run composer update
-   Copy .env.example and save as .env
-   Generate app key by running php artisan key:generate
-   Create database name ride_to_go_dev in your localhost PHPMyAdmin
-   In cmd, enter php artisan migrate for the database
-   Next, enter php artisan serve to run in localhost
-   In web browser, go to localhost:8000/clients

## About

Car Rental API's and Usage

## API's Overview (v1)

| Action           | Method | API                   | Headers                                                     |
| ---------------- | ------ | --------------------- | ----------------------------------------------------------- |
| `Admin Login`    | `POST` | `/api/v1/a/login/`    | `Acceptapplication/json`<br> `Content-Typeapplication/json` |
| `Admin Register` | `POST` | `/api/v1/a/register/` | `Acceptapplication/json`<br> `Content-Typeapplication/json` |
| `Admin Register` | `POST` | `/api/v1/a/register/` | `Acceptapplication/json`<br> `Content-Typeapplication/json` |

## API's

## **POST Register Admin User**

```
/api/v1/a/register/
```

**Usage**\
HEADERS\
`Acceptapplication/json`\
`Content-Typeapplication/json`

```json
{
    "f_name": "First",
    "m_name": "Middle",
    "l_name": "Last",
    "age": "22",
    "birthdate": "1999-05-31",
    "email": "admin@gmail.com",
    "password": "password!!!2019!!!",
    "password_confirmation": "password!!!2019!!!"
}
```

## **POST Login Admin User**

```
/api/v1/a/login/
```

**Usage**\
HEADERS\
`Acceptapplication/json`\
`Content-Typeapplication/json`

```json
{
    "email": "admin@gmail.com",
    "password": "password!!!2019!!!",
    "remember_me": false
}
```
