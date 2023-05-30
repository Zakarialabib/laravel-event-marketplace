import './bootstrap';
import '../css/app.css'; 
import '../css/select.css'; 
import "perfect-scrollbar/css/perfect-scrollbar.css";

// import {livewire_hot_reload} from 'virtual:livewire-hot-reload'
// livewire_hot_reload();

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from "@alpinejs/focus";
import intersect from "@alpinejs/intersect";
import Sortable from 'sortablejs';

window.Sortable = Sortable;

import 'quill/dist/quill.snow.css';
import Quill from "quill";
window.Quill = Quill;

Alpine.plugin(focus);
Alpine.plugin(intersect);

import PerfectScrollbar from "perfect-scrollbar";
window.PerfectScrollbar = PerfectScrollbar;

Alpine.data("mainState", () => {
    let lastScrollTop = 0;

    const init = function () {
        window.addEventListener("scroll", () => {
            let st = window.pageYOffset || document.documentElement.scrollTop;
            if (st > lastScrollTop) {
                // downscroll
                this.scrollingDown = true;
                this.scrollingUp = false;
            } else {
                // upscroll
                this.scrollingDown = false;
                this.scrollingUp = true;
                if (st == 0) {
                    // reset
                    this.scrollingDown = false;
                    this.scrollingUp = false;
                }
            }
            lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
        });
    };

    const loadingMask = {
        pageLoaded: false,
        init() {
            window.onload = (event) => {
                this.pageLoaded = true;
            };
        },
    };

    const getTheme = () => {
        if (window.localStorage.getItem("dark")) {
            return JSON.parse(window.localStorage.getItem("dark"));
        }
        return (
            !!window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        );
    };

    const setTheme = (value) => {
        window.localStorage.setItem("dark", value);
    };

    const enableTheme = (value) => {
        document.body.dir = value ? "rtl" : "ltr";
    };

    return {
        init,
        loadingMask,
        isDarkMode: getTheme(),
        toggleTheme() {
            this.isDarkMode = !this.isDarkMode;
            setTheme(this.isDarkMode);
        },
        isSidebarOpen: sessionStorage.getItem("sidebarOpen") === "true",
        handleSidebarToggle() {
            this.isSidebarOpen = !this.isSidebarOpen;
            sessionStorage.setItem("sidebarOpen", this.isSidebarOpen.toString());
        },
        isSidebarHovered: false,
        handleSidebarHover(value) {
            if (window.innerWidth < 1024) {
                return;
            }
            this.isSidebarHovered = value;
        },
        handleWindowResize() {
            if (window.innerWidth <= 1024) {
                this.isSidebarOpen = false;
            } else {
                this.isSidebarOpen = true;
            }
        },
        scrollingDown: false,
        scrollingUp: false,
    };
});

Alpine.plugin(collapse)

window.Alpine = Alpine;

Alpine.start();