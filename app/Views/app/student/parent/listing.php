<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase">Parents - Dossier étudiants</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Parents</li>
                    </ol>
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
                                <h5 class="text-uppercase">Liste Parents étudiants</h5>
                            </div>

                            <div class="card-tools float-right">
                                <a href="<?= base_url('etudiant/addForm/parent'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle inscription">
                                    <i class="fa fa-plus"></i> nouveau parent
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Père</th>
                                        <th>Mère</th>
                                        <th>Tuteur</th>
                                        <th>Tél.</th>
                                        <th>Statut</th>
                                        <th>Edition</th>
                                        <th>Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($parents) && !empty($parents)):
                                    foreach ($parents as $key => $value):
                                    $status = (!empty(esc($value['parent_statut'])) ? esc($value['parent_statut']) : 'inactif');
                                    ?>
                                    <tr class="small">
                                        <td><?= $count++; ?></td>
                                        <td class="text-uppercase"><?= esc($value['parent_nom_pere']); ?></td>
                                        <td class="text-uppercase"><?= esc($value['parent_nom_mere']); ?></td>
                                        <td class="text-uppercase"><?= esc($value['parent_nom_tuteur']); ?></td>
                                        <td class="text-uppercase"><?= esc($value['parent_phone']); ?></td>

                                        <td class="text-center">
                                            <a href="<?= base_url('etudiant/changeStatus/parent/' . esc($status) . '/' . esc($value['parent_uid'])); ?>"
                                               onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                            </a>
                                        </td>
                                        <td width="2px" class="text-center">
                                            <a href="<?= base_url('etudiant/editForm/parent/'. esc($value['parent_uid'])); ?>"
                                                   class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title="Cliquer pour modifier cette information">
                                                    <i class="fa fa-edit fa-2x"></i>
                                            </a>
                                        </td>
                                        <td width="2px" class="text-center">
                                            <a href="<?= base_url('etudiant/details/parent/'. esc($value['parent_uid'])); ?>"
                                                   class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-2x"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="8" class="text-uppercase">
                                                <strong>Aucun parent</strong>
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