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
                            <h5 class="font-weight-bold text-uppercase">Détails :
                                <?= (isset($mouvement)) ? esc($mouvement['mouvement_type']) : 'Aucun'; ?>
                                <?= (isset($mouvement)) ? esc($mouvement['mouvement_libelle']) : 'Aucun'; ?>
                            </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Mouvement</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i
                                            class="fas fa-caret-up"></i></span>
                                <h5 class="description-header">
                                    <?= (isset($mouvement)) ?number_format(esc($mouvement['mouvement_montant']), 2, ',', ' ') : '...'; ?>
                                    <?= (isset($mouvement)) ?(esc($mouvement['mouvement_devise'])) : '...'; ?>
                                </h5>
                                <span class="description-text">MONTANT</span>
                            </div>
                        </div>

                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i
                                            class="fas fa-caret-up"></i> %</span>
                                <h5 class="description-header  text-uppercase">
                                    <?= (isset($mouvement)) ?(esc($mouvement['caisse_libelle'])) : '...'; ?>
                                    <?= (isset($mouvement)) ?(esc($mouvement['caisse_code'])) : '...'; ?>
                                </h5>
                                <span class="description-text">CAISSE ECOLE</span>
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
                                <a href="<?= base_url('finance/view/depenses'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> Voir les dépenses
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('finance/view/recettes'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    Voir les recettes <i class="fa fa-arrow-circle-right"></i> 
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
                                        <td>Code référence mouvement</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_code']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Libellé mouvement</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['caisse_libelle']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Montant mouvement</td>
                                        <td class="text-uppercase">
                                             <?= (isset($mouvement)) ?number_format(esc($mouvement['mouvement_montant']), 2, ',', ' ') : '...'; ?>
                                    <?= (isset($mouvement)) ?(esc($mouvement['mouvement_devise'])) : '...'; ?>
                                        </td>
                                    </tr>  

                                    <tr>
                                        <td>Type mouvement</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_type']) : 'Aucun'; ?></td>
                                    </tr>
                                     <tr>
                                        <td>Caisse école</td>
                                        <td class="text-uppercase">
                                            <?= (isset($mouvement)) ?(esc($mouvement['caisse_libelle'])) : '...'; ?>
                                    <?= (isset($mouvement)) ?(esc($mouvement['caisse_code'])) : '...'; ?>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Nature mouvement</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_nature']) : 'Aucun'; ?></td>
                                    </tr>
                                
                                    <tr>
                                        <td> Statut visibilité </td>
                                        <td class="text-uppercase">  <?= (isset($mouvement)) ? esc($mouvement['mouvement_statut']) : 'Aucun '; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_annee">Motif:</label></td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_motif']) : 'Aucun'; ?></td>
                                    </tr>
                                     <tr>
                                        <td><label for="commentaire_annee">Observation ou Commentaire:</label></td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_comment']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée le</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_created_at']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée par</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_created_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dernière Mise à jour</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_updated_at']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_updated_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_deleted_at']) : 'Aucun'; ?></td>
                                    </tr><tr>
                                        <td>Supprimé par</td>
                                        <td class="text-uppercase"><?= (isset($mouvement)) ? esc($mouvement['mouvement_deleted_by']) : 'Aucun'; ?></td>
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
