<h1 align="center">💉 vacunacion.info</h1>

<p align="center">
  <b>Stack:</b> PHP · MySQL · JavaScript · AWS<br>
  <b>Arquitectura:</b> MVC · API externa (Brevo)<br>
  <b>Funcionalidades clave:</b> Autenticación · Emails automáticos · Panel admin
</p>

<p align="center">
  <b>Gestión inteligente del calendario vacunal infantil en España</b><br>
  Recordatorios automáticos · Personalización por comunidad · PWA
</p>

<p align="center">
  <a href="https://vacunacion.info">
    <img src="https://img.shields.io/badge/🌐%20Demo-vacunacion.info-blue?style=for-the-badge">
  </a>
  <a href="https://drive.google.com/file/d/12Dz6CHrXi_jIEx4uxA-nLytNDYiIeGBs/view?usp=drive_link">
    <img src="https://img.shields.io/badge/🎥%20Vídeo-Demo-red?style=for-the-badge">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Estado-Completo-success?style=for-the-badge">
  <img src="https://img.shields.io/badge/Versión-1.0.0-blue?style=for-the-badge">
  <img src="https://img.shields.io/badge/Última_actualización-2026-blue?style=for-the-badge">
  <img src="https://img.shields.io/badge/Licencia-MIT-yellow?style=for-the-badge">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Frontend-HTML5-orange?style=for-the-badge&logo=html5">
  <img src="https://img.shields.io/badge/Frontend-CSS3-blue?style=for-the-badge&logo=css3">
  <img src="https://img.shields.io/badge/Frontend-JavaScript-yellow?style=for-the-badge&logo=javascript">
  <img src="https://img.shields.io/badge/Framework-Bootstrap-purple?style=for-the-badge&logo=bootstrap">
  <img src="https://img.shields.io/badge/Backend-PHP-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/DB-MySQL-lightblue?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/Infra-AWS_Lightsail-orange?style=for-the-badge">
  <img src="https://img.shields.io/badge/Email-API_Brevo-blue?style=for-the-badge">
</p>

---

## 🚀 Descripción

`vacunacion.info` es una aplicación web diseñada para facilitar el seguimiento del calendario vacunal infantil en España, adaptándose automáticamente a la comunidad autónoma del usuario.

El sistema permite gestionar el historial vacunal de menores y automatizar recordatorios, mejorando la adherencia a los calendarios oficiales y reduciendo olvidos.

---

## 🎯 Problema que resuelve

- Diferencias entre calendarios vacunales por comunidad autónoma
- Falta de recordatorios centralizados y automatizados
- Dificultad para mantener un seguimiento actualizado

### 👨‍👩‍👧 Para familias
- Seguimiento completo de vacunación (0–18 años)
- Recordatorios automáticos antes de cada vacuna
- Adaptación dinámica al cambiar de comunidad

### 🏥 Para profesionales sanitarios
- Consulta del estado vacunal
- Registro y actualización de vacunas
- Mejora de la continuidad asistencial

---

## ✨ Funcionalidades principales

- 👶 Gestión de perfiles de menores
- 📅 Calendario vacunal personalizado por comunidad autónoma
- 📧 Sistema de recordatorios automatizados (30, 14 y 7 días antes de cada vacuna)
- 🔐 Sistema completo de autenticación (login, registro, recuperación de contraseña)
- 🔎 Buscador con autocompletado
- 📱 Instalación como Progressive Web App (PWA)
- 🛠️ Panel de administración con gestión de vacunas, calendarios y usuarios
- 🗑️ Eliminación segura de registros y cuentas

---

## 📸 Demo



https://github.com/user-attachments/assets/a6325f44-f071-4320-856b-6a63691f4db8


https://github.com/user-attachments/assets/0412e68c-6eac-4dc9-9515-d703ed957121



https://github.com/user-attachments/assets/57db0d3b-8d57-464e-a0be-44bee92d0cd5



---

## 🧰 Stack tecnológico

| Capa | Tecnología |
|------|-----------|
| Frontend | HTML5, CSS3, JavaScript, Bootstrap |
| Backend | PHP (patrón MVC) |
| Base de datos | MySQL |
| Infraestructura | AWS Lightsail + Apache (Bitnami) |
| Email | API Brevo (getbrevo/brevo-php ^2.0) |
| Gestor de dependencias | Composer |
| Otros | PWA (manifest + Service Worker) |

---

## 🏗️ Arquitectura y estructura del proyecto

```
vacunacion.info/
├── controllers/          → Lógica de negocio (procesarLogin, recordatorios, calendarios…)
├── models/
│   ├── BBDD.php          → Clase de conexión y operaciones con la base de datos (PDO)
│   └── vacunas.json      → Datos estructurados de vacunas
├── views/
│   ├── *.php             → Vistas (home, panel_usuario, panel_admin, registro…)
│   ├── javascript/       → Scripts del cliente
│   ├── header.php        → Cabecera común
│   ├── footer.php        → Pie de página común
│   └── style.css         → Estilos globales
├── includes/
│   └── email_functions.php → Funciones de envío de email via Brevo
├── logs/                 → Logs de errores y envíos de recordatorios
├── vendor/               → Dependencias Composer (no subir al repositorio)
├── vacunacion.info.sql   → Script de importación de la base de datos
├── manifest.json         → Configuración PWA
├── sw.js                 → Service Worker
├── route.php             → Enrutador principal
├── index.php             → Punto de entrada
├── .htaccess             → Configuración Apache
└── composer.json         → Definición de dependencias
```

---

## ⚙️ Decisiones técnicas

