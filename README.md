# API de Usuarios y Plantas - Backend

Este proyecto es el backend para una aplicación de gestión de usuarios y plantas. Está construido con Laravel y proporciona endpoints para realizar operaciones CRUD en usuarios y plantas.

## 💻 Requisitos

-   PHP >= 7.4
-   Composer
-   MySQL
-   Laravel 8.x

## 📦 Instalación

1. Clona el repositorio:

    ```sh
    git clone https://github.com/PeterThrs/api-laravel-backend.git
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

-   **GET** `/api/usuarios`: Obtener todos los usuarios.
-   **GET** `/api/usuarios/{id}`: Obtener un usuario por ID.
-   **POST** `/api/usuarios`: Crear un nuevo usuario.
-   **PUT** `/api/usuarios/{id}`: Actualizar un usuario por ID.
-   **DELETE** `/api/usuarios/{id}`: Eliminar un usuario por ID.

### 🪴 Plantas

-   **GET** `/api/plantas`: Obtener todas las plantas.
-   **GET** `/api/plantas/{id}`: Obtener una planta por ID.
-   **POST** `/api/plantas`: Crear una nueva planta.
-   **PUT** `/api/plantas/{id}`: Actualizar una planta por ID.
-   **DELETE** `/api/plantas/{id}`: Eliminar una planta por ID.

## 🚀 Ejecución del Servidor

Inicia el servidor de desarrollo:

```sh
php artisan serve
```

## Modelos

Este proyecto incluye dos modelos principales: **Usuario** y **Planta**, utilizados para manejar la lógica de datos de la aplicación.

## Modelo Usuario

```php
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuario';
    protected $fillable = [ //datos editables
        'name',
        'email',
        'password',
        'phone',
        'img_url'
    ];
}
```

El modelo `Usuario` representa a los usuarios del sistema y contiene los siguientes atributos:

- `name`: Nombre del usuario.
- `email`: Correo electrónico del usuario.
- `password`: Contraseña del usuario (encriptada).
- `phone`: Número de teléfono del usuario.
- `img_url`: URL de la imagen de perfil del usuario.

### Configuración:
- Tabla asociada: `usuario`.
- Propiedad `$fillable`: Permite editar de forma masiva los campos mencionados.


## Modelo Planta

```php
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    protected $table = 'planta';
    protected $fillable = [
        'nombre_comun',
        'nombre_cientifico',
        'familia',
        'tipo',
        'origen',
       'descripcion',
       'imagen'
    ];
}
```

El modelo `Planta` representa información sobre las plantas registradas en el sistema y contiene los siguientes atributos:

- `nombre_comun`: Nombre común de la planta.
- `nombre_cientifico`: Nombre científico de la planta.
- `familia`: Familia a la que pertenece la planta.
- `tipo`: Tipo de planta (e.g., ornamental, medicinal).
- `origen`: Lugar de origen de la planta.
- `descripcion`: Descripción general de la planta.
- `imagen`: URL de la imagen asociada a la planta.

### Configuración:
- Tabla asociada: `planta`.
- Propiedad `$fillable`: Permite editar de forma masiva los campos mencionados.


## Base de Datos: Migraciones

En este proyecto, se utilizan migraciones de Laravel para gestionar las tablas en la base de datos. A continuación, se describen las tablas creadas y sus respectivos campos:

---

### Tabla: `usuario`

Esta tabla almacena la información de los usuarios del sistema.

#### Campos:
- **id**: Identificador único del usuario (autoincremental).
- **name**: Nombre del usuario.
- **email**: Correo electrónico del usuario.
- **password**: Contraseña del usuario.
- **phone**: Número de teléfono del usuario.
- **img_url**: URL de la imagen de perfil del usuario.
- **timestamps**: Campos automáticos `created_at` y `updated_at` para registrar la fecha de creación y actualización.

#### Migración:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('img_url');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

### Tabla: `planta`

Esta tabla almacena la información sobre las plantas registradas en el sistema.

#### Campos:
- **id**: Identificador único de la planta (autoincremental).
- **nombre_comun**: Nombre común de la planta.
- **nombre_cientifico**: Nombre científico de la planta.
- **familia**: Familia a la que pertenece la planta.
- **tipo**: Tipo de planta (e.g., ornamental, medicinal).
- **origen**: Origen de la planta.
- **descripcion**: Descripción breve de la planta.
- **imagen**: URL de la imagen representativa de la planta.
- **timestamps**: Campos automáticos `created_at` y `updated_at` para registrar la fecha de creación y actualización.

#### Migración:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comun');
            $table->string('nombre_cientifico');
            $table->string('familia');
            $table->string('tipo');
            $table->string('origen');
            $table->string('descripcion');
            $table->string('imagen');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planta');
    }
};

```

