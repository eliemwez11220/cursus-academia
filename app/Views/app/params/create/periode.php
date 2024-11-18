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
                            <h5 class="font-weight-bold">Configuration - Nouvelle Période</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Période</li>
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
                    $new_code_generate = "CPR" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
                    //form attributes
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/ecole/savePeriode/create/', $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('ecole/view/periodes'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste</a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer la période
                                </button>
                            
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="code_periode" class="control-label">
                                            <span class="text-danger">*</span> Code période
                                            
                                        </label>
                                        <select id="code_periode" name="code_periode"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'code_periode')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un degres --</option>
                                            <option value="E1" <?= set_select('code_periode', 'E1'); ?>>Examen E1</option>
                                            <option value="E2" <?= set_select('code_periode', 'E2'); ?>>Examen E2</option>
                                            <option value="E3" <?= set_select('code_periode', 'E3'); ?>>Examen E3</option>
                                            <option value="P1" <?= set_select('code_periode', 'P1'); ?>>Période P1</option>
                                            <option value="P2" <?= set_select('code_periode', 'P2'); ?>>Période P2</option>
                                            <option value="P3" <?= set_select('code_periode', 'P3'); ?>>Période P3</option>
                                            <option value="P4" <?= set_select('code_periode', 'P4'); ?>>Période P4</option>
                                            <option value="P5" <?= set_select('code_periode', 'P5'); ?>>Période P5</option>
                                            <option value="P6" <?= set_select('code_periode', 'P6'); ?>>Période P6</option>
                                            <option value="<?= $new_code_generate;?>" <?= set_select('code_periode', 'P6'); ?>>
                                                 <?= $new_code_generate;?>
                                            </option>
                                            
                                        </select>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'code_periode'); ?>
                                            </span>
                                        <?php endif;?>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="libelle_periode" class="control-label">
                                            <span class="text-danger">*</span> Libelle période
                                        </label>
                                        <input type="text"
                                               class="form-control <?php if($validation->hasError( 'libelle_periode')){echo 'is-invalid';} ?>"
                                               name="libelle_periode" id="libelle_periode"
                                               value="<?= set_value('libelle_periode') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_periode'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="type_periode" class="control-label">
                                            <span class="text-danger">*</span> Type Période
                                        </label>
                                        <select id="type_periode" name="type_periode"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'type_periode')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un degres --</option>
                                            <option value="cotation" <?= set_select('type_periode', 'cotation'); ?>>Cotation</option>
                                            <option value="paiement" <?= set_select('type_periode', 'paiement'); ?>>Paiement</option>
                                            <option value="epreuve" <?= set_select('type_periode', 'epreuve'); ?>>Epreuve</option>
                                            <option value="new" <?= set_select('type_periode', 'new'); ?>>Autre (A preciser)</option>
                                        </select>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'type_periode'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                    <div id="inputnewitemshow" style="display:none;">
                                        <div class="form-group">
                                            <label for="nouveau_type_periode" class="control-label">
                                                <span class="text-danger">*</span> Libelle nouveau type période
                                            </label>
                                            <input type="text"
                                                   class="form-control <?php if($validation->hasError( 'nouveau_type_periode')){echo 'is-invalid';} ?>"
                                                   name="nouveau_type_periode"
                                                   id="nouveau_type_periode"
                                                   value="<?= set_value('nouveau_type_periode') ?>"
                                                   style="border-radius: 10px!important;"/>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'nouveau_type_periode'); ?>
                                            </span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">

                                    <div class="form-group">
                                        <label for="date_debut_annee">Date début période </label>
                                        <div class="input-group date" id="date_debut_annee"
                                             data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input
<?php if($validation->hasError( 'date_debut_periode')){echo 'is-invalid';} ?>"
                                                   name="date_debut_periode"
                                                   id="date_debut_annee" data-target="#date_debut_annee"
                                                   value="<?= set_value('date_debut_periode') ?>"/>
                                            <div class="input-group-append" data-target="#date_debut_annee"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'date_debut_periode'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_fin_annee">Date fin de clôture Période:</label>

                                        <div class="input-group date" id="date_fin_annee"
                                             data-target-input="nearest">
                                            <input type="text" name="date_fin_periode"
                                                   class="form-control datetimepicker-input
                                                   <?php if($validation->hasError( 'date_fin_periode')){echo 'is-invalid';} ?>"
                                                   data-target="#date_fin_periode" id="date_fin_annee"
                                                   value="<?= set_value('date_debut_periode') ?>"/>
                                            <div class="input-group-append" data-target="#date_fin_annee"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'date_fin_periode'); ?>
                                            </span>
                                        <?php endif;?>
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

