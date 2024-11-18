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
                    $aleatoire_value = "0123456789";
                    $new_identifiant_generate = "P" . date('Y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(4, 20))), 0, 4);

                    $validation = \Config\Services::validation();

                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('etudiant/saveParent/create/'), $attributes);
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
                                        <i class="fa fa-check-circle fa-lg"></i> Enregistrer
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="code_parent" id="code_parent"
                                                   class="form-control"
                                                   value="<?= (!empty($new_identifiant_generate)) ? $new_identifiant_generate : set_value('code_parent') ?>">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- Nom etudiant -->
                                        <div class="form-group">
                                            <label for="nom_pere"><span class="text-danger">*</span>Nom du père</label>
                                            <input type="text" name="nom_pere" id="nom_pere"
                                                   class="form-control <?= ($validation->hasError('nom_pere')) ? ' is-invalid' : '' ?>" value="<?= set_value('nom_pere'); ?>">
                                            <?php if ($validation->hasError('nom_pere')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('nom_pere'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="profession_pere"><span class="text-danger"></span>Profession
                                                du père</label>
                                            <input type="text" name="profession_pere" id="profession_pere"
                                                   class="form-control <?= ($validation->hasError('profession_pere')) ? ' is-invalid' : '' ?>"
                                                  value="<?= set_value('profession_pere'); ?>">
                                            <?php if ($validation->hasError('profession_pere')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('profession_pere'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Nom etudiant -->
                                        <div class="form-group">
                                            <label for="nom_mere"><span class="text-danger">*</span>Nom de la mère</label>
                                            <input type="text" name="nom_mere" id="nom_mere"
                                                   class="form-control <?= ($validation->hasError('nom_mere')) ? ' is-invalid' : '' ?>" value="<?= set_value('nom_mere'); ?>">
                                            <?php if ($validation->hasError('nom_mere')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('nom_mere'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="profession_mere"><span class="text-danger"></span>Profession
                                                de la mère</label>
                                            <input type="text" name="profession_mere" id="profession_mere"
                                                   class="form-control <?= ($validation->hasError('profession_mere')) ? ' is-invalid' : '' ?>"
                                                  value="<?= set_value('profession_mere'); ?>">
                                            <?php if ($validation->hasError('profession_mere')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('profession_mere'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <!-- Nom etudiant -->
                                        <div class="form-group">
                                            <label for="nom_tuteur"><span class="text-danger">*</span>Nom du tuteur</label>
                                            <input type="text" name="nom_tuteur" id="nom_tuteur"
                                                   class="form-control <?= ($validation->hasError('nom_tuteur')) ? ' is-invalid' : '' ?>"
                                                   value="<?= set_value('nom_tuteur'); ?>">
                                            <?php if ($validation->hasError('nom_tuteur')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('nom_tuteur'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="profession_tuteur"><span class="text-danger"></span>Profession
                                                du Tuteur</label>
                                            <input type="text" name="profession_tuteur" id="profession_tuteur"
                                                   class="form-control <?= ($validation->hasError('profession_tuteur')) ? ' is-invalid' : '' ?>"
                                                  value="<?= set_value('profession_tuteur'); ?>">
                                            <?php if ($validation->hasError('profession_tuteur')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('profession_tuteur'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="telephone_tuteur"><span class="text-danger"></span>Numéro téléphone du tuteur:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="telephone_tuteur" id="telephone_tuteur"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask
                                                       placeholder="Ex: 858533285">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email_tuteur"><span class="text-danger"></span>Adresse email du tuteur:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" id="email_tuteur" name="email_tuteur" value="<?= set_value('email_tuteur')?>" />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nom_autre_personne"><span class="text-danger"></span>
                                            Autre personne à contacter :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="nom_autre_personne" name="nom_autre_personne" value="<?= set_value('nom_autre_personne')?>" />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="adresseResidence"><span class="text-danger"></span>Adresse
                                             de résidence du tuteur</label>
                                        <div class="form-group">
                                            <textarea name="adresse_tuteur" id="adresseResidence" cols="30" rows="3" class="form-control"> <?= set_value('adresse_tuteur')?></textarea>
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

