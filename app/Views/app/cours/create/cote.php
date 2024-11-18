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
                            <h5 class="font-weight-bold">Nouvelle Cotation</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Cotes Etudiants</li>
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
                    echo form_open(base_url('cours/saveCoteetudiant/create'), $attributes);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('cours/view/cotes'); ?>"
                                   class="btn btn-dark btn-rounded text-uppercase">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste</a>
                            </div>
                            <div class="card-tools float-right">
                               <a href="<?= base_url('office/grille'); ?>"
                                                       class="btn btn-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                       Voir la grille
                                                    </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                    
                                        <select id="etudiant_uid" name="etudiant"
                                                class="form-control select2 select2-info text-uppercase <?php if ($validation->hasError('etudiant')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option  disabled>-- Sélectionnez un étudiant --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($etudiants) && !empty($etudiants)):
                                                foreach ($etudiants as $key => $value): ?>
                                                    <option value="<?= ($value['etudiant_uid']); ?>" 
                                                    <?= (session()->etudiant == ($value['etudiant_uid']))? 'selected': set_select('etudiant', esc($value['etudiant_uid'])); ?>> <?= esc($value['etudiant_matricule']); ?> - 
                                                    <?= ($value['etudiant_nom']); ?>
                                                    <?= ($value['etudiant_postnom']); ?>
                                                    <?= ($value['etudiant_prenom']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'etudiant'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-12">
                                   <div class="form-group">
                                    <input id="matricule_etudiant" type="text" name="matricule_etudiant" value="<?= session()->etudiantmatricule; ?>" readonly class="form-control" placeholder="Matricule(*)" data-toggle="tooltip" data-placement="top"
                                                   title="Matricule">
                                   </div>
                               </div>
                            <div class="col-lg-3 col-sm-3 col-xs-12">
                                   <div class="form-group">
                                    <input id="promotion_student" type="text" name="promotion_student" 
                                    value="<?= session()->etudiantpromotion; ?>" readonly class="form-control text-uppercase" 
                                    placeholder="Promotion(*)" data-toggle="tooltip" data-placement="top"
                                                   title="Promotion">
                                   </div>
                                </div>
                              </div>
                                <div class="row">   

                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="matiere" class="control-label">
                                            <span class="text-danger">*</span> Cours 
                                        </label>
                                        <select id="matiere" name="matiere"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('matiere')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez un cours --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($matieres) && !empty($matieres)):
                                                foreach ($matieres as $key => $value): 
                                                    if (session()->etudiantpromotionuid == $value['matiere_promotion_uid']):
                                                    ?>
                                                    <option value="<?= esc($value['matiere_uid']); ?>" <?= set_select('matiere', esc($value['matiere_uid'])); ?>>
                                                        <?= ucfirst(esc($value['branche_libelle'])); ?>
                                                        [Pondération/<?= esc($value['matiere_ponderation']); ?>]
                                                        [Crédit /<?= esc($value['matiere_credit_horaire']); ?>]
                                                    </option>
                                                     <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                           
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'matiere'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                              <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="periode" class="control-label">
                                            <span class="text-danger">*</span> Période d'évaluation
                                        </label>
                                        <select id="periode" name="periode"
                                                class="form-control select2 select2-info <?php if ($validation->hasError('periode')) {
                                                    echo 'is-invalid';
                                                } ?>"
                                                data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez une période --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($periodes) && !empty($periodes)):
                                                foreach ($periodes as $key => $value): ?>
                                                    <option value="<?= esc($value['periode_uid']); ?>" <?= set_select('periode', esc($value['periode_uid'])); ?>>
                                                        <?= ucfirst(esc($value['periode_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'periode'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                               
                                <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <!-- radio -->
                                    <div class="form-group mt-3">
                                        <div class="icheck-info d-inline">
                                            <input type="radio" name="type_cote" id="radioSuccess1"
                                                    value="moyenne" >
                                                <label for="radioSuccess1">
                                                    Cote Moyenne
                                                </label>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <div class="form-group mt-3">
                                        <div class="icheck-info d-inline">
                                            <input type="radio" name="type_cote" id="radioSuccess2" value="examen" >
                                            <label for="radioSuccess2">
                                                Cote Examen
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-2 col-sm-6 col-xs-12">
                                    <div class="form-group mt-3">
                                        <div class="icheck-info d-inline">
                                            <input type="radio" checked name="type_cote" id="annuelle" value="annuelle" >
                                            <label for="annuelle">
                                                Cote Annuelle
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php if ($validation->hasError('type_cote')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('type_cote'); ?></span>
                                        <?php } ?>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="form-group"> <label for="cote_obtenue" class="control-label">
                                            <span class="text-danger">*</span> Cote Obtenue
                                        </label>
                                <div class="input-group">
                                   
                                        <input type="number" min="0" step="0.00"
                                               class="form-control <?php if ($validation->hasError('cote_obtenue')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="cote_obtenue" id="cote_obtenue"
                                               value="<?= set_value('cote_obtenue') ?>"/>
                                       
                                    <div class="input-group-append">
                                           <button type="submit" class="btn btn btn-info text-uppercase" data-toggle="tooltip" data-placement="top" title="cliquez pour ajouter">
                                      <i class="fa fa-check-circle fa-lg"></i>Ajouter
                                    </button>
                                        </div>
                                   
                                    </div>
                                     <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'cote_obtenue'); ?>
                                            </span>
                                        <?php endif; ?>
                                </div>
                            </div> <!-- -->
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
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="card bg-secondary">
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="table_achats">
                                            <thead>
                                                <tr class="text-uppercase small">
                                                    <th>#</th>
                                                    <th>COURS</th>
                                                    <th>PERIODE</th>
                                                    <th>TYPE</th>
                                                    <th>PONDERATION</th>
                                                    <th class="text-center">COTE OBTENUE</th>
                                                    <th>TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if (isset($cotes) && !empty($cotes)):
                                                    foreach ($cotes as $key => $value):
                                                        if (session()->etudiant == $value['cote_etudiant_uid']):
                                                            $total = ($value['cote_point_obtenu'])*$value['matiere_ponderation'];
                                                        ?>
                                                        <tr class="small">
                                                        <td class="text-center"><?= $count++; ?></td>

                                                        <td><?= esc($value['branche_libelle']); ?></td>

                                                        <td><?= esc($value['periode_libelle']); ?></td>
                                                        <td><?= esc($value['cote_type']); ?></td>
                                                        <td><?= esc($value['matiere_ponderation']); ?></td>
                                                       <td class="text-center">
                                                       <?= esc($value['cote_point_obtenu']); ?>/
                                                       <?= ($value['matiere_credit_horaire']); ?></td>
                                                       <td class="text-center">
                                                       <?= $total; ?>/
                                                       <?= ($value['matiere_volume_horaire']); ?></td>

                                                      <td>
                                                    <a  class="btn btn-danger btn-xs"  href="<?= base_url('cours/remove/cote/'.($value['cote_uid'])); ?>"
                                                       onclick="return confirm('Etes-vous sûr de vouloir supprimer définitivement cette côte?');">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Suppression de la côte"> <i class="fas fa-trash"></i></span>
                                                    </a>
                                                </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                    <tr class="small alert alert-warning">
                                                        <td colspan="5" class="text-uppercase">
                                                            <strong>Aucune cote</strong>
                                                        </td>
                                                     </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                        </div>

                                    </div>
                                </div>
                                </div>
                                </div>
                        



        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>

