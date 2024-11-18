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
                            <h5 class="font-weight-bold">FICHE CLIENT</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Abonnement</li>
                                <li class="breadcrumb-item active">Clients</li>
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
                                    <a href="<?= base_url('client'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <a href="<?= base_url('client/update/' . (isset($client) ? esc($client['client_uid']) : '')); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-sm">
                                    <i class="fa fa-edit fa-lg"></i> <strong>Mettre à jour</strong>
                                </a>
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
                                        <td>Nom Client</td>
                                        <td class="text-capitalize"><?= isset($client) ? esc($client['client_name']):'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Client</td>
                                        <td class="text-lowercase">
                                            <?= isset($client) ? esc($client['client_email']):'Aucun'; ?></td>
                                    </tr> 

                                    <tr>
                                        <td>Téléphone Client</td>
                                        <td class="text-capitalize">
                                            <?= isset($client) ? esc($client['client_phone']):'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Type Client</td>
                                        <td class="text-capitalize">
                                            <?= isset($client) ? esc($client['client_type']):'Aucun'; ?></td>
                                    </tr> 



                                    <tr>
                                        <td>Statut visibilité</td>
                                        <td class="text-capitalize"><?= isset($client) ? esc($client['client_statut']):'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Ville Client</td>
                                        <td class="text-capitalize">
                                            <?= isset($client) ? esc($client['client_city']):'Aucun'; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Pays Client</td>
                                        <td class="text-capitalize">
                                            <?= isset($client) ? esc($client['client_country']):'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Adresse Client</td>
                                        <td class="text-capitalize">
                                            <?= isset($client) ? esc($client['client_address']):'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Crée le</td>
                                        <td><?= isset($client) ? esc($client['client_created_at']):'Aucune'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée par</td>
                                        <td><?= isset($client) ? esc($client['client_created_by']):'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td><?= isset($client) ? esc($client['client_updated_at']):'Aucune'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td><?= isset($client) ? esc($client['client_updated_by']):'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td><?= isset($client) ? esc($client['client_deleted_at']):'Aucune'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé par</td>
                                        <td><?= isset($client) ? esc($client['client_deleted_by']):'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commentaire ou Observation</td>
                                        <td><?= isset($client) ? esc($client['client_comment']):'Aucun'; ?></td>
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
