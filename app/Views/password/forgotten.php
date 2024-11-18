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
                <div class="col-lg-3 col-sm-3"></div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card mt-5" style="border-radius: 10px!important;">
                           <div class="card-header">
                                <h1 class="card-title text-uppercase"><strong> Réinitialisation  <br/>du MOT DE PASSE</strong></h1>
                                <div class="card-tools">
                                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><span class="fa fa-home"></span> Accueil</a></li>
                        <li class="breadcrumb-item active">Mot de passe</li>
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

                                <?php if (isset($session->success)): ?>
                                    <div class="container">
                                        
                                                <div class="alert alert-success text-center text-uppercase">
                                                    <span class="fa fa-check-circle"> </span> <?= $session->getFlashdata('success'); ?>
                                                </div>
                                                <a href="<?= base_url('password/forgotten'); ?>" class="btn btn-outline-danger btn-xs text-uppercase">
                                                    Email non recu ?
                                                </a>
                                            </div>
                                    <?php else: ?>

                                    <h5 class="text-primary  text-center small text-uppercase">
                                        <i class="fa fa-info-circle"></i>
                                        Veuillez saisir votre adresse mail ci-dessous liee a votre compte de cette application pour reinitialiser votre mot de passe.
                                    </h5>
                                <?php
                                $attibustes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(site_url('password/reset'), $attibustes);
                                ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    <input type="email" class="form-control-lg form-control <?= $validation->hasError('email') ? ' is-invalid' : '' ?>" placeholder="Votre adresse mail" name="email" autocomplete="off">
                                    <div class="input-group-append">
                                            <button href="#" class="btn btn-info">
                                                REINITIALISER
                                            </button>
                                       
                                    </div>

                                    <?php if (isset($validation)) {
                                        if ($validation->hasError('email')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('email') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                            <?= form_close(); ?>
                             <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3"></div>
            </div>
        </div>
    </div>
</filiere></div>
