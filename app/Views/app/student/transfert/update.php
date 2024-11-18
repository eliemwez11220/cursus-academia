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
                            <h5 class="font-weight-bold">Modification
                                Transfert
                                numéro <?= (isset($transfert)) ? esc($transfert['transfert_code']) : '' ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Transferts</li>
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
                    echo form_open(base_url() . '/etudiant/saveTransfert/update/' . (isset($transfert) ? esc($transfert['transfert_uid']) : ''), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('etudiant/dossier/transfert'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> Voir la liste
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
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label for="code_transfert"><span class="text-danger">*</span>Code référence
                                                transfert</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="code_transfert"
                                                   id="code_transfert"
                                                   value="<?= (isset($transfert)) ? esc($transfert['transfert_code']) : set_value('code_transfert') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                            <?php if (isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'code_transfert'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="etudiant_uid_transfert"><span class="text-danger">*</span>Elève
                                                transferé</label></td>
                                        <td>
                                            <div class="form-group">

                                                <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('etudiant_uid_transfert')) ? ' is-invalid' : '' ?>"
                                                        id="etudiant_uid_transfert"
                                                        name="etudiant_uid_transfert"
                                                        data-dropdown-css-class="select2-info" style="width: 100%;">
                                                         <option disabled>-- Sélectionnez un étudiant --
                                                                </option>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($etudiants) && !empty($etudiants)):
                                                        foreach ($etudiants as $key => $value):
                                                            if (isset($transfert)) {
                                                                if (esc($transfert['transfert_etudiant_uid']) == esc($value['etudiant_uid'])) { ?>
                                                                    <option selected
                                                                            value="<?= esc($value['etudiant_uid']); ?>" <?= set_select('etudiant_uid_transfert', esc($value['etudiant_uid'])); ?>>
                                                                        <?= ucfirst(esc($value['etudiant_matricule'])); ?>-
                                                                        <?= ucfirst(esc($value['etudiant_nom'])); ?>
                                                                        -<?= ucfirst(esc($value['etudiant_prenom'])); ?>
                                                                        <?= ucfirst(esc($value['etudiant_postnom'])); ?>
                                                                        | <?= ucfirst(esc($value['promotion_libelle'])); ?>
                                                                    </option>
                                                                <?php }
                                                            } ?>
                                                            <option value="<?= esc($value['etudiant_uid']); ?>" <?= set_select('etudiant_uid_transfert', esc($value['etudiant_uid'])); ?>>
                                                                <?= ucfirst(esc($value['etudiant_matricule'])); ?> -
                                                                <?= ucfirst(esc($value['etudiant_nom'])); ?>
                                                                -<?= ucfirst(esc($value['etudiant_prenom'])); ?>
                                                                <?= ucfirst(esc($value['etudiant_postnom'])); ?>
                                                                | <?= ucfirst(esc($value['promotion_libelle'])); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if ($validation->hasError('etudiant_uid_transfert')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('etudiant_uid_transfert'); ?></span>
                                                <?php } ?>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="ecole_uid_transfert"><span class="text-danger">*</span>Nouvelle
                                                école</label></td>
                                        <td>

                                            <div class="form-group">
                                                <select id="ecole_uid_transfert" name="ecole_uid_transfert"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                    <?php
                                                    
                                                    $count = 1;
                                                    if (isset($ecoles) && !empty($ecoles)):
                                                        foreach ($ecoles as $key => $value):
                                                            if (isset($transfert)) {

                                                                if (esc($transfert['transfert_ecole_nouvelle']) == esc($value['ecole_uid'])) { ?>
                                                                    <option selected
                                                                            value="<?= esc($value['ecole_uid']); ?>" <?= set_select('ecole_uid_transfert', esc($value['ecole_uid'])); ?>>
                                                                        <?= ucfirst(esc($value['ecole_libelle'])); ?>
                                                                        - <?= ucfirst(esc($value['ecole_code'])); ?>
                                                                    </option>
                                                                <?php }
                                                            } else { ?>
                                                                <option selected disabled>-- Sélectionnez une école --
                                                                </option>
                                                            <?php } ?>
                                                            <option value="<?= esc($value['ecole_uid']); ?>" <?= set_select('ecole_uid_transfert', esc($value['ecole_uid'])); ?>>
                                                                <?= ucfirst(esc($value['ecole_libelle'])); ?>
                                                                - <?= ucfirst(esc($value['ecole_code'])); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option>Aucune école n'est déjà enregistrée</option>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if (isset($validation)): ?>
                                                    <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'ecole_uid_transfert'); ?>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="statut_transfert"><span class="text-danger">*</span>
                                                Statut transfert
                                            </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <select id="statut_transfert" name="statut_transfert"
                                                        class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('statut_transfert')) ? ' is-invalid' : '' ?>"
                                                        data-dropdown-css-class="select2-info" style="width: 100%;">

                                                    <?php

                                                    if (isset($transfert)):
                                                        if (!empty(esc($transfert['transfert_statut']))) { ?>
                                                            <option selected
                                                                    value="<?= esc($transfert['transfert_statut']); ?>" <?= set_select('statut_transfert', esc($transfert['transfert_statut'])); ?>>
                                                                <?= ucfirst(esc($transfert['transfert_statut'])); ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php else: ?>

                                                        <option selected="selected" disabled>-- Sélectionnez un statut
                                                            --
                                                        </option>
                                                    <?php endif; ?>
                                                    <option value="valide" <?= set_select('statut_transfert', 'valide'); ?>>
                                                        Validé
                                                    </option>
                                                    <option value="encours" <?= set_select('statut_transfert', 'encours'); ?>>
                                                        Encours
                                                    </option>
                                                    <option value="annule" <?= set_select('statut_transfert', 'annule'); ?>>
                                                        Annulé
                                                    </option>


                                                </select>
                                                <?php if ($validation->hasError('statut_transfert')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('statut_transfert'); ?></span>
                                                <?php } ?>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="adresse_parent">Motif de transfert:</label></td>
                                        <td>
                                            <textarea name="motif_transfert" class="form-control"
                                                      id="motif_transfert" cols="30"
                                                      rows="3"><?= (isset($transfert)) ? esc($transfert['transfert_motif']) : set_value('motif_transfert') ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_transfert">Observation ou Annulation:</label></td>
                                        <td>
                                            <textarea name="commentaire_transfert" class="form-control"
                                                      id="commentaire_transfert" cols="30"
                                                      rows="3"><?= (isset($transfert)) ? esc($transfert['transfert_comment']) : set_value('commentaire_transfert') ?></textarea>
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
