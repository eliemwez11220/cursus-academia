<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Transferts des étudiants</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Transfert</li>
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
                                <h5>LISTE DES TRANSFERTS</h5>
                            </div>

                            <div class="card-tools float-right">

                                <a href="<?= base_url('etudiant/addForm/transfert'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle inscription">
                                    <i class="fa fa-plus"></i> Nouveau transfert
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Référence</th>
                                        <th>Elève</th>
                                        <th>Nouvelle Ecole</th>
                                        <th>Statut</th>
                                        <th>Edition</th>
                                        <th>Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody class="small">
                                    <?php
                                    $count = 1;
                                    if (isset($transferts) && !empty($transferts)):
                                        foreach ($transferts as $key => $value):
                                            $status = (!empty(esc($value['transfert_statut'])) ? esc($value['transfert_statut']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>

                                                <td class="text-uppercase"><?= esc($value['transfert_code']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_matricule']); ?>
                                                    - <?= esc($value['etudiant_nom']); ?>
                                                    -<?= esc($value['etudiant_postnom']); ?>
                                                    -<?= esc($value['etudiant_prenom']); ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['ecole_code']); ?>
                                                    - <?= esc($value['ecole_libelle']); ?>
                                                </td>

                                                <td>
                                                    <a href="<?= base_url('etudiant/changeStatus/transfert/' . esc($status) . '/' . esc($value['transfert_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <?php if ($status == 'encours') { ?>
                                                            <span class="badge badge-warning text-capitalize"> Encours</span>
                                                        <?php } elseif ($status == 'inactif') { ?>
                                                            <span class="badge badge-danger text-capitalize"> Annulé</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-info text-capitalize"> Validé</span>
                                                        <?php } ?>
                                                    </a>
                                                </td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/editForm/transfert/'.esc($value['transfert_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                </td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/details/transfert/'.esc($value['transfert_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-info-circle fa-2x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-secondary text-center">
                                            <td colspan="9" class="text-uppercase">
                                                <strong>Aucun transfert</strong>
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