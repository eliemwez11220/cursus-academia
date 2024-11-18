<?php
$aleatoire_value = "0123456789";
$new_identifiant_generate = "P" . date('Y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(4, 20))), 0, 4);
$validation = \Config\Services::validation(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="font-weight-bold text-uppercase">Parents - Dossiers étudiants</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Parents</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url().'/etudiant/saveParent/create/', $attributes);
                    ?>
                        <div class="card card-light">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="card-tools float-left">
                                        <a href="<?= base_url('etudiant/dossier/parent'); ?>"
                                           class="btn btn-default btn-rounded text-uppercase btn-sm">
                                            <i class="fa fa-arrow-circle-left fa-lg"></i> voir la liste
                                        </a>
                                    </div>
                                </div>
                                <div class="card-tools float-right">
                                    <button type="submit" class="btn btn-info btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-check-circle fa-lg"></i> Enregistrer parent
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-sm-4">
                                        <!-- Matricule etudiant -->
                                        <div class="form-group">
                                            <label for="code_parent"><span class="text-danger">*</span> Identifiant
                                                <span class="small text-info">(Genere automatiquement)</span></label>
                                            <input type="text" name="code_parent" id="code_parent"
                                                   class="form-control <?= ($validation->hasError('code_parent')) ? ' is-invalid' : '' ?>"
                                                   value="<?= (!empty($new_identifiant_generate)) ? $new_identifiant_generate : set_value('code_parent') ?>">
                                            <?php if ($validation->hasError('code_parent')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('code_parent'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div><!-- left column -->
                                    <div class="col-sm-4">
                                        <!-- Nom etudiant -->
                                        <div class="form-group">
                                            <label for="nom_parent"><span class="text-danger">*</span>Nom Parent</label>
                                            <input type="text" name="nom_parent" id="nom_parent"
                                                   class="form-control <?= ($validation->hasError('nom_parent')) ? ' is-invalid' : '' ?>"
                                                   placeholder="Nom Parent" value="<?= set_value('nom_parent'); ?>">
                                            <?php if ($validation->hasError('nom_parent')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('nom_parent'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="profession_parent"><span class="text-danger"></span>Profession
                                                Parent</label>
                                            <input type="text" name="profession_parent" id="profession_parent"
                                                   class="form-control <?= ($validation->hasError('profession_parent')) ? ' is-invalid' : '' ?>"
                                                  value="<?= set_value('profession_parent'); ?>">
                                            <?php if ($validation->hasError('profession_parent')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('profession_parent'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="telephone_parent"><span class="text-danger"></span>Numéro téléphone :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="telephone_parent" id="telephone_parent"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask
                                                       placeholder="Ex: 858533285">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email_parent"><span class="text-danger"></span>Adresse email :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" id="email_parent" name="email_parent" value="<?= set_value('email_parent')?>" />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <!-- radio -->
                                        <div class="form-group mt-3">
                                            <label><span class="text-danger">*</span>Statut: </label>
                                            <div class="icheck-info d-inline">
                                                <input type="radio" name="parent_statut_sexe" checked id="radioSuccess1" value="pere">
                                                <label for="radioSuccess1">
                                                    Père
                                                </label>
                                            </div>
                                            <div class="icheck-info d-inline">
                                                <input type="radio" name="parent_statut_sexe" id="radioSuccess2" value="mere">
                                                <label for="radioSuccess2">
                                                    Mère
                                                </label>
                                            </div><div class="icheck-info d-inline">
                                                <input type="radio" name="parent_statut_sexe" id="radioSuccess2" value="autre">
                                                <label for="radioSuccess2">
                                                    Autre
                                                </label>
                                            </div>
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="type_parent" id="checkboxTuteur">
                                                <label for="checkboxTuteur">
                                                    Est-il Tuteur ?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="adresseResidence"><span class="text-danger">*</span>Adresse
                                            résidence</label>
                                        <div class="form-group">
                                            <textarea name="adresse_parent" id="adresseResidence" cols="30" rows="3"
                                                      class="form-control"> <?= set_value('adresse_parent')?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                    <!-- /.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </filiere>
</div><!-- /.container-fluid -->

