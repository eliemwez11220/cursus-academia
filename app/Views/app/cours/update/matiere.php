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
                    $key_reference = isset($matiere)? esc($matiere['matiere_uid']):'';
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/cours/saveAffectatonMatiere/update/'.$key_reference, $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('cours/view/matieres'); ?>"
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
                                

                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="branche" class="control-label">
                                            <span class="text-danger">*</span> Branche
                                        </label>
                                        <select id="branche" name="branche"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('branche')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Sélectionnez un critère --</option>
                                            <?php
                                            $key_branche = isset($matiere)? esc($matiere['matiere_branche_uid']):'';
                                            $count = 1;
                                            if (isset($branches) && !empty($branches)):
                                                foreach ($branches as $key => $value):
                                                    if ($key_branche == $value['branche_uid']){ ?>
                                                    <option selected="selected" value="<?= $key_branche; ?>" <?= set_select('branche', $key_branche); ?>>
                                                        <?= ucfirst(esc($value['branche_libelle'])); ?>
                                                    </option>

                                                <?php } ?>
                                                    <option value="<?= esc($value['branche_uid']); ?>" <?= set_select('branche', esc($value['branche_uid'])); ?>>
                                                        <?= ucfirst(esc($value['branche_libelle'])); ?>
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
                               
                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="max_periode" class="control-label">
                                            <span class="text-danger"></span> Total Max cotation période
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('max_periode')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="max_periode" id="max_periode"
                                               value="<?= isset($matiere)? esc($matiere['matiere_max_periode']):set_value('max_periode') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'max_periode'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="max_examen" class="control-label">
                                            <span class="text-danger"></span> Total Max cotation examen
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('max_examen')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="max_examen" id="max_examen"
                                               value="<?= isset($matiere)? esc($matiere['matiere_max_examen']):set_value('max_examen') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'max_examen'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                   <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="maxima_groupe" class="control-label">
                                            <span class="text-danger">*</span> Groupe Maxima sur le bulletin
                                        </label>
                                        <select id="maxima_groupe" name="maxima_groupe"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('maxima_groupe')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Sélectionnez un groupe --</option>
                                            <?php
                                             $groupe_maxima_db  = isset($matiere)? esc($matiere['matiere_maxima_uid']):'';
                                            $count = 1;
                                            if (isset($maximas) && !empty($maximas)):
                                                foreach ($maximas as $key => $value): 
                                                    if ($groupe_maxima_db == $value['maxima_uid']){ ?>
                                                        <option selected value="<?= $groupe_maxima_db; ?>" <?= set_select('maxima_groupe', $groupe_maxima_db); ?>>
                                                               <?= ucfirst(($value['maxima_libelle'])); ?>
                                                 | Per.<?= ucfirst(esc($value['maxima_max_periode'])); ?>
                                                 | Exam. <?= ucfirst(esc($value['maxima_max_examen'])); ?>
                                                        </option>

                                                    <?php } ?>
                                                    <option value="<?= esc($value['maxima_uid']); ?>" <?= set_select('maxima_groupe', esc($value['maxima_uid'])); ?>>
                                                        <?= ucfirst(($value['maxima_libelle'])); ?>
                                                 | Per.<?= ucfirst(esc($value['maxima_max_periode'])); ?>
                                                 | Exam. <?= ucfirst(esc($value['maxima_max_examen'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'maxima_groupe'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="ordre_bulletin" class="control-label">
                                            <span class="text-danger">*</span> Numéro d'ordre sur le bulletin
                                        </label>
                                        <select id="ordre_bulletin" name="ordre_bulletin"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('ordre_bulletin')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Sélectionnez un numéro --</option>
                                            <?php
                                            $ordre_bull_db  = isset($matiere)? esc($matiere['matiere_ordre_bulletin']):'';
                                                for($i=1; $i <=20; $i++):
                                                    if ($ordre_bull_db == $i){ ?>
                                                        <option selected value="<?= $i; ?>" <?= set_select('ordre_bulletin', $i); ?>>
                                                            <?= $i; ?>
                                                        </option>

                                                    <?php } ?>
                                                    <option value="<?= $i; ?>" <?= set_select('ordre_bulletin', $i); ?>>
                                                   
                                                              <?= $i; ?>
                                                    </option>
                                              <?php endfor; ?>
                                          
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'ordre_bulletin'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div> <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="promotion" class="control-label">
                                            <span class="text-danger">*</span> promotion
                                        </label>
                                        <select id="promotion" name="promotion"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('promotion')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Sélectionnez une promotion --</option>
                                            <?php
                                            $key_promotion  = isset($matiere)? esc($matiere['matiere_promotion_uid']):'';
                                            $count = 1;
                                            if (isset($promotions) && !empty($promotions)):
                                                foreach ($promotions as $key => $value):
                                                    if ($key_promotion == $value['promotion_uid']){ ?>
                                                        <option selected="selected" value="<?= $key_promotion; ?>" <?= set_select('promotion', $key_promotion); ?>>
                                                            <?= ucfirst(($value['promotion_libelle'])); ?>
                                                            - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                            - <?= ucfirst(($value['option_libelle'])); ?>
                                                        </option>

                                                    <?php } ?>
                                                    <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotion', esc($value['promotion_uid'])); ?>>
                                                        <?= ucfirst(($value['promotion_libelle'])); ?>
                                                        - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                        - <?= ucfirst(($value['option_libelle'])); ?>
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
                                </div><div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="titulaire_matiere" class="control-label">
                                            <span class="text-danger">*</span> Enseignant Titulaire
                                        </label>
                                        <select id="titulaire_matiere" name="titulaire_matiere"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('titulaire_matiere')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option  disabled>-- Sèlectionnez un agent --</option>
                                            <?php
                                            $key_agent = isset($matiere)? esc($matiere['matiere_agent_uid']):'';
                                            $count = 1;
                                            if (isset($agents) && !empty($agents)):
                                                foreach ($agents as $key => $value):
                                                    if ($key_agent == $value['agent_uid']){ ?>
                                                        <option selected="selected"  value="<?= $key_agent; ?>" <?= set_select('titulaire_matiere', $key_agent); ?>>
                                                            <?= ucfirst(esc($value['agent_nom'])); ?>
                                                            -<?= ucfirst(esc($value['agent_postnom'])); ?>-
                                                            <?= ucfirst(esc($value['agent_prenom'])); ?>
                                                            - <?= ucfirst(esc($value['agent_matricule'])); ?>
                                                        </option>

                                                    <?php } ?>
                                                    <option value="<?= esc($value['agent_uid']); ?>" <?= set_select('titulaire_matiere', esc($value['agent_uid'])); ?>>
                                                        <?= ucfirst(esc($value['agent_nom'])); ?>
                                                        -<?= ucfirst(esc($value['agent_postnom'])); ?>-
                                                        <?= ucfirst(esc($value['agent_prenom'])); ?>
                                                        - <?= ucfirst(esc($value['agent_matricule'])); ?>
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
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="compose-textarea"> <span class="text-danger"></span> Description affectation</label>
                                        <textarea id="compose-textarea" name="description_affectation" class="form-control"
                                                  rows="10" style="height: 500px!important;"
                                                  placeholder="Decrivez l'evaluation ici..."><?= isset($matiere)? esc($matiere['matiere_comment']):set_value('description_affectation'); ?></textarea>
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

