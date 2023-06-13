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

$users = $db->SelectAll("SELECT * FROM users WHERE referral IS NOT NULL ", []);
require('header.php');
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
               <?php if (isset($users) && count($users)) { ?>
                    <div class="table-responsive">
                         <table class="table mb-0 table-striped table-hover">
                              <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Referral</th>
                                        <th colspan="2">Action</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   foreach ($users as $i => $user) {
                                   ?>
                                        <tr>
                                             <th scope="row"><?php echo ++$i; ?></th>
                                             <td><?php print(stripslashes($user['fullName'])) ?></td>
                                             <td><?php print(stripslashes($user['email'])) ?></td>
                                             <td><?php print(stripslashes($user['referral'])) ?></td>
                                             <td>
                                                  <a href="<?php print('./downlines.php?id=' . $user['referral']) ?>" class="btn btn-info">View Down Lines</a>
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
     <?php require_once('./footer.php'); ?>
</div>
</div>
</div>