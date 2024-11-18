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
                                <select id="anneeScolaire" name="yr"
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info">
                                    <option disabled>-- Année Scolaire --</option>
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
                        <li class="breadcrumb-item active">Recus</li>
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
                                RECUS PAIEMENTS -
                                <?= isset($promotionChoosed) ? $promotionChoosed['promotion_libelle'] . '|' : 'Generale'; ?>
                                <?= isset($promotionChoosed) ? $promotionChoosed['cycle_libelle'] . '|' : ''; ?>
                                <?= isset($promotionChoosed) ? $promotionChoosed['filiere_libelle'] . '|' : ''; ?>
                                <?= isset($promotionChoosed) ? $promotionChoosed['option_libelle'] : ''; ?>

                                <span class="badge badge-info"> 
                                    <?= isset($anneeChoosed) ? $anneeChoosed : session()->get('yearlibelle'); ?>
                                </span>
                            </h5>

                            <div class="card-tools printoff">
                                <button class="btn btn-success btn-rounded text-uppercase btn-xs" onclick="print()">
                                    <i class="fa fa-print"></i> Imprimer
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Recu</th>
                                        <th>Date</th>
                                        <th>Matricule</th>
                                        <th>Noms Elève</th>
                                        <th>promotion</th>

                                        <th>Montant</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $count = 1;

                                    $listVersements = isset($recuspromotions) ? $recuspromotions : $recus;
                                    if (!empty($listVersements)):
                                        foreach ($listVersements as $key => $value):

                                            ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td>
                                                    <?= esc($value['payment_numero_recu']); ?>
                                                </td>
                                                <td class="text-uppercase"><?= utf8_encode(strftime("%d/%m/%Y", strtotime(esc($value['payment_date'])))); ?></b></td>

                                                <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?>
                                                    <?= esc($value['etudiant_postnom']); ?>
                                                    <?= esc($value['etudiant_prenom']); ?></td>

                                                <td class="text-uppercase">
                                                    <?= ($value['promotion_libelle']); ?></td>


                                                <td class="font-weight-bold text-center">
                                                    <?= number_format(esc($value['recu_montant']), 2, ',', ' '); ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= site_url('finance/printInvoice/' . $value['etudiant_uid'] . '/' . $value['payment_date'] . '/' . $value['recu_numero_uid']); ?>"
                                                       class="btn btn-sm btn-info text-uppercase btn-xs">
                                                        <span class="fa fa-print"></span></a>
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
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>