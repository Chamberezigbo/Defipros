<?php
require('app.php');
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
                    <h2 class="page-title">Transactions</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<!-- Charts Section-->
<section class="charts">
     <div class="container-fluid">
          <div class="row gy-4 align-items-stretch">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                         <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Deposits</button>
                    </li>
                    <li class="nav-item" role="presentation">
                         <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Withdrawals</button>
                    </li>
                    <li class="nav-item" role="presentation">
                         <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Others</button>
                    </li>
               </ul>
               <div class="tab-content" id="myTabContent">
                    <!-- first tab -->
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                         <div class="card mb-0">
                              <div class="card-header">
                                   <h3 class="h4 mb-0" style="color:white !important;">Your ROI history</h3>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table mb-0">
                                             <thead>
                                                  <tr>
                                                       <th>Amount</th>
                                                       <th>Payment mode</th>
                                                       <th>Status</th>
                                                       <th>Date Created</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $results = $db->SelectAll("SELECT * FROM deposit WHERE user_id = :userId", ['userId' => $user_Id]);
                                                  if ($results && count($results)) {
                                                       foreach ($results as $i => $result) {
                                                  ?>
                                                            <tr>
                                                                 <th style="color:white !important">$<?= $result['amount'] ?></th>
                                                                 <td><?= $result['payment_mode'] ?></td>
                                                                 <td><?= $result['status'] ?></td>
                                                                 <td><?= $result['date'] ?></td>
                                                            </tr>
                                                       <?php
                                                       }
                                                  } else {
                                                       ?>
                                                       <td colspan="5" class="text-center">
                                                            <span class="text-danger">No data found</span>
                                                       </td>
                                                  <?php
                                                  };
                                                  ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- Second Tab  -->
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                         <div class="card mb-0">
                              <div class="card-header">
                                   <h3 class="h4 mb-0" style="color:white !important;">Your ROI history</h3>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table mb-0">
                                             <thead>
                                                  <tr>
                                                       <th>Amount</th>
                                                       <th>Payment Method</th>
                                                       <th>Status</th>
                                                       <th>Date</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
$results = $db->SelectAll("SELECT * FROM withdrawal WHERE user_id = :userId", ['userId' => $user_Id]);
                                                  if ($results && count($results)) {
                                                       foreach ($results as $i => $result) {
                                                  ?>
                                                            <tr>
                                                                 <th style="color:white !important">$<?= $result['amount'] ?></th>
                                                                 <td><?= $result['payment_mode'] ?></td>
                                                                 <td><?= $result['status'] ?></td>
                                                                 <td><?= $result['date'] ?></td>
                                                            </tr>
                                                       <?php
                                                       }
                                                  } else {
                                                       ?>
                                                       <td colspan="5" class="text-center">
                                                            <span class="text-danger">No data found</span>
                                                       </td>
                                                  <?php
                                                  };
                                                  ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- last tab -->
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                         <div class="card mb-0">
                              <div class="card-header">
                                   <h3 class="h4 mb-0" style="color:white !important;">Your ROI history</h3>
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
                                                  <?php
                                                  $results = $db->SelectAll("SELECT * FROM bonus WHERE userid = :userId", ['userId' => $user_Id]);
                                                  if ($results && count($results)) {
                                                       foreach ($results as $i => $result) {
                                                  ?>
                                                            <tr>
                                                                 <th style="color:white !important">$<?= $result['amount'] ?></th>
                                                                 <th style="color:white !important"><?= 'Bonus' ?></th>
                                                                 <td><?= $result['nirration'] ?></td>
                                                                 <td><?= date('d-m-y', $result['date'])  ?></td>
                                                            </tr>
                                                       <?php
                                                       }
                                                  } else {
                                                       ?>
                                                       <td colspan="5" class="text-center">
                                                            <span class="text-danger">No data found</span>
                                                       </td>
                                                  <?php
                                                  };
                                                  ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

</div>
<?php
require('footer.php');
?>