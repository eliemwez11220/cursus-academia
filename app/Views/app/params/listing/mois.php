<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Mois Scolaires</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Mois</li>
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
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp;  des mois</h5>
                            </div>
                             <!-- /.card-header
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle categorie">
                                        <i class="fa fa-plus"></i> Nouvelle  &nbsp; Categorie etudiants
                                    </span>
                                </a>
                            </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Libellé Mois</th>
                                        <th class="text-center">Statut</th>
                                        <th class="text-right">Crée le</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($mois) && !empty($mois)):
                                    foreach ($mois as $key => $value):
                                    $status = (! empty(esc($value['mois_statut']))?esc($value['mois_statut']):'inactif');
                                    ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td class="text-uppercase"><?= ($value['mois_libelle']); ?></td>
                                        <td class="text-center">
                                            <span class="badge  <?= (esc($status) =='Actif') ? 'badge-info':'badge-danger';?> text-capitalize"> <?= $status; ?> </span>
                                        </td>
                                        <td class="text-right"><?= esc($value['mois_created_at']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-secondary small">
                                            <td colspan="4" class="text-uppercase">
                                                <strong>Aucune donnée</strong>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
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
