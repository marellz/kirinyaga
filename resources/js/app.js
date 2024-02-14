import "./bootstrap";
// Default theme
import "@splidejs/splide/css";

// or only core styles
import "@splidejs/splide/css/core";

import Alpine from "alpinejs";
import { Splide } from "@splidejs/splide";

window.Alpine = Alpine;
window.Splide = Splide;

Alpine.start();
