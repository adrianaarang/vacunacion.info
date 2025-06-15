// ? sw.js — Service Worker funcional mínimo

self.addEventListener('install', event => {
  console.log('? Service Worker instalado');
  self.skipWaiting(); // activa inmediatamente
});

self.addEventListener('activate', event => {
  console.log('? Service Worker activado');
});

self.addEventListener('fetch', event => {
  // Opcional: responder desde caché
  console.log('?? Interceptado:', event.request.url);
});

