<?php
require_once("app.php");
include("header.php");
?>

<style>
     .account-menu .icon i {
          width: 47px;
          height: 45px;
          background-color: white;
          color: black;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 5px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          -ms-border-radius: 5px;
          -o-border-radius: 5px;
          cursor: pointer;
          font-size: 24px;
     }

     .header .main-menu li .sub-menu {
          position: absolute;

          top: 105%;
          left: -20px;
          z-index: 9999;
          background-color: black;
          padding: 10px 0;
          -webkit-box-shadow: 0px 18px 54px -8px rgb(0 0 0 / 15%);
          box-shadow: 0px 18px 54px -8px rgb(0 0 0 / 15%);
          border-radius: 5px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          -ms-border-radius: 5px;
          -o-border-radius: 5px;
          -webkit-transition: all 0.3s;
          -o-transition: all 0.3s;
          transition: all 0.3s;
          opacity: 0;
          visibility: hidden;
          border: 1px solid #e5e5e5;
     }
</style>
</header>
<!-- header-section end  -->
<!-- inner hero start -->
<section class="inner-hero bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/breadcrumb/63c7a2144362f1674027540.png">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <h2 class="page-title">Dashboard</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="pb-60 pt-60">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-md-12">
                         <?php
                         if ($balance == 0) :
                         ?>
                              <div class="alert border border--danger" role="alert">
                                   <div class="alert__icon d-flex align-items-center text--danger"><i class="fas fa-exclamation-triangle"></i></div>
                                   <p class="alert__message">
                                        <span class="fw-bold">Empty Balance</span><br>
                                        <small><i>Your balance is empty. Please make <a href="deposit.php" class="link-color">deposit</a> for your next investment.</i></small>
                                   </p>
                              </div>
                         <?php endif; ?>




                         <div class="alert border border--warning" role="alert">
                              <div class="alert__icon d-flex align-items-center text--warning"><i class="fas fa-user-lock"></i></div>
                              <p class="alert__message">
                                   <span class="fw-bold">2FA Authentication</span><br>
                                   <small><i>To keep safe your account, Please enable <a href="twofactor.php" class="link-color">2FA</a> security.</i>
                                        It will make secure your account and balance.</small>
                              </p>
                         </div>


                    </div>
               </div>
               <div class="row justify-content-center">
                    <div class="col-lg-12 mt-lg-0 mt-5">
                         <div class="row mb-none-30">
                              <div class="col-xl-4 col-sm-6 mb-30">
                                   <div class="d-widget d-flex justify-content-between gap-5">
                                        <div class="left-content">
                                             <span class="caption">Wallet Balance</span>
                                             <h4 class="currency-amount">$<?= $balance ?></h4>
                                        </div>
                                        <div class="icon ms-auto">
                                             <i class="las la-dollar-sign"></i>
                                        </div>
                                   </div><!-- d-widget-two end -->
                              </div>
                              <div class="col-xl-4 col-sm-6 mb-30">
                                   <div class="d-widget d-flex justify-content-between gap-5">
                                        <div class="left-content">
                                             <span class="caption">Interest Wallet Balance</span>
                                             <h4 class="currency-amount">
                                                  $ <?= $totalProfit ?></h4>
                                        </div>
                                        <div class="icon ms-auto">
                                             <i class="las la-wallet"></i>
                                        </div>
                                   </div><!-- d-widget-two end -->
                              </div>
                              <div class="col-xl-4 col-sm-6 mb-30">
                                   <div class="d-widget d-flex justify-content-between gap-5">
                                        <div class="left-content">
                                             <span class="caption">Total Invest</span>
                                             <h4 class="currency-amount">
                                                  <?= $numberOfInvestment ?>
                                             </h4>
                                        </div>
                                        <div class="icon ms-auto">
                                             <i class="las la-cubes "></i>
                                        </div>
                                   </div><!-- d-widget-two end -->
                              </div>
                              <div class="col-xl-4 col-sm-6 mb-30">
                                   <div class="d-widget d-flex justify-content-between gap-5">
                                        <div class="left-content">
                                             <span class="caption">Total Deposit</span>
                                             <h4 class="currency-amount">
                                                  $ <?= $totalDeposit ?>
                                             </h4>
                                        </div>
                                        <div class="icon ms-auto">
                                             <i class="las la-credit-card"></i>
                                        </div>
                                   </div><!-- d-widget-two end -->
                              </div>
                              <div class="col-xl-4 col-sm-6 mb-30">
                                   <div class="d-widget d-flex justify-content-between gap-5">
                                        <div class="left-content">
                                             <span class="caption">Total Withdraw</span>
                                             <h4 class="currency-amount">
                                                  $ <?= $totalWithdraws ?>
                                             </h4>
                                        </div>
                                        <div class="icon ms-auto">
                                             <i class="las la-cloud-download-alt"></i>
                                        </div>
                                   </div><!-- d-widget-two end -->
                              </div>
                              <div class="col-xl-4 col-sm-6 mb-30">
                                   <div class="d-widget d-flex justify-content-between gap-5">
                                        <div class="left-content">
                                             <span class="caption">Referral Earnings</span>
                                             <h4 class="currency-amount">
                                                  $ <?= $bonus ?>
                                             </h4>
                                        </div>
                                        <div class="icon ms-auto">
                                             <i class="las la-user-friends"></i>
                                        </div>
                                   </div><!-- d-widget-two end -->
                              </div>
                         </div><!-- row end -->
                         <div class="row mt-50">
                              <div class="col-lg-12">
                                   <div class="table-responsive--md">
                                        <table class="table style--two">
                                             <thead>
                                                  <tr>
                                                       <th>Amount</th>
                                                       <th>Payment mode</th>
                                                       <th>Status</th>
                                                       <th>Date Created</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $results = $db->SelectAll("SELECT * FROM deposit WHERE user_id = :userId", ['userId' => $user_Id]);
                                                  if ($results && count($results)) {
                                                       foreach ($results as $i => $result) {
                                                  ?>
                                                            <tr>
                                                                 <th style="color:white !important">$<?= $result['amount'] ?></th>
                                                                 <td><?= $result['payment_mode'] ?></td>
                                                                 <td><?= $result['status'] ?></td>
                                                                 <td><?= $result['date'] ?></td>
                                                            </tr>
                                                       <?php
                                                       }
                                                  } else {
                                                       ?>
                                                       <td colspan="5" class="text-center">
                                                            <span class="text-danger">No data found</span>
                                                       </td>
                                                  <?php
                                                  };
                                                  ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div><!-- row end -->
                    </div>
               </div>
          </div>
     </div>
</div>
<?php
require('footer.php');
