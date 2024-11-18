
 if ('serviceWorker' in navigator) {
   window.addEventListener('load', () => {
     navigator.serviceWorker.register('service-worker.js')
       .then(registration => {
         console.log('Le service Worker est enregistré', registration);
       })
       .catch(error => {
         console.error('Echec enregistrement sevice worker:', error);
       });
   });
 }