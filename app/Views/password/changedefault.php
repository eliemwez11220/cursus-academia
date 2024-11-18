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
                                <div class="card-title">
                                 <div class="d-inline">

                <img src="<?= ($session->get('usravatar') != '') ? $session->get('usravatar') : site_url('global/img/avatar.png'); ?>"
                     alt="Avatar" class="img-circle"
                     style="border-radius: 10px!important; width: 50px!important; height: 50px!important;"/>
        
                 <span class="text-uppercase small">
                        <?= $session->get('usrname') ?>
                    </span>
            </div>
            </div>
                                <div class="card-tools">
                                    <div class="float-right">
                                        <div class="d-inline">
                                    <a href="<?= base_url(); ?>"  data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour revenir a la page d'accueil">
                                    <img src="<?= site_url('global/logo/favicon.png'); ?>" alt="Logo"
                                         style="border-radius:100px; height:50px;">
										 <span class="text-uppercase small">MOT DE PASSE</span>
                                     </a>
									 </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                      
                                <?php if (isset($session->failed) OR isset($failed)): ?>
                                    <div class="alert alert-danger" id="hiddenmsg">
                                        <h3 class="text-center small text-uppercase">
                                            <?= (! empty($failed))? $failed : $session->failed; ?>
                                        </h3>
                                    </div>
                               <?php elseif (isset($session->info) OR isset($info)): ?>
                                    <div class="alert alert-danger" id="hiddenmsg">
                                        <h3 class="text-center small text-uppercase">
                                            <?= (! empty($info))? $info : $session->info; ?>
                                        </h3>
                                    </div>
                                <?php else: ?>
                                     <h5 class="text-primary small text-center text-uppercase">
                                        <i class="fa fa-info-circle"></i>
                                        Creez un nouveau mot de passe pour securiser votre compte et toutes vos donnees personnelles
                                    </h5>
                                <?php endif; ?>
                             <?php
                                $attibustes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(site_url('password/changeDefault'), $attibustes);
                                ?>
                                <div class="input-group mb-3">
                                    <input type="password" name="pass" class="form-control-lg form-control <?= $validation->hasError('pass') ? ' is-invalid' : '' ?>" placeholder="Nouveau mot de passe">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                     <?php if (isset($validation)) {
                                        if ($validation->hasError('pass')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('pass') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="cpass" class="form-control-lg form-control <?= $validation->hasError('cpass') ? ' is-invalid' : '' ?>" placeholder="Confirmer le nouveau mot de passe">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                        </div>
                                    </div>
                                     <?php if (isset($validation)) {
                                        if ($validation->hasError('cpass')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('cpass') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="text-center">
                                    <button href="#" class="btn btn-block btn-info btn-lg text-uppercase">
                                        CHANGER MOT DE PASSE
                                    </button>
                                </div>

                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2"></div>
            </div>
        </div>
    </div>
</filiere>
</div>
