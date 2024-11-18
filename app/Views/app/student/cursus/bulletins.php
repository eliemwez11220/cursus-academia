<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase ffont-weight-bold">Suivi scolaire - Bulletins des étudiants</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Bulletins</li>
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
                            <div class="card-tools">
                                <form role="form" id="presenceetudiantsForm" method="get">

                                    <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="anneeScolaire" name="promotion"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <?php
                                            if (isset($promotion) && !empty($promotion)): ?>
                                                <option selected
                                                        value="<?= esc($promotion['promotion_uid']); ?>" <?= set_select('promotion', esc($promotion['promotion_uid'])); ?>>
                                                    <?= ucfirst(($promotion['promotion_libelle'])); ?>
                                                    - <?= ucfirst(($promotion['cycle_libelle'])); ?>
                                                    - <?= ucfirst(($promotion['option_libelle'])); ?>
                                                </option>
                                            <?php else: ?>
                                                <option disabled selected>-- Filtrage par promotion --
                                                </option>
                                            <?php endif; ?>
                                            <?php
                                            $count = 1;
                                            if (isset($promotions) && !empty($promotions)):
                                                foreach ($promotions as $key => $value):?>
                                                        <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('promotion', esc($value['promotion_uid'])); ?>>
                                                            <?= ucfirst(($value['promotion_libelle'])); ?>
                                                            - <?= ucfirst(($value['cycle_libelle'])); ?>
                                                            - <?= ucfirst(($value['option_libelle'])); ?>
                                                        </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default text-uppercase">
                                                <i class="fa fa-search"></i>
                                            </button>
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
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom Elève</th>
                                        <th>Sexe</th>
                                        <th>promotion</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($etudiants) && !empty($etudiants)):
                                        foreach ($etudiants as $key => $value):
                                            $status = (!empty(esc($value['etudiant_statut'])) ? esc($value['etudiant_statut']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>

                                                <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_nom']); ?>
                                                    -<?= esc($value['etudiant_postnom']); ?>
                                                    -<?= esc($value['etudiant_prenom']); ?>
                                                </td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['promotion_libelle']); ?></td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/bulletin/' . esc($value['etudiant_uid']).'/'. esc($value['promotion_uid'])); ?>"
                                                       class="btn btn-sm btn-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                       Bulletin
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