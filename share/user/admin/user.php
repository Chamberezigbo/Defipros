<?php
session_start();

$id = (isset($_GET) && isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : exit();

require('../../../wp-content/process/pdo.php');

$db = new DatabaseClass();

$user = $db->SelectOne("SELECT * FROM users WHERE users.id = :id", ['id' => $id]);

//if user does not exist, kill the page
(!$user) && exit();
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
          $action  = $_POST['action'];
          $id = $_POST['id'];
          //check if the user exists
          $user = $db->SelectOne("SELECT * FROM users WHERE users.id = :id", ['id' => $id]);
          //update password
          if ($action == 'upd_pass' && $user) {
               // $secret = password_hash($_POST['pass'], PASSWORD_BCRYPT);
               $secret = $_POST['pass'];

               $db->Update("UPDATE users SET password = :secret WHERE users.id = :id", ['id' => $user['id'], 'secret' => $secret]);
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "Password has been updated successfully";
               //reset post array
               header("Location: ./user.php?id=$id");
               exit();
          }
          //delete user
          if ($action == 'del_user' && $user) {
               $db->Remove("DELETE FROM users WHERE users.id = :id", ['id' => $user['id']]);
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "User has been deleted successfully";
               //reset post array
               header("Location: users.php");
               exit();
          }
          //deactivate user
          if ($action == 'deactivate_user' && $user) {
               $db->Update("UPDATE users SET users.is_activated = :act WHERE users.id = :id", ['id' => $user['id'], 'act' => 'no']);
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "User has been deactivated successfully";
               //reset post array
               header("Location: ./user.php?id=$id");
               exit();
          }
          //activate user
          if ($action == 'activate_user' && $user) {
               $db->Update("UPDATE users SET users.is_activated = :act WHERE users.id = :id", ['id' => $user['id'], 'act' => 'yes']);
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "User has been activated successfully";
               //reset post array
               header("Location: ./user.php?id=$id");
               exit();
          }
          //update balance
          if ($action == 'upd_bal' && $user) {
               //act balance
               $db->Update("UPDATE users SET balance = :balance, users.total_profit = :tp, users.total_deposit = :td, users.total_inv_plans = :tip, users.total_act_plans = :tap  WHERE users.id = :id", [
                    'id' => $user['id'],
                    'balance' => $_POST['balance'],
                    'tp' => $_POST['total_profit'],
                    'td' => $_POST['total_deposit'],
                    'tip' => $_POST['total_inv_plans'],
                    'tap' => $_POST['total_act_plans'],
               ]);
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "User balance has been updated";
               //reset post array
               header("Location: ./user.php?id=$id");
               exit();
          }
     }
}
//acc bal is sum of except 
require "header.php";

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
                         <li class="breadcrumb-item active fw-light" aria-current="page">Users</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="tables">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-4">&nbsp;</div>
                    <div class="col-8 text-end">
                         <button id="btn_upd_bal" class="btn btn-outline-info mb-2 mb-md-0">
                              Update balance </button>
                         <button id="btn_upd_pwd" class="btn btn-info mb-2 mb-md-0">
                              Update password </button>
                         <?php if ($user['is_activated'] == "yes") : ?>
                              <form class="d-inline" method="post" onsubmit="return confirm('Are you sure that you want to deactivate this user?')">
                                   <input type="hidden" name="id" value="<?php print($id); ?>" />
                                   <input type="hidden" name="action" value="deactivate_user" />
                                   <button class="btn btn-danger mb-2 mb-md-0">
                                        Deactivate user </button>
                              </form>
                         <?php else : ?>
                              <form class="d-inline" method="post" onsubmit="return confirm('Are you sure that you want to activate this user?')">
                                   <input type="hidden" name="id" value="<?php print($id); ?>" />
                                   <input type="hidden" name="action" value="activate_user" />
                                   <button class="btn btn-success mb-2 mb-md-0">
                                        Activate user </button>
                              </form>
                         <?php endif; ?>
                    </div>
               </div>
               <div class="table-responsive mt-5 mb-5">
                    <table class="table table-bordered">
                         <tbody>
                              <tr>
                                   <th class="w-50">Full Name</th>
                                   <td class="w-50 should-break">
                                        <?php print($user['first_name'] . ' ' . $user['last_name']); ?>
                                   </td>
                              </tr>
                              <tr>
                                   <th class="w-50">Email</th>
                                   <td class="w-50 should-break">
                                        <?php print($user['email']); ?>
                                   </td>
                              </tr>
                              <tr>
                                   <th class="w-50">Phone</th>
                                   <td class="w-50 should-break">
                                        <?php print($user['phone']); ?>
                                   </td>
                              </tr>
                              <tr>
                                   <th class="w-50">Country</th>
                                   <td class="w-50 should-break">
                                        <?php print($user['country']); ?>
                                   </td>
                              </tr>
                         </tbody>
                    </table>
               </div>
               <div class="row">
                    <div class="col-6">&nbsp;</div>
                    <div class="col-6 text-end">
                         <form method="post" onsubmit="return confirm('Are you sure that you want to delete this user?')">
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                              <input type="hidden" name="action" value="del_user" />
                              <button class="btn btn-danger"> Delete user </button>
                         </form>
                    </div>
               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs" id="footer">
          <div class="container-fluid">
               <div class="row gy-2">
                    <div class="col-sm-6 text-sm-start">
                         <p class="mb-0">Your company &copy; 2017-2022</p>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                         <p class="mb-0">Design by <a href="https://bootstrapious.com/p/admin-template" class="text-white text-decoration-none">Bootstrapious</a></p>
                         <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                    </div>
               </div>
          </div>
     </footer>
