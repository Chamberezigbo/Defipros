<?php
ob_start();
require_once('app.php');
$msg = $success = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])) {
     $paymentMode = $_POST['paymentMode'];
     $amount = $_POST['amount'];
     $result = $db->SelectOne("SELECT * FROM payment_methods WHERE method = :method", ['method' => $paymentMode]);
     if (!($result['addr'] == NULL)) {
          $_SESSION["addr"] = $result['addr'];
          $_SESSION['paymentAmount'] = $amount;
          $_SESSION['paymentMode'] = $paymentMode;
          header("Location: deposit_manuel.php");
     } else {
          $_SESSION['success'] = false;
          $_SESSION['msg'] = "Payment failed. Try another method";
          header("Location: ./deposit.php");
     }
     exit();
}
require('header.php');
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
                    <h2 class="page-title">Deposit Methods</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="cmn-section">
          <div class="container">
               <div class="row mb-4 mb-sm-5 justify-content-center">
                    <div class="col-lg-6">
                         <div class="text-end">
                              <a href="transactions.php" class="btn btn--base">Deposit History</a>
                         </div>
                    </div>
               </div>
               <div class="row justify-content-center">
                    <div class="col-lg-6">
                         <form action="" method="post" id="submitpaymentform">
                              <input type="hidden" name="_token" value="iuQvZb57dTcm7tZPZ08eIEhkzxnL8ExBPUXD8Z7u"> <input type="hidden" name="method_code">
                              <input type="hidden" name="currency">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="form-group">
                                             <label class="form-label">Select Gateway</label>
                                             <select class="form-select form-control form--select" name="paymentMode" required>
                                                  <option value="">Select One</option>
                                                  <?php
                                                  $methods = $db->SelectAll("SELECT * FROM payment_methods WHERE addr IS NOT NULL", []);

                                                  if ($methods && count($methods)) {
                                                       foreach ($methods as $i => $method) {
                                                  ?>
                                                            <option value="<?php print($method['method']); ?>">
                                                                 <?php print($method['method']); ?>
                                                            </option>
                                                  <?php
                                                       }
                                                  }
                                                  ?>
                                             </select>
                                        </div>
                                        <div class="form-group">
                                             <label class="form-label">Amount</label>
                                             <div class="input-group">
                                                  <input onchange="(this.value < 0) ? this.value = 0 : null" type="number" step="any" name="amount" class="form-control form--control" value="" autocomplete="off" required>
                                                  <span class="input-group-text bg--base">USD</span>
                                             </div>
                                        </div>
                                        <div class="mt-3 preview-details d-none">
                                             <ul class="list-group">
                                                  <li class="list-group-item d-flex justify-content-between">
                                                       <span>Limit</span>
                                                       <span><span class="min fw-bold">0</span> USD - <span class="max fw-bold">0</span> USD</span>
                                                  </li>
                                                  <li class="list-group-item d-flex justify-content-between">
                                                       <span>Charge</span>
                                                       <span><span class="charge fw-bold">0</span> USD</span>
                                                  </li>
                                                  <li class="list-group-item d-flex justify-content-between">
                                                       <span>Payable</span> <span><span class="payable fw-bold"> 0</span> USD</span>
                                                  </li>
                                                  <li class="list-group-item justify-content-between d-none rate-element">

                                                  </li>
                                                  <li class="list-group-item justify-content-between d-none in-site-cur">
                                                       <span>In <span class="base-currency"></span></span>
                                                       <span class="final_amo fw-bold">0</span>
                                                  </li>
                                                  <li class="list-group-item justify-content-center crypto_currency d-none">
                                                       <span>Conversion with <span class="method_currency"></span> and final value will Show on next step</span>
                                                  </li>
                                             </ul>
                                        </div>
                                        <button type="submit" name="pay" class="btn--base w-100 mt-3">Submit</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
<?php
require('footer.php');
?>
<script>
     document.addEventListener('DOMContentLoaded', function() {
          const myForm = new octaValidate('form_invest')
          $('#form_invest').on('submit', (e) => {
               e.preventDefault()
               if (myForm.validate()) {
                    e.currentTarget.submit()
               }
          })
     })
</script>
<script>
     <?php
     if (isset($success) && isset($msg)) {
          if ($success && !empty($msg)) {
     ?>
               toastr.success("<?php echo $msg; ?>")
          <?php
          } elseif (!$success && !empty($msg)) { ?>
               toastr.error("<?php echo $msg; ?>")
     <?php
          }
     }
     ?>
</script>