<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                         <!-- start page title -->
                         <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
									<div class="col-lg-10 col-md-12 col-sm-12">
										<div class="">
                                            <h5> Production Planning Control  </h5>
										</div>
									</div><!-- end col-->
                                   
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Inventory Reduction</h4>
                                    </div>
                                    <div class="card-body">

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Product </th>
                                                    <th class="text-center"> Quantity </th>
                                                    <th class="text-center"> Unit </th>
                                                    <th class="text-center"> Process By </th>
                                                    <th class="text-center"> Date Added </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($restocks as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->product;?></td>
                                                    <td class="text-center"> <?= $i->quantity;?></td>
                                                    <td class="text-center"> <?= $i->unit;?></td>
                                                    <td class="text-center"> <?= $i->process_by;?></td>
                                                    <td class="text-center"> <?= $i->date_added;?></td>

                                                    <td class="text-center">
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#update<?= $i->id;?>"> Udpate </button>                       
                                                        <button class="btn btn-outline-danger waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#delete<?= $i->id;?>"> Delete </button>                       
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="update<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                              <form method="POST" action="<?= base_url("production/update-production-inventory");?>">
                                                                                    <div class="col-lg-12">
                                                                                    <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                    <input type="hidden" name="id"  value="<?php echo $i->id; ?>">

                                                                                        <div class="mb-3">
                                                                                            <label for="simpleinput" class="form-label">Category</label>
                                                                                            <select type="text" name="category" class="form-control" fdprocessedid="gm8jcl">
                                                                                                <option value=""> - Select Category - </option>
                                                                                                <?php foreach($category as $c){ ?>
                                                                                                    <?php if($i->category == $c->id) { ?>
                                                                                                      <option value="<?= $c->id;?>" selected> <?= $c->category;?></option>
                                                                                                    <?php }  else { ?>
                                                                                                      <option value="<?= $c->id;?>"> <?= $c->category;?></option>
                                                                                                    <?php } ?>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="example-email" class="form-label">Product Name</label>
                                                                                            <input type="text" id="product" name="product"  value="<?= $i->product;?>" class="form-control" >
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="example-email" class="form-label">Quantity </label>
                                                                                            <input type="text" id="quantity" name="quantity" value="<?= $i->quantity;?>" class="form-control">
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="example-palaceholder" class="form-label">Unit of Measurement</label>
                                                                                            <select type="text" name="unit" class="form-control" fdprocessedid="gm8jcl">
                                                                                                <option value=""> - Select Measurement - </option>
                                                                                                <?php if($i->unit == 'Kilo') { ?>
                                                                                                    <option value="Kilo" selected> Kilo </option>
                                                                                                    <option value="Pcs"> Pcs </option>
                                                                                                <?php }  else { ?>
                                                                                                    <option value="Kilo"> Kilo </option>
                                                                                                    <option value="Pcs" selected> Pcs </option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Process</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="modal fade" id="delete<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("production/delete-production-inventory-category");?>">
                                                                                        Are you sure to delete this data ?   
                                                                                    
                                                                                                <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                                <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">

                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="btn-process">Yes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                            
                                             <?php } ?>
                                             </tbody>
                                             </table>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

         
        </div>


        <script>
          

          $('#process-submit').submit(function(e) {

              $('.btn').prop('disabled', true);
              $('#btn-process').html('');
              $('#btn-process').html('<i class="fa fa-spinner fa-spin"></i> Processing ..');
              e.preventDefault();
          
              var product	  = $('#product_id').val();
              var quantity	  = $('#quantity').val();
              var unit	      = $('#unit').val();
 
              var csrf_token_1  = $("#csrf_token_1").val();

              setTimeout(function() {
                  $.ajax({
                      type: "POST",
                      url:  '../process-production-inventory-restock',
                      data: {

                          'product'    : product,
                          'quantity'   : quantity,
                          'unit'       : unit,
                          'csrf_token' : csrf_token_1,

                      },
                      success: function(data) {
                          $('#btn-process').html('Success');
                          setTimeout(function() {
                              Swal.fire({
                                  icon: "success",
                                  title: "Inventory Restock Added",
                                  text: "Added!",
                                  customClass: {
                                      confirmButton: "btn btn-primary waves-effect waves-light"
                                  },
                                  buttonsStyling: !1
                              })
                              setTimeout(function() {  window.location.reload(); }, 2000);
                          
                          }, 1000);
                      }
          
                  });
              }, 3000);
              
          });
      
      </script>