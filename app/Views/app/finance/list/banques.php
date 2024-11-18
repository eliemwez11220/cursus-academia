<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="font-weight-bold text-uppercase">Comptes bancaires</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Comptes bancaires</li>
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
                                <h5 class="font-weight-bold text-uppercase">Listes comptes bancaires</h5>
                            </div>

                            <div class="card-tools float-right">

                                <a href="<?= base_url('finance/addForm/banque'); ?>"
                                   class="btn btn-info btn-sm btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter un nocopte bancaire">
                                    <i class="fa fa-plus"></i> Nouveau compte bancaire
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
                                        <th>NUMERO COMPTE</th>
                                        <th>BANQUE</th>
                                        <th>SOLDE</th>
                                        <th>ENTREE</th>
                                        <th>SORTIE</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($comptes) && !empty($comptes)):
                                        foreach ($comptes as $key => $value):?>

                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase"><?= esc($value['compte_numero']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['banque_nom']); ?></td>
                                                <td><?= number_format(esc($value['compte_solde']), 2, ',', ' '); ?>
                                                    <?= esc($value['compte_devise']); ?></td>
                                                <td><?= number_format(esc($value['compte_total_entree']), 2, ',', ' '); ?>
                                                    <?= esc($value['compte_devise']); ?></td>
                                                <td><?= number_format(esc($value['compte_total_sortie']), 2, ',', ' '); ?>
                                                    <?= esc($value['compte_devise']); ?></td>

                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('finance/editForm/banque/' . esc($value['banque_uid'])); ?>"
                                                       class="btn btn-sm btn-outline-warning" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('finance/details/banque/' . esc($value['banque_uid'])); ?>"
                                                       class="btn btn-sm btn-outline-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-info-circle fa-2x"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>
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