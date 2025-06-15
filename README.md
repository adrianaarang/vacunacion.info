# vacunacion.info

Plataforma web para el seguimiento del calendario vacunal infantil en España. Permite a madres y padres registrar a sus hijos, recibir recordatorios personalizados según edad y comunidad autónoma, y acceder a información oficial sobre vacunas.

## Tecnologías utilizadas

- HTML5, CSS3, JavaScript
- Bootstrap 5
- PHP 8
- MySQL (Base de datos alojada en AWS Lightsail)
- Composer (para dependencias PHP)
- Brevo (API para envío de correos electrónicos)
- PWA (Progressive Web App)
- Apache2
- Git y GitHub

## Estructura principal

- `/models/`: lógica de conexión a la base de datos y consultas
- `/controllers/`: procesamiento de formularios, control de flujo y validaciones
- `/views/`: vistas del frontend (páginas PHP + Bootstrap)
- `/public/`: archivos públicos (imágenes, JS, CSS)
- `/json/`: archivo `vacunas.json` con datos sobre vacunas

## Funcionalidades destacadas

- Registro/Login con validación de datos
- Gestión de hijos (con límite de edad 0-18 años)
- Recordatorios por correo 30, 14 y 7 días antes de cada vacuna
- Calendarios vacunales por comunidad (imágenes subidas desde el panel de administración)
- Buscador con autocompletado de vacunas
- Recuperación de contraseña por correo
- Soporte para instalación como PWA

## Despliegue en AWS Lightsail

### Requisitos previos

- Instancia Bitnami (Apache + PHP + MySQL)
- Acceso SSH (usando PuTTY o terminal con clave `.pem`)
- Cliente SCP o WinSCP para transferir archivos

### Pasos

1. **Subir archivos del proyecto**
   - Comprimir en `.zip` el proyecto local (excepto `node_modules` y `.git`)
   - Subir por SCP o WinSCP a `/opt/bitnami/apache2/htdocs/`
   - Descomprimir en el servidor:  
     ```bash
     unzip TFG.zip -d /opt/bitnami/apache2/htdocs/
     ```

2. **Configurar Apache para HTTPS**
   - Asegurar que `httpd.conf` carga `mod_rewrite` y redirige HTTP a HTTPS:
     ```apache
     RewriteEngine On
     RewriteCond %{HTTPS} !=on
     RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
     ```
   - Forzar tráfico HTTPS por el puerto 443

3. **Conectar a base de datos remota**
   - Exportar base local con `phpMyAdmin`
   - Importar en AWS (vía `mysql` o `phpMyAdmin`)
   - Editar `/models/BBDD.php` con credenciales de AWS:
     ```php
     $host = 'localhost';
     $dbname = 'vacunacion.info';
     $username = 'root';
     $password = 'tu_contraseña_de_root';
     ```

4. **Composer (ya instalado)**
   - Verificar instalación con `composer --version`
   - Ejecutar `composer install` si se usan dependencias

5. **Permisos Apache para PWA y manifest**
   - Asegurarse de que el MIME type `application/manifest+json` está configurado en `mime.types`
   - Confirmar que `manifest.json` está bien enlazado en `<head>`

### Exportación de la base de datos desde AWS

- Accede por SSH y usa:
  ```bash
  mysqldump -u root -p vacunacion.info > backup.sql
  ```

- O usa `phpMyAdmin` accediendo a:
  ```
  http://IP_PUBLICA/phpmyadmin
  ```

## Dominio y HTTPS

El proyecto está actualmente desplegado en:

➡️ **https://vacunacion.info**

Con tráfico forzado a HTTPS vía configuración de Apache.

## Desarrollo.

Proyecto desarrollado por Adriana Aránguez García.
