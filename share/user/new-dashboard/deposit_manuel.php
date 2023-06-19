<?php
require('app.php');
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
     try {
          $target_dir = "uploads/";
          $target = $target_dir . basename($_FILES["proof_of_payment"]["name"]);
          $target_file = $_FILES["proof_of_payment"]["name"];
          $amount = $_SESSION['paymentAmount'];
          $paymentMode = $_SESSION['paymentMode'];
          $date = time();
          //check if file was uploaded
          if (!move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], $target)) {
               $_SESSION['msg'] = "File upload failed";
               $_SESSION['success'] = false;
               header("Location:./deposit_manuel.php");
               exit();
          } else {
               $query =
                    "INSERT INTO deposit (user_id, amount, payment_mode, prof_image, date)
          VALUES(:user_id, :amount, :payment_mode, :prof_image, :date)";
               $data = [
                    'user_id' => $_SESSION['user_id'],
                    'amount' => $amount,
                    'payment_mode' => $paymentMode,
                    'date' => $date,
                    'prof_image' => $target_file
               ];

               $result = $db->Insert($query, $data);

               if ($result) {
                    print("<script>
                    document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('file uploaded successfully');
                    setTimeout(function() {
                              toastr.clear()
                         }, 5000);
                         window.location.href='index.php';
                         })
               </script>");
               } else {
                    $_SESSION['msg'] = "Deposit not found. Please try again";
                    $_SESSION['success'] = false;
                    header("Location:./deposit.php");
                    exit();
               }
          }
     } catch (Exception $e) {
          error_log($e->getMessage());
          $_SESSION['msg'] = "A server error has occured. Try again later";
          $_SESSION['success'] = false;
          header("Location:./deposit.php");
          exit();
     }
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
                    <h2 class="page-title">Deposit Confirm</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="cmn-section">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-md-8">
                         <div class="card custom--card">
                              <div class="card-header card-header-bg">
                                   <h5 class="text-center" style="color:white !important;"> <i class="las la-wallet"></i> <?= $_SESSION['paymentMode'] ?></h5>
                              </div>
                              <div class="card-body  ">
                                   <form action="" id="form_confirm_payment" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="6urKTqqNHmfFzgjqYenXeTS7RcZeFRNJEGEQxUpu">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <p class="text-center mt-2">You have requested <b class="text-success"><?= $_SESSION['paymentAmount'] ?></b> , Please pay <b class="text-success"> <?= $_SESSION['paymentMode'] ?></b> for successful payment </p>

                                                  <div class="my-4">
                                                       <p>Please make payment to the <?= $_SESSION['paymentMode'] ?> wallet details below. Click To Copy.
                                                       <div><?= $_SESSION["addr"] ?><br></div>
                                                       </p>
                                                  </div>

                                             </div>

                                             <div class="form-group">
                                                  <label class="form-label">Submit Screenshot
                                                  </label>

                                                  <input type="file" class="form-control form--control" name="proof_of_payment" accept=" .jpg,  .jpeg,  .png,  .pdf, " id="inp_proof" octavalidate="R" accept-mime="image/jpeg, image/png, image/jpg" maxsize="10mb">
                                                  <pre class="text--base mt-1">Supported mimes: jpg,jpeg,png,pdf</pre>
                                             </div>

                                             <div class="col-md-12">
                                                  <div class="form-group">
                                                       <button type="submit" name="pay" class="btn--base w-100">Pay Now</button>
                                                  </div>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<?php
require('footer.php');
?>
<script>
     document.addEventListener('DOMContentLoaded', () => {
          $('#form_confirm_payment').on('submit', (e) => {
               const myForm = new octaValidate(e.target.id, {
                    strictMode: true
               });
               if (myForm.validate()) {
                    e.target.submit()
               } else {
                    e.preventDefault();
               }
          })
     })
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