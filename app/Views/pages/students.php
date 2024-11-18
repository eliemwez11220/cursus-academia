<?php
$validation = \Config\Services::validation();
$session = \Config\Services::session();
?>

    <filiere class="content">
        <div class="container-fluid">
        <div class="form-holder has-shadow mt-5">
            <div class="row">
                <div class="col-lg-3 col-sm-12"></div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card mt-5" style="border-radius: 10px!important;">
                        <div class="card-header text-center">
							<h1 class="card-title font-weight-bold text-uppercase"><strong>
                                Consultattion de résultats
                            </strong></h1>
                            <a href="<?= base_url(); ?>" class="btn text-uppercase py-4">
                                            revenir à l'Accueil
                                        </a>
                        </div>
                        <div class="card-body">
                            <?php if (isset($session->success)): ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <div class="alert alert-success text-center text-uppercase">
                                                <span class="fa fa-check-circle"> </span> <?= $session->getFlashdata('success'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div><?php endif; ?>
                            <?php if(isset($session->failed)): ?>
                                <div class="alert alert-danger">
                                        <h3 class="text-center small text-uppercase">
                                            <?= $session->failed; ?>
                                        </h3>
                                </div>
                            <?php endif; ?>
                            <?php
                            $attibustes=array('role'=>'form', 'autocomplete'=>'off');
                            echo form_open(site_url('secure/students'), $attibustes);
                            ?>
                                <div class="input-group mb-3"> 
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <input type="text" name="identifiant" id="identifiant" autocomplete="off"
                                           class="form-control-lg form-control <?= ($validation->hasError('identifiant')) ? ' is-invalid' : '' ?>"
                                           placeholder="Votre numéro matricule" value="<?= set_value('identifiant'); ?>">
                                    <div class="input-group-append">
                                         <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                        Consulter
                                    </button>
                                    </div>
                                    <?php if(isset($validation)){
                                    if ($validation->hasError('identifiant')) { ?>
                                        <span class="invalid-feedback"> <?= isset($validation)?$validation->getError('identifiant'):''; ?></span>
                                    <?php }} ?>
                                </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12"></div>
            </div>
        </div>
    </div>
</filiere>  
