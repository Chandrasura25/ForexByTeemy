window.addEventListener('DOMContentLoaded', function() {
    var loader = document.getElementById('loader');
    var loaderBar = document.querySelector('.loader-bar');
  
    // Show the loader when the page starts loading
    loader.style.display = 'block';
  
    // Hide the loader when the page finishes loading
    window.addEventListener('load', function() {
      loader.style.display = 'none';
    });
  
    // Show the loader when navigating between pages
    window.addEventListener('beforeunload', function() {
      loader.style.display = 'block';
    });
  
    // Move the loader bar during page navigation
    document.addEventListener('readystatechange', function() {
      if (document.readyState === 'loading') {
        loaderBar.style.width = '50%'; // Adjust as needed
      } else if (document.readyState === 'interactive') {
        loaderBar.style.width = '75%'; // Adjust as needed
      }
    });
  });
  