## Metodos utilizados para realizar el CRUD

### Obtener Usuarios
**Endpoint:** `GET /usuarios`

Obtiene la lista completa de usuarios registrados en el sistema.

```php
public function index()
    {
        $usuarios = Usuario::all();

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
```

### Insertar Usuario
**Endpoint:** `POST /usuarios`

Crea un nuevo usuario en el sistema. Valida los campos de entrada y retorna un mensaje de éxito o error.

**Validaciones:**
- `name`: Requerido.
- `email`: Requerido, formato de email, único en la tabla `usuario`.
- `password`: Requerido.
- `phone`: Requerido, debe tener 10 dígitos.
- `img_url`: Requerido.


```php
public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:usuario',
            'password' => 'required',
            'phone' => 'required|digits:10',
            'img_url' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'img_url' => $request->img_url
        ]);

        if (!$usuario) {
            $data = [
                'message' => 'Error al crear al usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $usuario,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
```

### Actualizar Planta
**Endpoint:** `PUT /plantas/{id}`

Actualiza los datos de una planta registrada. Valida la entrada y actualiza los campos correspondientes.

**Validaciones:**
- `nombre_comun`: Requerido, máximo 255 caracteres.
- `nombre_cientifico`: Requerido, máximo 255 caracteres.
- `familia`: Requerido, máximo 255 caracteres.
- `tipo`: Requerido, máximo 255 caracteres.
- `origen`: Requerido, máximo 255 caracteres.
- `descripcion`: Requerido, máximo 255 caracteres.
- `imagen`: Requerido.

```php
public function update(Request $request,$id){
    $planta = Planta::find($id);
    if(!$planta){
        $data = [
            'message' => 'Planta no encontrada',
                'status' => 404
        ];
        return response()-> json($data,404);
    }
    $validator = Validator::make($request->all(),[
        'nombre_comun'=> 'required|max:255',
        'nombre_cientifico' => 'required|max:255',
        'familia'=>'required|max:255',
        'tipo' => 'required|max:255',
        'origen' => 'required|max:255',
        'descripcion' => 'required|max:255',
        'imagen'=> 'required'
    ]);

    if($validator->fails()){
        $data = [
            'mesage'=> 'Error en la validación de datos',
            'errors' => $validator->errors(),
            'status' => 400
        ];
        return response()->json($data,400);
    }
    $planta ->nombre_comun = $request->nombre_comun;
    $planta ->nombre_cientifico = $request->nombre_cientifico;
    $planta ->familia = $request->familia;
    $planta ->tipo = $request->tipo;
    $planta ->origen = $request->origen;
    $planta ->descripcion = $request->descripcion;
    $planta ->imagen = $request->imagen;

    // $planta->save();
    $planta->save($request->only(['nombre_comun', 'nombre_cientifico', 'familia', 'tipo', 'origen','descripcion', 'imagen']));


    $data=[
        'message' => 'Planta actualizada',
        'planta' => $planta,
        'status' => 200
    ];
    return response()->json($data,200);

}
```

### Eliminar Planta
**Endpoint:** `DELETE /plantas/{id}`

Elimina una planta registrada en el sistema.

```php
public function destroy($id){
        $planta = Planta::find($id);
        if(!$planta){
            $data =[
                'message' => 'Planta no encontrada',
                    'status' => 404
            ];
            return response()->json($data,404);
        }
        $planta->delete();

        $data = [
            'message' => 'Planta eliminada',
                    'status' => 200
        ];
        return response()->json($data,200);
    }
```



Este proyecto de backend en Laravel proporciona una estructura sólida y escalable para la gestión de usuarios y plantas, permitiendo realizar operaciones CRUD de manera eficiente y segura. Gracias a las características de Laravel, como las migraciones, validaciones y modelos Eloquent, el desarrollo resulta más ágil y organizado, facilitando el manejo de los datos en la base de datos.


## ✒️ Autores 
   - Pedro López** - [PeterThrs 👾](https://github.com/PeterThrs)

   - Ilian Morales** - [iliMorales 💜](https://github.com/Ilimm9)

