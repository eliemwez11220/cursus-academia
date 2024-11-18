<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase">Transferts des étudiants</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php base_url('overview/type/dashboard')?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Transferts</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    //matricule generated
                    $aleatoire_value = "0123456789";
                    $new_send_student_generate = "TRF" . date('Y') . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(4, 20))), 0, 4);

                    //form validation services call
                    $validation = \Config\Services::validation();

                    //form
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/etudiant/saveTransfert/create/', $attributes);
                    ?>
                        <div class="card card-light">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="card-tools float-left">
                                        <a href="<?= base_url('etudiant/dossier/transfert'); ?>"
                                           class="btn btn-default btn-rounded text-uppercase">
                                            <i class="fa fa-arrow-circle-left fa-lg"></i> Revenir a la liste
                                        </a>
                                    </div>
                                </div>
                                <div class="card-tools float-right">
                                    <button type="submit" class="btn btn-info btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-check-circle fa-lg"></i> Enregistrer
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- Matricule etudiant -->
                                        <div class="form-group">
                                            <label for="code_transfert"><span class="text-danger">*</span> Code référence transfert étudiant
                                                <span class="small text-info">(Géneré automatiquement)</span></label>

                                            <input type="text" name="code_transfert" id="code_transfert"
                                                   class="form-control <?= ($validation->hasError('code_transfert')) ? ' is-invalid' : '' ?>"

                                                   value="<?= (!empty($new_send_student_generate)) ? $new_send_student_generate : set_value('code_transfert') ?>">

                                            <?php if ($validation->hasError('code_transfert')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('code_transfert'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div><!-- left column -->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="etudiant_uid_transfert">Elève à transferer</label>
                                            <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('etudiant_uid_transfert')) ? ' is-invalid' : '' ?>"
                                                    id="etudiant_uid_transfert"
                                                    name="etudiant_uid_transfert"
                                                    data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option selected="selected" disabled>-- Sélectionnez un étudiant --</option>
                                                <?php
                                                $count = 1;
                                                if (isset($etudiants) && !empty($etudiants)):
                                                    foreach ($etudiants as $key => $value): ?>
                                                        <option value="<?= esc($value['etudiant_uid']); ?>" <?= set_select('etudiant_uid_transfert', esc($value['etudiant_uid'])); ?>>
                                                            <?= ucfirst(esc($value['etudiant_matricule'])); ?> -
                                                            <?= ucfirst(esc($value['etudiant_nom'])); ?>-<?= ucfirst(esc($value['etudiant_prenom'])); ?>
                                                            <?= ucfirst(esc($value['etudiant_postnom'])); ?> | <?= ucfirst(($value['promotion_libelle'])); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if ($validation->hasError('etudiant_uid_transfert')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('etudiant_uid_transfert'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="ecole_uid_transfert">Nouvelle école de destination</label>
                                            <select id="ecole_uid_transfert" name="ecole_uid_transfert"
                                                    class="form-control select2 select2-info"
                                                    data-dropdown-css-class="select2-info">
                                                <option selected="selected" disabled>-- Ecole attachée --</option>
                                                <?php
                                                $count = 1;
                                                if (isset($ecoles) && !empty($ecoles)):
                                                    foreach ($ecoles as $key => $value):?>
                                                            <option value="<?= esc($value['ecole_uid']); ?>" <?= set_select('ecole_uid_transfert', esc($value['ecole_uid'])); ?>>
                                                                <?= ucfirst(($value['ecole_libelle'])); ?>
                                                            </option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucune école n'est déjà enregistrée</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'ecole_uid_transfert'); ?>
                                            </span>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="motif_transfert">Motif de transfert</label>
                                        <div class="form-group">
                                            <textarea name="motif_transfert" id="motif_transfert" cols="30" rows="3"
                                                      class="form-control" placeholder="Decrivez le motif de transfert ici..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                    <!-- /.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </filiere>
</div><!-- /.container-fluid -->

