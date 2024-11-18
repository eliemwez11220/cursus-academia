<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 25-Apr-21
 * Time: 12:47 PM
 */-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Cotes Elèves - Modification Cotation</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Cotes étudiants</li>
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
                    <?php

                    $validation = \Config\Services::validation();

                    $oldTableReference = isset($cote)? esc($cote['cote_uid']):'';

                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/cours/saveCoteetudiant/update/'.$oldTableReference, $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('cours/view/cotes'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste</a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="etudiant" class="control-label">
                                            <span class="text-danger">*</span> Elève | promotion
                                        </label>
                                        <select id="etudiant" name="etudiant"
                                                class="form-control select2 select2-info text-uppercase <?php if ($validation->hasError('etudiant')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Sélectionnez un étudiant --</option>
                                            <?php
                                            $oldetudiant = isset($cote)? esc($cote['cote_etudiant_uid']):'';
                                            $count = 1;
                                            if (isset($etudiants) && !empty($etudiants)):
                                                foreach ($etudiants as $key => $value):
                                                    if ($oldetudiant == esc($value['etudiant_uid'])){?>
                                                        <option selected value="<?= $oldetudiant; ?>" <?= set_select('epreuve', $oldetudiant); ?>>
                                                            <?= esc($value['etudiant_matricule']); ?>
                                                            - <?= esc($value['etudiant_nom']); ?>
                                                            -<?= esc($value['etudiant_postnom']); ?>
                                                            -<?= esc($value['etudiant_prenom']); ?>
                                                            | <?= esc($value['promotion_libelle']); ?>
                                                        </option>
                                                    <?php } ?>
                                                    <option value="<?= esc($value['etudiant_uid']); ?>" <?= set_select('etudiant', esc($value['etudiant_uid'])); ?>>
                                                        <?= esc($value['etudiant_matricule']); ?>
                                                        - <?= esc($value['etudiant_nom']); ?>
                                                        -<?= esc($value['etudiant_postnom']); ?>
                                                        -<?= esc($value['etudiant_prenom']); ?>
                                                        | <?= esc($value['promotion_libelle']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'etudiant'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                           <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="matiere" class="control-label">
                                            <span class="text-danger">*</span> Branche - Matière
                                        </label>
                                        <select id="matiere" name="matiere"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('matiere')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez une matière --</option>
                                            <?php
                                            $oldMatiere = isset($cote)? esc($cote['cote_matiere_uid']):'';

                                            $count = 1;
                                            if (isset($matieres) && !empty($matieres)):
                                                foreach ($matieres as $key => $value): 

                                                     if ($oldMatiere == esc($value['matiere_uid'])){?>
                                                        <option selected value="<?= $oldMatiere; ?>" <?= set_select('matiere', $oldMatiere); ?>>
                                                          <?= ucfirst(esc($value['branche_libelle'])); ?>
                                                        [Max Per. /<?= esc($value['matiere_max_periode']); ?>]
                                                        [Max Exam. /<?= esc($value['matiere_max_examen']); ?>]
                                                        </option>
                                                    <?php } ?>

                                                    <option value="<?= esc($value['matiere_uid']); ?>" <?= set_select('matiere', esc($value['matiere_uid'])); ?>>
                                                        <?= ucfirst(esc($value['branche_libelle'])); ?>
                                                        [Max Per. /<?= esc($value['matiere_max_periode']); ?>]
                                                        [Max Exam. /<?= esc($value['matiere_max_examen']); ?>]
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'matiere'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="periode" class="control-label">
                                            <span class="text-danger">*</span> Période d'évaluation
                                        </label>
                                        <select id="periode" name="periode"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('periode')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez une période --</option>
                                            <?php
                                            $oldPeriode = isset($cote)? esc($cote['cote_periode_uid']):'';

                                            $count = 1;
                                            if (isset($periodes) && !empty($periodes)):
                                                foreach ($periodes as $key => $value): 
                                                    
                                                    if ($oldPeriode == esc($value['periode_uid'])){?>
                                                        <option selected value="<?= $oldPeriode; ?>" <?= set_select('periode', $oldPeriode); ?>>
                                                          <?= ucfirst(esc($value['periode_libelle'])); ?>
                                                        </option>
                                                    <?php } ?>

                                                    <option value="<?= esc($value['periode_uid']); ?>" <?= set_select('periode', esc($value['periode_uid'])); ?>>
                                                        <?= ucfirst(esc($value['periode_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'periode'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                              
                        
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cote_obtenue" class="control-label">
                                            <span class="text-danger">*</span> Cote obtenue
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('cote_obtenue')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="cote_obtenue" id="cote_obtenue"
                                               value="<?= isset($cote)? esc($cote['cote_point_obtenu']): set_value('cote_obtenue') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cote_obtenue'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                   <div class="col-sm-12">
                                    <!-- radio -->
                                    <?php
                                            $oldTypeChecked = isset($cote)? esc($cote['cote_type']):'';
                                    ?>
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>Type Cote : </label>
                                        <div class="icheck-info d-inline">
                                            <input type="radio" name="type_cote" id="radioSuccess1"
                                                   value="periode" <?= ($oldTypeChecked =='periode') ?'checked':'' ?>>
                                            <label for="radioSuccess1">
                                                Cote Periode
                                            </label>
                                        </div>
                                        <div class="icheck-info d-inline">
                                            <input type="radio" name="type_cote" id="radioSuccess2" value="examen" <?= ($oldTypeChecked == 'examen') ?'checked':'' ?>>
                                            <label for="radioSuccess2">
                                                Cote Examen
                                            </label>
                                        </div>
                                        <?php if ($validation->hasError('type_cote')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('type_cote'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cote_bonus" class="control-label">
                                            <span class="text-danger"></span> Cote bonus
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control"
                                               name="cote_bonus" id="cote_bonus"
                                               value="<?= isset($cote)? esc($cote['cote_point_bonus']): set_value('cote_bonus') ?>"
                                               style="border-radius: 10px!important;"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cote_bonus_raison" class="control-label">
                                            <span class="text-danger"></span> Raison cote bonus
                                        </label>
                                        <input type="text"
                                               class="form-control"
                                               name="cote_bonus_raison" id="cote_bonus_raison"
                                               value="<?= isset($cote)? esc($cote['cote_raison_bonus']): set_value('cote_bonus_raison') ?>"
                                               style="border-radius: 10px!important;"/>
                                    </div>
                                </div><div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="observation_cote" class="control-label">
                                            <span class="text-danger"></span> Observation ou commentaire
                                        </label>
                                        <textarea  class="form-control" name="observation_cote" id="observation_cote" rows="3"
                                               style="border-radius: 10px!important;"><?= isset($cote)? esc($cote['cote_observation']): set_value('observation_cote') ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php echo form_close(); ?>
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

