<?php
session_start();

require('../../../wp-content/process/pdo.php');

$db = new DatabaseClass();

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

$users = $db->SelectAll("SELECT * FROM users");
require('header.php');
?>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Add Profit</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Users</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="tables">
          <div class="container-fluid">
               <?php if (isset($users) && count($users)) { ?>
                    <div class="table-responsive">
                         <table class="table mb-0 table-striped table-hover">
                              <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th colspan="2">Action</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   foreach ($users as $i => $user) {

                                   ?>
                                        <tr>
                                             <th scope="row"><?php echo ++$i; ?></th>
                                             <td><?php print(stripslashes($user['first_name'])) ?></td>
                                             <td><?php print(stripslashes($user['email'])) ?></td>
                                             <td><?php print(stripslashes($user['phone'])) ?></td>
                                             <td>
                                                  <a href="
                                                  <?php
                                                  print('./investment.php?id=' . $user['user_id'])
                                                  ?>" class="btn btn-info">View investment</a>
                                             </td>
                                        </tr>
                                   <?php  } ?>
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
     </section>
     <!-- Page Footer-->
     <?php require "footer.php" ?>
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