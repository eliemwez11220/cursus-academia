<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Types Frais</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Types Frais</li>
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
                                <h5 class="text-uppercase font-weight-bold"> Liste des types frais</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('finance/addform/typesfrais'); ?>"
                                   class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouveau type">
                                        <i class="fa fa-plus"></i> Nouveau type frais
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
                                        <th>Code Frais</th>
                                        <th>Libellé Frais</th>
                                        <th>Cycle</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($typesfrais) && !empty($typesfrais)):
                                        foreach ($typesfrais as $key => $value):
                                            $status = (!empty(esc($value['typesfrai_statut'])) ? esc($value['typesfrai_statut']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['typesfrai_code']); ?></td>
                                                <td class="text-uppercase"><?= ($value['typesfrai_libelle']); ?></td>
                                                <td class="text-uppercase"><?= ($value['cycle_libelle']); ?></td>
                                                <td class="text-uppercase"><?= number_format(esc($value['typesfrai_montant']),2,',', ' '); ?>
                                                    <?= esc($value['typesfrai_devise']); ?>
                                                </td>
                                                
                                                <td>
                                                    <a href="<?= base_url('finance/changeStatus/typesfrai/' . esc($status) . '/' . esc($value['typesfrai_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('finance/details/typesfrais/' . esc($value['typesfrai_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les details">
                                                <i class="fa fa-info-circle fa-2x"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-secondary small">
                                            <td colspan="9" class="text-uppercase">
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
