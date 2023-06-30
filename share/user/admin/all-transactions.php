<?php
session_start();


require('../../../wp-content/process/pdo.php');

$db = new DatabaseClass();


$deposits = $deposits = $db->SelectAll("SELECT d.*, u.email FROM deposit AS d JOIN users AS u ON d.user_id = u.user_id", []);
$withdrawals =
     $db->SelectAll("SELECT d.*, u.email FROM withdrawal AS d JOIN users AS u ON d.user_id = u.user_id", []);
$bonus =
     $db->SelectAll("SELECT d.*, u.email FROM bonus AS d JOIN users AS u ON d.userid = u.user_id", []);

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


//acc bal is sum of except 
require 'header.php';
?>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Transactions</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Transactions</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="tables">
          <div class="container-fluid">
               <div class="table-responsive mt-5 mb-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                         <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="deposit-tab" data-bs-toggle="tab" data-bs-target="#deposit" type="button" role="tab" aria-controls="deposit" aria-selected="true">Deposit</button>
                         </li>
                         <li class="nav-item" role="presentation">
                              <button class="nav-link" id="withdrawal-tab" data-bs-toggle="tab" data-bs-target="#withdrawal" type="button" role="tab" aria-controls="withdrawal" aria-selected="false">Withdrawal</button>
                         </li>
                         <li class="nav-item" role="presentation">
                              <button class="nav-link" id="others-tab" data-bs-toggle="tab" data-bs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false">Others</button>
                         </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                         <div class="tab-pane fade show active" id="deposit" role="tabpanel" aria-labelledby="deposit-tab">
                              <table class="table table-bordered">
                                   <thead>
                                        <tr>
                                             <th>Email</th>
                                             <th>Amount </th>
                                             <th>Payment mode </th>
                                             <th>Status</th>
                                             <th>Date</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                        if (!$deposits) {
                                        ?>
                                             <td colspan="5" class="text-center">
                                                  <span class="text-danger">No Deposits</span>
                                             </td>
                                        <?php
                                        }
                                        foreach ($deposits as $i => $deposit) {
                                        ?>
                                             <tr>
                                                  <td>
                                                       <?php echo ($deposit['email']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($deposit['amount']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($deposit['payment_mode']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($deposit['status']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo (date('D m M, Y', $deposit['date'])); ?>
                                                  </td>
                                             </tr>
                                        <?php
                                        } ?>
                                   </tbody>
                              </table>
                         </div>
                         <div class="tab-pane fade" id="withdrawal" role="tabpanel" aria-labelledby="withdrawal-tab">
                              <table class="table table-bordered">
                                   <thead>
                                        <tr>
                                             <th>Email</th>
                                             <th>Amount </th>
                                             <th>Charges</th>
                                             <th>Payment mode </th>
                                             <th>Status</th>
                                             <th>Date</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                        if (!$withdrawals) {
                                        ?>
                                             <td colspan="5" class="text-center">
                                                  <span class="text-danger">No Withdrawals</span>
                                             </td>
                                        <?php
                                        }
                                        foreach ($withdrawals as $i => $withdrawal) {
                                        ?>
                                             <tr>
                                                  <td>
                                                       <?php echo ($withdrawal['email']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($withdrawal['amount']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($withdrawal['charges']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($withdrawal['receive_mode']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($withdrawal['status']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($withdrawal['date']); ?>
                                                  </td>
                                             </tr>
                                        <?php } ?>
                                   </tbody>
                              </table>
                         </div>
                         <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="others-tab">
                              <table class="table table-bordered">
                                   <thead>
                                        <tr>
                                             <td>email</td>
                                             <th>Amount</th>
                                             <th>Type</th>
                                             <th>Date</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php
                                        if (!$bonus) {
                                        ?>
                                             <td colspan="5" class="text-center">
                                                  <span class="text-danger">No Bonus</span>
                                             </td>
                                        <?php
                                        }
                                        foreach ($bonus as $i => $bonu) {
                                        ?>
                                             <tr>
                                                  <td>
                                                       <?php echo ($bonu['email']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($bonu['amount']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo ($bonu['nirration']); ?>
                                                  </td>
                                                  <td>
                                                       <?php echo (date('d-m-Y', $bonu['date'])); ?>
                                                  </td>
                                             </tr>
                                        <?php } ?>
                                   </tbody>
                              </table>

                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Page Footer-->

</div>
</div>
</div>
<!-- modal view proof-->
<div class="modal" id="modal_view_proof" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Proof of payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">

               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Thank you</button>
               </div>
          </div>
     </div>
</div>
<!-- JavaScript files-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/just-validate/js/just-validate.min.js"></script>
<script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
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
<script src="./toastr/toastr.min.js"> </script>
<script>
     document.addEventListener('DOMContentLoaded', function() {
          //destructure array
          $('.btn-view-proof') && [...$('.btn-view-proof')].forEach(el => {
               $(el).on('click', function() {
                    //show the modal
                    new bootstrap.Modal('#modal_view_proof').show();
                    if (!this.getAttribute("data-proof-image")) {
                         $('#modal_view_proof .modal-body').html(`
                         <div class="alert alert-info p-3 text-center">
                              <p class="m-0">This user has not uploaded a <b>proof of payment</b></p>
                         </div>
                    `);
                    } else {
                         $('#modal_view_proof .modal-body').html(`
                         <div class="p-3"> 
                              <img src="${'../new-dashboard/uploads/' + this.getAttribute("data-proof-image")}" class="img-fluid mb-3" style="border-radius:10px" />
                              <a download href="../new-dashboard/uploads/${this.getAttribute("data-proof-image")}" class="btn btn-success">Download</a>
                         </div>
                    `);
                    }
               })
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
</body>

</html>