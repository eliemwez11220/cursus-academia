<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Apr-21
 * Time: 4:58 PM
 */-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-inline-flex">
                                <h5 class="font-weight-bold text-uppercase">
                                    filiere <?= (isset($filiere) ? ($filiere['filiere_libelle']) : 'Information'); ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Ecole</li>
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
                                    <a href="<?= base_url('ecole/view/filieres'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-uppercase "><strong>
                                        OPTION
                                        <?= (isset($filiere)) ? esc($filiere['option_libelle']) : 'Aucun libelle'; ?>
                                    </strong></h5>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>

                                    <tr>
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Code Référence</td>
                                        <td><?= (isset($filiere)) ? esc($filiere['filiere_code']) : 'Aucun Code'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nom filiere</td>
                                        <td class="text-uppercase"><?= (isset($filiere)) ? ($filiere['filiere_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nom Option</td>
                                        <td class="text-uppercase"><?= (isset($filiere)) ? ($filiere['option_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase"><?= (isset($filiere)) ? ($filiere['filiere_statut']) : 'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td><?= (isset($filiere)) ? esc($filiere['filiere_created_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td><?= (isset($filiere)) ? esc($filiere['filiere_created_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($filiere)) ? esc($filiere['filiere_updated_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($filiere)) ? esc($filiere['filiere_updated_by']) : 'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td><?= (isset($filiere)) ? esc($filiere['filiere_deleted_at']) : 'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée par</td>
                                        <td><?= (isset($filiere)) ? esc($filiere['filiere_deleted_by']) : 'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($filiere)) ? ($filiere['filiere_comment']) : 'Aucun agent'; ?></td>
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
