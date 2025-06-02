// /TFG/views/javascript/install-pwa-button.js

let deferredPrompt;
// Obtiene el botón de instalación una sola vez al cargar el script.
// Se asume que el botón con id="installAppButton" está presente en el HTML
// de la página principal (home.php), aunque oculto con 'd-none' inicialmente.
const installAppButton = document.getElementById('installAppButton');

// Solo ejecuta la lógica PWA si el botón fue encontrado en el DOM
if (installAppButton) {
    window.addEventListener('beforeinstallprompt', (e) => {
        // Previene que el navegador muestre su propio prompt automático
        e.preventDefault();
        // Guarda el evento para usarlo después (se necesitará para mostrar el prompt)
        deferredPrompt = e;
        // Hace visible tu botón de instalación personalizado en la página
        installAppButton.classList.remove('d-none');
        console.log('Evento beforeinstallprompt capturado. Botón de instalación visible.');
    });

    // Adjunta el listener de clic al botón de instalación.
    // Esto se hace una única vez, ya que el botón está presente en el DOM.
    installAppButton.addEventListener('click', async () => {
        // Oculta el botón una vez que el usuario hace clic para instalar
        installAppButton.classList.add('d-none');
        // Si el evento 'deferredPrompt' está disponible, muestra el prompt de instalación nativo
        if (deferredPrompt) {
            deferredPrompt.prompt();
            // Espera la elección del usuario (aceptar o rechazar)
            const { outcome } = await deferredPrompt.userChoice;
            console.log(outcome === 'accepted' ? '✅ Usuario aceptó la instalación' : '❌ Usuario rechazó la instalación');
            // El evento deferredPrompt solo se puede usar una vez, así que lo reseteamos
            deferredPrompt = null;
        }
    });

    // Escucha el evento 'appinstalled' para ocultar el botón si la PWA ya está instalada
    window.addEventListener('appinstalled', () => {
        installAppButton.classList.add('d-none');
        console.log('PWA instalada. Ocultando botón de instalación.');
    });

} else {
    // Este mensaje se mostrará si el script se carga en una página donde no existe el botón
    // con id="installAppButton" (por ejemplo, si no lo has puesto en esa página específica).
    console.log('El botón con id="installAppButton" no fue encontrado en esta página. La opción de instalación PWA no se mostrará.');
}