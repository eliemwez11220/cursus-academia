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
                            <h5 class="font-weight-bold text-uppercase">Détails configuration - Fonction Agents </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Fonction Agents </li>
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
                                    <a href="<?= base_url('agent/view/fonctions'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> Voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    FONCTION <?= (isset($fonction))? esc($fonction['fonction_libelle']):'Aucun'; ?>
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
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Code Référence</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_code']):'Aucun Code'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Libellé Type</td>
                                        <td class="text-uppercase">
                                            <?= (isset($fonction))? esc($fonction['fonction_libelle']):'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase"><?= (isset($fonction))? esc($fonction['fonction_statut']):'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_created_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_created_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_updated_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_updated_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_deleted_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée par</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_deleted_by']):'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($fonction))? esc($fonction['fonction_comment']):'Aucun'; ?></td>
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
