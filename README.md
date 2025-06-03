# Vacunacion.info

**Vacunacion.info** 
Su objetivo es facilitar a las familias la gestión y el seguimiento del calendario de vacunación infantil, ofreciendo información fiable, personalizada y accesible desde cualquier dispositivo.

## Funcionalidades principales

- Consulta del calendario vacunal infantil por edad y comunidad autónoma.
- Registro de usuarios con perfil de madre/padre.
- Gestión de hijos/as con cálculo automático de vacunas correspondientes.
- Recordatorios automáticos por correo electrónico antes de cada vacunación.
- Acceso privado para administradores con gestión de contenidos y usuarios.
- Diseño responsive y accesible.
- Despliegue en servidor remoto (AWS Lightsail).

## Tecnologías utilizadas

- HTML5, CSS3 y JavaScript
- PHP (MVC manual)
- MySQL y phpMyAdmin
- Bootstrap 5
- AJAX y jQuery
- API de envío de correos mediante [Brevo (Sendinblue)](https://www.brevo.com/)
- PuTTY y WinSCP para gestión remota en AWS
- PlantUML para la documentación técnica
- Git y GitHub para control de versiones

## Instalación

1. Clona el repositorio:

   ```bash
   git clone https://github.com/usuario/repositorio.git
   ```

2. Importa la base de datos desde el archivo `vacunacion.info.sql` usando phpMyAdmin o consola MySQL.

3. Configura los accesos a la base de datos en el archivo `models/BBDD.php`:

   ```php
   private $cadena_conexion = 'mysql:dbname=vacunacion.info;host=localhost';
   private $usuario = 'TU_USUARIO';
   private $password = 'TU_CONTRASEÑA';
   ```

4. **IMPORTANTE**: Por razones de seguridad, la clave de la API para el envío de correos **no está incluida** en este repositorio.  
   Para que los recordatorios automáticos funcionen correctamente, deberás insertar tu propia clave API en el archivo:

   **`controllers/recordatorios.php`**


## Seguridad

- Las contraseñas de usuario están encriptadas.
- El acceso al panel de administración está protegido.
- Se han aplicado medidas de validación en formularios tanto en el frontend como en el backend.
- Este repositorio omite cualquier dato sensible o privado por motivos de seguridad.

## Autoría

Este proyecto ha sido desarrollado por **Adriana Aránguez García** como parte del módulo de Proyecto en el CFGS de Desarrollo de Aplicaciones Web.
