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
                            <h5 class="font-weight-bold text-uppercase">Détails Caisse : <?= (isset($caisse)) ? esc($caisse['caisse_libelle']) : 'Aucun libelle'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Caisses</li>
                            </ol>
                        </div>
                    </div>
                </div>
                  <div class="card-footer">
                            <div class="row">
                              
                                <!-- /.col -->
                                <div class="col-sm-4 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i
                                                    class="fas fa-caret-left"></i> 0%</span>
                                        <h5 class="description-header"> CDF <?= (isset($caisse)) ? number_format(esc($caisse['caisse_solde']),2,',', ' ') : '...'; ?></h5>
                                        <span class="description-text">TOTAL SOLDE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i
                                                    class="fas fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">  CDF <?= (isset($caisse)) ? number_format(esc($caisse['caisse_total_entree']),2,',', ' ') : '...'; ?></h5>
                                        <span class="description-text">TOTAL ENTREE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-info"><i
                                                    class="fas fa-caret-down"></i> 18%</span>
                                        <h5 class="description-header"> CDF <?= (isset($caisse)) ? number_format(esc($caisse['caisse_total_sortie']),2,',', ' ') : '...'; ?></h5>
                                        <span class="description-text">TOTAL SORTIE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
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
                                <a href="<?= base_url('finance/view/caisses'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('finance/editForm/caisse/'.(isset($caisse) ? esc($caisse['caisse_uid']):'')); ?>"
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
                                        <td>Code caisse</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_code']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Libellé caisse</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_libelle']) : 'Aucun'; ?></td>
                                    </tr>  

                                    <tr>
                                        <td>Type caisse</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_type']) : 'Aucun'; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Localisation caisse</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_localisation']) : 'Aucun'; ?></td>
                                    </tr>
                                
                                    <tr>
                                        <td> Statut visibilité Caisse </td>
                                        <td class="text-uppercase">  <?= (isset($caisse)) ? esc($caisse['caisse_statut']) : 'Aucun '; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_created_at']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_created_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dernière Mise à jour</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_updated_at']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_updated_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_deleted_at']) : 'Aucun'; ?></td>
                                    </tr><tr>
                                        <td>Supprimée par</td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_deleted_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_annee">Observation:</label></td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_observation']) : 'Aucun'; ?></td>
                                    </tr>
                                     <tr>
                                        <td><label for="commentaire_annee">Commentaire:</label></td>
                                        <td class="text-uppercase"><?= (isset($caisse)) ? esc($caisse['caisse_comment']) : 'Aucun'; ?></td>
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
