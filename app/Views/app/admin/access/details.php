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
                            <h5 class="font-weight-bold">Administration - Détails Accès </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Type d'accès</li>
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
                                    <a href="<?= base_url('admin/view/access'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <h5 class="text-info text-uppercase font-weight-bold">
                                    <?= (isset($access))? esc($access['acces_libelle']):'Aucun Libelle'; ?>
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
                                        <td>Libellé Accès</td>
                                        <td class="text-uppercase">
                                            <?= (isset($access))? esc($access['acces_libelle']):'Aucun Libelle'; ?></td>
                                    </tr> <tr>
                                        <td>Libellé Objet Ou module Accès</td>
                                        <td class="text-uppercase">
                                            <?= (isset($access))? esc($access['acces_objet']):'Aucun Libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Mode Type</td>
                                        <td class="text-uppercase"><?= (isset($access))? esc($access['acces_type']):'Aucun statut'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-uppercase"><?= (isset($access))? esc($access['acces_status']):'Aucun statut'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Crée le</td>
                                        <td><?= (isset($access))? esc($access['acces_created_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée par</td>
                                        <td><?= (isset($access))? esc($access['acces_created_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= (isset($access))? esc($access['acces_updated_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= (isset($access))? esc($access['acces_updated_by']):'Aucun agent'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td><?= (isset($access))? esc($access['acces_deleted_at']):'Aucune date'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé par</td>
                                        <td><?= (isset($access))? esc($access['acces_deleted_by']):'Aucun agent'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= (isset($access))? esc($access['acces_observation']):'Aucun commentaire'; ?></td>
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
