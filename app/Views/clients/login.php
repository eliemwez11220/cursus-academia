<?php
$validation = \Config\Services::validation();
$session = \Config\Services::session();
?>

<filiere class="mt-5">
    <div class="container">
        <div class="form-holder has-shadow mt-5">
            
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                         
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card mt-5" style="border-radius: 10px!important;">
                            <div class="card-header">
                                <div class="card-title">
                                <span class="float-left">
                                    <a href="<?= base_url(); ?>">
                                    <img src="<?= site_url('global/logo/favicon.png'); ?>" alt="Logo"
                                         style="border-radius:100px; height:50px;"></a>
                                </span>
                                </div>
                                <div class="card-tools">
                                    <div class="float-right">
                                        <h1 class="d-none d-sm-block text-uppercase"><strong>Eduschool</strong></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if (isset($session->success)): ?>
                                    <div class="container" id="hiddenmsg">
                                        
                                                <div class="alert alert-success text-center text-uppercase">
                                                    <span class="fa fa-check-circle"> </span> <?= $session->getFlashdata('success'); ?>
                                                </div>
                                            </div>
                                       
                                <?php endif; ?>
                                <?php if (isset($session->failed)): ?>
                                    <div class="alert alert-danger" id="hiddenmsg">
                                        <h3 class="text-center small text-uppercase">
                                            <?= $session->failed; ?>
                                        </h3>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $attibustes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(site_url('secure/login'), $attibustes);
                                ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <input type="text" name="username" id="username" autocomplete="off"
                                           class="form-control-lg form-control <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                           placeholder="Saisissez votre Email ou Identifiant"
                                           value="<?= set_value('username'); ?>" autofocus>
                                    
                                    <?php if (isset($validation)) {
                                        if ($validation->hasError('username')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('username') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    <input type="password" name="password" id="password" autocomplete="off"
                                           class="form-control-lg form-control <?= $validation->hasError('password') ? ' is-invalid' : '' ?>"
                                           placeholder="Saisissez votre mot de passe">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <button type="button" onclick="showPassword();" class="btn btn-default btn-sm">
                                                <i class="fa fa-eye"></i></button>           
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (isset($validation)) {
                                        if ($validation->hasError('password')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('password') : ''; ?></span>
                                        <?php }
                                    } ?>
                               
                                <div class="form-group">
                                    <div class="d-inline">
                                        <button type="submit" class="font-weight-bold btn btn-info text-uppercase">
                                        Ouvrir session
                                    </button>
                                        <span class="text-right float-right">
                                            <a href="<?= base_url('password/forgotten'); ?>"
                                               class="small text-uppercase btn btn-default"><b>Mot de passe oublie?</b></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</filiere>
