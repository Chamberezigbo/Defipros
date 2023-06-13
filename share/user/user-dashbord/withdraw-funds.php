<?php
ob_start();
require_once('app.php');

//success / failure error
$msg = $success = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
     if (isset($_POST['action']) && !empty($_POST['action'])) {
          $action = $_POST['action'];
          try {
               if ($action == 'send-otp') {
                    $otp =  105; //rand(0000, 9999);
                    var_dump('otp', $otp);
                    $body = "Hello $fullName, your one time password is $otp";
                    $mail = sendMail($email, $fullName, 'WITHDRAWAL OTP', $body);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['success'] = true;
                    $_SESSION['msg'] = "Otp sent successfully";
                    header("Location: ./withdraw-funds.php");
                    exit();
               }

               if ($action == 'withdraw') {
                    //verify otp has been sent
                    if (!isset($_SESSION['otp']) || empty($_SESSION['otp'])) {
                         $_SESSION['success'] = false;
                         $_SESSION['msg'] = "Please request for an OTP";
                         header("Location: ./withdraw-funds.php");
                         exit();
                    }

                    if (!empty($_POST['otp']) && !empty($_POST['amount']) && !empty($_POST['details'])) {
                         //verify otp
                         if (intval($_POST['otp']) === intval($_SESSION['otp'])) {
                              //check balance
                              if (intval($balance) > intval($_POST['amount'])) {
                                   //process withdrawal
                                   $db->Insert("INSERT INTO withdrawal (user_id, amount, charges, receive_mode, date) VALUES (:uid, :amt, :cha, :rec, :date)", [
                                        "uid" => $user_Id,
                                        "amt" => $_POST['amount'],
                                        "cha" => "DEFAULT",
                                        //$_POST['']
                                        "rec" => "DEFAULT",
                                        "date" => time()
                                   ]);
                                   //success
                                   unset($_SESSION['otp']);
                                   $_SESSION['success'] = true;
                                   $_SESSION['msg'] = "Withdrawal has been initiated";
                                   header("Location: ./withdraw-funds.php");
                                   exit();
                              } else {
                                   //abort
                                   $_SESSION['success'] = false;
                                   $_SESSION['msg'] = "Your account balance is too low";
                                   header("Location: ./withdraw-funds.php");
                                   exit();
                              }
                         } else {
                              //abort
                              $_SESSION['success'] = false;
                              $_SESSION['msg'] = "The OTP code you provided is incorrect";
                              header("Location: ./withdraw-funds.php");
                              exit();
                         }
                    }
               }
          } catch (Exception $e) {
               var_dump($e);
               error_log($e);
               //abort
               $_SESSION['success'] = false;
               $_SESSION['msg'] = "A server error has occured";
               header("Location: ./withdraw-funds.php");
               exit();
          }
     }
}
include "header.php";
?>
<style>
     .fs-custom {
          font-size: 13px;
     }
</style>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Request for Withdrawal</h2>
               <form id="form_otp" method="post">
                    <input type="hidden" name="action" value="send-otp">
               </form>
          </div>
     </header>
     <!-- Forms Section-->
     <section class="forms">
          <div class="container-fluid">
               <div class="row">
                    <!-- Horizontal Form-->
                    <div class="p-md-4 p-2 rounded card bg-light">
                    <div class="m-auto alert alert-success d-flex align-items-center" role="alert" style="max-width:500px">
                              <i class="fa-solid fa-check"></i>
                              <div>
                                   <h4 class="text-dark">Your Payment Method is <strong>USDT</strong></h4>
                              </div>
                         </div>
                         <div class="card-body">
                              <form method="post" id="form_withdraw" novalidate>
                                   <input type="hidden" name="action" value="withdraw">
                                   <div class="mb-3">
                                        <h5 class="text-dark">Enter Amount to withdraw</h5>
                                        <input class="form-control text-dark bg-light" placeholder="Enter Amount" type="number" name="amount" required="" id="inp_amount" octavalidate="R,DIGITS">
                                   </div>
                                   <input value="USDT" type="hidden" name="method">
                                   <div class="mb-3">
                                   <div id="otp_wrapper">
                                        <h5 class="text-dark">Enter OTP</h5>
                                        <div class="input-group">
                                             <input class="form-control text-dark bg-light" placeholder="Enter Code" type="text" name="otp" id="inp_otp" required="" octavalidate="R,DIGITS">
                                             <div class="input-group-append">
                                                  <button form="form_otp" class="btn btn-success otp-btn">Resend
                                                       OTP</button>
                                             </div>
                                        </div>
                                   </div>     
                                   </div>

                                   <div class="mb-3">
                                        <h5 class="text-dark">Enter USDT Address </h5>
                                        <input class="form-control text-dark bg-light" placeholder="Enter USDT Address" type="text" name="details" id="inp_details" octavalidate="R,TEXT">
                                        <small class="text-dark">USDT is not a default withdrawal option in your
                                             account, please enter the correct wallet address to recieve your
                                             funds.</small>
                                   </div>

                                   <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">Complete Request</button>
                                   </div>
                              </form>
                         </div>
                    </div>
                    <!-- Inline Form-->
               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <?php require 'footer.php' ?>
     <script>
               <?php
               if (isset($success) && isset($msg)) {
                              if ($success && !empty($msg)) {
               ?>
                         toastr.success("<?php echo $msg; ?>")
                         <?php
                    } elseif(!$success && !empty($msg)) { ?>
                    toastr.error("<?php echo $msg; ?>")
                    <?php
                    }
               }
               ?>
     </script>
     <script>
          const myForm = new octaValidate("form_withdraw", {
               errorElem : {
                    "inp_otp" : "otp_wrapper"
               }
          });
          document.querySelector('#form_withdraw').addEventListener('submit', (e) => {
               if(myForm.validate()){
                    e.currentTarget.submit()
               }else{
                    e.preventDefault()
               }
          })
     </script>
</div>
</div>
</div>