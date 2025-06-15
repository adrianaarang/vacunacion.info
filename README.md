<h1 align="center">💉 vacunacion.info</h1>

<p align="center">Plataforma web para gestionar el calendario vacunal infantil en España</p>

<p align="center">
  <img src="https://img.shields.io/badge/Estado-En%20producción-brightgreen" alt="Estado">
  <img src="https://img.shields.io/badge/Versión-1.0-blue" alt="Versión">
  <img src="https://img.shields.io/badge/Licencia-MIT-yellow" alt="Licencia">
</p>

---

## 📌 Tabla de contenidos

- [🧰 Tecnologías utilizadas](#-tecnologías-utilizadas)
- [📁 Estructura del proyecto](#-estructura-del-proyecto)
- [✨ Funcionalidades destacadas](#-funcionalidades-destacadas)
- [🚀 Despliegue en AWS Lightsail](#-despliegue-en-aws-lightsail)
- [🌐 Dominio y HTTPS](#-dominio-y-https)
- [👩‍💻 Contacto](#-contacto)

---

## 🧰 Tecnologías utilizadas

![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?logo=bootstrap&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-D22128?logo=apache&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-181717?logo=github&logoColor=white)
![PWA](https://img.shields.io/badge/PWA-5A0FC8?logo=pwa&logoColor=white)
![AWS](https://img.shields.io/badge/AWS-232F3E?logo=amazonaws&logoColor=white)
![Brevo](https://img.shields.io/badge/Brevo-009EF7?style=flat&logoColor=white)

---

## 📁 Estructura del proyecto

- `models/` → conexión a la base de datos y queries
- `controllers/` → lógica de validación y flujo
- `views/` → páginas PHP + Bootstrap
- `public/` → archivos estáticos (CSS, JS, imágenes)
- `json/` → datos de vacunas (`vacunas.json`)

---

## ✨ Funcionalidades destacadas

- ✔️ Registro/Login con validaciones
- ✔️ Gestión de hijos (0-18 años)
- ✔️ Envío de recordatorios personalizados por email (30, 14, 7 días)
- ✔️ Calendario vacunal por comunidad
- ✔️ Buscador con autocompletado
- ✔️ Recuperación de contraseña por correo
- ✔️ Instalación como app PWA

---

## 🚀 Despliegue en AWS Lightsail

### Requisitos

- Instancia Bitnami (Apache, PHP, MySQL)
- Acceso por SSH (clave `.pem`)
- WinSCP o SCP para transferencias

### Pasos

```bash
# 1. Subir y descomprimir el proyecto
scp -i tu_clave.pem TFG.zip bitnami@IP_PUBLICA:/opt/bitnami/apache2/htdocs/
unzip TFG.zip

# 2. Redirigir a HTTPS
RewriteEngine On
RewriteCond %{HTTPS} !=on
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# 3. Configurar base de datos
# Edita models/BBDD.php con tus credenciales
```

---

## 🌐 Dominio y HTTPS

El proyecto está disponible en:

🔗 **https://vacunacion.info**  
✔️ Tráfico forzado a HTTPS  
✔️ Soporte para PWA (`manifest.json` configurado)

---

## 👩‍💻 Desarrollo

Desarrollado por **Adriana Aránguez García**  
Proyecto final.
