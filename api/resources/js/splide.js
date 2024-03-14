import { Splide } from "@splidejs/splide";
const sliders = [
    {
        el: ".splide.product-images",
        options: {
            type: "loop",
            perPage: 3,
            padding: {
                left: "2rem",
                right: "2rem",
            },
            breakpoints: {
                640: {
                    type: "loop",
                    perPage: 1,
                    padding: 30,
                },
                768: {
                    type: "loop",
                    perPage: 2,
                    padding: 30,
                },
            },
        },
    },
    {
        el: ".splide.home-slider",
        options: {
            type: "loop",
            autoWidth: true,
            arrows:false,
            pagination: false,
        },
    },
];

const splides = [];

sliders.forEach((slider) => {
    if (document.querySelectorAll(slider.el).length) {
        const instance = new Splide(slider.el, slider.options);
        splides.push(instance);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    splides.forEach((element) => {
        element.mount();
    });
});
