document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('formPencarian').addEventListener('submit', function (e) {
      e.preventDefault();
      pencarian();
    });
  
    function pencarian() {
      var kataKunci = document.getElementById('kataKunci').value.toLowerCase();
      var menuItems = document.querySelectorAll('#menu li a');
      var found = false;
  
      menuItems.forEach(function (menuItem) {
        var itemText = menuItem.textContent.toLowerCase();
        if (itemText.indexOf(kataKunci) > -1) {
          // Redirect to the appropriate page if a match is found
          window.location.href = menuItem.href;
          found = true;
        }
      });
  
      if (!found) {
        alert('Menu tidak ditemukan.');
      }
    }
  });
  