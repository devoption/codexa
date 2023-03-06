import './bootstrap';

/**
 * Import Highlight.js
 *
 * @see https://highlightjs.org/
 *
 */

import hljs from 'highlight.js/lib/common';
import 'highlight.js/styles/nord.css';

hljs.highlightAll();

/**
 * Import Emoji.js
 *
 * @see https://github.com/iamcal/js-emoji
 *
 */

import EmojiConvertor from 'emoji-js';
var emoji = new EmojiConvertor();

emoji.replace_mode = 'unified';
emoji.allow_native = true;

var content = document.getElementById('main-content');
var emojis = [];

content.innerHTML.replace(/:\S+:/g, function (match) {
    emojis.push(match);
});

emojis.forEach(function (item) {
    content.innerHTML = content.innerHTML.replace(item, emoji.replace_colons(item));
});

Alpine.data('theme', () => ({
    isLight: false,
    isDark: false,
    isSystem: false,

    init() {
        this.setTheme();
    },

    theme: localStorage.theme,

    lightMode() {
        localStorage.theme = 'light';
        this.setTheme();
    },

    darkMode() {
        localStorage.theme = 'dark';
        this.setTheme();
    },

    systemMode() {
        localStorage.theme = 'system';
        this.setTheme();
    },

    setTheme() {
        if (! ('theme' in localStorage)) {
            localStorage.theme = 'system';
        }

        switch (localStorage.theme) {
            case 'system':
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                this.isLight = false;
                this.isDark = false;
                this.isSystem = true;
                break;

            case 'dark':
                document.documentElement.classList.add('dark');
                this.isLight = false;
                this.isDark = true;
                this.isSystem = false;
                break;

            case 'light':
                document.documentElement.classList.remove('dark');
                this.isLight = true;
                this.isDark = false;
                this.isSystem = false;
                break;
        }
    },

    toggle($class) {
        var elements = document.getElementsByClassName($class);

        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.toggle('hidden');
        }
    }
}));

Alpine.start();
