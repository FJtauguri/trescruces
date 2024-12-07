import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.PUSHER_APP_KEY,  // Make sure this is set correctly
    cluster: window.PUSHER_APP_CLUSTER, // Correct cluster value
    encrypted: true,
});


echo.channel('notifications.' + userId) // Dynamically set user ID
    .listen('NotificationUpdated', (event) => {
        // Listen to the broadcasted event and update the unread count
        document.getElementById('notification-badge').innerText = event.unreadCount;
    });
