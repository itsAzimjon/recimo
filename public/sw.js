self.addEventListener('push', (event) => {
  const notification = event.data.json();

  event.waitUntil(
      self.registration.showNotification(notification.title, {
          body: notification.body,
          data: {
              notifUrl: notification.url
          }
      })
  );
});

self.addEventListener('notificationclick', (event) => {
  event.waitUntil(
      clients.openWindow(event.notification.data.notifUrl)
  );
});

