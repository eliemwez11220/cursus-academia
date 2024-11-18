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
                            <h5 class="font-weight-bold text-uppercase">Détails promotion <?= (isset($promotion)) ? ($promotion['promotion_libelle']) : 'Aucun libelle'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                        href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">promotion</li>
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
                                <a href="<?= base_url('ecole/view/promotions'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('ecole/editForm/promotion/'.esc($promotion['promotion_uid'])); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-edit"></i> Apporter des modifications
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
                                        <td>Code promotion</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_code']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nom promotion</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? ($promotion['promotion_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Degres promotion
                                        </td>
                                        <td class="text-uppercase">
                                            <?= (isset($promotion)) ? ($promotion['degres_libelle']) : 'Aucun libelle'; ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Cycle
                                        </td>
                                        <td class="text-uppercase">
                                            <?= (isset($promotion)) ? ($promotion['cycle_libelle']) : 'Aucun libelle'; ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>filiere</td>
                                        <td class="text-uppercase">
                                            <?= (isset($promotion)) ? ($promotion['filiere_libelle']) : 'Aucun libelle'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Option</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? ($promotion['option_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Titulaire promotion</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? ($promotion['promotion_titulaire']) : 'Aucun libelle'; ?></td>
                                    </tr><tr>
                                        <td>Effectif etudiants</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_effectif']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="timepicker">Statut promotion:</label></td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? ($promotion['promotion_statut']) : 'Aucun libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_created_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_created_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_updated_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_updated_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_deleted_at']) : 'Aucun libelle'; ?></td>
                                    </tr><tr>
                                        <td>Supprimée par</td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? esc($promotion['promotion_deleted_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_annee">Observation ou commentaire:</label></td>
                                        <td class="text-uppercase"><?= (isset($promotion)) ? ($promotion['promotion_comment']) : 'Aucun libelle'; ?></td>
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
