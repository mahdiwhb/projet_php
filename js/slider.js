document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
  
    setInterval(() => {
      // Retire la classe "active" de la slide courante
      slides[currentSlide].classList.remove('active');
      // Passe à la slide suivante (ou revient à la première)
      currentSlide = (currentSlide + 1) % slides.length;
      // Ajoute la classe "active" à la nouvelle slide
      slides[currentSlide].classList.add('active');
    }, 5000); // 5000 ms = 5 secondes entre chaque transition
  });
  