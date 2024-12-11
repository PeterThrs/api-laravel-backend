# API de Usuarios y Plantas - Backend

Este proyecto es el backend para una aplicación de gestión de usuarios y plantas. Está construido con Laravel y proporciona endpoints para realizar operaciones CRUD en usuarios y plantas.

## 💻 Requisitos

- PHP >= 7.4
- Composer
- MySQL
- Laravel 8.x

## 📦 Instalación

1. Clona el repositorio:

    ```sh
    git clone https://github.com/tu_usuario/tu_repositorio_backend.git
    cd tu_repositorio_backend
    ```

2. Instala las dependencias de Composer:

    ```sh
    composer install
    ```

3. Copia el archivo de configuración `.env.example` a `.env`:

    ```sh
    cp .env.example .env
    ```

4. Genera la clave de la aplicación:

    ```sh
    php artisan key:generate
    ```

5. Configura la base de datos en el archivo `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_la_base_de_datos
    DB_USERNAME=usuario
    DB_PASSWORD=contraseña
    ```

6. Ejecuta las migraciones de la base de datos:

    ```sh
    php artisan migrate
    ```

## Endpoints

### 👤 Usuarios

- **GET** `/api/usuarios`: Obtener todos los usuarios.
- **GET** `/api/usuarios/{id}`: Obtener un usuario por ID.
- **POST** `/api/usuarios`: Crear un nuevo usuario.
- **PUT** `/api/usuarios/{id}`: Actualizar un usuario por ID.
- **DELETE** `/api/usuarios/{id}`: Eliminar un usuario por ID.

### 🪴 Plantas

- **GET** `/api/plantas`: Obtener todas las plantas.
- **GET** `/api/plantas/{id}`: Obtener una planta por ID.
- **POST** `/api/plantas`: Crear una nueva planta.
- **PUT** `/api/plantas/{id}`: Actualizar una planta por ID.
- **DELETE** `/api/plantas/{id}`: Eliminar una planta por ID.

## 🚀 Ejecución del Servidor

Inicia el servidor de desarrollo:

```sh
php artisan serve
    ```
