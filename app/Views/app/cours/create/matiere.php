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
                            <h5 class="font-weight-bold">Matière - Nouvelle Affectation</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Affectation matière</li>
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
                    //new code generated automatically
                    $aleatoire_value = "0123456789";
                    $new_code_generate = "CAM" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
                    //form attributes
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url( 'cours/saveAffectatonMatiere/create'), $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('cours/view/matieres'); ?>"
                                   class="btn btn-dark btn-rounded text-uppercase">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste</a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase">
                                    <i class="fa fa-check-circle"></i> Enregistrer
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="branche" class="control-label">
                                            <span class="text-danger">*</span> Intitulé Branche
                                        </label>
                                        <select id="branche" name="branche"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('branche')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($branches) && !empty($branches)):
                                                foreach ($branches as $key => $value): ?>
                                                    <option value="<?= esc($value['branche_uid']); ?>" <?= set_select('branche', esc($value['branche_uid'])); ?>>
                                                        <?= ucfirst(($value['branche_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'branche'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="subtitle" class="control-label">
                                            <span class="text-danger"></span> Sous-titre du cours
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('subtitle')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="subtitle" id="subtitle"
                                               value="<?= set_value('subtitle') ?>"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'subtitle'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="credit_horaire" class="control-label">
                                            <span class="text-danger">*</span> Crédit Horaire
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('credit_horaire')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="credit_horaire" id="credit_horaire"
                                               value="<?= set_value('credit_horaire') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'credit_horaire'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="volume_horaire" class="control-label">
                                            <span class="text-danger">*</span> Volume Horaire
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('volume_horaire')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="volume_horaire" id="volume_horaire"
                                               value="<?= set_value('volume_horaire') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'volume_horaire'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="ponderation" class="control-label">
                                            <span class="text-danger">*</span> Pondération
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('ponderation')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="ponderation" id="ponderation"
                                               value="<?= set_value('ponderation') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'ponderation'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="promotion" class="control-label">
                                            <span class="text-danger">*</span> Promotion
                                        </label>
                                        <select id="promotion" name="promotion"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('promotion')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($promotions) && !empty($promotions)):
                                                foreach ($promotions as $key => $value): ?>
                                                    <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotion', esc($value['promotion_uid'])); ?>>
                                                        <?= ucfirst(($value['promotion_libelle'])); ?>
                                                         <?= ucfirst($value['cycle_libelle']); ?>
                                                         <?= ucfirst($value['option_libelle']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'promotion'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="titulaire_matiere" class="control-label">
                                            <span class="text-danger">*</span> Enseignant Titulaire
                                        </label>
                                        <select id="titulaire_matiere" name="titulaire_matiere"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('titulaire_matiere')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnezagent --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($agents) && !empty($agents)):
                                                foreach ($agents as $key => $value): ?>
                                                    <option value="<?= esc($value['agent_uid']); ?>" <?= set_select('titulaire_matiere', esc($value['agent_uid'])); ?>>
                                                        <?= ucfirst(esc($value['agent_nom'])); ?>
                                                 <?= ucfirst(esc($value['agent_postnom'])); ?>
                                                        <?= ucfirst(esc($value['agent_prenom'])); ?>
                                                        - <?= ucfirst(esc($value['agent_matricule'])); ?>
                                                        - <?= ucfirst(($value['fonction_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'titulaire_matiere'); ?>
                                            </span>
                                        <?php endif; ?>
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

