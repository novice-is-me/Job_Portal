import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import PrimeVue from "primevue/config";
import Aura from "@primeuix/themes/aura";
import "primeicons/primeicons.css";
import "@fortawesome/fontawesome-free/css/all.css";
import { definePreset } from "@primeuix/themes";
import { ConfirmationService, Toast, ToastService } from "primevue";
// If we want to use PrimeVue components
// import { Toast, ConfirmDialog } from "primevue";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            100: "#cfe2ff", // Lightest Blue
            200: "#9ec5fe",
            300: "#6ea8fe",
            400: "#3d8bfd",
            500: "#0d6efd", // Base Color
            600: "#0b5ed7",
            700: "#0a58ca",
            800: "#094bba",
            900: "#083d9b", // Darkest Blue
        },
    },
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: MyPreset,
                    options: {
                        darkModeSelector: false || "none",
                    },
                },
            })
            .use(ToastService)
            .use(ConfirmationService)
            .component("Toast", Toast)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
