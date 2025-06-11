# Vacunacion.info

**Vacunacion.info** es una plataforma web centrada en la información y gestión personalizada de vacunas infantiles en España.
Permite a madres y padres consultar calendarios vacunales por comunidad autónoma, registrar hijos/as, recibir recordatorios de vacunas y consultar efectos secundarios.

---

🔗 Actualmente desplegado en producción:  
👉 [https://vacunacion.info](https://vacunacion.info) (con protocolo HTTPS activo)

---

## 🌐 Tecnologías utilizadas

- **PHP 8.2**
- **MySQL / MariaDB**
- **HTML5, CSS3, JavaScript**
- **Bootstrap 5**
- **JSON para autocompletado**
- **Sendinblue/Brevo API** para envío de recordatorios
- **Servidor: Apache en AWS Lightsail**
- **Composer** (opcional para dependencias PHP)
- **PWA (Progressive Web App)** básica

---

## 🚀 Instrucciones para desplegar en AWS (Lightsail)

### 1. Crear instancia en AWS Lightsail

- Escoge **LAMP (Linux, Apache, MySQL, PHP)** como imagen base
- Asigna IP estática
- Abre los puertos 22 (SSH), 80 (HTTP), 443 (HTTPS)

### 2. Acceder a la instancia

```bash
ssh -i "tu-clave.pem" bitnami@IP-DE-TU-SERVIDOR
```

### 3. Subir el proyecto

- Usa **WinSCP** o **FileZilla** para copiar la carpeta completa (`TFG`) a:

```bash
/opt/bitnami/apache/htdocs/
```

### 4. Configurar base de datos

- Importa el archivo `vacunacion_info.sql` con:

```bash
sudo /opt/bitnami/mysql/bin/mysql -u root -p vacunacion < /opt/bitnami/apache/htdocs/TFG/vacunacion_info.sql
```

- Edita `config.php` con las credenciales de la instancia

💡 Para exportar o importar la base de datos en AWS Lightsail, es necesario acceder por SSH (por ejemplo, usando **PuTTY**) y ejecutar los comandos MySQL desde el terminal.

---

## 🔐 Configuración de claves (opcional, recomendado en producción)

Usar variables de entorno en lugar de claves en el código:

1. Crea un archivo `.env`:

```env
BREVO_API_KEY=tu_clave_de_brevo
```

2. Usa `getenv("BREVO_API_KEY")` en tu PHP

3. Asegúrate de que `.env` está incluido en `.gitignore`

---

## 🛠 Recomendaciones para producción

### 🔐 Forzar redirección HTTP → HTTPS en Apache

Para asegurar que todo el tráfico use HTTPS (puerto 443), edita el archivo de configuración de Apache (`bitnami.conf` o `httpd.conf`) y añade una redirección como esta:

```apache
<VirtualHost *:80>
  ServerName vacunacion.info
  Redirect permanent / https://vacunacion.info/
</VirtualHost>
```

También asegúrate de que el puerto 443 está habilitado en Lightsail y que el certificado SSL está instalado correctamente (puedes usar Let's Encrypt).

### ⚙️ Configuraciones necesarias para el funcionamiento del PWA

Para que el `manifest.json`, `service worker (sw.js)` y demás archivos de la PWA funcionen correctamente:

- Asegúrate de que Apache esté sirviendo correctamente estos archivos con los MIME types adecuados.
- Verifica que en tu archivo `mime.types` de Apache esté incluida esta línea:

```apache
application/manifest+json           webmanifest json
```

- Además, asegúrate de que los encabezados de caché no bloqueen el `service worker`.

---

## 🧪 Usuario de prueba (si procede)

```txt
Email: demo@vacunacion.info
Contraseña: demo1234
```

---

## 📄 Licencia

Proyecto académico desarrollado por **Adriana Aránguez García**.

---
