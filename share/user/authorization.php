<?php
//check if session is started already
if (session_status() === PHP_SESSION_NONE)
     session_start();

require '../../wp-content/process/octaValidate-PHP-main/src/Validate.php';

use Validate\octaValidate;
//set configuration
$options = array(
     "stripTags" => true,
     "strictMode" => true
);
//create new instance
$myForm = new octaValidate('auth', $options);
//define rules for each form input name
$valRules = array(
     "code" => array(
          ["R", "Your OTP is required"],
     ),

);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     //begin validation on form fields from $_POST array
     if ($myForm->validateFields($valRules, $_POST)) {
          require '../../wp-content/process/pdo.php';
          $db = new DatabaseClass();
          $enteredOtp = $_POST['code'];
          $user_Id = $_SESSION['user_id'];

          if ($enteredOtp == $_SESSION['otp']) {
               $result = $db->Update(
                    "UPDATE users SET users.is_activated = :active WHERE user_id = :user",
                    ['active' => 'yes', 'user' => $user_Id]
               );
               if ($result) {
                    header("Location:new-dashboard/");
                    die();
               }
          } else {
               $errMsg = array(
                    'auth' => array(
                         'code' => 'OTP is incorrect'
                    )
               );
               print('<script>
                    document.addEventListener("DOMContentLoaded", function(){
                         showErrors(' . json_encode($errMsg) . ');
                    });</script>');
          }
     } else {
          //return errors
          print('<script>
               document.addEventListener("DOMContentLoaded", function(){
                    showErrors(' . json_encode($myForm->getErrors()) . ');
          });</script>');
     }
}
include('header.php');
?>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap');

     .form-control:focus {
          background: transparent;
          border: none;
     }

     .verification-code-wrapper {
          width: 480px;
          padding: 40px;
          display: flex;
          align-items: center;
          justify-content: center;
          border-radius: 5px;
          background-color: #fff;
          border: 1px solid #ebebeb
     }

     .verification-area {
          width: 100%;
     }

     .verification-code {
          display: flex;
          position: relative;
          z-index: 1;
          height: 50px;
          width: 100%;
     }

     .verification-code::after {
          position: absolute;
          content: '';
          right: -37px;
          width: 35px;
          height: 50px;
          background-color: #fff;
          z-index: 2;
     }

     .verification-code input {
          position: absolute;
          height: 50px;
          width: calc(100% + 80px);
          left: 0;
          background: transparent;
          border: none;
          font-size: 25px !important;
          font-weight: 800;
          letter-spacing: 51px;
          text-indent: 1px;
          border: none;
          z-index: 1;
          padding-left: 25px;
          font-family: 'Courier Prime', monospace;
          color: #504c4c !important;
     }


     .octavalidate-txt-error {
          display: block;
          color: #d10745;
          font-size: 0.9rem;
          margin: 45px 0px 0px 0px !important;
     }

     .verification-code input:focus {
          outline: none;
          cursor: pointer;
          box-shadow: none;
     }

     .boxes {
          position: absolute;
          top: 0;
          height: 100%;
          width: 100%;
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          z-index: -1;
     }

     .verification-code span {
          height: 50px;
          width: calc((100% / 6) - 3px);
          background: #f1f1f1;
          border: solid 1px #f1f1f1;
          text-align: center;
          line-height: 50px;
          color: #cdc8c8
     }

     .verification-text {
          font-size: 1.2rem;
     }


     @media (max-width: 575px) {
          .verification-code-wrapper {
               width: 400px;
               padding: 32px;
          }

          .verification-code input {
               width: calc(100% + 35px);
               padding-left: 18px;
               letter-spacing: 41px;
          }

          .verification-text {
               font-size: 1rem;
          }

          .verification-code::after {
               right: -32px;
               width: 30px;
          }
     }

     @media (max-width: 450px) {
          .verification-code-wrapper {
               width: 380px;
               padding: 32px;
          }

          .verification-code input {
               width: calc(100% + 45px);
               padding-left: 15px;
               letter-spacing: 38px;
          }
     }

     @media (max-width: 400px) {
          .verification-code {
               height: 40px;
          }

          .verification-code-wrapper {
               width: 340px;
               padding: 32px;
          }

          .verification-code input {
               width: calc(100% + 40px);
               padding-left: 15px;
               letter-spacing: 34px;
               height: 40px;
          }

          .verification-code span {
               height: 40px;
               line-height: 40px;
          }

          .verification-code::after {
               height: 40px;
          }

          .verification-code input {
               font-size: 20px !important;
          }
     }


     @media (max-width: 375px) {
          .verification-code-wrapper {
               width: 300px;
               padding: 32px;
          }

          .verification-code input {
               padding-left: 13px;
               letter-spacing: 27px;
               height: 40px;
          }
     }

     /* Copy Animation */

     .copyInput {
          display: inline-block;
          line-height: 50px;
          position: absolute;
          top: 0;
          right: 0;
          width: 40px;
          text-align: center;
          font-size: 14px;
          cursor: pointer;
          -webkit-transition: all .3s;
          -o-transition: all .3s;
          transition: all .3s;
     }

     .copied::after {
          position: absolute;
          top: 8px;
          right: 12%;
          width: 100px;
          display: block;
          content: "COPIED";
          font-size: 1em;
          padding: 5px 5px;
          color: #fff;
          background-color: hsl(var(--base));
          border-radius: 3px;
          opacity: 0;
          will-change: opacity, transform;
          animation: showcopied 1.5s ease;
     }

     @keyframes showcopied {
          0% {
               opacity: 0;
               transform: translateX(100%);
          }

          50% {
               opacity: 0.7;
               transform: translateX(40%);
          }

          70% {
               opacity: 1;
               transform: translateX(0);
          }

          100% {
               opacity: 0;
          }
     }

     .input-group-text.copytext.copyBoard {
          cursor: pointer;
     }




     .cookies-card {
          width: 520px;
          padding: 30px;
          color: #dddddd;
          position: fixed;
          bottom: 15px;
          left: 15px;
          z-index: 999999;
          transition: all .5s;
          background: #222222;
          border-radius: 5px;
          border: 2px solid hsl(var(--base)/ 0.5);
          border-radius: 5px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          -ms-border-radius: 5px;
          -o-border-radius: 5px;
          background-color: var(--second_color);
          box-shadow: 0 0 15px hsl(var(--base)/ 0.5);
     }

     .cookies-card.hide {
          bottom: -500px !important;
     }

     .radius--10px {
          border-radius: 10px;
     }

     .cookies-card__icon {
          width: 55px;
          height: 55px;
          border-radius: 50%;
          background-color: #6e6f70;
          color: #fff;
          font-size: 32px;
          display: inline-flex;
          justify-content: center;
          align-items: center;
     }

     .cookies-card__content {
          margin-bottom: 0;
     }

     .cookies-btn {
          color: #363636;
          text-decoration: none;
          padding: 10px 35px;
          margin: 3px 5px;
          display: inline-block;
          border-radius: 999px;
     }

     .cookies-btn:hover {
          color: #363636;
     }


     @media (max-width: 767px) {
          .cookies-card {
               width: 100%;
               left: 0;
               bottom: 0;
               font-size: 14px;
               padding: 15px;
          }
     }




     .hover-input-popup {
          position: relative;
     }

     .input-popup {
          display: none;
     }

     .hover-input-popup .input-popup {
          display: block;
          position: absolute;
          bottom: 70%;
          left: 50%;
          width: 280px;
          background-color: #1a1a1a;
          color: #fff;
          padding: 20px;
          border-radius: 5px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          -ms-border-radius: 5px;
          -o-border-radius: 5px;
          -webkit-transform: translateX(-50%);
          -ms-transform: translateX(-50%);
          transform: translateX(-50%);
          -webkit-transition: all 0.3s;
          -o-transition: all 0.3s;
          transition: all 0.3s;
     }

     .input-popup::after {
          position: absolute;
          content: '';
          bottom: -19px;
          left: 50%;
          margin-left: -5px;
          border-width: 10px 10px 10px 10px;
          border-style: solid;
          border-color: transparent transparent #1a1a1a transparent;
          -webkit-transform: rotate(180deg);
          -ms-transform: rotate(180deg);
          transform: rotate(180deg);
     }

     .input-popup p {
          padding-left: 20px;
          position: relative;
     }

     .input-popup p::before {
          position: absolute;
          content: '';
          font-family: 'Line Awesome Free';
          font-weight: 900;
          left: 0;
          top: 4px;
          line-height: 1;
          font-size: 18px;
     }

     .input-popup p.error {
          text-decoration: line-through;
     }

     .input-popup p.error::before {
          content: "\f057";
          color: #ea5455;
     }

     .input-popup p.success::before {
          content: "\f058";
          color: #28c76f;
     }



     .show-filter {
          display: none;
     }

     @media(max-width:767px) {
          .responsive-filter-card {
               display: none;
               transition: none;
          }

          .show-filter {
               display: block;
          }
     }

     .modal-content {
          background-color: #242431;
          border: 1px solid rgba(0, 0, 0, .2);
     }

     .modal-content .close {
          background: transparent;
          color: #fff;
     }

     .modal-header {
          border-bottom: 1px solid #373742;
     }

     .modal-footer {
          border-top: 1px solid #373742;
     }


     .table-search {
          width: 33%;
          margin-left: auto;
     }

     @media (max-width:991px) {
          .table-search {
               width: 50%;
          }
     }

     @media (max-width:575px) {
          .table-search {
               width: 100%;
          }
     }

     .verification-code-wrapper {
          border: 1px solid rgba(255, 255, 255, 0.24) !important;
          background-color: #000 !important;
     }

     .verification-code::after {
          background-color: #000 !important;
     }

     .verification-code input:focus {
          background-color: inherit !important;
     }

     .border-bottom {
          border-color: rgba(255, 255, 255, 0.24) !important;
     }

     label.required:after {
          content: '*';
          color: #DC3545 !important;
          margin-left: 2px;
     }


     /* =========================== Custom Checkbox Design Start =========================== */
     .form--check .form-check-input {
          -webkit-box-shadow: none;
          box-shadow: none;
          background-color: transparent;
          box-shadow: none !important;
          border: 0;
          position: relative;
          border-radius: 2px;
          width: 16px;
          height: 16px;
          border: 1px solid hsl(var(--base));
          margin-right: 5px;
     }

     .form--check .form-check-input:checked {
          background-color: hsl(var(--base)) !important;
          border-color: hsl(var(--base)) !important;
          -webkit-box-shadow: none;
          box-shadow: none;
     }

     .form--check .form-check-input:checked[type=checkbox] {
          background-image: none;
     }

     .form--check .form-check-input:checked::before {
          position: absolute;
          content: "\f00c";
          font-family: "Font Awesome 5 Free";
          font-weight: 900;
          color: #fff;
          font-size: 10px;
          top: 50%;
          left: 50%;
          -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
     }

     /* =========================== Custom Checkbox Design End =========================== */
     .verification-code span {
          background: #22222e;
          border: solid 1px #f1f1f11f;
          color: #ffffff;
     }

     .verification-code input {
          color: #ffff !important;
     }

     .disabled {
          opacity: 0.7;
     }

     .input-group-text {
          background-color: hsl(var(--base)) !important;
     }

     .file-upload .remove-btn {
          background: #dc3545 !important;
          border-color: #dc3545 !important;
     }
</style>
<!-- inner hero start -->
<section class="inner-hero bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/breadcrumb/63c7a2144362f1674027540.png" style="background-image: url(&quot;https://creativewealth.ltd/share/assets/images/frontend/breadcrumb/63c7a2144362f1674027540.png&quot;);">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <h2 class="page-title">Verify Email</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="cmn-section">
          <div class="container">
               <div class="d-flex justify-content-center">
                    <div class="verification-code-wrapper">
                         <div class="verification-area">
                              <form action="" id="auth" loadnovalidate method="POST" class="submit-form">
                                   <input type="hidden" name="_token" value="xK8SpdMxKMrFsHYZA2rI8beH8OAlo6gecbqBEBc3">
                                   <p class="verification-text">A 6 digit verification code sent to your email address </p>

                                   <div class="mb-3">
                                        <label>Verification Code</label>
                                        <div class="verification-code">
                                             <input type="text" name="code" id="code" class="form-control overflow-hidden" required="" autocomplete="off" spellcheck="false" data-ms-editor="true" minlength="6">
                                             <div class="boxes">
                                                  <span>-</span>
                                                  <span>-</span>
                                                  <span>-</span>
                                                  <span>-</span>
                                                  <span>-</span>
                                                  <span>-</span>
                                             </div>
                                        </div>
                                   </div>



                                   <div class="mb-3">
                                        <button type="submit" class="btn--base w-100">Submit</button>
                                   </div>

                                   <div class="mb-3">
                                        <p>
                                             If you don't get any code, <a href="./authorization.php"> Try again</a>
                                        </p>

                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     const myInput = document.getElementById('code');

     myInput.addEventListener('input', function() {
          if (this.value.length === 6) {
               this.form.submit();
          }
     });
</script>


<?php
include('footer.php');
