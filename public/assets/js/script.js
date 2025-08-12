

/* -------------------menu----------------------- */
const menu = document.querySelector(".menu");
const openMenuBtn = document.querySelector(".open-menu-btn");
const closeMenuBtn = document.querySelector(".close-menu-btn");

[openMenuBtn, closeMenuBtn].forEach((btn)=>{
    btn.addEventListener("click",()=>{
        menu.classList.toggle("open");
        menu.style.transition ="transform 0.5s ease"
    });
});

menu.addEventListener("transitionend",function(){
    this.removeAttribute("style");
});

menu.querySelectorAll(".dropdown > i").forEach((arrow) =>{
    arrow.addEventListener("click",function(){
        this.closest(".dropdown").classList.toggle("active");
    });
});

/* -------------------TESTIMONIALS----------------------- */

const swiperTestimonial = new Swiper('.testimonial-swiper', {
  loop: true,
  watchSlidesProgress: true,
  SlidesPerview:3,
  centeredSlides:'auto',
  spaceBetween:16,
  grabCursor:true,
  speed:600,
  effect:'coverflow',
  coverflowEffect:{
    rotate: -90,
    depth:600,
    modifier: .5,
    slideShadows:false,
  },

  pagination: {
    el: '.swiper-pagination',
    clickable:true,
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay:{
    delay:3000,
    disableOnInteraction:false,
  }
});

/* -------------------SHOP Books----------------------- */
document.addEventListener('DOMContentLoaded', function() {
    const allBooks = Array.from(document.querySelectorAll('#all-books .book-card'));
    const wrapper = document.querySelector('.books-swiper .swiper-wrapper');

    // Group books into batches of 15 per slide
    for (let i = 0; i < allBooks.length; i += 15) {
        const slide = document.createElement('div');
        slide.className = 'swiper-slide books-slide-grid';

        // Container inside slide to hold the grid
        const gridContainer = document.createElement('div');
        gridContainer.className = 'books-grid';

        allBooks.slice(i, i + 15).forEach(book => {
            gridContainer.appendChild(book);
        });

        slide.appendChild(gridContainer);
        wrapper.appendChild(slide);
    }

    // Initialize Swiper
    var swiper = new Swiper('.books-swiper', {
    slidesPerView: 1, // One "grid" slide at a time
    grid: {
        rows: 1 // One grid per slide, but each slide contains 15 books via Blade chunk
    },
    spaceBetween: 20,
    navigation: {
        nextEl: '.books-swiper-button-next',
        prevEl: '.books-swiper-button-prev',
    },
    pagination: {
        el: '.books-swiper-pagination',
        clickable: true,
    },
});

});


document.querySelectorAll('.sub-menu a').forEach(link => {
    link.addEventListener('mouseenter', () => {
        document.body.classList.add('blur-active');
    });
    link.addEventListener('mouseleave', () => {
        document.body.classList.remove('blur-active');
    });
});