- **MVC** para separar responsabilidades y facilitar mantenibilidad
- **PDO** para acceso a la base de datos con protección frente a SQL Injection
- **API Brevo** para delegar el envío de emails de forma fiable y escalable
- **Cron job** para automatizar el envío de recordatorios sin intervención manual
- **PWA** para mejorar la experiencia en dispositivos móviles
- **AWS Lightsail** para un despliegue sencillo, controlado y con coste reducido

---

## 📧 Sistema de notificaciones (API Brevo)

- Integración mediante la librería oficial `getbrevo/brevo-php` desde PHP
- Envío automático de emails 30, 14 y 7 días antes de cada vacuna
- Personalización de mensajes según usuario y vacuna
- Autenticación segura mediante variable de entorno `BREVO_API_KEY`
- Control de errores en el envío con registro en logs
- Trazabilidad de recordatorios para evitar duplicados y facilitar auditoría

---

## 🔐 Seguridad

- Almacenamiento seguro de contraseñas mediante hashing (`password_hash`)
- Validación y sanitización de inputs en cliente y servidor
- Protección frente a SQL Injection mediante PDO con parámetros preparados
- Prevención de ataques XSS
- Gestión segura de sesiones PHP
- API Key de Brevo almacenada como variable de entorno (nunca en el código)

---

## 💻 Instalación local

### Requisitos previos

- PHP 8.x
- MySQL 8.x
- Composer
- Servidor local (XAMPP, Laravel Herd, MAMP, etc.)

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/adrianaarang/vacunacion.info
cd vacunacion.info

# 2. Instalar dependencias PHP
composer install

# 3. Importar la base de datos
mysql -u root -p < vacunacion.info.sql

# 4. Configurar la conexión a la base de datos
# Editar models/BBDD.php con tus credenciales locales:
#   private $cadena_conexion = 'mysql:dbname=vacunacion.info;host=localhost';
#   private $usuario = 'root';
#   private $password = '';

# 5. Configurar la variable de entorno para Brevo
export BREVO_API_KEY="tu_api_key_de_brevo"
# O añadirla en la configuración de tu servidor virtual (Apache/Nginx)

# 6. Arrancar el servidor local y acceder a:
#    http://localhost/vacunacion.info
```

---

## 🚀 Despliegue en producción (AWS Lightsail)

- Servidor en AWS Lightsail (Bitnami + Apache)
- Dominio propio configurado con DNS
- Redirección automática a HTTPS mediante `.htaccess`
- Despliegue mediante SCP al directorio `/opt/bitnami/apache2/htdocs/`
- Variable de entorno `BREVO_API_KEY` configurada en el VirtualHost de Apache

### Configuración del cron job de recordatorios

```bash
# Ejecutar diariamente a las 9:00 AM
0 9 * * * php /opt/bitnami/apache2/htdocs/TFG/controllers/recordatorios.php >> /opt/bitnami/apache2/htdocs/TFG/controllers/recordatorios_cron.log 2>&1
```

---

## 🧪 Testing

Las pruebas realizadas han sido de tipo manual:

- Validación de formularios en cliente y servidor
- Verificación de flujos completos de autenticación (registro, login, recuperación)
- Pruebas de envío de recordatorios con distintos escenarios de fecha
- Comprobación de interacción entre módulos (calendario ↔ comunidad ↔ recordatorios)
- Verificación del comportamiento en distintos dispositivos (PWA)

> La implementación de tests automatizados (PHPUnit) se plantea como mejora futura.

---

## 📊 Diagramas del sistema

El proyecto ha sido diseñado con modelado UML:

- Diagrama de casos de uso
- Diagrama de clases
- Modelo entidad-relación (base de datos)

Estos diagramas reflejan la estructura del sistema, las relaciones entre entidades y el flujo de interacción entre módulos.

---

## 🧠 Aprendizajes

- Diseño e implementación de arquitectura MVC desde cero en PHP
- Autenticación completa con gestión de sesiones y recuperación de contraseña
- Integración con APIs externas (Brevo) usando librería oficial
- Automatización de procesos con cron jobs
- Despliegue en entorno cloud real (AWS Lightsail)
- Desarrollo de aplicaciones PWA con Service Worker y manifest

---

## 🚧 Mejoras futuras

**Técnicas:**
- Desarrollo de API REST desacoplada del frontend
- Migración a framework moderno (React / Vue)
- Notificaciones push (Web Push API)
- Tests automatizados con PHPUnit
- Uso de variables de entorno mediante `.env` (vlucas/phpdotenv)

**Funcionales:**
- Perfil para vacunación de viajeros internacionales
- Recomendaciones según destino con integración OMS / CDC
- Extensión a calendarios de vacunación de adultos

---

## 👩‍💻 Autora

<p align="center">
  <b>Adriana Aránguez García</b><br><br>
  <a href="https://www.linkedin.com/in/adriana-aranguez">
    <img src="https://img.shields.io/badge/LinkedIn-Adriana-blue?style=for-the-badge&logo=linkedin">
  </a>
  <a href="https://github.com/adrianaarang">
    <img src="https://img.shields.io/badge/GitHub-adrianaarang-black?style=for-the-badge&logo=github">
  </a>
</p>

---

## 📊 Métricas del repositorio

<p align="center">
  <img src="https://img.shields.io/github/languages/top/adrianaarang/vacunacion.info?style=for-the-badge">
  <img src="https://img.shields.io/github/last-commit/adrianaarang/vacunacion.info?style=for-the-badge">
  <img src="https://img.shields.io/github/repo-size/adrianaarang/vacunacion.info?style=for-the-badge">
  <img src="https://img.shields.io/github/issues/adrianaarang/vacunacion.info?style=for-the-badge">
</p>
