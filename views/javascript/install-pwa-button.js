let deferredPrompt;

const installBtn = document.getElementById('installAppButton');


window.addEventListener('beforeinstallprompt', (e) => {

  e.preventDefault();

  deferredPrompt = e;

  installBtn.classList.remove('d-none');


  installBtn.addEventListener('click', () => {

    installBtn.classList.add('d-none');

    deferredPrompt.prompt();

    deferredPrompt.userChoice.then(() => {

      deferredPrompt = null;

    });

  });

});

