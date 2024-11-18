
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Personnel - Nouvel Agent</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Agent</li>
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
                        //matricule generated
                        $aleatoire_value = "0123456789";
                        $new_matricule_generate = "AM" . date('Y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(4, 20))), 0, 4);
                        
                        //form validation services call
                        $validation = \Config\Services::validation(); 

                        //form
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('agent/saveAgent/create') , $attributes);
                    ?>
                    <div class="card card-light">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-tools float-left">
                                    <a href="<?= base_url('agent/view/personnels'); ?>"
                                       class="btn btn-default btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">

                                <button type="submit" class="btn btn-info btn-sm btn-rounded text-uppercase">
                                    <i class="fa fa-check-circle fa-lg"></i> Enregistrer l'agent
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-sm-4">
                                    <!-- Matricule etudiant -->
                                    <div class="form-group">
                                        <label for="matricule"><span class="text-danger">*</span> Matricule agent
                                            <span class="small text-info">(Genéré. Modifiable)</span></label>

                                        <input type="text" name="matricule" id="matricule"
                                               class="form-control <?= ($validation->hasError('matricule')) ? ' is-invalid' : '' ?>"
                                               placeholder="Matricule Agent"
                                               value="<?= (!empty($new_matricule_generate)) ? $new_matricule_generate : set_value('matricule') ?>">

                                        <?php if ($validation->hasError('matricule')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('matricule'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div><!-- left column -->
                                <div class="col-sm-4">
                                    <!-- Nom etudiant -->
                                    <div class="form-group">
                                        <label for="nom"><span class="text-danger">*</span>Nom Agent</label>

                                        <input type="text" name="nom" id="nom"
                                               class="form-control <?= ($validation->hasError('nom')) ? ' is-invalid' : '' ?>"
                                               placeholder="Nom Agent" value="<?= set_value('nom'); ?>">

                                        <?php if ($validation->hasError('nom')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('nom'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- PostNom etudiant -->
                                    <div class="form-group">
                                        <label for="postnom"><span class="text-danger">*</span>Postnom
                                            </label>

                                        <input type="text" name="postnom" id="postnom"
                                               class="form-control <?= ($validation->hasError('postnom')) ? ' is-invalid' : '' ?>"
                                               placeholder="Postnom Agent" value="<?= set_value('postnom'); ?>">

                                        <?php if ($validation->hasError('postnom')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('postnom'); ?></span>
                                        <?php } ?>

                                    </div> <!-- prenom etudiant -->
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="prenom"><span class="text-danger">*</span>Prenom
                                            </label>

                                        <input type="text" name="prenom" id="prenom"
                                               class="form-control <?= ($validation->hasError('prenom')) ? ' is-invalid' : '' ?>"
                                               placeholder="Prenom Agent" value="<?= set_value('prenom'); ?>">

                                        <?php if ($validation->hasError('prenom')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('prenom'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                               

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="fonction"><span class="text-danger">*</span>
                                            Fonction
                                            </label>
                                        <select id="fonction" name="fonction"
                                                class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('fonction')) ? ' is-invalid' : '' ?>"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez une fonction --
                                            </option>
                                            <?php
                                            $count = 1;
                                            if (isset($fonctions) && !empty($fonctions)):
                                                foreach ($fonctions as $key => $value): ?>
                                                    <option value="<?= esc($value['fonction_uid']); ?>" <?= set_select('fonction', esc($value['fonction_uid'])); ?>>
                                                        <?= ucfirst(esc($value['fonction_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('fonction')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('fonction'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="grade"><span class="text-danger">*</span>Grade</label>
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('grade')) ? ' is-invalid' : '' ?>"
                                                id="grade"
                                                name="grade"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez un grade --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($grades) && !empty($grades)):
                                                foreach ($grades as $key => $value): ?>
                                                    <option value="<?= esc($value['grade_uid']); ?>" <?= set_select('grade', esc($value['grade_uid'])); ?>>
                                                        <?= ucfirst(esc($value['grade_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('grade')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('grade'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="secteur"><span class="text-danger">*</span>Secteurs d'activités</label>
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('secteur')) ? ' is-invalid' : '' ?>"
                                                id="secteur"
                                                name="secteur"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez un secteur --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($secteurs) && !empty($secteurs)):
                                                foreach ($secteurs as $key => $value): ?>
                                                    <option value="<?= esc($value['secteur_uid']); ?>" <?= set_select('secteur', esc($value['secteur_uid'])); ?>>
                                                        <?= ucfirst(esc($value['secteur_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('secteur')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('secteur'); ?></span>
                                        <?php } ?>
                                    </div>

                                </div>
                          
                                <div class="col-sm-4">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>Sexe Agent : </label><br>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="sexe" checked id="radioSuccess1"
                                                   value="masculin">
                                            <label for="radioSuccess1">
                                                Masculin
                                            </label>
                                        </div>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="sexe" id="radioSuccess2" value="feminin">
                                            <label for="radioSuccess2">
                                                Feminin
                                            </label>
                                        </div>
                                        
                                        <?php if ($validation->hasError('sexe')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('sexe'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <!-- Date -->
                                    <div class="form-group">
                                        <label for="dateNaissance"><span class="text-danger"></span>Date de
                                            naissance:</label>
                                        <div class="input-group date" id="date_format_abrege"
                                             data-target-input="nearest">
                                            <input type="date" class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissance')) ? ' is-invalid' : '' ?>"
                                                   id="dateNaissance" value="<?= set_value('dateNaissance') ?>"
                                                   data-target="#date_format_abrege" name="dateNaissance"/>
                                            <div class="input-group-append" data-target="#date_format_abrege"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if ($validation->hasError('dateNaissance')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('dateNaissance'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <!-- Nom etudiant -->
                                    <div class="form-group">
                                        <label for="lieuNaissance"><span class="text-danger"></span>Lieu Naissance
                                            </label>

                                        <input type="text" name="lieuNaissance" id="lieuNaissance"
                                               class="form-control <?= ($validation->hasError('lieuNaissance')) ? ' is-invalid' : '' ?>"
                                               value="<?= set_value('lieuNaissance'); ?>">

                                        <?php if ($validation->hasError('lieuNaissance')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('lieuNaissance'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="telephone"><span class="text-danger"></span>Numéro téléphone
                                            :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone"
                                                   id="telephone" value="<?= set_value('telephone') ?>"
                                                   data-inputmask='"mask": "+243999999999"'
                                                   data-mask
                                                   placeholder="Ex: 858533285">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email"><span class="text-danger"></span>Adresse Mail :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <!-- Date -->
                                    <div class="form-group">
                                        <label for="date_engagement"><span class="text-danger"></span>Date d'engagement:</label>
                                        <div class="input-group date" id="date_debut_annee"
                                             data-target-input="nearest">
                                            <input type="date" class="form-control datetimepicker-input <?= ($validation->hasError('date_engagement')) ? ' is-invalid' : '' ?>"
                                                   id="date_engagement" value="<?= set_value('date_engagement') ?>"
                                                   data-target="#date_debut_annee" name="date_engagement"/>
                                            <div class="input-group-append" data-target="#date_debut_annee"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if ($validation->hasError('date_engagement')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('date_engagement'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <!-- Nom etudiant -->
                                    <div class="form-group">
                                        <label for="lieu_engagement"><span class="text-danger"></span>Lieu d'engagement
                                            </label>

                                        <input type="text" name="lieu_engagement" id="lieu_engagement"
                                               class="form-control <?= ($validation->hasError('lieu_engagement')) ? ' is-invalid' : '' ?>"
                                               value="<?= set_value('lieu_engagement'); ?>">

                                        <?php if ($validation->hasError('lieu_engagement')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('lieu_engagement'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="adresse"><span class="text-danger"></span>Adresse
                                        Résidence</label>
                                    <div class="form-group">

                                        <input type="text" name="adresse" id="adresse"
                                               class="form-control <?= ($validation->hasError('adresse')) ? ' is-invalid' : '' ?>"
                                               value="<?= set_value('adresse'); ?>">
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

