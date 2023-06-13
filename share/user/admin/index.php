<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require('../../../wp-content/process/pdo.php');
error_reporting(0);
$image = "../admin-dashboard/" . $_SESSION['image'];
if (!$_SESSION['auth']) {
     header('location:../index.php');
     die();
} else {
     $currentTime = time();
     if ($currentTime > $_SESSION['expire']) {
          session_unset();
          session_destroy();
          header('location:../index.php');
          die();
     } else {
          require('header.php');
?>
          <div class="content-inner w-100">
               <!-- Page Header-->
               <header class="bg-white shadow-sm px-4 py-3 z-index-20">
                    <div class="container-fluid px-0">
                         <h2 class="mb-0 p-1">Dashboard</h2>
                    </div>
               </header>
               <!-- Dashboard Counts Section-->
               <section class="pb-0">
                    <div class="container-fluid">
                         <div class="card mb-0">
                              <div class="card-body">
                                   <div class="row gx-5 bg-white">
                                        <!-- Item -->
                                        <div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-violet">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                                                            <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z" />
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                                       </svg>
                                                  </div>
                                                  <div class="mx-3">
                                                       <h6 class="h4 fw-light text-gray-600 mb-3">Account Balance</h6>
                                                  </div>
                                                  <div class="number"><strong class="text-lg">$0</strong></div>
                                             </div>
                                        </div>
                                        <!-- Item -->
                                        <div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-red">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                       </svg>
                                                  </div>
                                                  <div class="mx-3">
                                                       <h6 class="h4 fw-light text-gray-600 mb-3">Total <br> Balance</h6>
                                                  </div>
                                                  <div class="number"><strong class="text-lg">$0</strong></div>
                                             </div>
                                        </div>
                                        <!-- Item -->
                                        <div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-green">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gift-fill" viewBox="0 0 16 16">
                                                            <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zm6 4v7.5a1.5 1.5 0 0 1-1.5 1.5H9V7h6zM2.5 16A1.5 1.5 0 0 1 1 14.5V7h6v9H2.5z" />
                                                       </svg>
                                                  </div>
                                                  <div class="mx-3">
                                                       <h6 class="h4 fw-light text-gray-600 mb-3">Total <br>Bonus</h6>
                                                  </div>
                                                  <div class="number"><strong class="text-lg">$0</strong></div>
                                             </div>
                                        </div>
                                        <!-- Item -->
                                        <div class="col-xl-3 col-sm-6 py-4">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-orange">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                                                            <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z" />
                                                       </svg>
                                                  </div>
                                                  <div class="mx-3">
                                                       <h6 class="h4 fw-light text-gray-600 mb-3">Total <br> Referral Bonus</h6>
                                                  </div>
                                                  <div class="number"><strong class="text-lg">$0</strong></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </section>
               <!-- Dashboard Header Section    -->
               <section class="pb-0">
                    <div class="container-fluid">
                         <div class="row align-items-stretch">
                              <!-- Statistics -->
                              <div class="col-lg-3 col-12">
                                   <div class="card mb-3">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-red"><i class="fas fa-tasks"></i></div>
                                                  <div class="ms-3"><strong class="text-lg d-block lh-1 mb-1">$0</strong><small class="text-uppercase text-gray-500 small d-block lh-1">Total Investment Plans</small></div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card mb-3">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-green">
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                                                            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                                                       </svg>
                                                  </div>
                                                  <div class="ms-3"><strong class="text-lg d-block lh-1 mb-1">$ 0</strong><small class="text-uppercase text-gray-500 small d-block lh-1">Total Active Investment Plans</small></div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card mb-0">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-orange"><i class="fa-solid fa-money-bill-transfer"></i></div>
                                                  <div class="ms-3"><strong class="text-lg d-block lh-1 mb-1">$12</strong><small class="text-uppercase text-gray-500 small d-block lh-1">Total Deposit</small></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!-- Line Chart            -->
                              <div class="col-lg-6 col-12">
                                   <div class="card mb-0 h-100">
                                        <!-- TradingView Widget BEGIN -->
                                        <div class="tradingview-widget-container">
                                             <div class="tradingview-widget-container__widget"></div>
                                             <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/indices/" rel="noopener" target="_blank"><span class="blue-text">Indices</span></a> <span class="blue-text">and</span> <a href="https://www.tradingview.com/markets/futures/" rel="noopener" target="_blank"><span class="blue-text">Futures</span></a> by TradingView</div>
                                             <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-quotes.js" async>
                                                  {
                                                       "width": "100%",
                                                       "height": "100%",
                                                       "symbolsGroups": [{
                                                                 "name": "Indices",
                                                                 "originalName": "Indices",
                                                                 "symbols": [{
                                                                           "name": "BITSTAMP:BTCUSD"
                                                                      },
                                                                      {
                                                                           "name": "BINANCE:ETHUSDT"
                                                                      },
                                                                      {
                                                                           "name": "BINANCE:BNBUSDT"
                                                                      },
                                                                      {
                                                                           "name": "BINANCE:LTCUSDT"
                                                                      },
                                                                      {
                                                                           "name": "BITSTAMP:ETHUSD"
                                                                      }
                                                                 ]
                                                            },
                                                            {
                                                                 "name": "Futures",
                                                                 "originalName": "Futures",
                                                                 "symbols": [{
                                                                           "name": "CME_MINI:ES1!",
                                                                           "displayName": "S&P 500"
                                                                      },
                                                                      {
                                                                           "name": "CME:6E1!",
                                                                           "displayName": "Euro"
                                                                      },
                                                                      {
                                                                           "name": "COMEX:GC1!",
                                                                           "displayName": "Gold"
                                                                      },
                                                                      {
                                                                           "name": "NYMEX:CL1!",
                                                                           "displayName": "Crude Oil"
                                                                      },
                                                                      {
                                                                           "name": "NYMEX:NG1!",
                                                                           "displayName": "Natural Gas"
                                                                      },
                                                                      {
                                                                           "name": "CBOT:ZC1!",
                                                                           "displayName": "Corn"
                                                                      }
                                                                 ]
                                                            }
                                                       ],
                                                       "showSymbolLogo": true,
                                                       "colorTheme": "light",
                                                       "isTransparent": true,
                                                       "locale": "en"
                                                  }
                                             </script>
                                        </div>
                                        <!-- TradingView Widget END -->
                                   </div>
                              </div>
                              <div class="col-lg-3 col-12">
                                   <!-- Numbers-->
                                   <div class="card mb-0">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div class="icon flex-shrink-0 bg-green"><i class="fas fa-chart-area"></i></div>
                                                  <div class="ms-3"><strong class="text-lg mb-0 d-block lh-1">$ <?= $totalWithdraws ?></strong><small class="text-gray-500 small text-uppercase">Total Withdrawals</small></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </section>
               <!-- Client Section-->
               <section class="pb-0">
                    <div class="container-fluid">
                         <div class="row gy-4">
                              <!-- Total Overdue             -->
                              <div class="col-lg-12">
                                   <!-- TradingView Widget BEGIN -->
                                   <div class="tradingview-widget-container">
                                        <div id="tradingview_9f058"></div>
                                        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/BTCUSD/?exchange=BITSTAMP" rel="noopener" target="_blank"><span class="blue-text">BTCUSD Chart</span></a> by TradingView</div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                        <script type="text/javascript">
                                             new TradingView.widget({
                                                  "autosize": true,
                                                  "symbol": "BITSTAMP:BTCUSD",
                                                  "interval": "D",
                                                  "timezone": "Etc/UTC",
                                                  "theme": "light",
                                                  "style": "1",
                                                  "locale": "en",
                                                  "toolbar_bg": "#f1f3f6",
                                                  "enable_publishing": false,
                                                  "allow_symbol_change": true,
                                                  "studies": [
                                                       "BB@tv-basicstudies"
                                                  ],
                                                  "container_id": "tradingview_9f058"
                                             });
                                        </script>
                                        <style>
                                             #tradingview_9f058 {
                                                  height: 60vh;
                                             }
                                        </style>
                                   </div>
                                   <!-- TradingView Widget END -->
                              </div>
                         </div>
                    </div>
               </section>
               <?php
               require_once './footer.php';
               ?>
          </div>
          </div>
          </div>


<?php
     }
}
?>