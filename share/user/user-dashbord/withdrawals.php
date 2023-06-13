<?php
require_once('app.php');
include  "header.php";
?>
<style>
     .fs-custom {
          font-size: 13px;
     }
</style>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Request for Withdrawal</h2>
          </div>
     </header>
     <!-- Forms Section-->
     <section class="forms">
          <div class="container-fluid">
               <div class="row">
                    <!-- Horizontal Form-->
                    <div class="col-lg-4">
                         <div class="card">
                              <div class="card-header">
                                   <div class="card-close">
                                        <div class="dropdown">
                                             <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                             <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#">
                                                       <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <h1 class="text-center">USDT</span></h1>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Minimum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$100</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Maximum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$10000000</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charge Type:</p>
                                        <p class="card-text ms-auto fs-custom">pecentage</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charges Amount:</p>
                                        <p class="card-text ms-auto fs-custom">0%</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Duration:</p>
                                        <p class="card-text ms-auto fs-custom"></p>
                                   </div>
                                   <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button"><a class="text-light" href="withdraw-funds.php">+Request Withdraw</a></button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Inline Form-->

                    <!-- Horizontal Form-->
                    <div class="col-lg-4">
                         <div class="card">
                              <div class="card-header">
                                   <div class="card-close">
                                        <div class="dropdown">
                                             <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                             <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#">
                                                       <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <h1 class="text-center">Bitcoin Cash</span></h1>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Minimum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$100</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Maximum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$10000000</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charge Type:</p>
                                        <p class="card-text ms-auto fs-custom">pecentage</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charges Amount:</p>
                                        <p class="card-text ms-auto fs-custom">0%</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Duration:</p>
                                        <p class="card-text ms-auto fs-custom"></p>
                                   </div>
                                   <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button"><a class="text-light" href="withdraw-funds.php">+Request Withdraw</a></button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Inline Form-->

                    <!-- Horizontal Form-->
                    <div class="col-lg-4">
                         <div class="card">
                              <div class="card-header">
                                   <div class="card-close">
                                        <div class="dropdown">
                                             <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                             <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#">
                                                       <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <h1 class="text-center">Doge</span></h1>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Minimum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$100</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Maximum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$10000000</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charge Type:</p>
                                        <p class="card-text ms-auto fs-custom">pecentage</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charges Amount:</p>
                                        <p class="card-text ms-auto fs-custom">0%</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Duration:</p>
                                        <p class="card-text ms-auto fs-custom"></p>
                                   </div>
                                   <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button"><a class="text-light" href="withdraw-funds.php">+Request Withdraw</a></button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Inline Form-->

                    <!-- Horizontal Form-->
                    <div class="col-lg-4">
                         <div class="card">
                              <div class="card-header">
                                   <div class="card-close">
                                        <div class="dropdown">
                                             <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                             <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#">
                                                       <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <h1 class="text-center">Litecoin</span></h1>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Minimum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$100</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Maximum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$10000000</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charge Type:</p>
                                        <p class="card-text ms-auto fs-custom">pecentage</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charges Amount:</p>
                                        <p class="card-text ms-auto fs-custom">0%</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Duration:</p>
                                        <p class="card-text ms-auto fs-custom"></p>
                                   </div>
                                   <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button"><a class="text-light" href="withdraw-funds.php">+Request Withdraw</a></button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Inline Form-->

                    <!-- Horizontal Form-->
                    <div class="col-lg-4">
                         <div class="card">
                              <div class="card-header">
                                   <div class="card-close">
                                        <div class="dropdown">
                                             <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                             <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#">
                                                       <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <h1 class="text-center">Ethereum</span></h1>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Minimum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$100</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Maximum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$10000000</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charge Type:</p>
                                        <p class="card-text ms-auto fs-custom">pecentage</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charges Amount:</p>
                                        <p class="card-text ms-auto fs-custom">0%</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Duration:</p>
                                        <p class="card-text ms-auto fs-custom"></p>
                                   </div>
                                   <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button"><a class="text-light" href="withdraw-funds.php">+Request Withdraw</a></button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Inline Form-->

                    <!-- Horizontal Form-->
                    <div class="col-lg-4">
                         <div class="card">
                              <div class="card-header">
                                   <div class="card-close">
                                        <div class="dropdown">
                                             <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                             <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#">
                                                       <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <h1 class="text-center">Bitcoin</span></h1>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Minimum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$100</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Maximum Amount:</p>
                                        <p class="card-text ms-auto fs-custom">$10000000</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charge Type:</p>
                                        <p class="card-text ms-auto fs-custom">pecentage</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Charges Amount:</p>
                                        <p class="card-text ms-auto fs-custom">0%</p>
                                   </div>
                                   <div class="d-flex">
                                        <p class="card-text fs-custom">Duration:</p>
                                        <p class="card-text ms-auto fs-custom"></p>
                                   </div>
                                   <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button"><a class="text-light" href="withdraw-funds.php">+Request Withdraw</a></button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Inline Form-->
               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <?php
     require 'footer.php'
     ?>
</div>
</div>
</div>