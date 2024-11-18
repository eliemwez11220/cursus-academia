<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase ffont-weight-bold">Liste des étudiants inscrits en <?= session()->get('yearlibelle'); ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Inscription</li> 
                    </ol>
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
                        <div class="card-header">
                            <div class="card-title">
                                <form role="form" id="presenceetudiantsForm" method="get">
                                    <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="anneeScolaire" name="y"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Année Académique--</option>
                                            <option selected="selected" value=" <?= session()->get('yearuid'); ?>"><?= session()->get('yearlibelle'); ?></option>
                                            <?php
                                            $count = 1;
                                            if (isset($annees) && !empty($annees)):
                                                foreach ($annees as $key => $value): ?>
                                                    <option value="<?= esc($value['annee_uid']); ?>" <?= set_select('y', esc($value['annee_uid'])); ?>>
                                                        <?= ucfirst(esc($value['annee_libelle'])); ?>
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
                            <div class="card-tools float-right">
                                <a href="<?= base_url('student/addForm/inscription'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle inscription">
                                    <i class="fa fa-plus"></i> Inscrire nouvel étudiant
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
                                        <th>Matricule</th>
                                        <th>Noms</th>
                                        <th>Sexe</th>
                                        <th>Promotion</th>
                                        <th>Etat</th>
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
                                            <tr class="small">
                                                <td scope="1"><?= $count++; ?></td>

                                                <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?>  <?= esc($value['etudiant_postnom']); ?> <?= esc($value['etudiant_prenom']); ?>
                                                    <?php if($value['inscription_date'] == date('Y-m-d')): ?>
                                                    <span class="badge badge-info">new</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= ($value['etudiant_sexe'] == 'masculin')?'M':'F'; ?></td>
                                                <td class="text-uppercase"><?= ($value['promotion_libelle']); ?>

                                             <?= ($value['cycle_libelle']); ?></td>

                                                <td>
                                                    <a href="">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('student/editForm/inscription/' . esc($value['etudiant_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                               
                                                    <a href="<?= base_url('student/details/inscription/' . esc($value['etudiant_uid']) . '/' . esc($value['inscription_promotion_uid'])); ?>"
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
                </div>
            </div>
        </div>
    </filiere>
    <!-- /.content -->
</div>