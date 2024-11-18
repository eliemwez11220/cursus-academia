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
                            <h5 class="font-weight-bold">Détails configuration - Catégorie Elèves</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Catégorie Elèves</li>
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
                                    <a href="<?= base_url('ecole/view/typesetudiants'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    <?= (isset($typesetudiant))? ($typesetudiant['typesetudiant_libelle']):'Aucun Libelle'; ?>
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
                                        <td><?= (isset($typesetudiant))? esc($typesetudiant['typesetudiant_code']):'Aucun Code'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Libellé Type</td>
                                        <td class="text-uppercase">
                                            <?= (isset($typesetudiant))? ($typesetudiant['typesetudiant_libelle']):'Aucun Libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase"><?= (isset($typesetudiant))? ($typesetudiant['typesetudiant_statut']):'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Crée le</td>
                                        <td><?= (isset($typesetudiant))? esc($typesetudiant['typesetudiant_created_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée par</td>
                                        <td><?= (isset($typesetudiant))? esc($typesetudiant['typesetudiant_created_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($typesetudiant))? esc($typesetudiant['typesetudiant_updated_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($typesetudiant))? esc($typesetudiant['typesetudiant_updated_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td><?= (isset($typesetudiant))? esc($typesetudiant['typesetudiant_deleted_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé par</td>
                                        <td><?= (isset($typesetudiant))? esc($typesetudiant['typesetudiant_deleted_by']):'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($typesetudiant))? ($typesetudiant['typesetudiant_comment']):'Aucun commentaire'; ?></td>
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
