<?php
require_once('app.php');
$user_Id = $_SESSION['user_id'];

try {
     $investments = $db->SelectAll(
          "SELECT * FROM investments INNER JOIN package ON package.id = investments.package_id WHERE investments.user_id = :uid",
          [
               'uid' =>
               $user_Id
          ]
     );
} catch (Exception $e) {
     error_log($e);
     $_SESSION['success'] = false;
     $_SESSION['msg'] = "A server error has occured";
     header("Location: ./index.php");
     exit();
}

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

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "updateProfile") {
     $result = $db->Update(
          "UPDATE users SET first_name = :fullName, phone = :phone, last_name = :lastN, city = :city, state = :state, country = :country ,address = :address  WHERE user_id = :id",
          [
               'fullName' => $_POST['fullName'],  'phone' => $_POST['phone'], 'lastN' => $_POST['lastN'], 'city' => $_POST['city'],
               'state' => $_POST['state'], 'country' => $_POST['country'], 'address' => $_POST['address'], 'id' => $user_Id
          ]
     );
     if ($result) {
          # code...
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Update successfully";
          header("Location:./profile.php");
          exit();
     } else {
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Update not successfully";
          header("Location:./profile.php");
          exit();
     }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "updatePass") {
     $result = $db->Update(
          "UPDATE users SET password = :password WHERE user_id = :id",
          ['password' => $_POST['pass'], 'id' => $user_Id]
     );
     if ($result) {
          # code...
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Paassword Updated successfully";
          header("Location:./profile.php");
          exit();
     } else {
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Update not successfully";
          header("Location:./profile.php");
          exit();
     }
}
include("header.php");
?>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Account</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Profile</li>
                    </ol>
               </nav>
          </div>
     </div>
     <!-- Charts Section-->
     <section class="charts">
          <div class="container-fluid">
               <div class="row gy-4 align-items-stretch">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                         <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Profile Settings</button>
                         </li>
                         <li class="nav-item" role="presentation">
                              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Password Details</button>
                         </li>
                         <!-- <li class="nav-item" role="presentation">
                              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Others</button>
                         </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                         <!-- first tab -->
                         <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                              <div class="card mb-0">
                                   <div class="card-header">
                                        <div class="card-close">
                                             <div class="dropdown">
                                                  <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                             </div>
                                        </div>
                                        <h3 class="h4 mb-0">Profile Settings</h3>
                                        <p>Here are the list of your investment please note you can also invest in more than one page</p>
                                   </div>
                                   <div class="card-body">
                                        <?php
                                        $results = $db->SelectAll("SELECT * FROM users WHERE user_id = :userId", ['userId' => $user_Id]);
                                        if ($results && count($results)) {
                                             foreach ($results as $i => $result) {
                                        ?>

                                                  <div class="row">
                                                       <div class="col-sm-12 col-md-6">
                                                            <form method="post" action="">
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">Email</label>
                                                                      <input type="text" id="disabledTextInput" class="form-control input-sm" placeholder="<?= $result['email'] ?>" disabled>
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">First Name</label>
                                                                      <input type="text" name="fullName" class="form-control" value="<?= $result['first_name'] ?>">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">Phone</label>
                                                                      <input type="text" name="phone" class="form-control" value="<?= $result['phone'] ?>">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">last Name</label>
                                                                      <input type="text" name="lastN" class="form-control" value="<?= $result['last_name'] ?>">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">Address</label>
                                                                      <input type="text" name="address" class="form-control" value="<?= $result['address'] ?>">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">City</label>
                                                                      <input type="text" name="city" class="form-control" value="<?= $result['city'] ?>">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">County</label>
                                                                      <input type="text" name="country" class="form-control" value="<?= $result['country'] ?>">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="disabledTextInput" class="form-label">State</label>
                                                                      <input type="text" name="state" class="form-control" value="<?= $result['state'] ?>">
                                                                 </div>
                                                                 <input type="hidden" name="action" value="updateProfile">
                                                                 <input type="submit" class="btn btn-primary" value="Update">
                                                            </form>
                                                       </div>
                                                       <div class="col-sm-12 col-md-6">
                                                            <?php if (isset($investments) && count($investments)) { ?>
                                                                 <div class="table-responsive">
                                                                      <table class="table mb-0 table-striped table-hover">
                                                                           <thead>
                                                                                <tr>
                                                                                     <th>#</th>
                                                                                     <th>Package name</th>
                                                                                     <th>Amount Invested</th>
                                                                                     <th>Date</th>
                                                                                </tr>
                                                                           </thead>
                                                                           <tbody>
                                                                                <?php foreach ($investments as $i => $investment) { ?>
                                                                                     <tr>
                                                                                          <th scope="row">
                                                                                               <?php echo ++$i; ?>
                                                                                          </th>
                                                                                          <td>
                                                                                               <?php print(stripslashes($investment['package_name'])) ?>
                                                                                          </td>
                                                                                          <td>
                                                                                               <?php print(stripslashes($investment['amount_invested'])) ?>
                                                                                          </td>
                                                                                          <td>
                                                                                               <?php print(date('D d M, Y', $investment['date'])) ?>
                                                                                          </td>
                                                                                     </tr>
                                                                                <?php } ?>
                                                                           </tbody>
                                                                      </table>
                                                                 </div>
                                                            <?php } else { ?>

                                                                 <div class="text-center" style="font-size: 1.2rem;">
                                                                      <p><i class="fa-4x fas fa-exclamation-triangle text-warning"></i></p>
                                                                      <p>You have not subscribed to any plan. <br /> <a href="./plans.php">Subscribe now?</a></p>
                                                                 </div>
                                                            <?php } ?>
                                                       </div>
                                                  </div>
                                        <?php
                                             }
                                        }
                                        ?>
                                   </div>
                              </div>
                         </div>

                         <!-- Second Tab  -->
                         <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                              <div class="card mb-0">
                                   <div class="card-header">
                                        <div class="card-close">
                                             <div class="dropdown">
                                                  <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                             </div>
                                        </div>
                                        <h3 class="h4 mb-0">Change Password</h3>
                                   </div>
                                   <div class="card-body">
                                        <form method="post" action="" id="form_upd_pass">

                                             <div class="row">
                                                  <div class="col-sm-12">
                                                       <div class="mb-3">
                                                            <label>New Password</label>
                                                            <input autocomplete="off" name="pass" id="inp_pass" type="password" class="form-control" placeholder="Enter new password" octavalidate="R" />
                                                       </div>
                                                       <div class="mb-3">
                                                            <label>Confirm password</label>
                                                            <input autocomplete="off" id="inp_conpass" type="password" class="form-control" placeholder="Re-enter password" equalto="inp_pass" octavalidate="R" ov-equalto:msg="Both passwords do not match" />
                                                       </div>
                                                  </div>
                                                  <input type="hidden" name="action" value="updatePass">
                                             </div>
                                             <input type="submit" class="btn btn-primary" value="Update Password">

                                        </form>
                                   </div>
                              </div>
                         </div>

                         <!-- last tab -->
                         <!-- <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                              <div class="card mb-0">
                                   <div class="card-header">
                                        <div class="card-close">
                                             <div class="dropdown">
                                                  <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                             </div>
                                        </div>
                                        <h3 class="h4 mb-0">Your ROI history</h3>
                                   </div>
                                   <div class="card-body">
                                        <div class="table-responsive">
                                             <table class="table mb-0">
                                                  <thead>
                                                       <tr>
                                                            <th>Amount</th>
                                                            <th>Type</th>
                                                            <th>Plan/Nirration</th>
                                                            <th>Date</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <tr>
                                                            <th>$<?= $bonus ?></th>
                                                            <td>Bonus</td>
                                                            <td>Signup Bonus</td>
                                                            <td>Thu, Nov 17, 2022 12:41 PM</td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div> -->
                    </div>
               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <?php
     require "./footer.php";
     ?>
</div>
</div>
</div>
<script>
     document.addEventListener('DOMContentLoaded', function() {

          const myForm = new octaValidate('form_upd_pass')
          $('#form_upd_pass').on('submit', (e) => {
               e.preventDefault()
               if (myForm.validate()) {
                    e.currentTarget.submit()
               }
          })

          const myProfile = new octaValidate('form_upd_profile_image')
          $('#form_upd_profile_image').on('submit', (e) => {
               e.preventDefault()
               if (myProfile.validate()) {
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