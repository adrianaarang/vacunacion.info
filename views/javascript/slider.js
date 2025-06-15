document.addEventListener("DOMContentLoaded", function () {
  const verticalSlider = document.querySelector('#carouselVertical');

  if (verticalSlider) {
    const instance = new bootstrap.Carousel(verticalSlider, {
      interval: 3000,   // Cambiar slide cada 3 segundos
      ride: 'carousel', // Comenzar automáticamente
      pause: 'hover'    // Pausar si el mouse pasa por encima
    });
  }
});
