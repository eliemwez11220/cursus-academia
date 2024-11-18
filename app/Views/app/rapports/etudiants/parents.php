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

                                    <select id="promotionuid" name="cls" title="promotion"
                                            class="form-control select2 select2-info"
                                            data-dropdown-css-class="select2-info">
                                        <option disabled selected>-- toutes les promotions --</option>
                                        <option value="all">Toutes les promotions</option>
                                        <?php
                                        $selectedpromotion = isset($promotionChoosed) ? $promotionChoosed['promotion_uid'] : '';
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
                                        <i class="fa fa-search"></i>Rechercher
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
                        <li class="breadcrumb-item active">Elèves</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 invoice-col border-right">
                            <address>
                                <span class="text-uppercase">
                                    <b>

                                       <?= session()->get('schoolname'); ?> |
                                        <?= isset($ecole) ? esc($ecole['ecole_code']) : ''; ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-capitalize">
                                    <?= isset($ecole) ? esc($ecole['ecole_ville']) . ' , ' . esc($ecole['ecole_province']) : ''; ?>
                                </span>
                                <br>
                                <span class="text-capitalize">
                                    <?= isset($ecole) ? esc($ecole['ecole_adresse']) : ''; ?>
                                </span>
                                <br>
                                <p>
                                    Téléphone: <?= isset($ecole) ? esc($ecole['ecole_telephone']) : ''; ?><br>
                                    Email: <?= isset($ecole) ? esc($ecole['ecole_email']) : ''; ?>
                                </p>
                            </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <address>
                                <span class="text-uppercase">
                                    <b>
                                              Année scolaire  :
                                        <?= isset($anneeChoosed) ? $anneeChoosed : session()->get('yearlibelle'); ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase">
                                    <b>promotion:
                                        <?= isset($promotionChoosed) ? $promotionChoosed['promotion_libelle'] : 'Toutes'; ?>
                                    </b>
                                </span>
                                <br> <span class="text-uppercase">
                                    <b>Cycle:
                                        <?= isset($promotionChoosed) ? $promotionChoosed['cycle_libelle'] : 'Tous'; ?>
                                    </b>
                                </span>
                                <br>

                                <span class="text-uppercase">
                                    <b>
                                        filiere :
                                        <?= isset($promotionChoosed) ? $promotionChoosed['filiere_libelle'] : 'Toutes'; ?>
                                    </b>
                                    <br>
                                <span class="text-uppercase">
                                    <b>
                                        Option :
                                        <?= isset($promotionChoosed) ? $promotionChoosed['option_libelle'] : 'Toutes'; ?>
                                    </b>
                                </span>

                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-uppercase font-weight-bold">
                                Liste générale - Parents & Enfants
                                <span class="badge badge-info">
                                    <?= isset($anneeChoosed) ? $anneeChoosed : session()->get('yearlibelle'); ?>
                                </span>
                            </h5>

                            <div class="card-tools printoff">
                                <button class="btn btn-success btn-rounded text-uppercase btn-xs"
                                        onclick="window.print()">
                                    <i class="fa fa-print"></i> Imprimer
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions"
                                       class="table table-sm">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Père</th>
                                        <th>Mère</th>
                                        <th>Tuteur</th>
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($parents) && !empty($parents)):
                                        foreach ($parents as $key => $parent):?>
                                            <tr class="font-weight-bold">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase"><?= ($parent['parent_nom_pere']); ?></td>
                                                <td class="text-uppercase"><?= ($parent['parent_nom_mere']); ?></td>
                                                <td class="text-uppercase"><?= ($parent['parent_nom_tuteur']); ?></td>
                                                <td class="text-uppercase"><?= esc($parent['parent_phone']); ?></td>
                                                <td class="text-lowercase"><?= esc($parent['parent_email']); ?></td>
                                                <td></td>
                                            </tr>
                                            <?php if (isset($etudiants) && !empty($etudiants)): ?>
                                                <tr class="small text-uppercase">
                                                    <th>Matricule</th>
                                                    <th>Nom</th>
                                                    <th>Postnom</th>
                                                    <th>Prénom</th>
                                                    <th>Sexe</th>
                                                    <th>Lieu & Date Naiss.</th>
                                                    <th>promotion</th>
                                                </tr>
                                                <?php foreach ($etudiants as $key2 => $etudiant):
                                                    if ($etudiant['etudiant_tuteur_uid'] == $parent['parent_uid']):
                                                        $sexe = ($etudiant['etudiant_sexe'] == "masculin") ? "M" : "F";
                                                        ?>
                                                        <tr class="small">
                                                            <td class="text-uppercase"><?= esc($etudiant['etudiant_matricule']); ?></td>
                                                            <td class="text-uppercase"><?= ($etudiant['etudiant_nom']); ?></td>
                                                            <td class="text-uppercase"><?= ($etudiant['etudiant_postnom']); ?></td>
                                                            <td class="text-uppercase"><?= ($etudiant['etudiant_prenom']); ?></td>
                                                            <td class="text-uppercase"><?= $sexe; ?></td>
                                                            <td class="text-uppercase">
                                                                <b><?= ucfirst($etudiant['etudiant_lieu_naissance']); ?>
                                                                    <span>Le </span><?= utf8_encode(strftime("%d/%m/%Y", strtotime(esc($etudiant['etudiant_date_naissance'])))); ?>
                                                                </b></td>
                                                            <td class="text-uppercase">
                                                                <?= ($etudiant['promotion_libelle']); ?>
                                                                <?= ($etudiant['cycle_libelle']); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <tr style="page-break-before:avoid!important;">
                                                    <td colspan="7"></td>
                                                </tr>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="7" class="text-uppercase">
                                                <strong>Aucun parent</strong>
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