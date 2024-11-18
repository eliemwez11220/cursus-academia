<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Cotation - Epreuves</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Epreuves</li>
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
                                <h5 class="text-uppercase font-weight-bold"> Liste des épreuves</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('cours/addform/epreuve'); ?>"
                                   class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle epreuve">
                                        <i class="fa fa-plus"></i> Nouvelle épreuve
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Libellé</th>
                                        <th>Matière</th>
                                        <th>Période</th>
                                        <th>Max</th>
                                        <th>Statut</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($epreuves) && !empty($epreuves)):
                                        foreach ($epreuves as $key => $value):
                                            $status = (!empty(esc($value['epreuve_statut'])) ? esc($value['epreuve_statut']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase">
                                                    <a href="<?= base_url('cours/details/epreuve/' . esc($value['epreuve_uid'])); ?>">
                                                        <?= esc($value['epreuve_libelle']); ?>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= esc($value['branche_libelle']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['periode_libelle']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['epreuve_cote_max']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('cours/changeStatus/epreuve/' . esc($status) . '/' . esc($value['epreuve_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('cours/editForm/epreuve/' . esc($value['epreuve_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('cours/details/epreuve/' . esc($value['epreuve_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les details">
                                                <i class="fa fa-info-circle fa-2x"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="8" class="text-uppercase">
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
