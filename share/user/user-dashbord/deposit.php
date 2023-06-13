<?php
//turn on output buffering
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
          header("Location: payment.php");
     } else {
          $_SESSION['success'] = false;
          $_SESSION['msg'] = "Payment failed. Try another method";
          header("Location: ./deposit.php");
     }
     exit();
}

include("header.php");
?>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Fund Your Account</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.php">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Fund Your Account</li>
                    </ol>
               </nav>
          </div>
     </div>
     <!-- Forms Section-->
     <section class="forms">
          <div class="container-fluid">
               <div class="row">
                    <div class="card-body">
                         <div class="row">
                              <div class="col-md-12">

                                   <form action="" method="post" id="submitpaymentform">
                                        <input type="hidden" name="_token" value="VwJXSdV5Py8OIzWjZnjqdOUj6MXszJxbjQZCUJJF">
                                        <div class="row">
                                             <div class="mb-4 col-md-12">
                                                  <h5 class="card-title text-dark">Enter Amount</h5>
                                                  <input onchange="(this.value < 0) ? this.value = 0 : null" class="form-control text-dark bg-light" placeholder="Enter Amount" type="number" name="amount" required>
                                             </div>
                                             <div class="mb-4 col-md-12">
                                                  <select class="form-select" name="paymentMode" id="floatingSelect" aria-label="Floating label select example">
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
                                                  <label for="floatingSelect">select a payment method</label>
                                                  <label for="floatingSelect">select a payment method</label>
                                             </div>
                                             <div class="col-md-6">
                                                  <div class="card">
                                                       <div class="card-body">
                                                            <div class="d-flex">
                                                                 <img src="https://imgs.search.brave.com/_kUCc5M-8rKIllUV_Et0Pt2XUMsvmV4BKCxfp0btOAY/rs:fit:847:225:1/g:ce/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5f/RnY3Tk1FQ1lScmh3/OUJBWUZZMldRSGFF/SiZwaWQ9QXBp" width="15%" alt="">
                                                                 <p class="ms-auto">USDT</p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="col-md-6">
                                                  <div class="card">
                                                       <div class="card-body">
                                                            <div class="d-flex">
                                                                 <img src="https://cdn.pixabay.com/photo/2013/12/08/12/12/bitcoin-225079_960_720.png" width="10%" alt="">
                                                                 <p class="ms-auto">Bitcoin Cash</p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-md-6">
                                                  <div class="card">
                                                       <div class="card-body">
                                                            <div class="d-flex">
                                                                 <img src="https://cdn.pixabay.com/photo/2021/05/12/20/18/dogecoin-6249162__340.png" width="10%" alt="">
                                                                 <p class="ms-auto">Doge</p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="col-md-6">
                                                  <div class="card">
                                                       <div class="card-body">
                                                            <div class="d-flex">
                                                                 <img src="https://cdn.pixabay.com/photo/2018/05/08/21/29/paypal-3384015__340.png" width="10%" alt="">
                                                                 <p class="ms-auto">Paypal</p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="col-md-6">
                                                  <div class="card">
                                                       <div class="card-body">
                                                            <div class="d-flex">
                                                                 <img src="https://imgs.search.brave.com/IMv6YbifW7hn1Y9iNl-6a2s8-lnUhlcfO4eYg1PeNJ8/rs:fit:474:225:1/g:ce/aHR0cHM6Ly90c2Uz/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5y/OTU1c1BJQ041VnJh/TENMMEo3VnVRSGFI/YSZwaWQ9QXBp" width="10%" alt="">
                                                                 <p class="ms-auto">Litecoin</p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="col-md-6">
                                                  <div class="card">
                                                       <div class="card-body">
                                                            <div class="d-flex">
                                                                 <img src="https://imgs.search.brave.com/lyo7BA_r7eqNAjOWI0HmujEo9iN2zdXdTE43wjCNhxg/rs:fit:453:225:1/g:ce/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5p/Rm9TRE9iM1JEZXBD/U3V4WHhNNEVnSGFI/diZwaWQ9QXBp" width="10%" alt="">
                                                                 <p class="ms-auto">Ethereum</p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="d-grid gap-2">
                                                  <button name="pay" class="btn btn-primary" type="submit">Continue</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <?php
     require "footer.php"
     ?>
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
</div>
</div>
</div>