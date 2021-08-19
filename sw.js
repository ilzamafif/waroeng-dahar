var CACHE_NAME = "waroeng-dahar-cache-v1";
var urlsToCache = [
  "./waroeng_dahar/index.php/frontend/styles/style.css",
  "./waroeng_dahar/index.php/frontend/scripts/main.js",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-72x72.png",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-96x96.png",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-128x128.png",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-144x144.png",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-152x152.png",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-192x192.png",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-384x384.png",
  "./waroeng_dahar/index.php/frontend/images/icons/icon-512x512.png",
  "./waroeng_dahar/index.php/frontend/images/favicon/favicon.png",
  "./waroeng_dahar/index.php/frontend/images/hero/hero.jpg",
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(function (cache) {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener("fetch", function (event) {
  event.respondWith(
    caches.match(event.request).then(function (response) {
      // Cache hit - return response
      if (response) {
        return response;
      }
      return fetch(event.request);
    })
  );
});

self.addEventListener("activate", function (event) {
  event.waitUntil(
    caches.keys().then(function (cacheNames) {
      return Promise.all(
        cacheNames
          .filter(function (cacheName) {
            return cacheName != CACHE_NAME;
          })
          .map(function (cacheName) {
            return cache.delete(cacheName);
          })
      );
    })
  );
});