</div>
</div>
</div>
<!-- modal update password -->
<div class="modal" id="modal_pwd" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" id="form_upd_pass">
                         <input type="hidden" name="action" value="upd_pass">
                         <input type="hidden" name="id" value="<?php echo $id; ?>">
                         <div class="mb-2">
                              <label>New Password</label>
                              <input autocomplete="off" name="pass" id="inp_pass" type="password" class="form-control" placeholder="Enter new password" octavalidate="R" />
                         </div>
                         <div class="mb-2">
                              <label>Confirm password</label>
                              <input autocomplete="off" id="inp_conpass" type="password" class="form-control" placeholder="Re-enter password" equalto="inp_pass" octavalidate="R" ov-equalto:msg="Both passwords do not match" />
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button form="form_upd_pass" class="btn btn-success">Update</button>
               </div>
          </div>
     </div>
</div>

<!-- modal update balance -->
<div class="modal" id="modal_bal" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Update Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form method="post" id="form_upd_bal">
                         <input type="hidden" name="action" value="upd_bal">
                         <input type="hidden" name="id" value="<?php echo $id; ?>">
                         <div class="mb-2">
                              <label>Wallet Balance</label>
                              <input name="balance" id="inp_t_bonus" type="number" class="form-control" placeholder="Enter total bonus" octavalidate="R,DIGITS" value="<?php (isset($user['balance'])) ? print($user['balance']) : ''; ?>" />
                         </div>
                         <div class="mb-2">
                              <label>Total profit</label>
                              <input name="total_profit" id="inp_t_profit" type="number" class="form-control" placeholder="Enter total profit" octavalidate="R,DIGITS" value="<?php (isset($user['total_profit'])) ? print($user['total_profit']) : ''; ?>" />
                         </div>
                         <div class="mb-2">
                              <label>Total deposit</label>
                              <input name="total_deposit" id="inp_t_deposit" type="number" class="form-control" placeholder="Enter total deposit" octavalidate="R,DIGITS" value="<?php (isset($user['total_deposit'])) ? print($user['total_deposit']) : ''; ?>" />
                         </div>
                         <div class="mb-2">
                              <label>Total investment plans</label>
                              <input name="total_inv_plans" id="inp_inv_plans" type="number" class="form-control" placeholder="Enter total investment plans" octavalidate="R,DIGITS" value="<?php (isset($user['total_inv_plans'])) ? print($user['total_inv_plans']) : ''; ?>" />
                         </div>
                         <div class="mb-2">
                              <label>Total active plans</label>
                              <input name="total_act_plans" id="inp_act_plans" type="number" class="form-control" placeholder="Enter total active plans" octavalidate="R,DIGITS" value="<?php (isset($user['total_act_plans'])) ? print($user['total_act_plans']) : ''; ?>" />
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button form="form_upd_bal" class="btn btn-success">Update</button>
               </div>
          </div>
     </div>
</div>

<?php include('footer.php'); ?>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script>
     document.addEventListener('DOMContentLoaded', function() {
          $('#btn_upd_pwd').on('click', function() {
               //show the modal
               new bootstrap.Modal('#modal_pwd').show()
          })
          $('#btn_upd_bal').on('click', function() {
               //show the modal
               new bootstrap.Modal('#modal_bal').show()
          })

          const myForm = new octaValidate('form_upd_pass')
          $('#form_upd_pass').on('submit', (e) => {
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