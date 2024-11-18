<div class="container-scroller bg-info">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper auth">
            <div class="row flex-grow">
                <!--  bg-secondary text-white -->
                <div class="col-lg-4 offset-lg-4 col-sm-12">
                    <div class="bg-light auth-form-transparent p-3 card card-radius">
                        <div class="text-center">
                           

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
                                <h5 class="text-uppercase font-weight-bold">
                                    Application de gestion du cursus des étudiants.</h5>
                               
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
                                    <input type="text"
                                           class="form-control input-right-radius input-p-35 border-left-0 <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                           id="username" placeholder="Ex: eduschool@ditotase.com" name="username"
                                           value="<?= set_value('username'); ?>" autocomplete="off" autofocus>
                                </div>
                                <span class="text-danger"><?= display_validation_error($validation, 'username'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0  input-left-radius">
                                            <i class="fas fa-lock text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="password"
                                           class="form-control input-p-35 border-left-0 <?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>"
                                           id="password" placeholder="Ex: XXXXXXX" name="password"
                                           value="<?= set_value('password'); ?>" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent input-right-radius" id="inputGroupPrepend">
                                        <button onclick="showPass();" type="button" class="btn">
                                            <i id="eyepass" class="fas fa-eye-slash"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                                <span class="text-danger"><?= display_validation_error($validation, 'password'); ?></span>
                            </div>
                            <div class="my-3">
                                <button class="btn btn-block btn-primary btn-lg input-radius font-weight-medium auth-form-btn"
                                        type="submit">SE CONNECTER
                                </button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- content-wrapper ends -->
    </div><!-- page-body-wrapper ends -->
</div><!-- scroller container ends -->

