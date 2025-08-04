

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


