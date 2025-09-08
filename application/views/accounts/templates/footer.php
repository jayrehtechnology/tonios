           <!-- Footer Start -->
           <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; <a href="">TONIO'S SISIG</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                  DEVELOPED BY JAYREH TECHNOLOGY
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
         
<!-- Right bar overlay-->

<!-- Vendor js -->


   <!-- third party js -->
<script src="<?= base_url(); ?>assets/js/lib/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/buttons.bootstrap5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/js/lib/datatables/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="<?= base_url(); ?>assets/js/lib/datatables/database-init.js"></script>

<!-- App js-->
<script src="https://stockist.my/assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="https://stockist.my/assets/libs/autonumeric/autoNumeric.min.js"></script>
<script src="https://stockist.my/assets/js/pages/form-masks.init.js"></script>
<script src="<?= base_url(); ?>assets/js/app.min.js"></script>

<script>
 $('#table-1').DataTable({
    language: {
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'>",
            next: "<i class='mdi mdi-chevron-right'>"
        }
    },
    drawCallback: function() {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
    }
  });
</script>

<script>
    $('#finish_products').DataTable({
        order: [[3, 'desc']] // ← index starts at 0
    });
</script>
