// SeafarerJobs.com Frontend JS
// Hotjobs slider functionality
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.hotjobs-slider');
    const cards = document.querySelectorAll('.hotjob-card');
    const prevBtn = document.querySelector('.hotjobs-slider-prev');
    const nextBtn = document.querySelector('.hotjobs-slider-next');
    let currentIndex = 0;
    const visibleCards = () => {
        if (window.innerWidth <= 600) return 1;
        if (window.innerWidth <= 900) return 2;
        return 3;
    };
    function updateSlider() {
        const cardWidth = cards[0].offsetWidth + 24; // 24px gap
        slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }
    function showPrev() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    }
    function showNext() {
        if (currentIndex < cards.length - visibleCards()) {
            currentIndex++;
            updateSlider();
        }
    }
    prevBtn && prevBtn.addEventListener('click', showPrev);
    nextBtn && nextBtn.addEventListener('click', showNext);
    window.addEventListener('resize', function () {
        // Clamp currentIndex if window resized
        if (currentIndex > cards.length - visibleCards()) {
            currentIndex = Math.max(0, cards.length - visibleCards());
        }
        updateSlider();
    });
    updateSlider();
});

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainMenu = document.querySelector('.main-menu');
    if(menuToggle && mainMenu) {
        menuToggle.addEventListener('click', function() {
            mainMenu.classList.toggle('open');
            menuToggle.classList.toggle('open');
            // Toggle icon
            const icon = menuToggle.querySelector('i');
            if(mainMenu.classList.contains('open')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
});

