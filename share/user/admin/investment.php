<?php
session_start();


//if action is null, render the form to create a new package
$userId = (isset($_GET) && isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : null;


require('../../../wp-content/process/pdo.php');

$db = new DatabaseClass();

$user = $db->SelectOne("SELECT * FROM users WHERE user_id = :id", ['id' => $userId]);
//if user does not exist, kill the page
(!$user) && exit();


$msg = $success = $packages = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     if (isset($_POST['action']) && !empty($_POST['action'])) {
          $action = $_POST['action'];
          if ($action == 'del-package') {
               try {
                    $db->Remove("DELETE FROM investments WHERE id = :id", ['id' => $_POST['id']]);
                    $_SESSION['success'] = true;
                    $_SESSION['msg'] = "Investment has been deleted";

                    //reset post array
                    header("Location: investment.php?id=" . $userId);
                    exit();
               } catch (Exception $e) {
                    var_dump($e);
                    error_log($e);
                    $_SESSION['success'] = false;
                    $_SESSION['msg'] = "A server error has occured";
                    //reset post array
                    header("Location:./investment.php?id=" . $$userId);
                    exit();
               }
          }
          if ($action == 'end' && $user) {
               $investment = $db->SelectOne("SELECT * FROM investments WHERE id = :id", ['id' => $_POST['id']]);
               if ($investment) {
                    $currentBalance = $user['balance'] + $investment['profit'] + $investment['amount_invested'];
                    $totalProfit = $user['total_profit'] + $investment['profit'];
                    $db->Update("UPDATE users SET balance = :bal, total_profit = :totalP WHERE user_id = :uid", ['bal' => $currentBalance, 'totalP' => $totalProfit, 'uid' => $user['user_id']]);
                    $db->Remove("DELETE FROM investments WHERE id = :id", ['id' => $_POST['id']]);
                    $_SESSION['success'] = true;
                    $_SESSION['msg'] = "Investment has been updated successfully";
               }
          }
     }
}

//render the form 
$investments = $db->SelectAll("SELECT *, investments.id AS investment_id FROM investments INNER JOIN package ON package.id = investments.package_id WHERE investments.user_id = :user", ["user" => $userId]);

require "header.php";
?>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Users Investment</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Update Investment</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="container-fluid p-3">
          <div class="row mb-3">
               <div class="col-4">&nbsp;</div>
               <div class="col-8 text-end">
                    <a href="<?php print('./add-investment.php?id=' . $userId) ?>" class="btn btn-info mb-2 mb-md-0">
                         Add new Investment </a>
               </div>
          </div>
          <div class="table-responsive">
               <table class="table mb-0 table-striped table-hover">
                    <thead>
                         <tr>
                              <th>#</th>
                              <th>Investments Name</th>
                              <th>Amount </th>
                              <th>Profit</th>
                              <th>Date</th>
                              <th colspan="2" class="text-center">Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         if ($investments && count($investments)) {
                              foreach ($investments as $i => $investment) {
                         ?>
                                   <tr>
                                        <th scope="row">
                                             <?php echo ++$i; ?>
                                        </th>
                                        <td>
                                             <?php print(stripslashes($investment['package_name'])); ?>
                                        </td>
                                        <td>
                                             <?php print(stripslashes($investment['amount_invested'])); ?>
                                        </td>
                                        <td>
                                             <?php print(stripslashes($investment['profit'])); ?>
                                        </td>
                                        <td>
                                             <?php print(stripslashes(date('d-m-y', $investment['date']))); ?>
                                        </td>
                                        <td class="text-center">
                                             <a href=" <?php print('./update-investment.php?id=' . $investment['investment_id']) ?>">
                                                  <button class="btn btn-success mb-2 mb-md-0 mt-4">Update</button>
                                             </a>
                                             <form method="post" onsubmit="return confirm('Are you sure you want to close this investment and automatically grant user balance and profit?')" class="d-inline">
                                                  <input type="hidden" name="id" value="<?php echo $investment['investment_id']; ?>">
                                                  <input type="hidden" name="action" value="end" />
                                                  <button class="btn btn-danger mt-4">End</button>
                                             </form>
                                             <form method="post" onsubmit="return confirm('Are you sure that you want to delete this package?')" class="d-inline">
                                                  <input type="hidden" name="id" value="<?php echo $investment['investment_id']; ?>">
                                                  <input type="hidden" name="action" value="del-package" />
                                                  <button class="btn btn-danger mt-4"> Delete</button>
                                             </form>
                                        </td>
                                   </tr>
                              <?php }
                         } else { ?>
                              <td colspan="10" class="text-center">
                                   No Investment
                              </td>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>

     <!-- Page Footer-->
     <?php require 'footer.php' ?>
</div>
</div>
</div>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script>
     document.addEventListener('DOMContentLoaded', function() {
          const myForm = new octaValidate('form_new_package')
          $('#form_new_package').on('submit', (e) => {
               e.preventDefault()
               if (myForm.validate()) {
                    e.currentTarget.submit()
               }
          });
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