console.log("home.js loaded!");

function initSlick(slider) {
    if (!$(slider).hasClass('slick-initialized')) {
        $(slider).slick({
            autoplay: true,
            dots: true,
            slidesToShow: 5,
            slidesToScroll: 1
        });
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const defaultTab = 'tab-fol';
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.getElementById(defaultTab).classList.add('active');

    const defaultLink = document.querySelector(`.tab-button[href="#${defaultTab}"]`);
    if (defaultLink) {
        defaultLink.classList.add('active');
        const defaultImg = defaultLink.querySelector('img');
        if (defaultImg && defaultImg.dataset.active) {
            defaultImg.src = defaultImg.dataset.active;
        }
    }

    const initialSlider = document.querySelector(`#${defaultTab} .slider`);
    if (initialSlider) {
        initialSlider.classList.add('active'); 
        initSlick(initialSlider);
    }

    document.querySelectorAll('.tab-button').forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();

            history.pushState("", document.title, window.location.pathname + window.location.search);
    
            const targetSelector = tab.dataset.category;
            const targetContent = document.querySelector(targetSelector);
            console.log("Clicked tab:", targetSelector);
    
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));

            if (targetContent) targetContent.classList.add('active');

            document.querySelectorAll('.slider').forEach(sl => sl.classList.remove('active'));
    
            const slider = targetContent.querySelector('.slider');
            if (slider) {
                slider.classList.add('active');
                initSlick(slider);
            }

            document.querySelectorAll('.tab-button').forEach(link => {
                link.classList.remove('active');
                const img = link.querySelector('img');
                if (img && img.dataset.default) {
                    img.src = img.dataset.default;
                }
            });
    
            tab.classList.add('active');
            const activeImg = tab.querySelector('img');
            if (activeImg && activeImg.dataset.active) {
                activeImg.src = activeImg.dataset.active;
            }
        });
    });
});