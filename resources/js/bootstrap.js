/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// window.axios = require('axios');

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

window.OnImageError = (event) => {
  const element = event.target;
  const emptyImagePlaceholder = document.createElement('div');
  emptyImagePlaceholder.textContent = 'Gambar tidak tersedia.';
  emptyImagePlaceholder.classList.add('flex', 'items-center', 'justify-center', 'text-sm', 'bg-gray-200', 'text-gray-400', 'py-20', 'rounded-lg');
  element.parentNode.appendChild(emptyImagePlaceholder);
};

window.notify = (detail) => {
  document.querySelector('#notify-wrapper')
    .dispatchEvent(new CustomEvent('add', { detail }));
};
