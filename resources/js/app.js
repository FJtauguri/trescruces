import './bootstrap';
import Alpine from 'alpinejs';
// import Echo from 'laravel-echo';

window.Alpine = Alpine;
Alpine.start();

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true,
// });

// window.Echo.channel('database-updates')
//     .listen('.Monitoring', (data) => {
//         console.log(data.message);
//     })
