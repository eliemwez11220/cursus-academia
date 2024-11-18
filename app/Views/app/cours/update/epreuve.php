<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Apr-21
 * Time: 10:20 AM
 */
 -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">Détails -
                                Epreuve <?= (isset($epreuve)) ? esc($epreuve['epreuve_libelle']) : 'Aucun'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Epreuves</li>
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
                    $idKey = (isset($epreuve) ? esc($epreuve['epreuve_uid']) : 'Aucun');

                    $validation = \Config\Services::validation();

                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/cours/saveEpreuve/update/' . $idKey, $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="float-left">
                                    <a href="<?= base_url('cours/view/epreuves'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-condensed table-head-fixed">
                                    <thead>

                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label for="libelle_epreuve" class="control-label">
                                                <span class="text-danger">*</span> Libellé épreuve
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text"
                                                       class="form-control <?php if ($validation->hasError('libelle_epreuve')) {
                                                           echo 'is-invalid';
                                                       } ?>"
                                                       name="libelle_epreuve" id="libelle_epreuve"
                                                       value="<?= (isset($epreuve)) ? esc($epreuve['epreuve_libelle']) : set_value('libelle_epreuve') ?>"
                                                       style="border-radius: 10px!important;"/>
                                                <?php if (isset($validation)): ?>
                                                    <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_epreuve'); ?>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="type_epreuve" class="control-label">
                                                <span class="text-danger">*</span> Type tâche
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <select id="type_epreuve" name="type_epreuve"
                                                        class="form-control select2 select2-info <?php if ($validation->hasError('type_epreuve')) {
                                                            echo 'is-invalid';
                                                        } ?>"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Sélectionnez un type --</option>
                                                    <?php
                                                    $old_type = isset($epreuve) ? esc($epreuve['epreuve_type_uid']) : '';
                                                    $count = 1;
                                                    if (isset($typesepreuves) && !empty($typesepreuves)):
                                                        foreach ($typesepreuves as $key => $value):
                                                            if ($old_type == esc($value['typesepreuve_uid'])) { ?>
                                                                <option selected
                                                                        value="<?= esc($old_type); ?>" <?= set_select('type_epreuve', esc($old_type)); ?>>
                                                                    <?= ucfirst(esc($value['typesepreuve_libelle'])); ?>
                                                                </option>
                                                            <?php } ?>
                                                            <option value="<?= esc($value['typesepreuve_uid']); ?>" <?= set_select('type_epreuve', esc($value['typesepreuve_uid'])); ?>>
                                                                <?= ucfirst(esc($value['typesepreuve_libelle'])); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if (isset($validation)): ?>
                                                    <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'type_epreuve'); ?>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="branche" class="control-label">
                                                <span class="text-danger">*</span> Branche - Matière
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <select id="branche" name="branche"
                                                        class="form-control select2 select2-info <?php if ($validation->hasError('branche')) {
                                                            echo 'is-invalid';
                                                        } ?>"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Selectionnez une branche --</option>
                                                    <?php
                                                    $oldBranche = isset($epreuve) ? esc($epreuve['epreuve_branche_uid']) : '';
                                                    $count = 1;
                                                    if (isset($branches) && !empty($branches)):
                                                        foreach ($branches as $key => $value):
                                                            if ($oldBranche == esc($value['branche_uid'])) { ?>
                                                                <option selected
                                                                        value="<?= esc($oldBranche); ?>" <?= set_select('branche', esc($oldBranche)); ?>>
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="periode_epreuve" class="control-label">
                                                <span class="text-danger">*</span> Période d'évaluation
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <select id="periode_epreuve" name="periode_epreuve"
                                                        class="form-control select2 select2-info <?php if ($validation->hasError('periode_epreuve')) {
                                                            echo 'is-invalid';
                                                        } ?>"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Sélectionnez une période --</option>
                                                    <?php
                                                    $oldPeriode = isset($epreuve) ? esc($epreuve['epreuve_periode_uid']) : '';
                                                    $count = 1;
                                                    if (isset($periodes) && !empty($periodes)):
                                                        foreach ($periodes as $key => $value):
                                                            if ($oldPeriode == esc($value['periode_uid'])) { ?>
                                                                <option selected
                                                                        value="<?= esc($oldPeriode); ?>" <?= set_select('periode_epreuve', esc($oldPeriode)); ?>>
                                                                    <?= ucfirst(esc($value['periode_libelle'])); ?>
                                                                </option>
                                                            <?php } ?>
                                                            <option value="<?= esc($value['periode_uid']); ?>" <?= set_select('periode_epreuve', esc($value['periode_uid'])); ?>>
                                                                <?= ucfirst(esc($value['periode_libelle'])); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if (isset($validation)): ?>
                                                    <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'periode_epreuve'); ?>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="numero_epreuve" class="control-label">
                                                <span class="text-danger">*</span> Numéro Epreuve
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <select id="numero_epreuve" name="numero_epreuve"
                                                        class="form-control select2 select2-info <?php if ($validation->hasError('numero_epreuve')) {
                                                            echo 'is-invalid';
                                                        } ?>"
                                                        data-dropdown-css-class="select2-info">
                                                    <option disabled>-- Sélectionnez un numéro --</option>
                                                    <?php
                                                    $oldNumber = isset($epreuve) ? esc($epreuve['epreuve_numero']) : '';
                                                    for ($count = 1; $count <= 25; $count++):
                                                        if ($oldNumber == $count) { ?>
                                                            <option selected
                                                                    value="<?= esc($oldNumber); ?>" <?= set_select('numero_epreuve', esc($oldNumber)); ?>>
                                                                <?= $oldNumber; ?>
                                                            </option>
                                                        <?php } ?>
                                                        <option value="<?= $count; ?>" <?= set_select('numero_epreuve', $count); ?>>
                                                            <?= $count; ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                                <?php if (isset($validation)): ?>
                                                    <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'numero_epreuve'); ?>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="cotes_max" class="control-label">
                                                <span class="text-danger">*</span> Max cotation epreuve
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="number" min="0" step="0.00"
                                                       class="form-control <?php if ($validation->hasError('cotes_max')) {
                                                           echo 'is-invalid';
                                                       } ?>"
                                                       name="cotes_max" id="cotes_max"
                                                       value="<?= isset($epreuve) ? esc($epreuve['epreuve_cote_max']) : set_value('cotes_max') ?>"
                                                       style="border-radius: 10px!important;"/>
                                                <?php if (isset($validation)): ?>
                                                    <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cotes_max'); ?>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="ponderation_epreuve">Pondération Epreuve</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control"
                                                       name="ponderation_epreuve" id="ponderation_epreuve"
                                                       value="<?= (isset($epreuve)) ? esc($epreuve['epreuve_ponderation']) : set_value('ponderation_epreuve') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="lecon_epreuve">Leçon Epreuve</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control"
                                                       name="lecon_epreuve" id="lecon_epreuve"
                                                       value="<?= (isset($epreuve)) ? esc($epreuve['epreuve_lecon']) : set_value('lecon_epreuve') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="methode_epreuve">Méthode Epreuve</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control"
                                                       name="methode_epreuve" id="methode_epreuve"
                                                       value="<?= (isset($epreuve)) ? esc($epreuve['epreuve_methode']) : set_value('methode_epreuve') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="duree_minute_epreuve">Durée epreuve en minute</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control"
                                                       name="duree_minute_epreuve" id="duree_minute_epreuve"
                                                       value="<?= (isset($epreuve)) ? esc($epreuve['epreuve_duree_minute']) : set_value('duree_minute_epreuve') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr><tr>
                                        <td><label for="nombre_questions_epreuve">Nombre total des questions</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="number" min="0"
                                                       class="form-control"
                                                       name="nombre_questions_epreuve" id="nombre_questions_epreuve"
                                                       value="<?= (isset($epreuve)) ? esc($epreuve['epreuve_nombre_questions']) : set_value('nombre_questions_epreuve') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr><tr>
                                        <td><label for="nombre_etudiants_epreuve">Nombre des étudiants participants</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="number" min="0"
                                                       class="form-control"
                                                       name="nombre_etudiants_epreuve" id="nombre_etudiants_epreuve"
                                                       value="<?= (isset($epreuve)) ? esc($epreuve['epreuve_nombre_etudiants']) : set_value('nombre_etudiants_epreuve') ?>"
                                                       style="border-radius: 10px!important;"/>
                                            </div>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td><label for="observation_epreuve">Commentaire ou Observation</label></td>
                                        <td>
                                            <div class="form-group">

                                                <textarea id="observation_epreuve" name="observation_epreuve"
                                                          class="form-control" rows="3"
                                                          placeholder="Decrivez ici le commentaire..."><?= isset($epreuve) ? esc($epreuve['epreuve_observation']) : set_value('observation_epreuve'); ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>   <label for="compose-textarea"> <span class="text-danger">*</span>
                                                Description epreuve</label></td>
                                        <td>
                                            <div class="form-group">

                                                <textarea id="compose-textarea" name="description_epreuve"
                                                          class="form-control"
                                                          rows="10" style="height: 500px!important;"
                                                          placeholder="Decrivez l'execution de la tache ici..."><?= isset($epreuve) ? esc($epreuve['epreuve_description']) : set_value('description_epreuve'); ?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                <i class="fa fa-check-circle"></i> Enregistrer les modifications
                            </button>
                        </div>
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
