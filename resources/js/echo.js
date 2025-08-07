import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

window.Echo.channel('dashboard')
    .listen('.AktivitasSiswaUpdated', (data) => {
        console.log('[Realtime Update]', data);
        const event = new CustomEvent('dashboardUpdated', { detail: data });
        window.dispatchEvent(event);
    });
