document.addEventListener('DOMContentLoaded', () => { const input = 
  document.getElementById('busquedaVacuna'); const sugerencias = 
  document.getElementById('sugerencias'); const form = 
  document.getElementById('formBuscador');

  if (!input || !sugerencias || !form) return;

  let listaVacunas = [];

  // ✅ Cargar lista desde PHP con fetch
  fetch('/controllers/getVacunas.php')
    .then(res => res.json())
    .then(data => {
      listaVacunas = data;
      configurarBuscador();
    })
    .catch(error => console.error('Error cargando vacunas:', error));

  function configurarBuscador() {
    input.addEventListener('input', () => {
      const texto = input.value.toLowerCase().trim();
      sugerencias.innerHTML = '';
      sugerencias.classList.add('d-none');

      if (!texto) return;

      const coincidencias = listaVacunas.filter(nombre =>
        nombre.toLowerCase().includes(texto)
      );

      if (coincidencias.length === 0) {
        const li = document.createElement('li');
        li.textContent = 'No se encontraron vacunas';
        li.classList.add('list-group-item', 'text-muted');
        sugerencias.appendChild(li);
        sugerencias.classList.remove('d-none');
        return;
      }

      coincidencias.forEach(nombre => {
        const li = document.createElement('li');
        li.textContent = nombre;
        li.classList.add('list-group-item');
        li.addEventListener('click', () => {
          input.value = nombre;
          sugerencias.innerHTML = '';
          sugerencias.classList.add('d-none');
          form.submit();
        });
        sugerencias.appendChild(li);
      });

      sugerencias.classList.remove('d-none');
    });

    // Oculta sugerencias al hacer clic fuera
    document.addEventListener('click', (e) => {
      if (!e.target.closest('#formBuscador')) {
        sugerencias.innerHTML = '';
        sugerencias.classList.add('d-none');
      }
    });
  }
});
