<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Gestion Cours</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Enseignement</li>
                                <li class="breadcrumb-item active">Cours</li>
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
                                <h5 class="text-uppercase font-weight-bold"> Liste des Cours</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('cours/addform/matiere'); ?>"
                                   class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle promotion">
                                        <i class="fa fa-plus"></i> Nouveau Cours
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
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Intitulé</th>
                                        <th>Promotion</th>
                                        <th>Titulaire</th>
                                        <th width="1px">Crédit</th>
                                        <th width="1px">Volume H.</th>
                                        <th width="1px">Pondération</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($matieres) && !empty($matieres)):
                                        foreach ($matieres as $key => $value): ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                 <td class="text-uppercase"><?= esc($value['branche_libelle']); ?></td>
                                                 <td class="text-uppercase"><?= esc($value['promotion_libelle']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['agent_matricule']); ?> -
                                                    <?= esc($value['agent_nom']); ?>-<?= esc($value['agent_postnom']); ?>-<?= esc($value['agent_prenom']); ?>
                                                </td>
                                                <td width="1px" class="text-uppercase text-center"><?= esc($value['matiere_credit_horaire']); ?></td>
                                                <td width="1px" class="text-uppercase text-center"><?= esc($value['matiere_volume_horaire']); ?></td>
 <td width="1px" class="text-uppercase text-center"><?= esc($value['matiere_ponderation']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('cours/editForm/matiere/' . esc($value['matiere_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                
                                                    <a href="<?= base_url('cours/details/matiere/' . esc($value['matiere_uid'])); ?>"
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
