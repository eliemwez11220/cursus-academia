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
                            <h5 class="font-weight-bold">Modification -  <?= isset($periode)? ($periode['periode_libelle']):'' ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                        href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Periodes</li>
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
                    echo form_open(base_url() . '/ecole/savePeriode/update/'.(isset($periode)?esc($periode['periode_uid']):''), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('ecole/view/periodes'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a>
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
                                       class="table table-sm  table-hover table-head-fixed">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td><label for="code_periode">Code Période</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize <?php if($validation->hasError( 'code_periode')){echo 'is-invalid';} ?>"
                                                   name="code_periode"
                                                   id="code_periode"
                                                   value="<?= isset($periode)? esc($periode['periode_code']): set_value('code_periode') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'code_periode'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="libelle_periode">Libellé Période</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize <?php if($validation->hasError( 'libelle_periode')){echo 'is-invalid';} ?>"
                                                   name="libelle_periode"
                                                   id="libelle_periode"
                                                   value="<?= isset($periode)? ($periode['periode_libelle']):set_value('libelle_periode') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_periode'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="type_periode" class="control-label">
                                                Type Periode
                                            </label></td>
                                        <td>
                                            <div class="form-group">
                                                <select id="type_periode" name="type_periode"
                                                        class="form-control select2 select2-info <?php if($validation->hasError( 'type_periode')){echo 'is-invalid';} ?>"
                                                        data-dropdown-css-class="select2-info">
                                                    <option selected="selected" disabled>-- Sélectionnez une periode --</option>
                                                    <?php if(isset($periode)):?>
                                                    <option value="<?= esc($periode['periode_type']); ?>" selected>
                                                        <?= esc($periode['periode_type']); ?></option>
                                                    <?php else:?>
                                                    <?php endif;?>
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
                                                        <span class="text-danger">*</span> Libellé nouveau type période
                                                    </label>
                                                    <input type="text"
                                                           class="form-control text-capitalize"
                                                           name="nouveau_type_periode"
                                                           id="nouveau_type_periode"
                                                           value="<?= set_value('nouveau_type_periode') ?>"
                                                           style="border-radius: 10px!important;"/>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="date_debut_annee">Date début période </label></td>
                                        <td>
                                            <div class="input-group date" id="date_debut_annee"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input <?php if($validation->hasError( 'date_debut_periode')){echo 'is-invalid';} ?>"
                                                       name="date_debut_periode"
                                                       id="date_debut_annee" data-target="#date_debut_annee"
                                                       value="<?= isset($periode)? esc($periode['periode_date_debut']):
                                                           set_value('date_debut_periode') ?>"/>
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="date_fin_annee">Date fin de clôture Période:</label></td>
                                        <td>
                                            <div class="input-group date" id="date_fin_annee"
                                                 data-target-input="nearest">
                                                <input type="text" name="date_fin_periode"
                                                       value="<?= isset($periode)? esc($periode['periode_date_fin']):
                                                           set_value('date_fin_periode') ?>"
                                                       class="form-control datetimepicker-input <?php if($validation->hasError( 'date_fin_periode')){echo 'is-invalid';} ?>"
                                                       data-target="#date_fin_annee" id="date_fin_annee"/>
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
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="commentaire_periode">Observation ou commentaire:</label></td>
                                        <td>
                                            <textarea name="commentaire_periode" class="form-control"
                                                      id="commentaire_periode" cols="30" rows="5"><?= isset($periode)?($periode['periode_comment']):
                                                    set_value('commentaire_periode') ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <?= form_close(); ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
