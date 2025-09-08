
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
                                            <h5> Sales Management </h5>
										</div>
									</div><!-- end col-->
                                   
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row">
                            <div class="col-12">
                            <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-primary"><?= $this->session->flashdata('success'); ?></div>
                                <?php endif; ?>
                                <div class="card">
                                    <div class="card-header bg-danger">
                                        <h4 class="card-title text-white mb-0">Credit Collection List</h4>
                                    </div>
                                    <div class="card-body">

                                           <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row">
                                            <div class="row"><div class="col-sm-12">
                                            <table id="table-1" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>

                                                    <th class="text-center"> Transaction Code </th>
                                                    <th class="text-center"> Customer Name </th>
                                                    <th class="text-center"> Credit Amount  </th>
                                                    <th class="text-center"> Paid Amount </th>
                                                    <th class="text-center"> Action </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($collection as $i){ ?>
                                                <tr>
                                                    <td class="text-center"> <?= $i->trans_code;?></td>
                                                    <td class="text-center"> <?= $i->customer_name;?></td>
                                                    <td class="text-center"> <?= number_format($i->amount,2);?></td>
                                                    <td class="text-center"> <?= $i->paid_amount;?></td>
                                                    <td class="text-center">
                                                    <?php if($i->assigned_logistics != 0){
                                                        
                                                         $this->db->select('*');
                                                         $this->db->from('tonios_employee ');
                                                         $this->db->where("id" , $i->assigned_logistics);
                                                 
                                                         $query1 = $this->db->get();

                                                         foreach($query1->result() as $ii){

                                                            echo "<b> Assigned Collection to : </b> " . $ii->fullname ."<br><br>";
                                                         }

                                                        }?>
                                                        <?php if($this->session->userdata['logged_in']['department'] == 'Sales'){?> 
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#assign<?= $i->id;?>"> Assign to Logistics </button>                       
                                                        <?php } ?>
                                                        <button class="btn btn-outline-dark waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#activate<?= $i->id;?>"> Records </button>                       
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="assign<?= $i->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Assign Collection - <?= $i->trans_code;?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                            <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <form method="POST" action="<?= base_url("sales/process-assigned-collection");?>" class="process_assign">
                                                                                        <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                                                        <input type="hidden" name="id" class="form-control" value="<?= $i->id;?>">
                                                                                        <div class="mb-3">
                                                                                        <label for="simpleinput" class="form-label">Select Logistic </label>
                                                                                        <select type="text" name="logistic_id" class="form-control"required>
                                                                                            <option value=""> - Select Logistic - </option>
                                                                                            <?php foreach($logistics as $a){ ?>
                                                                                                <option value="<?= $a->id;?>" data-id="<?= $a->fullname;?>"> <?= $a->fullname;?> </option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    </div> <!-- end col -->
                                                                                </div>                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light"  data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-outline-dark waves-effect waves-light btn_assign">Process</button>
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
        $(document).ready(function() {

            $(".process_assign").submit(function() {
                $(".btn_assign").prop("disabled", true).text("Processing...");
            });

        });
    </script>