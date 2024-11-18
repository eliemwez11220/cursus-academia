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
                            <h5 class="font-weight-bold text-uppercase">Détails -
                                Epreuve <?= (isset($epreuve)) ? esc($epreuve['epreuve_libelle']) : 'Aucun'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Epreuves</li>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="float-left">
                                    <a href="<?= base_url('cours/view/epreuves'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    <?php $idKey = (isset($epreuve) ? esc($epreuve['epreuve_uid']) : 'Aucun'); ?>
                                    <a href="<?= base_url('cours/editForm/epreuve/' . $idKey); ?>"
                                       class="btn btn-warning btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-edit"></i> Mettre à jour les infos
                                    </a>
                                </h5>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed">
                                    <thead>

                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Libellé Epreuve</td>
                                        <td class="text-uppercase">
                                            <?= (isset($epreuve)) ? esc($epreuve['epreuve_libelle']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Type Epreuve</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['typesepreuve_libelle']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Branche Matière</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['branche_libelle']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Période</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['periode_libelle']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Numéro Epreuve</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_numero']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Maxima Cotation Epreuve</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_cote_max']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ponderation Epreuve</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_ponderation']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Leçon Epreuve</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_lecon']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Méthode Epreuve</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_methode']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Durée Epreuve</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_duree_minute']) : 'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_statut']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre des questions</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_nombre_questions']) : 'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre des étudiants participants</td>
                                        <td class="text-uppercase"><?= (isset($epreuve)) ? esc($epreuve['epreuve_nombre_etudiants']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td><?= (isset($epreuve)) ? esc($epreuve['epreuve_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td><?= (isset($epreuve)) ? esc($epreuve['epreuve_created_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($epreuve)) ? esc($epreuve['epreuve_updated_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($epreuve)) ? esc($epreuve['epreuve_updated_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td><?= (isset($epreuve)) ? esc($epreuve['epreuve_deleted_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée par</td>
                                        <td><?= (isset($epreuve)) ? esc($epreuve['epreuve_deleted_by']) : 'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($epreuve)) ? esc($epreuve['epreuve_observation']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description Epreuve</td>
                                        <td><?= (isset($epreuve)? ($epreuve['epreuve_description']) : 'Aucun'); ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
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
