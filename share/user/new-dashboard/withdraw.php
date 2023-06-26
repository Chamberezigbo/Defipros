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
               // if ($action == 'send-otp') {
               //      $otp =  105; //rand(0000, 9999);
               //      var_dump('otp', $otp);
               //      $body = "Hello $fullName, your one time password is $otp";
               //      $mail = sendMail($email, $fullName, 'WITHDRAWAL OTP', $body);
               //      $_SESSION['otp'] = $otp;
               //      $_SESSION['success'] = true;
               //      $_SESSION['msg'] = "Otp sent successfully";
               //      header("Location: ./withdraw-funds.php");
               //      exit();
               // }

               if ($action == 'withdraw') {
                    //verify otp has been sent
                    // if (!isset($_SESSION['otp']) || empty($_SESSION['otp'])) {
                    //      $_SESSION['success'] = false;
                    //      $_SESSION['msg'] = "Please request for an OTP";
                    //      header("Location: ./withdraw-funds.php");
                    //      exit();
                    // }

                    if (!empty($_POST['amount']) && !empty($_POST['details'])) {

                         //check balance
                         if (intval($balance) > intval($_POST['amount'])) {
                              //process withdrawal
                              $db->Insert("INSERT INTO withdrawal (user_id, amount, charges, receive_mode, address, date) VALUES (:uid, :amt, :cha, :rec,:addr, :date)", [
                                   "uid" => $user_Id,
                                   "amt" => $_POST['amount'],
                                   "cha" => "DEFAULT",
                                   //$_POST['']
                                   "rec" => $_POST['method_code'],
                                   "addr" => $_POST['details'],
                                   "date" => time()
                              ]);
                              //success
                              unset($_SESSION['otp']);
                              $_SESSION['success'] = true;
                              $_SESSION['msg'] = "Withdrawal has been initiated";
                              header("Location: ./withdraw.php");
                              exit();
                         } else {
                              //abort
                              $_SESSION['success'] = false;
                              $_SESSION['msg'] = "Your account balance is too low";
                              header("Location: ./withdraw.php");
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
                    <h2 class="page-title">Withdraw Money</h2>
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
                    var days = `<span>${days}d</span>`;
                    var hours = `<span>${hours}h</span>`;
                    var minutes = `<span>${minutes}m</span>`;
                    var seconds = `<span>${seconds}s</span>`;
                    document.getElementById(elementId).innerHTML = days + ' ' + hours + " " + minutes + " " + seconds;
                    if (distance < 0) {
                         clearInterval(x);
                         document.getElementById(elementId).innerHTML = "COMPLETE";
                    }
                    tms--;
               }, 1000);
          }
     </script>
     <div class="cmn-section">
          <div class="container">
               <div class="row mb-4 mb-sm-5 justify-content-center">
                    <div class="col-lg-6">
                         <div class="text-end">
                              <a href="transactions.php" class="btn btn--base">Withdraw History</a>
                         </div>
                    </div>
               </div>
               <div class="row justify-content-center">
                    <div class="col-lg-6">
                         <div class="card custom--card ">
                              <div class="card-body">
                                   <form action="" method="post" id="form_withdraw" novalidate>
                                        <input type="hidden" name="action" value="withdraw">
                                        <input type="hidden" name="_token" value="6urKTqqNHmfFzgjqYenXeTS7RcZeFRNJEGEQxUpu">
                                        <div class="form-group">
                                             <label class="form-label">Method</label>
                                             <select class="form-control form--control" name="method_code" required>
                                                  <option value="">Select Gateway</option>
                                                  <option value="Bitcoin" data-resource="{&quot;id&quot;:1,&quot;form_id&quot;:21,&quot;name&quot;:&quot;Bitcoin&quot;,&quot;min_limit&quot;:&quot;10.00000000&quot;,&quot;max_limit&quot;:&quot;1000000.00000000&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;0.00004700&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;currency&quot;:&quot;Btc&quot;,&quot;description&quot;:&quot;Please enter your Bitcoin wallet address below&quot;,&quot;status&quot;:1,&quot;created_at&quot;:&quot;2023-01-18T07:14:05.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-18T07:14:05.000000Z&quot;}"> Bitcoin</option>
                                                  <option value="Ethereum" data-resource="{&quot;id&quot;:2,&quot;form_id&quot;:22,&quot;name&quot;:&quot;Ethereum&quot;,&quot;min_limit&quot;:&quot;10.00000000&quot;,&quot;max_limit&quot;:&quot;1000000.00000000&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;0.00063000&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;currency&quot;:&quot;Eth&quot;,&quot;description&quot;:&quot;Please enter your Ethereum wallet address below&quot;,&quot;status&quot;:1,&quot;created_at&quot;:&quot;2023-01-18T07:15:38.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-18T07:15:38.000000Z&quot;}"> Ethereum</option>
                                                  <option value="USDTTRC20" data-resource="{&quot;id&quot;:3,&quot;form_id&quot;:23,&quot;name&quot;:&quot;USDT TRC20&quot;,&quot;min_limit&quot;:&quot;10.00000000&quot;,&quot;max_limit&quot;:&quot;1000000.00000000&quot;,&quot;fixed_charge&quot;:&quot;0.00000000&quot;,&quot;rate&quot;:&quot;1.00000000&quot;,&quot;percent_charge&quot;:&quot;0.00&quot;,&quot;currency&quot;:&quot;USDT&quot;,&quot;description&quot;:&quot;Please enter your USDT TRC20 wallet address below&quot;,&quot;status&quot;:1,&quot;created_at&quot;:&quot;2023-01-18T07:16:39.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-01-18T07:16:39.000000Z&quot;}"> USDT TRC20</option>
                                             </select>
                                        </div>
                                        <div class="form-group">
                                             <label class="form-label">Amount</label>
                                             <div class="input-group">
                                                  <input type="number" step="any" name="amount" value="" class="form-control form--control" required id="inp_amount" octavalidate="R,DIGITS">
                                                  <span class="input-group-text bg--base">USD</span>
                                             </div>
                                             <div class="input-group">
                                                  <input type="text" step="any" placeholder="Enter USDT Address" class="form-control form--control" required name="details" id="inp_details" octavalidate="R,TEXT">
                                             </div>
                                        </div>
                                        <div class="mt-3 preview-details d-none">
                                             <ul class="list-group text-center">
                                                  <li class="list-group-item d-flex justify-content-between">
                                                       <span>Limit</span>
                                                       <span><span class="min fw-bold">0</span> USD - <span class="max fw-bold">0</span> USD</span>
                                                  </li>
                                                  <li class="list-group-item d-flex justify-content-between">
                                                       <span>Charge</span>
                                                       <span><span class="charge fw-bold">0</span> USD</span>
                                                  </li>
                                                  <li class="list-group-item d-flex justify-content-between">
                                                       <span>Receivable</span> <span><span class="receivable fw-bold"> 0</span> USD </span>
                                                  </li>
                                                  <li class="list-group-item d-none justify-content-between rate-element">

                                                  </li>
                                                  <li class="list-group-item d-none justify-content-between in-site-cur">
                                                       <span>In <span class="base-currency"></span></span>
                                                       <strong class="final_amo">0</strong>
                                                  </li>
                                             </ul>
                                        </div>
                                        <button type="submit" class="btn--base w-100 mt-3">Submit</button>
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
<script>
     const myForm = new octaValidate("form_withdraw", {
          errorElem: {
               "inp_otp": "otp_wrapper"
          }
     });
     document.querySelector('#form_withdraw').addEventListener('submit', (e) => {
          if (myForm.validate()) {
               e.currentTarget.submit()
          } else {
               e.preventDefault()
          }
     })
</script>