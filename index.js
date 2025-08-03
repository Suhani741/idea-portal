// index.js

// Carousel Functionality
const track = document.querySelector('.carousel-track');
const slides = Array.from(track.children);
const nextButton = document.querySelector('.carousel-btn.right');
const prevButton = document.querySelector('.carousel-btn.left');

let currentIndex = 1;
const slideCount = slides.length;
const slideWidth = slides[0].getBoundingClientRect().width;

track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

function updateCarousel() {
    track.style.transition = 'transform 0.5s ease-in-out';
    track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

function moveToNextSlide() {
    currentIndex++;
    updateCarousel();
    if (currentIndex === slideCount - 1) {
        setTimeout(() => {
            track.style.transition = 'none';
            currentIndex = 1;
            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }, 500);
    }
}

function moveToPrevSlide() {
    currentIndex--;
    updateCarousel();
    if (currentIndex === 0) {
        setTimeout(() => {
            track.style.transition = 'none';
            currentIndex = slideCount - 2;
            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }, 500);
    }
}

nextButton.addEventListener('click', () => {
    clearInterval(autoSlide);
    moveToNextSlide();
    autoSlide = setInterval(moveToNextSlide, 3000);
});

prevButton.addEventListener('click', () => {
    clearInterval(autoSlide);
    moveToPrevSlide();
    autoSlide = setInterval(moveToNextSlide, 3000);
});

let autoSlide = setInterval(moveToNextSlide, 3000);

window.addEventListener('resize', () => {
    track.style.transition = 'none';
    const newSlideWidth = slides[0].getBoundingClientRect().width;
    track.style.transform = `translateX(-${currentIndex * newSlideWidth}px)`;
});

function toggleAnswer(questionElement) {
    const answer = questionElement.nextElementSibling;
    const arrow = questionElement.querySelector('.arrow');

    if (answer.style.display === "block") {
        answer.style.display = "none";
        arrow.classList.remove('open');
    } else {
        answer.style.display = "block";
        arrow.classList.add('open');
    }
}

function scrollToSection(id) {
    const section = document.getElementById(id);
    section.scrollIntoView({ behavior: 'smooth' });
}

