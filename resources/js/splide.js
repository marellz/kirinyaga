import { Splide } from '@splidejs/splide'

new Splide(".splide.product-images", {
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
}).mount();