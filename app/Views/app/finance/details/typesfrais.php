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
                            <h5 class="font-weight-bold text-uppercase">Détails TYPE Frais : <?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_libelle']) : 'Aucun libelle'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Types Frais</li>
                            </ol>
                        </div>
                    </div>
                </div>


                 <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> $</span>
                                 <h5 class="description-header"> 
                                      <?= (isset($typesfrais)) ?number_format($typesfrais['typesfrai_montant'], 2,',',' ') : '...'; ?> 
                                </h5>
                                <span class="description-text">MONTANT</span>
                            </div>
                        </div> 

                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> %</span>
                                 <h5 class="description-header"> 
                                     <?= (isset($typesfrais)) ?(esc($typesfrais['typesfrai_taux'])) : '...'; ?></h5>
                                    <span class="description-text">TAUX CHANGE</span>
                            </div>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/typesfrais'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('finance/editForm/typesfrais/'.(isset($typesfrais) ? esc($typesfrais['typesfrai_uid']):'')); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-edit"></i> Mettre à jour infos
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Code type frais</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_code']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Libellé type frais</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? ($typesfrais['typesfrai_libelle']) : 'Aucun'; ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <td> Montant fixe </td>
                                        <td class="text-uppercase">  
                                            <?= (isset($typesfrais)) ? number_format(esc($typesfrais['typesfrai_montant']),2,',', ' ') : '...'; ?>

                                            <?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_devise']) : '...'; ?>  
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td> Cycle des promotions concernées </td>
                                        <td class="text-uppercase">  
                                            <?= (isset($typesfrais)) ? ($typesfrais['cycle_libelle']) : 'Aucun'; ?>  
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td> Nature de paiement  </td>
                                        <td class="text-uppercase">  <?= (isset($typesfrais)) ? ($typesfrais['typesfrai_nature']) : 'Aucun '; ?></td>
                                    </tr>

                                    <tr>
                                        <td> Statut visibilité </td>
                                        <td class="text-uppercase">  <?= (isset($typesfrais)) ? ($typesfrais['typesfrai_statut']) : 'Aucun '; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Date début paiement </td>
                                        <td class="text-uppercase">  <?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_date_debut']) : 'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Date fin paiement</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_date_fin']) : 'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Crée le</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_created_at']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée par</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_created_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_updated_at']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_updated_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_deleted_at']) : 'Aucun'; ?></td>
                                    </tr><tr>
                                        <td>Supprimé par</td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_deleted_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_annee">Observation ou commentaire:</label></td>
                                        <td class="text-uppercase"><?= (isset($typesfrais)) ? esc($typesfrais['typesfrai_comments']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
