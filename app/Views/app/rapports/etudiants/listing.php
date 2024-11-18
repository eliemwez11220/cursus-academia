<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="printoff">
                        <form role="form" id="annee_scolaire_filter" method="get">
                            <div class="input-group input-group" style="width: 100%!important;">
                                <select id="anneeScolaire" name="yr" title="yearschool"
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info">
                                    <option disabled>-- Annee Scolaire --</option>
                                    <?php
                                    $selectedYear = isset($anneeChoosed) ? $anneeChoosed : session()->yearlibelle;
                                    $count = 1;
                                    if (isset($annees) && !empty($annees)):
                                        foreach ($annees as $key => $value):
                                            if ($selectedYear == $value['annee_libelle']) { ?>
                                                <option selected
                                                        value="<?= esc($value['annee_uid']); ?>" <?= set_select('yr', esc($value['annee_uid'])); ?>>
                                                    <?= ucfirst(esc($value['annee_libelle'])); ?>
                                                </option>
                                            <?php } ?>

                                            <option value="<?= esc($value['annee_uid']); ?>" <?= set_select('yr', esc($value['annee_uid'])); ?>>
                                                <?= ucfirst(esc($value['annee_libelle'])); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="input-group-append">

                                    <select id="promotionuid" name="cls"
                                            class="form-control select2 select2-info"
                                            data-dropdown-css-class="select2-info">
                                        <option disabled selected>-- toutes les promotions --</option>
                                        <option value="all">Toutes les promotions</option>
                                        <?php
                                        $selectedpromotion = isset($promotionChoosed['promotion_uid']) ? $promotionChoosed['promotion_uid'] : '';
                                        $count = 1;
                                        if (isset($promotions) && !empty($promotions)):
                                            foreach ($promotions as $key => $value):
                                                if ($selectedpromotion == $value['promotion_uid']) { ?>
                                                    <option selected
                                                            value="<?= esc($value['promotion_uid']); ?>" <?= set_select('cls', esc($value['promotion_uid'])); ?>>
                                                        <?= ucfirst(($value['promotion_libelle'])); ?>
                                                        <?= ucfirst(($value['cycle_libelle'])); ?>
                                                    </option>
                                                <?php } ?>
                                                <option value="<?= esc($value['promotion_uid']); ?>" <?= set_select('cls', esc($value['promotion_uid'])); ?>>
                                                    <?= ucfirst(($value['promotion_libelle'])); ?>
                                                    <?= ucfirst(($value['cycle_libelle'])); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default text-uppercase">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Rapports</li>
                        <li class="breadcrumb-item active">Listing</li>
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
                            <h5 class="card-title text-uppercase font-weight-bold">
                                Liste des étudiants - Générale
                                <span class="badge badge-info"> 
                                    <?= isset($anneeChoosed) ? $anneeChoosed : session()->get('yearlibelle'); ?>
                                </span>
                            </h5>

                            <div class="card-tools printoff">
                                <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-xs printoff" onclick="window.print();">
                                    <i class="fa fa-print"></i> Imprimer la liste</a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php

                                if (isset($promotionChoosed)): ?>
                                    <table id="datatablesReportingActions"
                                           class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                        <thead>
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Postnom</th>
                                            <th>Prenom</th>
                                            <th>Sexe</th>
                                            <th>Lieu Naissance</th>
                                            <th>Date Naissance</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        if (isset($etudiants) && !empty($etudiants)):
                                            foreach ($etudiants as $key => $value): ?>
                                                <tr class="small">
                                                    <td><?= $count++; ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_postnom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_prenom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                   <td class="text-uppercase"><?= ($value['etudiant_lieu_naissance']); ?></td>
                                                    <td class="text-uppercase">
                                                        <?= utf8_encode(strftime("%d/%m/%Y", strtotime($value['etudiant_date_naissance']))); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <?php
                                    $count = 1;

                                    if (isset($promotions) && !empty($promotions)):
                                    foreach ($promotions

                                    as $key => $ligne): ?>
                                    <tr class="small text-uppercase">
                                        <th>N°</th>
                                        <th>Promotion: <?= ($ligne['promotion_libelle']); ?></th>
                                        <th>Cycle: <?= ($ligne['cycle_libelle']); ?></th>
                                        <th></th>
                                        <th>Filière: <?= ($ligne['filiere_libelle']); ?></th>
                                        <th>Option: <?= ($ligne['option_libelle']); ?></th>
                                        <th></th>
                                        <th>Année:
                                            <span class="badge badge-info">
                                                    <?= isset($anneeChoosed) ? $anneeChoosed : session()->get('yearlibelle'); ?>
                                                    </span>
                                        </th>
                                    </tr>
                                    <tr class="small text-uppercase">
                                        <th width="1px">#</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Postnom</th>
                                        <th>Prenom</th>
                                        <th>Sexe</th>
                                        <th>Lieu Naissance</th>
                                        <th>Date Naissance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($etudiants) && !empty($etudiants)):
                                        foreach ($etudiants as $key2 => $value):
                                            if ($value['inscription_promotion_uid'] == $ligne['promotion_uid']):?>
                                                <tr class="small">
                                                    <td width="1px"><?= $count++; ?></td>

                                                    <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_postnom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_prenom']); ?></td>

                                                    <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                    <td class="text-uppercase"><?= ($value['etudiant_lieu_naissance']); ?></td>
                                                    <td class="text-uppercase">
                                                        <?= utf8_encode(strftime("%d/%m/%Y", strtotime($value['etudiant_date_naissance']))); ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <tr style="page-break-before:always!important; " class="alert alert-secondary">
                                            <td colspan="9"></td>
                                        </tr>
                                    <?php endif; ?>

                                    </tbody>
                                    <?php endforeach; ?>

                                    <?php endif; ?>
                                    <?php endif; ?>
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

</div>
<!-- 

<tr style="page-break-before:always!important; page-break-after:always!important;" class="alert alert-secondary">
                                                 <th colspan="8"> </th>
                                        </tr>
 -->