<<!-- footer.php -->
<footer class="footer-personalizado text-white mt-5 py-4" role="contentinfo">
  <div class="container">
    <div class="row text-center text-md-start">
      
      <!-- Columna 1: Derechos -->
      <div class="col-md-4 mb-3">
        <p>&copy; 2025 <strong>Vacunacion.info</strong> – Todos los derechos reservados.</p>
        <nav class="social-icons mt-2" aria-label="Redes sociales">
          <a href="#" target="_blank" rel="noopener" title="Visítanos en Facebook" aria-label="Facebook">
            <i class="bi bi-facebook text-white"></i>
          </a>
          <a href="#" target="_blank" rel="noopener" title="Síguenos en Twitter" aria-label="Twitter">
            <i class="bi bi-twitter text-white"></i>
          </a>
          <a href="#" target="_blank" rel="noopener" title="Síguenos en Instagram" aria-label="Instagram">
            <i class="bi bi-instagram text-white"></i>
          </a>
        </nav>
      </div>

      <!-- Columna 2: Mapa del sitio -->
      <div class="col-md-4 mb-3">
        <h5 id="mapaSitio">Mapa del sitio</h5>
        <ul class="list-unstyled" aria-labelledby="mapaSitio">
          <li><a href="/TFG/index.php" class="text-white text-decoration-none">Inicio</a></li>
          <li><a href="/TFG/views/calculadora.php" class="text-white text-decoration-none">Calculadora de vacunas</a></li>
          <li><a href="/TFG/views/calendariosVacunacion.php" class="text-white text-decoration-none">Calendario de vacunación</a></li>
          <li><a href="/TFG/views/preguntasFrecuentes.php" class="text-white text-decoration-none">Preguntas frecuentes</a></li>
          <li><a href="/TFG/views/enlaces.php" class="text-white text-decoration-none">Enlaces de interés</a></li>
          <li><a href="/TFG/views/about.php" class="text-white text-decoration-none">Sobre nosotros</a></li>
        </ul>
      </div>

      <!-- Columna 3: Enlaces útiles -->
      <div class="col-md-4 mb-3">
        <h5 id="enlacesUtiles">Enlaces útiles</h5>
        <ul class="list-unstyled" aria-labelledby="enlacesUtiles">
          <li><a href="/TFG/views/privacidad.php" class="text-white text-decoration-none">Política de privacidad</a></li>
          <li><a href="/TFG/views/cookies.php" class="text-white text-decoration-none">Política de cookies</a></li>
        </ul>
      </div>

    </div>
  </div>
</footer>

<!-- 📦 Registro del Service Worker -->
<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/TFG/sw.js')
        .then(reg => console.log('✅ Service Worker registrado en:', reg.scope))
        .catch(err => console.error('❌ Error al registrar el Service Worker:', err));
    });
  }
</script>

<!-- 📲 Banner de instalación PWA -->
<div id="installBanner" class="position-fixed bottom-0 start-0 end-0 bg-primary text-white p-3 d-none" style="z-index: 9999;" role="dialog" aria-label="Instalar aplicación">
  <div class="d-flex justify-content-between align-items-center container">
    <span><i class="bi bi-download me-2" aria-hidden="true"></i> ¿Quieres instalar <strong>Vacunacion.info</strong> como app?</span>
    <button class="btn btn-light text-primary" id="installBtn" aria-label="Instalar aplicación">Instalar</button>
  </div>
</div>

<script>
  let deferredPrompt;
  const installBanner = document.getElementById('installBanner');
  const installBtn = document.getElementById('installBtn');

  window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    installBanner.classList.remove('d-none');
  });

  installBtn.addEventListener('click', async () => {
    installBanner.classList.add('d-none');
    if (deferredPrompt) {
      deferredPrompt.prompt();
      const { outcome } = await deferredPrompt.userChoice;
      console.log(outcome === 'accepted' ? '✅ Usuario aceptó la instalación' : '❌ Usuario rechazó la instalación');
      deferredPrompt = null;
    }
  });
</script>
