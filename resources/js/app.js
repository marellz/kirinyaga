import "./bootstrap";
// Default theme
import "@splidejs/splide/css";

// or only core styles
import "@splidejs/splide/css/core";

import Alpine from "alpinejs";
import { Splide } from "@splidejs/splide";
import { createApp } from "vue";
import { components } from './src/components'

window.Alpine = Alpine;
window.Splide = Splide;

Alpine.start();

const app = createApp({});

components.forEach((component) => {
    app.component(component.name, component.component);
});

app.mount("#app");
