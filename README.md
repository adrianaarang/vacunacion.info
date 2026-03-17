💉 vacunacion.info

Plataforma web para gestionar el calendario vacunal infantil en España

👉 Aplicación completa que permite a familias llevar el control de vacunas de sus hijos, con recordatorios automáticos y calendario adaptado por comunidad autónoma.

🔗 Demo: https://vacunacion.info

🚀 ¿Qué problema resuelve?

En España, el calendario vacunal:

cambia según la comunidad autónoma

es difícil de seguir para familias

no tiene recordatorios centralizados

👉 Esta app soluciona eso automatizando el seguimiento y avisando por email antes de cada vacuna.

✨ Funcionalidades principales

👶 Gestión de hijos (0–18 años)

📅 Calendario vacunal por comunidad autónoma

📧 Recordatorios automáticos (30, 14 y 7 días antes)

🔐 Sistema de autenticación (registro/login + recuperación)

🔎 Buscador con autocompletado

📱 Instalable como app (PWA)

🧰 Tecnologías

Frontend: HTML5, CSS3, JavaScript, Bootstrap

Backend: PHP

Base de datos: MySQL

Arquitectura: MVC

Infraestructura: AWS Lightsail + Apache

Otros: Composer, Brevo (emails), PWA

🏗️ Arquitectura
models/       → acceso a datos (MySQL)
controllers/  → lógica de negocio
views/        → interfaz (PHP + Bootstrap)
public/       → assets (CSS, JS, imágenes)
json/         → datos de vacunas
🚀 Despliegue

Aplicación desplegada en AWS Lightsail usando stack Bitnami (Apache + PHP + MySQL).

Incluye:

🔐 Redirección automática a HTTPS

🌐 Dominio propio configurado

📦 Subida por SCP

📸 Capturas 

👉 Login


👉 Dashboard
👉 Calendario

🧠 Aprendizajes clave

Implementación de arquitectura MVC desde cero

Gestión de autenticación y sesiones en PHP

Integración de envío de emails automatizados

Despliegue real en AWS con servidor Apache

Configuración de PWA

👩‍💻 Autor

Adriana Aránguez García
LinkedIn
 | GitHub
