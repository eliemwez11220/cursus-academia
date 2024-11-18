<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-7 col-sm-12 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent p-3">
                        <div class="text-center">
                            <div class="brand-logo">
                                <a href="<?= base_url(); ?>">
                                    <img src="<?= base_url('global/logo/favicon.png'); ?>" alt="School Logo">
                                </a>
                            </div>

                            <?php if (isset(session()->success)) : ?>
                                <div class="container" id="hiddenmsg">
                                    <div class="alert alert-success text-center">
                                        <span class="fa fa-check-circle"> </span>
                                        <?= session()->getFlashdata('success'); ?>
                                    </div>
                                </div>
                            <?php elseif (isset(session()->failed)) : ?>
                                <div class="alert alert-danger" id="hiddenmsg">
                                    <h3 class="text-center small">
                                        <?= session()->failed; ?>
                                    </h3>
                                </div>
                            <?php else: ?>
                                <h5 class="text-uppercase font-weight-bold">Application de gestion des écoles</h5>
                                <h6 class="font-weight-bold">Identifiez-vous pour accèder à votre espace de travail
                                    et retouvez toutes les données de votre compte.</h6>
                            <?php endif; ?>
                        </div>
                        <div class="text-left pt-3">
                            <?php
                            $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('secure/login'), $attributes);
                            ?>
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="username">Adresse mail du service</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0 input-left-radius">
                                            <i class="fas fa-user text-primary"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-right-radius input-p-35 border-left-0 <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                           id="username" placeholder="Ex: laribambelle@gmail.com" name="username" value="<?= set_value('username'); ?>" autofocus>
                                </div>
                                <span class="text-danger"><?= display_validation_error($validation, 'username'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent"
                      <span class="input-group-text bg-transparent border-right-0  input-left-radius">
                        <i class="fas fa-lock text-primary"></i>
                      </span>
                                    </div>
                                    <input type="password" class="form-control input-p-35 border-left-0 <?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>"
                                           id="password" placeholder="Ex: XXXXXXX"  name="password" value="<?= set_value('password'); ?>">
                                    <span class="input-group-text" id="inputGroupPrepend input-right-radius">
                                               <button onclick="showPass();" type="button" class="btn">
                                                   <i id="eyepass" class="fas fa-eye-slash"></i>
                                               </button>
                                            </span>
                                </div>
                                <span class="text-danger"><?= display_validation_error($validation, 'password'); ?></span>
                            </div>
                            <!--<div class="my-2 d-inline">
                              <div class="text-left form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" onclick="showPass();">
                                        <span id="passmsg">Afficher le mot de passe</span>
                                    </label>
                                </div>
                            </div>-->
                            <div class="my-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SE CONNECTER</button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12 d-flex flex-row"
                     style="background: url(<?= base_url('global/img/bg.jpg'); ?>); background-size: cover;  background-position: center center;
                             background-repeat: no-repeat;max-width:100%!important;
                             height:100%!important;">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">
                        Tous droits réservés &copy; <?= date('Y'); ?> <strong>Eduschool Management.</strong>
                        <span class="text-white text-sm">Created by
                            <a href="https://ditotase.com" rel="nofollow" target="_blank" class="btn btn-danger">Ditotase</a></span>
                    </p>
                </div>
            </div>
        </div><!-- content-wrapper ends -->
    </div><!-- page-body-wrapper ends -->
</div><!-- container-scroller -->

