<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase ffont-weight-bold">
                        Résultats de recherche des informations
                    </h5>
                </div>
                <div class="col-sm-6">

                        <div class="card-tools float-right">

                            <a href="<?= base_url('etudiant/addForm/inscription'); ?>"
                               class="btn btn-info btn-sm text-uppercase"
                               data-toggle="tooltip" data-placement="bottom"
                               title="Cliquer pour ajouter une nouvelle inscription">
                                <i class="fa fa-plus"></i> Inscrire nouvel étudiant
                            </a>
                        </div>
                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-title float-left">
                            <div>
                                <form id="formSearchAdvanced" method="post" action="<?= base_url('overview/search'); ?>">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-inline">
                                                <div class="input-group">
                                                    <input class="form-control form-control-lg" type="search" name="query"
                                                           placeholder="Saisissez le nom ou le numéro matricule de l'étudiant"
                                                           aria-label="Search" autofocus value="<?= isset($query)?$query:set_value('query'); ?>"
                                                           style="border-top-left-radius: 100px!important; border-bottom-left-radius: 100px!important;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default btn-lg" type="submit"
                                                                style="border-top-right-radius: 100px!important; border-bottom-right-radius: 100px!important;">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                        <th>Matricule</th>
                                        <th>Nom Elève</th>
                                        <th>Sexe</th>
                                        <th>promotion</th>
                                        <th>Statut</th>
                                        <th>Edition</th>
                                        <th>Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($etudiants) && !empty($etudiants)):
                                        foreach ($etudiants as $key => $value):
                                            $status = (!empty(esc($value['etudiant_statut'])) ? esc($value['etudiant_statut']) : 'inactif');
                                            ?>
                                            <tr class="small">
                                                <td scope="1"><?= $count++; ?></td>

                                                <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?>  <?= esc($value['etudiant_postnom']); ?> <?= esc($value['etudiant_prenom']); ?>
                                                    <?php if ($value['inscription_date'] == date('Y-m-d')): ?>
                                                        <span class="badge badge-info">new</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= ($value['etudiant_sexe'] == 'masculin') ? 'M' : 'F'; ?></td>
                                                <td class="text-uppercase"><?= ($value['promotion_libelle']); ?>

                                                    <?= ($value['cycle_libelle']); ?></td>

                                                <td>
                                                    <a href="<?= base_url('etudiant/changeStatus/etudiant/' . esc($status) . '/' . esc($value['etudiant_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/editForm/inscription/' . esc($value['etudiant_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                </td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/details/inscription/' . esc($value['etudiant_uid']) . '/' . esc($value['inscription_promotion_uid'])); ?>"
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
                                            <td colspan="9" class="text-uppercase">
                                                <strong>Aucun etudiant</strong>
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