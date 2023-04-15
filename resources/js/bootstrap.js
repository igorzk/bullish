import _ from 'lodash';
window._ = _;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

import "bootstrap";

import { library, dom } from '@fortawesome/fontawesome-svg-core';
import {
    faFileContract,
    faCircleInfo,
    faCircleXmark,
    faUserCheck,
    faMagnifyingGlass,
    faKey,
    faDownload,
    faBan, } from '@fortawesome/free-solid-svg-icons';
import { faGitAlt } from '@fortawesome/free-brands-svg-icons';

library.add(
    faFileContract,
    faDownload,
    faGitAlt,
    faCircleInfo,
    faCircleXmark,
    faUserCheck,
    faMagnifyingGlass,
    faKey,
    faBan
);

dom.watch();
