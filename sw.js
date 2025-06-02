// sw.js
const CACHE_NAME = 'vacunacion-cache-v1';
const urlsToCache = [
  '/TFG/index.php',
  '/TFG/views/style.css',
  '/TFG/views/javascript/buscadorHeader.js',
  '/TFG/views/javascript/registro.js',
  '/TFG/views/javascript/login.js',
  '/TFG/views/bootstrap/img/logo/logo6.png',
  '/TFG/views/bootstrap/img/slider/foto1.png',
  '/TFG/views/bootstrap/img/slider/foto2.png',
  '/TFG/views/bootstrap/img/slider/foto3.png'
];

// Instalación: almacena archivos en caché
self.addEventListener('install', event => { // <-- ¡Aquí está la corrección!
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(urlsToCache);
    })
  );
});

// Activación: limpieza de versiones antiguas si las hubiera
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.map(key => {
          if (key !== CACHE_NAME) return caches.delete(key);
        })
      )
    )
  );
});

// Intercepción de solicitudes
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});