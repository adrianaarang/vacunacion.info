# Vacunacion.info

**Vacunacion.info** es una plataforma web diseñada para facilitar a las familias la gestión y seguimiento del calendario de vacunación infantil. Ofrece información fiable, personalizada y accesible desde cualquier dispositivo.

## 🌐 Proyecto en producción

Puedes visitar la plataforma desplegada en el siguiente enlace:

🔗 **[https://vacunacion.info](https://vacunacion.info)**

---

## 🚀 Funcionalidades principales

- Consulta del calendario vacunal infantil por edad y comunidad autónoma.
- Registro de usuarios con perfil de madre/padre.
- Gestión de hijos/as con cálculo automático de vacunas correspondientes.
- Recordatorios automáticos por correo electrónico antes de cada vacunación.
- Acceso privado para administradores con gestión de contenidos y usuarios.
- Diseño responsive y accesible.
- Despliegue en servidor remoto (AWS Lightsail).

---

## 🛠 Tecnologías utilizadas

- HTML5, CSS3, JavaScript
- PHP (con arquitectura MVC)
- MySQL y phpMyAdmin
- Bootstrap 5
- AJAX y jQuery
- API de correos con [Brevo (Sendinblue)](https://www.brevo.com/)
- PuTTY y WinSCP para administración remota
- PlantUML para documentación técnica
- Git y GitHub para control de versiones

---

## ⚙️ Instalación

1. Clona este repositorio:

   ```bash
   git clone https://github.com/usuario/repositorio.git
   ```

2. Importa la base de datos `vacunacion.info.sql` en tu servidor local (por ejemplo, phpMyAdmin o terminal MySQL).

3. Configura tu conexión a la base de datos en `models/BBDD.php`:

   ```php
   private $cadena_conexion = 'mysql:dbname=vacunacion.info;host=localhost';
   private $usuario = 'TU_USUARIO';
   private $password = 'TU_CONTRASEÑA';
   ```

4. ⚠️ **IMPORTANTE**: Por seguridad, la clave API de Brevo **no se incluye** en el repositorio.
   Para activar el envío de correos, inserta tu clave en:

   `controllers/recordatorios.php`

   ```php
   $apiKey = "tu-clave-api-aquí";
   ```

---

## 🔐 Seguridad

- Contraseñas cifradas con `password_hash`.
- Validaciones de formularios tanto en cliente como servidor.
- Acceso restringido por roles (`admin`, `usuario`).
- No se incluye información sensible ni claves privadas en el repositorio.

---

## 👩‍💻 Autoría

Proyecto desarrollado por **Adriana Aránguez García** como parte del módulo de Proyecto del CFGS en Desarrollo de Aplicaciones Web.

---
