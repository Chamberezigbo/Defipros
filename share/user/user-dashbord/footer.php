<!-- JavaScript files-->
<!-- Page Footer-->
<footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs" id="footer">
     <div class="container-fluid">
          <div class="row gy-2">
               <div class="col-sm-6 text-sm-start">
                    <p class="mb-0">DEFI Pros &copy;<?php echo date("Y"); ?></p>
               </div>
          </div>
     </div>
</footer>

<!-- Place this script before the </head> tag -->
<script src="https://unpkg.com/octavalidate@latest/native/validate.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/just-validate/js/just-validate.min.js"></script>
<script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="js/charts-home.js"></script>
<!-- Main File-->
<script src="js/front.js"></script>
<script src="../../../wp-content/process/toastr-master/build/toastr.min.js"></script>

<!-- google translator -->
<script type="text/javascript">
     function googleTranslateElementInit() {
          new google.translate.TranslateElement({
               pageLanguage: 'en'
          }, 'google_translate_element');
     }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- end of translator -->








<script>
     // ------------------------------------------------------- //
     //   Inject SVG Sprite - 
     //   see more here 
     //   https://css-tricks.com/ajaxing-svg-sprite/
     // ------------------------------------------------------ //
     function injectSvgSprite(path) {

          var ajax = new XMLHttpRequest();
          ajax.open("GET", path, true);
          ajax.send();
          ajax.onload = function(e) {
               var div = document.createElement("div");
               div.className = 'd-none';
               div.innerHTML = ajax.responseText;
               document.body.insertBefore(div, document.body.childNodes[0]);
          }
     }

     function myFunction() {
          // Get the text field
          var copyText = document.getElementById("myInput");

          // Select the text field
          copyText.select();
          copyText.setSelectionRange(0, 99999); // For mobile devices

          // Copy the text inside the text field
          navigator.clipboard.writeText(copyText.value);

          // // Alert the copied text
          // alert("Copied the text: " + copyText.value);
     }
     // this is set to BootstrapTemple website as you cannot 
     // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
     // while using file:// protocol
     // pls don't forget to change to your domain :)
     injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
</script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/678ed16258.js" crossorigin="anonymous"></script>
</body>

</html>