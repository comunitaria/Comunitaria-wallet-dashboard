## Instalación y levantamiento del proyecto

### 1. Instalar PHP

En Mac, ejecuta en la terminal:
```sh
brew install php
```
Verifica la instalación:
```sh
php -v
```

### 2. Instalar Composer

Ejecuta en la terminal:
```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```
Verifica la instalación:
```sh
composer --version
```

### 3. Instalar dependencias del backend

En la raíz del proyecto:
```sh
composer install
```

### 4. Configurar entorno

Renombra `.env.example` a `.env` y ajusta los valores según tu entorno.

### 5. Instalar dependencias del frontend

En el directorio `app`:
```sh
cd app
npm install
```

### 6. Levantar el backend

En la raíz del proyecto:
```sh
php spark serve
```
El backend estará disponible en `http://localhost:8080`.

### 7. Levantar el frontend

En el directorio `app`:
```sh
ionic serve
```
o
```sh
ng serve
```
El frontend estará disponible en `http://localhost:8100` (o el puerto que indique Ionic/Angular).

### 8. Acceso

- Backend: `http://localhost:8080`
- Frontend: `http://localhost:8100`

