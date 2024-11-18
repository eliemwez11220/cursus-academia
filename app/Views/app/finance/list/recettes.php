<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Mouvements - Recettes</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/types/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Recettes</li>
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
                                <h5 class="font-weight-bold text-uppercase">Liste des dépenses</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('finance/addForm/recette'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle inscription">
                                    <i class="fa fa-plus"></i> Nouvelle recette
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
                                        <th>CODE REF.</th>
                                        <th>CAISSE</th>
                                        <th>MONTANT ENTRE</th>
                                        <th width="1px">DETAILS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($recettes) && !empty($recettes)):
                                        foreach ($recettes as $key => $value):?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['mouvement_code']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['caisse_code']); ?>
                                                    |<?= esc($value['caisse_libelle']); ?></td>
                                                <td class="text-uppercase"><?= number_format(esc($value['mouvement_montant']), 2, ',', ' '); ?>
                                                    <?= esc($value['mouvement_devise']); ?>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('finance/details/mouvement/' . esc($value['mouvement_uid'])); ?>"
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