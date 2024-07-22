
# Instalación de Pokedex
### Clonar el proyecto
Desde una terminal, ejecuta el siguiente comando:
`git clone https://github.com/OzzMkl/CC-POKEDEX.git`

### Moverse a la carpeta del proyecto
`cd CC-POKEDEX/`

### Crear el archivo .env
`cp .env.example .env`  # Comando para Linux/macOS
`copy .env.example .env`  # Comando para Windows

### Modificar el archivo .env
Busca los siguientes parámetros comentados en el archivo `.env`:

`DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=laravel
#DB_USERNAME=root
#DB_PASSWORD=`

Y reemplázalos con:
`DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cc-pokedex
DB_USERNAME=root  # Reemplaza con tu nombre de usuario de MySQL
DB_PASSWORD=      # Reemplaza con tu contraseña de MySQL (si aplica)`

### Instalar dependencias
`composer install`

### Generar llave única de aplicación
php artisan key:generate

### Ejecutar migraciones
`php artisan migrate`
El sistema te preguntará si quieres crear la base de datos. Selecciona "sí".

### Levantar el proyecto
`php artisan serve`

### Acceder al proyecto
Por defecto, la aplicación estará disponible en:
`http://127.0.0.1:8000/`

