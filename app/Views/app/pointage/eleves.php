<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mb-2">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Pointages Elèves</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Pointages</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php if (isset($promotionselected) && !empty($promotionselected)) {
        $newpromotion = $promotionselected['promotion_uid'];
    } ?>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <!-- Filtre des etudiants -->
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-uppercase">Pointages des Elèves pour la frequentation
                                journalière</h5>
                                <div class="card-tools">
                                    
                                        <a href="<?= base_url('pointage/view/etudiants'); ?>" class="btn btn-info btn-xs text-uppercase">
                                    Voir la liste de pointages</a>
                            
                                </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form role="form" method="get">
                                <div class="form-group">
                                    <label for="clsPrc" class="text-uppercase">promotion des étudiants à pointer</label>
                                    <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="clsPrc" name="clsPrc"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <?php
                                            if (isset($promotionselected) && !empty($promotionselected)) {
                                                ?>
                                                <option selected="selected"
                                                        value="<?= esc($promotionselected['promotion_uid']); ?>" <?= set_select('clsPrc', esc($promotionselected['promotion_uid'])); ?>>
                                                    <?= ucfirst(($promotionselected['promotion_libelle'])); ?>
                                                    - <?= ucfirst(($promotionselected['cycle_libelle'])); ?>
                                                    - <?= ucfirst(($promotionselected['option_libelle'])); ?>
                                                </option>
                                            <?php } else { ?>
                                                <option disabled selected>-- Sélectionnez une promotion --</option>
                                            <?php }
                                            //get all class
                                            $promotionselected = session()->get('promotionpointage');
                                            if (isset($promotions) && !empty($promotions)):
                                                foreach ($promotions as $key => $value):?>

                                                    <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('clsPrc', esc($value['promotion_uid'])); ?>>
                                                        <?= ucfirst(($value['promotion_libelle'])); ?>
                                                        - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                        - <?= ucfirst(($value['option_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info text-uppercase">
                                                <i class="fa fa-filter"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
              <?php if (isset($presences) && !empty($presences)): ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">
                                    <strong>
                                        Liste des presences journalieres
                                    </strong>
                                </h5>
                            </div>
                            <div class="card-tools">
                                <form role="form" id="presenceetudiantsForm" method="get">

                                    <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="anneeScolaire" name="dayof"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Date Jour Présence --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($pointages) && !empty($pointages)):
                                                foreach ($pointages as $key => $value): ?>
                                                    <option value="<?= esc($value['presence_date']); ?>" <?= set_select('dayof', esc($value['presence_date'])); ?>>
                                                        <?= ucfirst(esc($value['presence_date'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default text-uppercase">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatablesExample2"
                                   class="table table-sm table-bordered table-hover table-head-fixed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Matricule</th>
                                    <th>Noms</th>
                                    <th>promotion</th>
                                    <th>Date</th>
                                    <th>Observation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $count = 1;
                               
                                    foreach ($presences as $key => $value):?>
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td><?= esc($value['etudiant_matricule']); ?></td>
                                            <td class="text-uppercase">
                                                <?= ($value['etudiant_nom']); ?>
                                                <?= ($value['etudiant_postnom']); ?> <?= ($value['etudiant_prenom']); ?>
                                               
                                            </td>
                                            <td><?= ($value['promotion_libelle']); ?></td>
                                            <td><?= esc($value['presence_date']); ?></td>
                                       
                                               <td width="1px">
                                                <a data-toggle="modal"
                                                   data-target="#update_<?= $count; ?>"
                                                   href="#" class="btn btn-xs btn-default btn-block">
                                                <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit"></i></span>
                                                <span class="badge  <?= (esc($value['presence_libelle']) =='Present')?'badge-info':'badge-danger'; ?> ">
                                                    <?= esc($value['presence_libelle']); ?></span>
                                                </a>
                                            </td>
                                         
                                        </tr>


                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $count; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4 class="modal-title d-inline-flex text-uppercase">Modification
                                                            Présence <br> 
                                                            Elève : <?= esc($value['etudiant_matricule']); ?>
                                                             - <?= ($value['etudiant_nom']); ?>
                                                                
                                                            </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                   
                                                    $validation = \Config\Services::validation();
                                                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open(base_url().'/pointage/updatePointage/'.esc($value['presence_uid']), $attributes);
                                                    ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                        <div class="col-sm-12">

                                                            <div class="form-group">
                                                                <label for="presence_libelle">Libellé Pointage Présence</label>
                                                        <select class="form-control select2" id="browser<?= $count; ?>"
                                                                style="width: 100%;" name="presence_libelle">
                                                           
                                                                <?php if(!empty(esc($value['presence_libelle']))): ?>
                                                                    <option  selected="selected">
                                                                        <?= esc($value['presence_libelle']); ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            
                                                            <option disabled="disabled">-- Justification
                                                                --
                                                            </option>
                                                            <option>Absent</option>
                                                            <option>Maladie</option>
                                                            <option>Renvoie</option>
                                                            <option>Circonstance</option>
                                                            <option>Absence Justifiée</option>
                                                            <option>Absence Non Justifiée</option>
                                                            <option>Non Justifiée Prolongée</option>
                                                            <option>Retard Justifié</option>
                                                            <option>Retard Non Justifié</option>
                                                        </select>
                                                    </div>

                                                    </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="presence_comment">Observation ou commentaire</label>
                                                                <input type="text" name="presence_comment" class="form-control" value=" <?= esc($value['presence_comment']); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="submit"
                                                                class="btn btn-info btn-sm text-uppercase">Enregistrer les modifications
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                data-dismiss="modal">Fermer
                                                        </button>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end update year modal -->
                                    <?php endforeach; ?>
                               
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row --> 
        <?php endif; ?>
<?php if (isset($etudiants_pointages) && !empty($etudiants_pointages)): ?>
            <div class="row">
                <div class="col-12">
                    <?php
                    //form validation services call
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url() . '/pointage/savePointageJournalier', $attributes);
                    ?>
                    <?php

                    $request = \Config\Services::request();
                    $promotion_choosed = esc($request->getGet('clsPrc') != '') ? esc($request->getGet('clsPrc')) : '';
                    if ( !empty($promotion_choosed)): ?>
                        <input type="hidden"
                               name="promotion_pointage"
                               value="<?= esc($promotion_choosed); ?>">
                    <?php endif; ?>
                    <div class="card card-light">
                            <div class="card-header">
                                <div class="card-title">
                                   
                                       
                                    <div class="input-group date" id="date_format_abrege"
                                             data-target-input="nearest">

                                             <div class="input-group-append">
                                                <div class="input-group-text">
                                                      Date Pointage :
                                                </div>
                                            </div>

                                            <input type="text" class="form-control datetimepicker-input"
                                                   id="date_jour_pointage" value="<?= date('Y/m/d'); ?>"
                                                   data-target="#date_format_abrege" name="date_jour_pointage"/>
                                            <div class="input-group-append" data-target="#date_format_abrege"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                               

                                <div class="card-tools float-right">
                                    <button type="submit" class="btn btn-info bsn-sm text-uppercase">
                                        Valider le pointage
                                    </button>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed">
                                    <thead>
                                    <tr>
                                        <th>Pointage</th>
                                        <th>Matricule</th>
                                        <th>Noms</th>
                                        <th>Observation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $count = 1;
                                    foreach ($etudiants_pointages as $key => $value): $count++ ?>

                                        <tr>
                                            <td>

                                                <div class="icheck-info d-inline">
                                                    <input type="checkbox" name="etudiantIdentifiant[]"
                                                           id="etudiantIdentifiant<?= $count; ?>"
                                                           checked value="<?= esc($value['etudiant_uid']); ?>">
                                                    <label for="etudiantIdentifiant<?= $count; ?>">
                                                    </label>
                                                </div>

                                            </td>
                                            <td><?= esc($value['etudiant_matricule']); ?></td>
                                            <td class="text-uppercase">
                                                <?= ($value['etudiant_nom']); ?>
                                                <?= ($value['etudiant_postnom']); ?> <?= ($value['etudiant_prenom']); ?>
                                               
                                            </td>
                                          
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control select2" id="browser<?= $count; ?>"
                                                            style="width: 100%;" name="presence_libelle">
                                                        <option  value="present" selected="selected">Présent</option>
                                                        <option  value="absent">Absent</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                     
                                    </tbody>
                                  
                                </table>
                            </div>
                           
                    <!-- /.card -->
                    <?= form_close(); ?>
                </div>
            </div>
        <!-- /.card-body -->
                        <?php else: ?>
                        <?php 
                        $request = \Config\Services::request();
                            if ($request->getGet('clsPrc')) { ?>
                               <div class="card-footer">
                                    <div class="alert alert-warning small">
                                    Aucune donnée trouvee dans cette promotion
                                </div>
                               </div>
                           <?php }  ?>
                        <?php endif; ?>
                    </div>
        </div>
        <!-- /.container-fluid -->
    </filiere>
</div>
