<?php
require_once('app.php');
$user_Id = $_SESSION['user_id'];
try {
     $investments = $db->SelectAll(
          "SELECT * FROM investments INNER JOIN package ON package.id = investments.package_id WHERE investments.user_id = :uid",
          [
               'uid' =>
               $user_Id
          ]
     );
} catch (Exception $e) {
     error_log($e);
     $_SESSION['success'] = false;
     $_SESSION['msg'] = "A server error has occured";
     header("Location: ./index.php");
     exit();
}
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
                    <h2 class="page-title">Invest Statistics</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <script>
          "use strict"

          function createCountDown(elementId, sec) {
               var tms = sec;
               var x = setInterval(function() {
                    var distance = tms * 1000;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById(elementId).innerHTML = days + "d: " + hours + "h " + minutes + "m " + seconds + "s ";
                    if (distance < 0) {
                         clearInterval(x);
                         document.getElementById(elementId).innerHTML = "COMPLETE";
                    }
                    tms--;
               }, 1000);
          }
     </script>

     <section class="pb-60 pt-60">

          <div class="container">

               <div class="row gy-4 mb-4">
                    <div class="col-md-5">
                         <div class="card h-100">
                              <div class="card-body">
                                   <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div>
                                             <p class="mb-2 fw-bold">Total Invest</p>
                                             <h4 class="text--base"><sup class="top-0 fw-light me-1">$</sup>0.00</h4>
                                        </div>
                                        <div>
                                             <p class="mb-2 fw-bold">Total Profit</p>
                                             <h4 class="text--base"><sup class="top-0 fw-light me-1">$</sup>0.00</h4>
                                        </div>
                                   </div>
                                   <div class="d-flex flex-wrap justify-content-between mt-3 mt-sm-4 gap-2">
                                        <a href="plan.php" class="btn btn--sm btn--base">Invest Now <i class="las la-arrow-right fs--12px ms-1"></i></a>
                                        <a href="withdraw.php" class="btn btn--sm btn--base">Withdraw Now <i class="las la-arrow-right fs--12px ms-1"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-7">
                         <div class="card h-100">
                              <?php if (isset($investments) && count($investments)) { ?>
                                   <h3 class="text-center" style="color:green !important">You Have An Investment</h3>
                              <?php } else { ?>
                                   <div class="card-body">
                                        <h3 class="text-center" style="color:red !important">No Investment Found Yet</h3>
                                   </div>
                              <?php } ?>
                         </div>
                    </div>
               </div>

               <div class="row justify-content-center mt-2">
                    <div class="col-md-12">
                         <?php if (isset($investments) && count($investments)) { ?>
                              <div class="table-responsive--md">
                                   <table class="table">
                                        <thead>
                                             <tr>
                                             <tr>
                                                  <th>#</th>
                                                  <th>Package name</th>
                                                  <th>Amount Invested</th>
                                                  <th>Date</th>
                                             </tr>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach ($investments as $i => $investment) { ?>
                                                  <tr>
                                                       <th scope="row">
                                                            <?php echo ++$i; ?>
                                                       </th>
                                                       <td>
                                                            <?php print(stripslashes($investment['package_name'])) ?>
                                                       </td>
                                                       <td>
                                                            <?php print(stripslashes($investment['amount_invested'])) ?>
                                                       </td>
                                                       <td>
                                                            <?php print(date('D d M, Y', $investment['date'])) ?>
                                                       </td>
                                                  </tr>
                                             <?php } ?>
                                        </tbody>
                                   </table>
                              </div>
                         <?php } else { ?>
                              <div class="table-responsive--md">
                                   <table class="table">
                                        <thead>
                                             <tr>
                                                  <th>Plan</th>
                                                  <th>Return</th>
                                                  <th>Received</th>
                                                  <th>Next payment</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <tr>
                                                  <td colspan="100%" class="text-center">Data not found</td>
                                             </tr>

                                        </tbody>
                                   </table>


                              </div>
                         <?php } ?>
                    </div>
               </div>
          </div>
     </section>

</div>
<?php
require('footer.php');
?>