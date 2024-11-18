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
                            <h5 class="font-weight-bold">Epreuve - Nouvelle</h5>
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

                    $validation = \Config\Services::validation();

                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/cours/saveEpreuve/create/', $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('cours/view/epreuves'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste</a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9 col-sm-9 col-xs-12">
                                    <div class="form-group">
                                        <label for="libelle_epreuve" class="control-label">
                                            <span class="text-danger">*</span> Libellé Epreuve
                                        </label>
                                        <input type="text"
                                               class="form-control <?php if ($validation->hasError('libelle_epreuve')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="libelle_epreuve" id="libelle_epreuve"
                                               value="<?= set_value('libelle_epreuve') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_epreuve'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="numero_epreuve" class="control-label">
                                            <span class="text-danger">*</span> Numéro Epreuve
                                        </label>
                                        <select id="numero_epreuve" name="numero_epreuve"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('numero_epreuve')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un numéro --</option>
                                            <?php

                                            for ($count = 1; $count <= 25; $count++): ?>
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
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="type_epreuve" class="control-label">
                                            <span class="text-danger">*</span> Type Epreuve
                                        </label>
                                        <select id="type_epreuve" name="type_epreuve"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('type_epreuve')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un type --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($typesepreuves) && !empty($typesepreuves)):
                                                foreach ($typesepreuves as $key => $value): ?>
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
                                </div>

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
                                            <option selected="selected" disabled>-- Sélectionnez un critère --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($branches) && !empty($branches)):
                                                foreach ($branches as $key => $value): ?>
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

                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="periode_epreuve" class="control-label">
                                            <span class="text-danger">*</span> Période d'évaluation
                                        </label>
                                        <select id="periode_epreuve" name="periode_epreuve"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('periode_epreuve')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez une période --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($periodes) && !empty($periodes)):
                                                foreach ($periodes as $key => $value): ?>
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
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cotes_max" class="control-label">
                                            <span class="text-danger">*</span> Cotation Max
                                        </label>
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('cotes_max')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="cotes_max" id="cotes_max"
                                               value="<?= set_value('cotes_max') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cotes_max'); ?>
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

