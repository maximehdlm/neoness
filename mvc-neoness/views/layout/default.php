

<html>

  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="../style.css" type="text/css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
      
  </head>
<body>
<header>

	<div class="overlay">
  <h1>NEONESS</h1>
<h3>Salle de sport</h3>

	<br>
	
		</div>
</header>
    
<main>
    <?= $content ?>
</main>
<footer>

<div class="footer">
  <div id="button"></div>
<div id="container">
<div id="cont">
<div class="footer_center">
	   <h3>neoness © 04.00.00.00.00</h3>
     <h2></h2>
</div>
</div>
</div>
</div>
  
</footer>
</body>
</html>

<!-- Script de validation Bootstrap -->
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>