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
                            <h5 class="font-weight-bold">Personnel - Modification Attribution Tâche</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Attribution Tâche</li>
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

                    $uid_tache = isset($tache) ? esc($tache['tache_uid']) : '';
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/agent/saveTache/update/' . $uid_tache, $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('agent/view/taches'); ?>"
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

                                <div class="col-lg-4 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="code_tache" class="control-label">
                                            <span class="text-danger">*</span> Code Tâche
                                        </label>
                                        <input type="text"
                                               class="form-control <?php if ($validation->hasError('code_tache')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="code_tache"
                                               id="code_tache"
                                               value="<?= isset($tache) ? esc($tache['tache_code']) : set_value('code_tache') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'code_tache'); ?>
                                            </span>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="libelle_tache" class="control-label">
                                            <span class="text-danger">*</span> Libellé Tâche
                                        </label>
                                        <input type="text"
                                               class="form-control <?php if ($validation->hasError('libelle_tache')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="libelle_tache" id="libelle_tache"
                                               value="<?= isset($tache) ? esc($tache['tache_libelle']) : set_value('libelle_tache') ?>"
                                               style="border-radius: 10px!important;"/>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_tache'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="type_tache" class="control-label">
                                            <span class="text-danger">*</span> Type Tâche
                                        </label>
                                        <select id="type_tache" name="type_tache"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('type_tache')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un type --</option>
                                            <?php
                                            $old_type = isset($tache) ? esc($tache['tache_type_uid']) : '';
                                            $count = 1;
                                            if (isset($typestaches) && !empty($typestaches)):
                                                foreach ($typestaches as $key => $value):
                                                    if ($old_type == esc($value['typestache_uid'])) { ?>
                                                        <option selected
                                                                value="<?= esc($old_type); ?>" <?= set_select('type_tache', esc($old_type)); ?>>
                                                            <?= ucfirst(esc($value['typestache_libelle'])); ?>
                                                        </option>
                                                    <?php } ?>
                                                    <option value="<?= esc($value['typestache_uid']); ?>" <?= set_select('type_tache', esc($value['typestache_uid'])); ?>>
                                                        <?= ucfirst(esc($value['typestache_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'type_tache'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="agent_tache" class="control-label">
                                            <span class="text-danger">*</span> Agent à attribuer la Tâche
                                        </label>
                                        <select id="agent_tache" name="agent_tache"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('agent_tache')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un agent --</option>
                                            <?php
                                            $old_agent = isset($tache) ? esc($tache['tache_agent_uid']) : '';
                                            $count = 1;
                                            if (isset($agents) && !empty($agents)):
                                                foreach ($agents as $key => $value):
                                                    if ($old_agent == esc($value['agent_uid'])) { ?>
                                                    <option selected
                                                            value="<?= esc($old_agent); ?>" <?= set_select('agent_tache', esc($old_agent)); ?>>
                                                        <?= ucfirst(esc($value['agent_nom'])); ?>
                                                        -<?= ucfirst(esc($value['agent_postnom'])); ?>-
                                                        <?= ucfirst(esc($value['agent_prenom'])); ?> -
                                                        <?= ucfirst(esc($value['agent_matricule'])); ?>
                                                    </option>
                                                    <?php } ?>
                                                    <option value="<?= esc($value['agent_uid']); ?>" <?= set_select('agent_tache', esc($value['agent_uid'])); ?>>
                                                        <?= ucfirst(esc($value['agent_nom'])); ?>
                                                        -<?= ucfirst(esc($value['agent_postnom'])); ?>-
                                                        <?= ucfirst(esc($value['agent_prenom'])); ?> -
                                                        <?= ucfirst(esc($value['agent_matricule'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'agent_tache'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">

                                    <div class="form-group">
                                        <label for="date_debut_annee">Date début exécution </label>
                                        <div class="input-group date" id="date_debut_annee"
                                             data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input
                                            <?php if ($validation->hasError('date_debut_tache')) {
                                                echo 'is-invalid';
                                            } ?>"
                                                   name="date_debut_tache"
                                                   id="date_debut_annee" data-target="#date_debut_annee"
                                                   value="<?= isset($tache)? esc($tache['tache_date_debut']):set_value('date_debut_tache') ?>"/>
                                            <div class="input-group-append" data-target="#date_debut_annee"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'date_debut_tache'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_fin_annee">Date fin exécution:</label>

                                        <div class="input-group date" id="date_fin_annee"
                                             data-target-input="nearest">
                                            <input type="text" name="date_fin_tache"
                                                   class="form-control datetimepicker-input
                                                   <?php if ($validation->hasError('date_fin_tache')) {
                                                       echo 'is-invalid';
                                                   } ?>"
                                                   data-target="#date_fin_periode" id="date_fin_annee"
                                                   value="<?= isset($tache)? esc($tache['tache_date_fin']):set_value('date_fin_tache') ?>"/>
                                            <div class="input-group-append" data-target="#date_fin_annee"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'date_fin_tache'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="compose-textarea"> <span class="text-danger">*</span> Description
                                            Exécution Tâche</label>
                                        <textarea id="compose-textarea" name="description_tache" class="form-control"
                                                  rows="10" style="height: 500px!important;"
                                                  placeholder="Decrivez l'execution de la tache ici..."><?= isset($tache)? esc($tache['tache_description']):set_value('description_tache'); ?></textarea>
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

