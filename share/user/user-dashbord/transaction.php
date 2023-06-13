<?php
require_once('app.php');
include "header.php";
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
                         <li class="breadcrumb-item active fw-light" aria-current="page">Transactions on your account</li>
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
                                                                      <th><?= $result['amount'] ?></th>
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
                                                            <th>#</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Username</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php
                                                       $results = $db->SelectAll("SELECT * FROM deposit WHERE user_id = :userId", ['userId' => $user_Id]);
                                                       if ($results && count($results)) {
                                                            foreach ($results as $i => $result) {
                                                       ?>
                                                                 <tr>
                                                                      <th><?= $result['amount'] ?></th>
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
                                                       <?php
                                                       $results = $db->SelectAll("SELECT * FROM bonus WHERE userid = :userId", ['userId' => $user_Id]);
                                                       if ($results && count($results)) {
                                                            foreach ($results as $i => $result) {
                                                       ?>
                                                                 <tr>
                                                                      <th><?= $result['amount'] ?></th>
                                                                      <th><?= 'Bonus' ?></th>
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
     <!-- Page Footer-->
     <?php
     require "./footer.php";
     ?>
</div>
</div>
</div>