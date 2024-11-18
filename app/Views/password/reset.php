<?php
$validation = \Config\Services::validation();
$session = \Config\Services::session();
?>
<!-- ##### Breadcumb Area Start ##### -->
<div class="content-wrapper">
<filiere class="content">
    <div class="container">
        <div class="form-holder has-shadow mt-5">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-2 col-sm-2"></div>
                <div class="col-lg-8 col-sm-8">
                    <div class="card mt-5" style="border-radius: 10px!important;">
                            <div class="card-header">
                                <h1 class="card-title text-uppercase"><strong> Récupération <br/> du MOT DE PASSE</strong></h1>
                                <div class="card-tools">
                                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><span class="fa fa-home"></span> Accueil</a></li>
                        <li class="breadcrumb-item active">Code</li>
                    </ol>
                                </div>
                            </div>
                            <div class="card-body">
                                       
                                <?php if (isset($session->failed) OR isset($failed)): ?>
                                    <div class="alert alert-danger" id="hiddenmsg">
                                        <h3 class="text-center small text-uppercase">
                                            <?= (! empty($failed))? $failed : $session->failed; ?>
                                        </h3>
                                    </div>
                               
                                <?php endif; ?>

                                <?php if (isset($session->success) OR isset($success)): ?>
                                    <div class="container">
                                        
                                                <div class="alert alert-success text-center text-uppercase">
                                                    <span class="fa fa-check-circle"> </span> 
                                                    <?= (!empty($success))? $success : $session->getFlashdata('success'); ?>
                                                </div>
                                                
                                            </div>
                                    <?php else: ?>

                                    <h5 class="text-primary  text-center small text-uppercase">
                                        <i class="fa fa-info-circle"></i>
                                        Veuillez saisir le code de reinitialisation de votre mot de passe  que vous avez recu 
                                    </h5>
                                     <?php endif; ?>
                                <?php
                                $attibustes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(site_url('password/checkTokenReset'), $attibustes);
                                ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control-lg form-control <?= $validation->hasError('code_reset') ? ' is-invalid' : '' ?>" placeholder="Code reset" name="code_reset" autocomplete="off">
                                    <div class="input-group-append">
                                            <button href="#" class="btn btn-info">
                                                CONFIRMER
                                            </button>
                                       
                                    </div>

                                    <?php if (isset($validation)) {
                                        if ($validation->hasError('code_reset')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('code_reset') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                            <?= form_close(); ?>
                            <a href="<?= base_url('password/forgotten'); ?>" class="btn btn-outline-danger btn-xs text-uppercase"> Code non recu ? </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2"></div>
            </div>
        </div>
    </div>
</filiere></div>
