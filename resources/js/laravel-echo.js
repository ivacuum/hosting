import Echo from 'laravel-echo'

if (typeof Pusher !== 'undefined') {
  window.Echo = new Echo({
    key: window.AppOptions.pusherKey,
    wsHost: window.AppOptions.pusherWsHost,
    wsPort: window.AppOptions.pusherWsPort,
    wssPort: window.AppOptions.pusherWsPort,
    broadcaster: 'pusher',
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
  })
}
