<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="font-weight-bold text-uppercase">Caisses & Comptes</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Caisses & comptes</li>
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
                                <h5 class="font-weight-bold text-uppercase">Listes Caisses & Comptes</h5>
                            </div>

                            <div class="card-tools float-right">

                                <a href="<?= base_url('finance/addForm/caisse'); ?>"
                                   class="btn btn-info btn-sm btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle inscription">
                                    <i class="fa fa-plus"></i> Nouvelle caisse
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
                                        <th>CODE</th>
                                        <th>LIBELLE CAISSE</th>
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
                                    if (isset($caisses) && ! empty($caisses)):
                                    foreach ($caisses as $key => $value):?>
                                                                      
                                                <tr>                    
                                            <td><?= $count++; ?></td>
                                            <td class="text-uppercase"><?= esc($value['caisse_code']); ?></td>
                                          <td class="text-uppercase"><?= esc($value['caisse_libelle']); ?></td>
                                                    <td><?= number_format(esc($value['caisse_solde']), 2, ',', ' '); ?></td>
                                                    <td><?= number_format(esc($value['caisse_total_entree']), 2, ',', ' '); ?></td>
                                                    <td><?= number_format(esc($value['caisse_total_sortie']), 2, ',', ' '); ?></td>

                                                    <td width="1px" class="text-center">
                                                <a href="<?= base_url('finance/editForm/caisse/'.esc($value['caisse_uid'])); ?>"
                                                   class="btn btn-sm btn-outline-warning" data-toggle="tooltip"
                                                   data-placement="bottom"
                                                   title="Cliquer pour modifier cette information">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>
                                            </td>
                                            <td width="1px" class="text-center">
                                                <a href="<?= base_url('finance/details/caisse/'.esc($value['caisse_uid'])); ?>"
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