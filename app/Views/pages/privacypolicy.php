<?php
    $validation = \Config\Services::validation();
    $session = \Config\Services::session();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
    <filiere class="content mt-5">
        <div class="container-fluid">
        <div class="mt-5">
		<!--<embed src="" type="application/pdf" controls
                                           style="height:50%!important;width:100%!important;">-->
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                         <div class="col-lg-12 col-sm-12">
						 
										   
                      <iframe src="<?= base_url('global/legale/privacy.pdf'); ?>#toolbar=0" width="100%" height="600px"></iframe>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</filiere>
</div>