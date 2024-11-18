<?php
    $validation = \Config\Services::validation();
    $session = \Config\Services::session();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
        <div class="form-holder has-shadow mt-5">
            <?php if (isset($admins)): ?>
            <!-- if sysadmin account exist -->
            <?php if ($admins >= 1): ?>
                <div class="row">
                    <div class="col-lg-3 col-sm-12"></div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card mt-5" style="border-radius: 10px!important;">
                            <div class="card-header">
							<div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold small card-title">Se Connecter a l'application</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><span class="fa fa-home"></span> Accueil</a></li>
                        <li class="breadcrumb-item active">Connexion</li>
                    </ol>
                </div>
            </div>
                            </div>
                            <div class="card-body">
                                <?php if (isset($session->success)): ?>
                                    <div class="container" id="hiddenmsg">
                                        <div class="alert alert-success text-center text-uppercase">
                                            <span class="fa fa-check-circle"> </span> 
                                            <?= $session->getFlashdata('success'); ?>
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
                                            <button type="button" onclick="showPassword();" class="btn btn-default btn-sm"> <i class="fa fa-eye"></i>
                                            </button>         
                                        </div>
                                    </div>
                                    <?php if (isset($validation)) {
                                        if ($validation->hasError('password')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('password') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="form-group">
                                    <div class="d-inline">
                                        <span class="text-left">
                                            <a href="<?= base_url('secure/guest'); ?>"
                                               class="small text-uppercase"><b>Accès étudiant</b></a>
                                        </span>
                                        <span class="text-right float-right">
                                            <a href="<?= base_url('password/forgotten'); ?>"
                                               class="small text-uppercase"><b>Mot de passe oublie?</b></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="font-weight-bold btn btn-default btn-block text-uppercase">
                                        Se connecter
                                    </button>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12"></div>
                </div>
            <?php else: ?>
            <div class="card" style="border-radius: 10px!important;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="container">
                                <?php if (isset($session->failed)): ?>
                                    <div class="alert alert-danger" id="hiddenmsg">
                                        <h3 class="text-center small text-uppercase">
                                            <?= $session->failed; ?>
                                        </h3>
                                    </div>  
                                <?php elseif (isset($session->success)): ?>
                                    <div class="alert alert-danger" id="hiddenmsg">
                                        <h3 class="text-center small text-uppercase">
                                            <?= $session->success; ?>
                                        </h3>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-info text-center">
                                        <h5>
                                            <span class="fa fa-info-circle"> </span>
                                            Veuillez configurer le compte administrateur systeme pour activer l'application
                                        </h5>
                                    </div>
                                <?php endif; ?>
                                <div class="float-left">
                                    <a href="<?= base_url(); ?>">
                                        <img src="<?= site_url('global/logo/favicon.png'); ?>" alt="Logo"
                                             style="border-radius:100px; height:50px;"></a>
                                </div>
                                <div class="float-right">
                                    <h1 class="d-none d-sm-block text-uppercase"><strong>Eduschool</strong></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <?php
                            $attibustes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(site_url('secure/createAdminAccount'), $attibustes);
                            $default = 'sysadmin'; ?>
                            <div class="input-group mb-3">
                                <input type="text" name="username" id="username" autocomplete="off"
                                       class="form-control-lg form-control <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                       placeholder="Pseudo login"
                                       value="<?= (! empty($default)) ? $default : set_value('username'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <?php if (isset($validation)) {
                                    if ($validation->hasError('username')) { ?>
                                        <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('username') : ''; ?></span>
                                    <?php }
                                } ?>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="fullname" id="fullname" autocomplete="off"
                                       class="form-control-lg form-control <?= ($validation->hasError('fullname')) ? ' is-invalid' : '' ?>"
                                       placeholder="Nom complet"
                                       value="<?= set_value('fullname'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <?php if (isset($validation)) {
                                    if ($validation->hasError('fullname')) { ?>
                                        <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('fullname') : ''; ?></span>
                                    <?php }
                                } ?>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" name="email" id="email" autocomplete="off"
                                       class="form-control-lg form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                       placeholder="Email Admin"
                                       value="<?= set_value('email'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <?php if (isset($validation)) {
                                    if ($validation->hasError('email')) { ?>
                                        <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('email') : ''; ?></span>
                                    <?php }
                                } ?>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password" autocomplete="off"
                                       class="form-control-lg form-control <?= $validation->hasError('password') ? ' is-invalid' : '' ?>"
                                       placeholder="Saisissez le mot de passe">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                                <?php if (isset($validation)) {
                                    if ($validation->hasError('password')) { ?>
                                        <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('password') : ''; ?></span>
                                    <?php }
                                } ?>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password_confirm" id="password_confirm" autocomplete="off"
                                       class="form-control-lg form-control <?= $validation->hasError('password_confirm') ? ' is-invalid' : '' ?>"
                                       placeholder="Confirmer le mot de passe">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                                <?php if (isset($validation)) {
                                    if ($validation->hasError('password_confirm')) { ?>
                                        <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('password_confirm') : ''; ?></span>
                                    <?php }
                                } ?>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                    Creer compte sysadmin
                                </button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</filiere>
</div>