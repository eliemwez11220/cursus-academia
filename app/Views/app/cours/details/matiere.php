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
                            <h5 class="font-weight-bold text-uppercase">Détails Affectation Matière</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Affectation Matière</li>
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
                                    <a href="<?= base_url('cours/view/matieres'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    <?php $uid_key = (isset($matiere)) ? esc($matiere['matiere_uid']) : 'Aucun'; ?>
                                    <a href="<?= base_url('cours/editForm/matiere/' . $uid_key); ?>"
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
                                        <td>Enseignant Titulaire</td>
                                        <td>
                                            <?= (isset($matiere)) ? esc($matiere['agent_matricule']) : ''; ?> -
                                            <?= (isset($matiere)) ? esc($matiere['agent_nom']) : ''; ?>
                                            <?= (isset($matiere)) ? esc($matiere['agent_postnom']) : ''; ?>
                                            <?= (isset($matiere)) ? esc($matiere['agent_prenom']) : ''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Branche</td>
                                        <td class="text-uppercase">
                                            <?= (isset($matiere)) ? esc($matiere['branche_libelle']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>promotion</td>
                                        <td class="text-uppercase">
                                            <?= (isset($matiere)) ? esc($matiere['promotion_libelle']) : 'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase">
                                            <?= (isset($matiere)) ? esc($matiere['matiere_statut']) : 'Aucun statut'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Total Max Cotation Période</td>
                                        <td class="text-uppercase">
                                            <?= (isset($matiere)) ? esc($matiere['matiere_max_periode']) : 'Aucun'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Max Cotation Examen</td>
                                        <td class="text-uppercase">
                                            <?= (isset($matiere)) ? esc($matiere['matiere_max_examen']) : 'Aucun'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Ordre d'affichage sur le bulletin</td>
                                        <td class="text-uppercase">
                                            <?= (isset($matiere)) ? esc($matiere['matiere_ordre_bulletin']) : 'Aucun'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groupe Maxima sur le bulletin</td>
                                        <td class="text-uppercase">
                                            <?= (isset($matiere)) ? esc($matiere['maxima_libelle']) : 'Aucun'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td><?= (isset($matiere)) ? esc($matiere['matiere_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td><?= (isset($matiere)) ? esc($matiere['matiere_created_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($matiere)) ? esc($matiere['matiere_updated_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($matiere)) ? esc($matiere['matiere_updated_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td><?= (isset($matiere)) ? esc($matiere['matiere_deleted_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée par</td>
                                        <td><?= (isset($matiere)) ? esc($matiere['matiere_deleted_by']) : 'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Description</td>
                                        <td><?= (isset($matiere)) ? ($matiere['matiere_comment']) : 'Aucun'; ?></td>
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
