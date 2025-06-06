<!-- footer.php -->

<!-- Pie de página general del sitio -->
<footer class="footer-personalizado text-white mt-5 py-4" role="contentinfo">
  <!-- Contenedor principal para ajustar el ancho y alineación del contenido -->
  <div class="container">
    <div class="row text-center text-md-start">
      
      <!-- Columna 1: Información de derechos y redes sociales -->
      <div class="col-md-4 mb-3">
        <!-- Texto de derechos de autor -->
        <p>&copy; 2025 <strong>Vacunacion.info</strong> – Todos los derechos reservados.</p>

        <!-- Iconos de redes sociales con títulos y etiquetas de accesibilidad -->
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

      <!-- Columna 2: Mapa del sitio con enlaces internos -->
      <div class="col-md-4 mb-3">
        <h5 id="mapaSitio">Mapa del sitio</h5>
        <!-- Lista de enlaces de navegación principal -->
        <ul class="list-unstyled" aria-labelledby="mapaSitio">
          <li><a href="/TFG/index.php" class="text-white text-decoration-none">Inicio</a></li>
          <li><a href="/TFG/views/calculadora.php" class="text-white text-decoration-none">Calculadora de vacunas</a></li>
          <li><a href="/TFG/views/calendariosVacunacion.php" class="text-white text-decoration-none">Calendario de vacunación</a></li>
          <li><a href="/TFG/views/preguntasFrecuentes.php" class="text-white text-decoration-none">Preguntas frecuentes</a></li>
          <li><a href="/TFG/views/enlaces.php" class="text-white text-decoration-none">Enlaces de interés</a></li>
          <li><a href="/TFG/views/about.php" class="text-white text-decoration-none">Sobre nosotros</a></li>
        </ul>
      </div>

      <!-- Columna 3: Enlaces relacionados con aspectos legales -->
      <div class="col-md-4 mb-3">
        <h5 id="enlacesUtiles">Enlaces útiles</h5>
        <!-- Lista de enlaces a políticas legales -->
        <ul class="list-unstyled" aria-labelledby="enlacesUtiles">
          <li><a href="/TFG/views/privacidad.php" class="text-white text-decoration-none">Política de privacidad</a></li>
          <li><a href="/TFG/views/cookies.php" class="text-white text-decoration-none">Política de cookies</a></li>
        </ul>
      </div>

    </div>
  </div>
</footer>

<!-- Scripts para Progressive Web App (PWA) -->
<script src="/TFG/views/javascript/register-sw.js"></script> <!-- Registro del Service Worker -->
<script src="/TFG/views/javascript/install-pwa-button.js"></script> <!-- Botón para instalar la PWA -->

<!-- Cierre del <body> y del documento HTML -->
</body>
</html>

