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
                            <h5 class="font-weight-bold text-uppercase">Détails Cotation Enseignant</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Cotation Enseignant </li>
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
                                    <a href="<?= base_url('agent/view/cotationenseignants'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    <?php $uid = (isset($cotation))? esc($cotation['cotation_uid']):'Aucun'; ?>
                                    <a href="<?= base_url('agent/editForm/cotationenseignant/'.$uid); ?>"
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
                                        <td>Agent Coté </td>
                                        <td>
                                            <?= (isset($cotation))? esc($cotation['agent_matricule']):''; ?> -
                                            <?= (isset($cotation))? esc($cotation['agent_nom']):''; ?>
                                            <?= (isset($cotation))? esc($cotation['agent_postnom']):''; ?>
                                            <?= (isset($cotation))? esc($cotation['agent_prenom']):''; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Critere de cotation</td>
                                        <td class="text-uppercase">
                                            <?= (isset($cotation))? esc($cotation['critere_libelle']):'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Periode cotation</td>
                                        <td class="text-uppercase">
                                            <?= (isset($cotation))? esc($cotation['periode_libelle']):'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase">
                                            <?= (isset($cotation))? esc($cotation['cotation_statut']):'Aucun statut'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cotes Directeur</td>
                                        <td class="text-uppercase">
                                            <?= (isset($cotation))? esc($cotation['cotation_cote_directeur']):'Aucun'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cotes Inspecteur Division</td>
                                        <td class="text-uppercase">
                                            <?= (isset($cotation))? esc($cotation['cotation_cote_insp_division']):'Aucun'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cotes Inspecteur Coordination</td>
                                        <td class="text-uppercase">
                                            <?= (isset($cotation))? esc($cotation['cotation_cote_insp_coordination']):'Aucun'; ?>
                                        </td>
                                    </tr>      <tr>
                                        <td>Cotes Moyenne</td>
                                        <td class="text-uppercase">
                                            <?= (isset($cotation))? esc($cotation['cotation_cote_moyenne']):'Aucun'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Créee le</td>
                                        <td><?= (isset($cotation))? esc($cotation['cotation_created_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créee par</td>
                                        <td><?= (isset($cotation))? esc($cotation['cotation_created_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($cotation))? esc($cotation['cotation_updated_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($cotation))? esc($cotation['cotation_updated_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimee le</td>
                                        <td><?= (isset($cotation))? esc($cotation['cotation_deleted_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimee par</td>
                                        <td><?= (isset($cotation))? esc($cotation['cotation_deleted_by']):'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Description</td>
                                        <td><?= (isset($cotation))? ($cotation['cotation_description']):'Aucun'; ?></td>
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
