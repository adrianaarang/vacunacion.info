    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/TFG/sw.js', { scope: '/TFG/' })
                .then(registration => {
                    console.log('Service Worker registrado con éxito:', registration.scope);
                })
                .catch(error => {
                    console.error('Fallo en el registro del Service Worker:', error);
                });
        });
    }