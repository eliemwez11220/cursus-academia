<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Création nouvelle promotion</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">promotions</li>
                            </ol>
                        </div>
                    </div> </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Création d'une nouvelle promotion</h4>
                            <div class="card-tools float-right">
                                <a  href="<?= base_url('ecole/view/promotions');?>" class="btn btn-default btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour fermer cette page et revenir a la liste">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste des promotions
                                    </span>
                                </a>
                            </div>
                        </div>
                        <?php
                        $validation = \Config\Services::validation();
                        //new code generated automatically
                        $aleatoire_value = "0123456789";
                        $new_code_generate = "CCL" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
                        //form attributes
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('ecole/savepromotion/create'), $attributes);
                        ?>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="code_promotion" class="control-label">
                                            <span class="text-danger">*</span> Code promotion
                                            <span class="small">
                                    (Ce code a été généré automatiquement.
                                    Vous pouvez modifier manuellement en cas de besoin avant d'enregistrer)
                                </span>
                                        </label>
                                        <input type="text"
                                               class="form-control bg-light text-capitalize <?php if($validation->hasError( 'code_promotion')){echo 'is-invalid';} ?>"
                                               name="code_promotion"
                                               id="code_promotion"
                                               value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_promotion') ?>"
                                               style="border-radius: 10px!important;"
                                               />
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'code_promotion'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="libelle_promotion" class="control-label">
                                            <span class="text-danger">*</span> Libellé de la promotion
                                        </label>
                                        <input type="text"
                                               class="form-control bg-light text-capitalize <?php if($validation->hasError( 'libelle_promotion')){echo 'is-invalid';} ?>"
                                               name="libelle_promotion"
                                               id="libelle_promotion"
                                               value="<?= set_value('libelle_promotion') ?>"
                                               style="border-radius: 10px!important;"
                                               />
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_promotion'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="degres_sid_promotion" class="control-label">
                                            <span class="text-danger">*</span> Degrés promotion
                                        </label>
                                        <select id="degres_sid_promotion" name="degres_sid_promotion"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'degres_sid_promotion')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un degré --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($degres) && !empty($degres)):
                                                foreach ($degres as $key => $value): ?>
                                                    <option value="<?= esc($value['degres_uid']); ?>" <?= set_select('degres_sid_promotion', esc($value['degres_uid'])); ?>>
                                                        <?= ucfirst($value['degres_libelle']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun degres</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'degres_sid_promotion'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="cycle_sid_promotion" class="control-label">
                                            <span class="text-danger">*</span> Cycles
                                        </label>
                                        <select id="cycle_sid_promotion" name="cycle_sid_promotion"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'cycle_sid_promotion')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un cycle --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($cycles) && !empty($cycles)):
                                                foreach ($cycles as $key => $value): ?>
                                                    <option value="<?= esc($value['cycle_uid']); ?>" <?= set_select('cycle_sid_promotion', esc($value['cycle_uid'])); ?>>
                                                        <?= ucfirst(($value['cycle_libelle'])); ?></option>
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
                                    </div>
                                </div>        <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="filiere_sid_promotion" class="control-label">
                                            <span class="text-danger">*</span> Filière / Option
                                        </label>
                                        <select id="filiere_sid_promotion" name="filiere_sid_promotion"
                                                class="form-control select2 select2-info <?php if($validation->hasError( 'filiere_sid_promotion')){echo 'is-invalid';} ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez une option--</option>
                                            <?php
                                            $count = 1;
                                            if (isset($filieres) && !empty($filieres)):
                                                foreach ($filieres as $key => $value): ?>
                                                    <option value="<?= esc($value['filiere_uid']); ?>" <?= set_select('filiere_sid_promotion', esc($value['filiere_uid'])); ?>>
                                                        <?= ucfirst(($value['filiere_libelle'])); ?> - <?= ucfirst(($value['option_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucune filiere</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'filiere_sid_promotion'); ?>
                                            </span>
                                        <?php endif;?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer la promotion</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.card-body -->
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
