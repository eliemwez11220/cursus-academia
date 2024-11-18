<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    
                     <a href="<?= base_url('student/cursus/parcours') ?>" class="text-uppercase btn btn-default btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> VOIR LA LISTE</a>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Détails Parcours</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- tables -->
                    <?php if (isset($inscription)): ?>

                        <!--Card-->
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                   <h5 class="text-uppercase font-weight-bold">
                                        Parcours :
                                       
                                        <?= isset($etudiant) ? esc($etudiant['etudiant_nom']) : ''; ?>
                                        <?= isset($etudiant) ? esc($etudiant['etudiant_postnom']) : ''; ?>
                                        <?= isset($etudiant) ? esc($etudiant['etudiant_prenom']) : ''; ?> - 
                                         <?= isset($etudiant) ? esc($etudiant['etudiant_matricule']) : ''; ?>
                                    </h5>
                                </div>
                                <div class="card-tools printoff">
                                       
                                    <a data-toggle="modal" data-target="#nouvelle_annee"
                                        href="#" class="btn btn-info btn-xs  text-uppercase">
                                        <span data-toggle="tooltip" data-placement="top"
                                              title="Cliquer pour créer un parcours">
                                            <i class="fa fa-plus"></i> Ajouter un parcours
                                        </span>
                                    </a>
                                    <a href="javascript:void();" class="text-uppercase btn btn-success btn-xs"  onclick="window.print();">
                                        <i class="fa fa-print"></i> IMPRIMER</a>
                                </div>
                            </div>
                            <!--Card content-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-hover"
                                           id="datatablesReportingActions">
                                        <thead>
                                        <tr class="text-uppercase text-center small">
                                            <th>Pourcentage</th>
                                            <th>Mention</th>
                                            <th>Année</th>
                                            <th>Promotion</th>
                                            <th>Option</th>
                                            <th>Cycle</th>
                                            <th>Date</th>
                                            <th>Ecole</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($inscription)) :
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($inscription as $value) : ?>
                                                <tr class="small text-center">
                                                     <td class="text-uppercase"><?= $value['inscription_pourcentage']; ?></td>
                                                      <td class="text-uppercase"><?= $value['inscription_mention']; ?></td>
                                                    <td class="text-uppercase"><?= $value['annee_libelle']; ?></td>
                                                    <td class="text-uppercase"><?= $value['promotion_libelle']; ?>
                                                    <?= $value['option_libelle']; ?></td>
                                                    <td class="text-uppercase"><?= $value['filiere_libelle']; ?></td>
                                                    <td class="text-uppercase"><?= $value['cycle_libelle']; ?></td>
                                                    <td class="text-uppercase"><?= $value['inscription_date']; ?></td> 
                                                    <td class="text-uppercase"><?= $value['inscription_provenance']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="alert alert-info">
                                                    <strong>
                                                        Aucun parcours
                                                    </strong>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.Card-->
                    <?php endif; ?>
                    
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>

<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvelle_annee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Enregistrement parcours</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php

                    //form validation services call
            $validation = \Config\Services::validation();

            $etudiant_reference = isset($etudiant) ? esc($etudiant['etudiant_uid']) : '';
            
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url() . '/student/saveetudiantParcours/'.$etudiant_reference, $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="annee_scolaire" class="control-label">
                                <span class="text-danger">*</span> Année
                            </label>
                            <select id="annee_scolaire" name="annee_scolaire"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Année --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($annees) && !empty($annees)):
                                                foreach ($annees as $key => $value): ?>
                                                    <option value="<?= esc($value['annee_uid']); ?>" <?= set_select('annee_scolaire', esc($value['annee_uid'])); ?>>
                                                        <?= ucfirst(esc($value['annee_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                         <?php if ($validation->hasError('annee_libelle')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('annee_libelle'); ?></span>
                                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        
                                    <div class="form-group">
                                        <label for="promotion_etudiant"><span class="text-danger">*</span>Promotion</label>
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('promotion_etudiant')) ? ' is-invalid' : '' ?>"
                                                id="promotion_etudiant"
                                                name="promotion_etudiant"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($promotions) && !empty($promotions)):
                                                foreach ($promotions as $key => $value): ?>
                                                    <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotion_etudiant', esc($value['promotion_uid'])); ?>>
                                                        <?= ucfirst(($value['promotion_libelle'])); ?>
                                                        - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                        - <?= ucfirst(($value['option_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('promotion_etudiant')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('promotion_etudiant'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                       
                                            <div class="form-group">
                                                <label for="date_inscription"><span class="text-danger">*</span>Date d'inscription</label>
                                                <div class="input-group date" id="date_format_abrege"
                                                     data-target-input="nearest">
                                                    <input type="date"
                                                           class="form-control datetimepicker-input <?= ($validation->hasError('date_inscription')) ? ' is-invalid' : '' ?>"
                                                           id="date_inscription"
                                                           value="<?= set_value('date_inscription') ?>"
                                                           data-target="#date_format_abrege" name="date_inscription"/>
                                                    <div class="input-group-append" data-target="#date_format_abrege"
                                                         data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($validation->hasError('date_inscription')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('date_inscription'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                         <div class="col-lg-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="ecole_provenance"><span class="text-danger">*</span>
                                                Ecole de provenance du parcours</label>
                                                <input type="text" name="ecole_provenance" id="ecole_provenance"
                                                       class="form-control <?= ($validation->hasError('ecole_provenance')) ? ' is-invalid' : '' ?>"
                                                       value="<?= set_value('ecole_provenance'); ?>" placeholder="Nom Ecole Provenance">

                                                <?php if ($validation->hasError('ecole_provenance')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('ecole_provenance'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        

                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                       
                                            <div class="form-group">
                                                <label for="pourcentage"><span class="text-danger">*</span>Pourcentage obtenu</label>
                                                <div class="input-group">
                                                    <input type="number"
                                                           class="form-control <?= ($validation->hasError('pourcentage')) ? ' is-invalid' : '' ?>"
                                                           id="pourcentage"
                                                           value="<?= set_value('pourcentage') ?>"
                                                           step="0.00" name="pourcentage"/>
                                                    
                                                </div>
                                                <?php if ($validation->hasError('pourcentage')) { ?>
                                                    <span class="invalid-feedback"> <?= $validation->getError('pourcentage'); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        
                                    <div class="form-group">
                                        <label for="mention"><span class="text-danger">*</span>
                                    Mention</label>
                                        <select class="form-control select2 select2-info text-capitalize 
                                        <?= ($validation->hasError('mention')) ? ' is-invalid' : '' ?>"
                                                id="mention"
                                                name="mention"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez --</option>
                                            <option value="grande-distinction">Grande distinction</option>
                                            <option value="distinction">distinction</option>
                                            <option value="satisfaction">satisfaction</option>
                                            <option value="ajournée">ajournée</option>
                                        </select>
                                        <?php if ($validation->hasError('mention')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('mention'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                       
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer parcours</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->