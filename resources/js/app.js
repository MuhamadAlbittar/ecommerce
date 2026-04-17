import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

// تأكد من وجود المتغيرات البيئية
const pusherKey = import.meta.env.VITE_PUSHER_APP_KEY;
const pusherHost = import.meta.env.VITE_PUSHER_HOST;
const pusherPort = import.meta.env.VITE_PUSHER_PORT;
const pusherScheme = import.meta.env.VITE_PUSHER_SCHEME;

console.log('🔧 Echo Config:', {
    key: pusherKey ? '✅ exists' : '❌ missing',
    host: pusherHost,
    port: pusherPort,
    scheme: pusherScheme
});

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: pusherKey,
    wsHost: pusherHost,
    wsPort: pusherPort,
    wssPort: pusherPort,
    forceTLS: pusherScheme === 'https',
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});

// انتظر حتى يتم تهيئة Echo قبل استخدامه
document.addEventListener('DOMContentLoaded', () => {
    // تأكد من أن Echo جاهز
    if (!window.Echo) {
        console.error('❌ Echo not initialized');
        return;
    }

    const userId = document.querySelector('meta[name="user-id"]')?.getAttribute('content');

    if (!userId) {
        console.error('❌ User ID not found');
        return;
    }

    console.log('✅ Echo initialized, connecting to channel: users.' + userId);

    const channel = window.Echo.private(`users.${userId}`);

    channel
        .subscribed(() => {
            console.log('✅ Subscribed to users.' + userId);
        })
        .error((error) => {
            console.error('❌ Subscription error:', error);
        })
        .listen('category.approved', (data) => {
            console.log('🎉 Notification received:', data);
            // عرض الإشعار
        });
});
