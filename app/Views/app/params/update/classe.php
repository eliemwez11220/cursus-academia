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
                            <h5 class="font-weight-bold text-uppercase">Modification promotion <?= (isset($promotion)) ? ($promotion['promotion_libelle']) : 'Aucun libelle'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">promotion</li>
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
                    echo form_open(base_url() . '/ecole/savepromotion/update/'.(isset($promotion) ? esc($promotion['promotion_uid']) :''), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('ecole/view/promotions'); ?>"
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
                                        <td><label for="code_promotion">Code promotion</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="code_promotion"
                                                   id="code_promotion"
                                                   value="<?= (isset($promotion)) ? esc($promotion['promotion_code']) : set_value('code_promotion') ?>"
                                                   style="border-radius: 10px!important;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="libelle_promotion">Nom promotion</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="libelle_promotion"
                                                   id="libelle_promotion"
                                                   value="<?= (isset($promotion)) ? ($promotion['promotion_libelle']) :set_value('libelle_promotion') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="degres_sid_promotion" class="control-label">
                                                <span class="text-danger">*</span> Degrés promotion
                                            </label>
                                        </td>
                                        <td>
                                            <select id="degres_sid_promotion" name="degres_sid_promotion"
                                                    class="form-control select2 select2-info <?php if($validation->hasError( 'degres_sid_promotion')){echo 'is-invalid';} ?>"
                                                    data-dropdown-css-class="select2-info">
                                                <option selected="selected" disabled>-- Sélectionnez un degrès --</option>
                                                <?php
                                                $count = 1;
                                                if (isset($degres) && !empty($degres)):
                                                    foreach ($degres as $key => $value):
                                                        if (esc($value['degres_uid']) == esc($promotion['promotion_degres_uid'])): ?>
                                                        <option selected value="<?= esc($promotion['promotion_degres_uid']); ?>" <?= set_select('degres_sid_promotion', esc($promotion['promotion_degres_uid'])); ?>>
                                                            <?= ucfirst(($value['degres_libelle'])); ?></option>
                                                        <?php else:?>
                                                        <option value="<?= esc($value['degres_uid']); ?>" <?= set_select('degres_sid_promotion', esc($value['degres_uid'])); ?>>
                                                            <?= ucfirst(($value['degres_libelle'])); ?> 
                                                        </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucun degrès</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'degres_sid_promotion'); ?>
                                            </span>
                                            <?php endif;?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="cycle_sid_promotion" class="control-label">
                                                <span class="text-danger">*</span> Cycle
                                            </label>
                                        </td>
                                        <td>
                                            <select id="cycle_sid_promotion" name="cycle_sid_promotion"
                                                    class="form-control select2 select2-info <?php if($validation->hasError( 'cycle_sid_promotion')){echo 'is-invalid';} ?>"
                                                    data-dropdown-css-class="select2-info">
                                                <option selected="selected" disabled>-- Sélectionnez un cycle --</option>
                                                <?php
                                                $count = 1;
                                                if (isset($cycles) && !empty($cycles)):
                                                    foreach ($cycles as $key => $value):
                                                if (esc($value['cycle_uid']) == esc($promotion['promotion_cycle_uid'])): ?>
                                                    <option selected value="<?= esc($promotion['promotion_cycle_uid']); ?>" <?= set_select('cycle_sid_promotion', esc($promotion['promotion_cycle_uid'])); ?>>
                                                        <?= ucfirst(($value['cycle_libelle'])); ?></option>
                                                <?php else:?>
                                                        <option value="<?= esc($value['cycle_uid']); ?>" <?= set_select('cycle_sid_promotion', esc($value['cycle_uid'])); ?>>
                                                            <?= ucfirst(($value['cycle_libelle'])); ?>
                                                <?php endif; ?>

                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucun cycle</option>
                                                <?php endif; ?>

                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cycle_sid_promotion'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="filiere_sid_promotion" class="control-label">
                                                <span class="text-danger">*</span> filieres & options
                                            </label>
                                        </td>
                                        <td>
                                            <select id="filiere_sid_promotion" name="filiere_sid_promotion"
                                                    class="form-control select2 select2-info <?php if($validation->hasError( 'filiere_sid_promotion')){echo 'is-invalid';} ?>"
                                                    data-dropdown-css-class="select2-info">
                                                <option selected="selected" disabled>-- Sélectionnez une option--</option>
                                                <?php
                                                $count = 1;
                                                if (isset($filieres) && !empty($filieres)):
                                                    foreach ($filieres as $key => $value):
                                                if (esc($value['filiere_uid']) == esc($promotion['promotion_filiere_uid'])): ?>
                                                    <option selected value="<?= esc($promotion['promotion_filiere_uid']); ?>" <?= set_select('filiere_sid_promotion', esc($promotion['promotion_filiere_uid'])); ?>>
                                                        <?= ucfirst(($value['filiere_libelle'])); ?> - <?= ucfirst(($value['option_libelle'])); ?></option>
                                                <?php else:?>
                                                        <option value="<?= esc($value['filiere_uid']); ?>" <?= set_select('filiere_sid_promotion', esc($value['filiere_uid'])); ?>>
                                                            <?= ucfirst(($value['filiere_libelle'])); ?> - <?= ucfirst(($value['option_libelle'])); ?>
                                                        </option>
                                                <?php endif; ?><?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucune filiere</option>
                                                <?php endif; ?>

                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'filiere_sid_promotion'); ?>
                                            </span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="titulaire_promotion">Titulaire promotion</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="titulaire_promotion"
                                                   id="titulaire_promotion"
                                                   value="<?= (isset($promotion)) ? ($promotion['promotion_titulaire']) :set_value('titulaire_promotion') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr><tr>
                                        <td><label for="effectif_etudiants">Effectif Elèves</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="effectif_etudiants"
                                                   id="effectif_etudiants"
                                                   value="<?= (isset($promotion)) ? ($promotion['promotion_effectif']) :set_value('effectif_etudiants') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="commentaire_promotion">Observation ou commentaire:</label></td>
                                        <td>
                                            <textarea name="commentaire_promotion" class="form-control"
                                                      id="commentaire_promotion" cols="30" rows="5"><?= (isset($promotion)) ? ($promotion['promotion_comment']) :set_value('commentaire_promotion') ?></textarea>
                                        </td>
                                    </tr>
                                </table>
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
