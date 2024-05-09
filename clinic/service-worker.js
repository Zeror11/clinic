const CACHE_NAME = 'dental-clinic-cache-v1';
const urlsToCache = [
  '/',
  '/main_page.css',
  '/Orthodontics.html',
  '/Tooth colored.html',
  '/Tooth Extraction.html',
  '/Dentures.html',
  '/Oral Prophylaxis.html',
  '/index.html',
  '/Admin.html',
  '/logo.ico',
  '/favicon.ico',
  '/lisa.ico',
  '/main_page.html',
  '/contact.html',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});
