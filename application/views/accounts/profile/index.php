
<div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                         <!-- start page title -->
                         <div class="row justify-content-center">
                         <div class="col-6">
                                <div class="page-title-box">
									<div class="col-lg-10 col-md-12 col-sm-12">
										<div class="">
                                            <h5> My Profile  </h5>
										</div>
									</div><!-- end col-->
                                    
                                 
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        <div class="row justify-content-center">
                         <div class="col-lg-6 col-xl-6 col-sm-12 col-md-12">
                             <div class="card">
                                    <div class="card-body">
                                    <?php if(isset($_GET['updated'])){
                                    echo '<div class="alert alert-primary" role="alert">
                                                <strong>Success! </strong> Information Updated!
                                            </div>';
                                     }
                                      ?>
                                    <form  action="<?= base_url("profile/update-profile");?>" method="POST">
											<div class="row g-6  mb-6">
												<h4> Personal Information </h4>
                                                <hr>
												  <div class="col-md-6 mb-3">
													 <label class="form-label">Full Name</label>
                                                     <input type="hidden"  class="form-control" name="id" value="<?= $this->session->userdata['logged_in']['user_id'];?>" required>
                                                     <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                     <input type="text"  class="form-control" name="fullname" value="<?= $profile[0]->fullname;?>" required>
												  </div>
												 
											</div>

											<div class="row g-6  mb-6">
												  <div class="col-md-6 mb-3">
													  <label class="form-label">Contact Number</label>
													  <input type="text"  class="form-control" name="contact_no"  value="<?= $profile[0]->contact_no;?>"  required>
												  </div>
												   <div class="col-md-6 mb-3">
													  <label class="form-label">Email Address</label>
													  <input type="text" class="form-control" name="email" value="<?= $profile[0]->email;?>" required>
												  </div>
											</div>

											<div class="row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Detailed Address</label>
													<input type="text" class="form-control" name="address"  value="<?= $profile[0]->address;?>"required>
												</div>
											</div>

                                            <div class="row g-6  mb-6">
												  <div class="col-md-6 mb-3">
													  <label class="form-label">Birth Date</label>
													  <input type="date"  class="form-control" name="birthdate"  value="<?= $profile[0]->birthdate;?>"  required>
												  </div>
												   <div class="col-md-6 mb-3">
													  <label class="form-label">Age</label>
													  <input type="text" class="form-control" name="age" value="<?= $profile[0]->age;?>" required>
												  </div>
											</div>

                                            <div class="row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Incase of Emegency</label>
													<input type="text" class="form-control" name="incase_emegency"  value="<?= $profile[0]->incase_emegency;?>"required>
												</div>
											</div>
										
										
										  <div id="process-add-item"></div>
										  <button type="submit" id="btn-add" class="btn btn-outline-dark waves-effect waves-light" >Update</button>

										</form>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->

                            
			
                        </div>
                        <!-- end row-->

                                
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-xl-6 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                    <?php if(isset($_GET['password-updated'])){
                                    echo '<div class="alert alert-primary" role="alert">
                                                <strong>Success! </strong> Password Updated!
                                            </div>';
                                     }
                                      ?>
                                    <form  action="<?= base_url("profile/update-password");?>" method="POST">
											<div class="row g-6  mb-6">
												<h4> Change Password </h4>
                                                <hr>
												  <div class="col-md-6 mb-3">
													 <label class="form-label">Enter Current Password</label>
                                                     <input type="hidden"  class="form-control" name="id" id="id" value="<?= $this->session->userdata['logged_in']['user_id'];?>" required>
                                                     <input type="hidden" name="csrf_token" id="csrf_token_1" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                     <input type="password"  class="form-control" id="current_password" value="" required>
                                                     <div id="error-password"></div>
												  </div>
												
											</div>

											<div class="row g-6  mb-6">
												  <div class="col-md-6 mb-3">
                                                  <label class="form-label">Enter New Password</label>
                                                  <input type="password"  class="form-control" name="password" id="new_password" value="" required disabled>
												  </div>
												
											</div>

										
										  <div id="process-add-item"></div>
										  <button type="submit" id="btn-add" class="btn btn-outline-dark waves-effect waves-light" >Update</button>

										</form>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->

                            
			
                        </div>
                        <!-- end row-->
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

         
        </div>
    

        <script>

            $('#current_password').on('change', function() {

            var csrf_token_1  = $("#csrf_token_1").val();
            var id            = $("#id").val();
            
            $.ajax({
                url: 'check-password',
                type: 'POST',
                data: {
                    'password'            : this.value,
                    'id'                  : id,
                    'csrf_token'          : csrf_token_1,
                },
                success: function(response) {
                    if(response == 1){
                        $("#new_password").prop("disabled", false)
                        $("#error-password").html("");
                    } else{
                        $("#new_password").prop("disabled", true)
                        $("#error-password").html("<font color=red> Password not match to your current password! </font>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
            });

        </script>