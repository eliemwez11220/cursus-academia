<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Détails Année Scolaire <?= (isset($annee)) ? ($annee['annee_libelle']) : 'Aucun libelle'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Année scolaire</li>
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
                                    <a href="<?= base_url('ecole/view/annees'); ?>"
                                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                                    </a>
                                </div>
                            </div>

                            <div class="card-tools float-right">
                                <a href="<?= base_url('ecole/editForm/annee/'.(isset($annee) ? esc($annee['annee_uid']) : '')); ?>"
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

                                    <tr>
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Code Année</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? esc($annee['annee_code']) : 'Aucun code'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Libellé Année</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? ($annee['annee_libelle']) : 'Aucun libelle'; ?></td>
                                    </tr>
                              
                                    <tr>
                                        <td>Date ouveture</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? esc($annee['annee_date_ouverture']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date clôture</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? esc($annee['annee_date_cloture']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Commentaire</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? ($annee['annee_comment']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée le</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? esc($annee['annee_created_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? esc($annee['annee_created_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? esc($annee['annee_updated_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($annee)) ? esc($annee['annee_updated_by']) : 'Aucun libelle'; ?></td>
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
