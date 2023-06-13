<?php
session_start();

require('../../../wp-content/process/pdo.php');

$db = new DatabaseClass();

$methods = $db->SelectAll("SELECT * FROM payment_methods");

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

          //add address
          if ($action == 'add-addr') {
               $db->Update(
                    "UPDATE payment_methods SET addr = :addr WHERE method = :method",
                    [
                         'addr' => $_POST['addr'],
                         'method' => $_POST['method']
                    ]
               );
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "Address has been updated successfully";
               //reset post array
               header("Location: ./payment-methods.php");
               exit();
          }
     }
}
require 'header.php';
//acc bal is sum of except 
?>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Users</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Payment Methods</li>
                    </ol>
               </nav>
          </div>
     </div>
     <div class="container-fluid">
          <div class="row mt-5">
               <div class="col-4">&nbsp;</div>
               <div class="col-8 text-end">
                    <button id="btn_upd_addr" class="btn btn-outline-info">
                         Update Address </button>
               </div>
          </div>
          <section class="m-auto" style="max-width:500px">
               <?php if (isset($methods) && count($methods)) { ?>
                    <div class="table-responsive">
                         <table class="table mb-0 table-striped table-hover">
                              <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>Payment method</th>
                                        <th>Wallet Address</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   foreach ($methods as $i => $method) {
                                   ?>
                                        <tr>
                                             <th scope="row">
                                                  <?php echo ++$i; ?>
                                             </th>
                                             <td>
                                                  <?php (isset($method['method']) && !empty($method['method'])) ? print(stripslashes($method['method'])) : print('NOT SET'); ?>
                                             </td>
                                             <td>
                                                  <?php (isset($method['addr']) && !empty($method['addr'])) ? print(stripslashes($method['addr'])) : print('NOT SET'); ?>
                                             </td>
                                        </tr>
                                   <?php } ?>
                              </tbody>
                         </table>
                    </div>
               <?php } else { ?>
                    <div class="text-center" style="font-size: 1.2rem;">
                         <p><i class="fa-4x fas fa-exclamation-triangle text-warning"></i></p>
                         <p>No users found. <a href="./users.php">Try again?</a></p>
                    </div>
               <?php } ?>
     </div>
</div>
<!-- Page Footer-->
<?php require "footer.php" ?>
</div>
</div>
</div>
<!-- modal update password -->
<div class="modal" id="modal_address" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Add payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" id="form_address">
                         <input type="hidden" name="action" value="add-addr">
                         <div class="mb-2">
                              <label class="form-label">Select Payment Method</label>
                              <select id="inp_method" class="form-control" name="method" octavalidate="R">
                                   <option value="">Select One</option>
                                   <?php
                                   foreach ($methods as $i => $method) {
                                   ?>
                                        <option>
                                             <?php print($method['method']); ?>
                                        </option>
                                   <?php }
                                   ?>
                              </select>
                         </div>
                         <div class="mb-2">
                              <label class="form-label">Wallet Address</label>
                              <input id="inp_addr" class="form-control" name="addr" octavalidate="R">
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button form="form_address" class="btn btn-success">Update Address</button>
               </div>
          </div>
     </div>
</div>
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
<!-- Place this script before the </head> tag -->
<script src="https://unpkg.com/octavalidate@1.2.5/native/validate.js"></script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script>
     document.addEventListener('DOMContentLoaded', function() {
          $('#btn_upd_addr').on('click', function() {
               //show the modal
               new bootstrap.Modal('#modal_address').show()
          })
          const myForm = new octaValidate('form_address')
          $('#form_address').on('submit', (e) => {
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
</body>

</html>