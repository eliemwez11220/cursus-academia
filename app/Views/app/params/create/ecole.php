<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Création nouvelle Ecole</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Nouvelle Ecole</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card-header -->
                    <?php
                    $validation = \Config\Services::validation();
                    //new code generated automatically
                    $aleatoire_value = "0123456789";
                    $new_code_generate = "CEC" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
                    //form attributes
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/ecole/saveEcole/create/', $attributes);
					
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('ecole/view/ecoles'); ?>"
                                   class="btn btn-default btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle ecole">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste des Ecoles
                                    </span>
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer l'école
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="code_ecole" class="control-label">
                                            <span class="text-danger">*</span> Code Ecole
                                            <span class="small">
                                    (Ce code a été généré automatiquement. Il est modifiable )
                                </span>
                                        </label>
                                        <input type="text"
                                               class="form-control bg-light text-capitalize <?php if ($validation->hasError('code_ecole')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="code_ecole"
                                               id="code_ecole"
                                               value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_ecole') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'code_ecole'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="libelle_ecole" class="control-label">
                                            <span class="text-danger">*</span> Nom Ecole
                                        </label>
                                        <input type="text"
                                               class="form-control bg-light text-capitalize <?php if ($validation->hasError('libelle_ecole')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="libelle_ecole"
                                               id="libelle_ecole"
                                               value="<?= set_value('libelle_ecole') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_ecole'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="gestionnaire_ecole" class="control-label">
                                            <span class="text-danger"></span> Nom Gestionnaire
                                        </label>
                                        <input type="text"
                                               class="form-control bg-light text-capitalize"
                                               name="gestionnaire_ecole"
                                               id="gestionnaire_ecole"
                                               value="<?= set_value('gestionnaire_ecole') ?>"
                                               style="border-radius: 10px!important;"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="coordination_ecole" class="control-label">
                                            <span class="text-danger">*</span> Réseaux 
                                        </label>
                                        <select id="coordination_ecole" name="coordination_ecole"
                                                class="form-control select2 select2-info text-capitalize <?php if ($validation->hasError('coordination_ecole')) {
                                                    echo 'is-invalid';
                                                } ?>" 
                                                data-dropdown-css-class="select2-info" required>
                                            <option selected="selected" disabled>-- Sélectionnez type enseignement--
                                            </option>
                                            <?php
                                            $count = 1;
                                            if (isset($coordinations) && !empty($coordinations)):
                                                foreach ($coordinations as $key => $value): ?>
                                                    <option value="<?= esc($value['coordination_uid']); ?>" <?= set_select('coordination_ecole', esc($value['coordination_uid'])); ?>>
                                                        <?= ucfirst(esc($value['coordination_libelle'])); ?></option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'coordination_ecole'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="typeens_sid_ecole" class="control-label">
                                            <span class="text-danger">*</span> Type Enseignement
                                        </label>
                                        <select id="typeens_sid_ecole" name="typeens_sid"
										    data-dropdown-css-class="select2-info"
                                                class="form-control select2 select2-info text-capitalize 
												<?php if ($validation->hasError('typeens_sid')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                            <option selected="selected" disabled>-- Sélectionnez type enseignement--
                                            </option>
                                            <?php
                                            $count = 1;
                                            if (isset($typesens) && !empty($typesens)):
                                                foreach ($typesens as $key => $value): ?>
                                                    <option value="<?= esc($value['typesens_uid']); ?>" <?= set_select('typeens_sid', esc($value['typesens_uid'])); ?>>
                                                        <?= ucfirst(esc($value['typesens_libelle'])); ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucune type </option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'typeens_sid'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="typeecole_sid" class="control-label">
                                            <span class="text-danger">*</span> Type Ecole
                                        </label>
                                        <select id="typeecole_sid" name="typeecole_sid"
                                                class="form-control select2 select2-info text-capitalize <?php if ($validation->hasError('typeecole_sid')) {
                                                    echo 'is-invalid';
                                                } ?>" 
                                                data-dropdown-css-class="select2-info" required>
                                            <option selected="selected" disabled>-- Sélectionnez type ecole--</option>
                                            <?php
                                            $count = 1;
                                            if (isset($typesecoles) && !empty($typesecoles)):
                                                foreach ($typesecoles as $key => $value): ?>
                                                    <option value="<?= esc($value['typesecole_uid']); ?>" <?= set_select('typecole_sid', esc($value['typesecole_uid'])); ?>>
                                                        <?= ucfirst(esc($value['typesecole_libelle'])); ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun type</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'typecole_sid'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if (!empty(session()->clienttoken) && session()->profile =='client'):?>
                                <input type="hidden"
                                               class="form-control bg-light text-capitalize"
                                               name="client_ecole"
                                               id="client_ecole"
                                               value="<?= session()->clienttoken ?>"
                                               style="border-radius: 10px!important;"/>
                                   <?php else: ?>            
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="client_ecole" class="control-label">
                                            <span class="text-danger">*</span> Propriétaire de l'école
                                        </label>
                                        <select id="client_ecole" name="client_ecole"
                                                class="form-control select2 select2-info text-capitalize <?php if ($validation->hasError('client_ecole')) {
                                                    echo 'is-invalid';
                                                } ?> " 
                                                data-dropdown-css-class="select2-info" required>
                                            <option selected="selected" disabled>-- Sélectionnez client--</option>
                                            <?php
                                            $count = 1;
                                            if (isset($clients) && !empty($clients)):
                                                foreach ($clients as $key => $value): ?>
                                                    <option value="<?= esc($value['client_uid']); ?>" <?= set_select('client_ecole', esc($value['client_uid'])); ?>>
                                                        <?= ucfirst(($value['client_name'])); ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucune donnée</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'client_ecole'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        </div>

                        <?php echo form_close(); ?>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>