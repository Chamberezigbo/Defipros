<?php
require "header.php"
?>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Crypto Exchange</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Crypto Exchange</li>
                    </ol>
               </nav>
          </div>
     </div>
     <!-- Forms Section-->
     <section class="forms">
          <div class="container-fluid">
               <div class="row">
                    <!-- Basic Form-->
                    <div class="col-lg-12">

                         <script src="https://crypto.com/price/static/widget/index.js"></script>
                         <div id="crypto-widget-CoinBlocks" data-design="modern" data-coin-ids="1,166,136,29,20"></div>
                    </div>
                    <!-- Inline Form-->
                    <div class="col-lg-8">
                         <!-- TradingView Widget BEGIN -->
                         <div class="tradingview-widget-container">
                              <div id="tradingview_781cc"></div>
                              <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text">AAPL Chart</span></a> by TradingView</div>
                              <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                              <script type="text/javascript">
                                   new TradingView.widget({
                                        "autosize": true,
                                        "symbol": "NASDAQ:AAPL",
                                        "interval": "D",
                                        "timezone": "Etc/UTC",
                                        "theme": "light",
                                        "style": "1",
                                        "locale": "en",
                                        "toolbar_bg": "#f1f3f6",
                                        "enable_publishing": false,
                                        "allow_symbol_change": true,
                                        "container_id": "tradingview_781cc"
                                   });
                              </script>
                              <style>
                                   #tradingview_781cc {
                                        height: 60vh;
                                   }
                              </style>
                         </div>
                         <!-- TradingView Widget END -->
                    </div>
                    <div class="col-lg-4">
                         <script src="https://cdn.jsdelivr.net/gh/coinponent/coinponent@1.2.6/dist/coinponent.js"></script>

                         <coin-ponent units="0"></coin-ponent>
                    </div>
               </div>
          </div>
</div>
</section>
</div>
</div>
</div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/just-validate/js/just-validate.min.js"></script>
<script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="js/charts-home.js"></script>
<!-- Main File-->
<script src="js/front.js"></script>
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