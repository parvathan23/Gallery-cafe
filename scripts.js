document.addEventListener('DOMContentLoaded', function() {
  function updateIframeSrc(src) {
    console.log(`Updating iframe source to: ${src}`); // Debug line
    document.getElementById('adminFrame').src = src;
  }

  document.getElementById('preorder-link').addEventListener('click', function(event) {
    event.preventDefault();
    updateIframeSrc('preorder.php');
  });

  document.getElementById('tablebooking-link').addEventListener('click', function(event) {
    event.preventDefault();
    updateIframeSrc('tablebooking.php');
  });

  document.getElementById('staffadd-link').addEventListener('click', function(event) {
    event.preventDefault();
    updateIframeSrc('staadd.html');
  });

  document.getElementById('staffview-link').addEventListener('click', function(event) {
    event.preventDefault();
    updateIframeSrc('staffview.php');
  });

  document.getElementById('staffdelete-link').addEventListener('click', function(event) {
    event.preventDefault();
    updateIframeSrc('staffdelete.php');
  });

  document.querySelector('.logout').addEventListener('click', function(event) {
    event.preventDefault();
    // Perform logout logic here
  });
});
