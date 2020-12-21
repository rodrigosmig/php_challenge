<h1 align="center">PHP Challenge</h1>

## Requirements
- Docker

## Installation
- add execution permission to the install.sh file
    * $ chmod +x install.sh
- run the install.sh file for project configuration
    * $ ./install.sh
- http://localhost:8001/


## Api
- /api/auth/register
    * method: POST
    * data: {"name": "Teste", "email":"teste@teste.com", "password":"12345678"}
- /api/auth/login
    * method: POST
    * data: {"email":"teste@teste.com", "password":"12345678"}

- /api/auth/person (authenticated)
    * method: GET
- /api/auth/ship-orders (authenticated)
    * method: GET

