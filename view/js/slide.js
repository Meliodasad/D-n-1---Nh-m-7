let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function nextSlide() {
    slides[currentIndex].classList.remove('slide-active');
    currentIndex = (currentIndex + 1) % totalSlides;
    slides[currentIndex].classList.add('slide-active');
}

function startSlideShow() {
    slides[currentIndex].classList.add('slide-active'); 
    setInterval(nextSlide, 3000);
}

document.addEventListener('DOMContentLoaded', startSlideShow);
