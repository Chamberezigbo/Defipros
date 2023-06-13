<?php
require_once('app.php');
include('header.php');
?>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Your ROI history</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">History</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="tables">
          <div class="container-fluid">
               <div class="row gy-4">
                    <div class="col-lg-12">
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
                                                       <th>Plan</th>
                                                       <th>Amount</th>
                                                       <th>Type</th>
                                                       <th>Date Created</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <td>

                                                       </td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                        <p class="text-center">
                                             No data
                                        </p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <?php
     require_once './footer.php';
     ?>
</div>
</div>