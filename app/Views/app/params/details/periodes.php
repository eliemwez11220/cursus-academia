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
                            <h5 class="font-weight-bold">Détails Configuration période <?= (isset($periode)? ($periode['periode_libelle']):''); ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Périodes</li>
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
                                <a href="<?= base_url('ecole/view/periodes'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url().'/ecole/editForm/periode/'.(isset($periode)?esc($periode['periode_uid']):''); ?>"
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
                                        <td>Code periode</td>
                                        <td><?= (isset($periode)? esc($periode['periode_code']):'Aucun code'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Libelle période</td>
                                        <td class="text-uppercase"><?= (isset($periode)? ($periode['periode_libelle']):''); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                           Type période
                                        </td>
                                        <td><span class="badge  badge-info text-capitalize">
                                            <?= (isset($periode)? ($periode['periode_type']):''); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date début période</td>
                                        <td><?= (isset($periode)? esc($periode['periode_date_debut']):''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date fin période</td>
                                        <td><?= (isset($periode)? esc($periode['periode_date_fin']):''); ?></td>
                                    </tr>

                                    <tr>
                                        <td><label for="timepicker">Statut période:</label></td>
                                        <td>
                                            <span class="badge  badge-info text-capitalize">
                                                <?= (isset($periode)? ($periode['periode_statut']):''); ?> </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Créée le</td>
                                        <td><?= (isset($periode)? esc($periode['periode_created_at']):''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td><?= (isset($periode)? esc($periode['periode_created_by']):''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($periode)? esc($periode['periode_updated_at']):''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($periode)? esc($periode['periode_updated_by']):''); ?></td>

                                    </tr>
                                    <tr>
                                        <td>Supprimée le</td>
                                        <td><?= (isset($periode)? esc($periode['periode_deleted_at']):''); ?></td>
                                    </tr><tr>
                                        <td>Supprimée par</td>
                                        <td><?= (isset($periode)? esc($periode['periode_deleted_by']):''); ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_annee">Observation ou commentaire:</label></td>
                                        <td><?= (isset($periode)? ($periode['periode_comment']):''); ?></td>
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
