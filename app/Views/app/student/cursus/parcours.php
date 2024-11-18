<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase ffont-weight-bold">Parcours académiques</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Parcours</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Noms</th>
                                        <th>Sexe</th>
                                        <th>Catégorie</th>
                                        <th>Cursus</th>
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
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_nom']); ?>
                                                    <?= esc($value['etudiant_postnom']); ?>
                                                    <?= esc($value['etudiant_prenom']); ?>
                                                </td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['typesetudiant_libelle']); ?></td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('student/cursus/parcours/' . esc($value['etudiant_uid'])); ?>"
                                                       class="btn btn-sm btn-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                       Détails
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
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
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>