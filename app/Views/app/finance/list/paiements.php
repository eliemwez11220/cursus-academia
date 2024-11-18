<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Paiements Frais</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/dashboard') ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Finance</li>
                        <li class="breadcrumb-item active">Paiements Frais</li>
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
                                <form role="form" id="annee_scolaire_filter" method="get">
                                    <div class="input-group input-group" style="width: 100%!important;">

                                        <div class="input-group-append">
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

                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default text-uppercase">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-tools float-right">

                                <a href="<?= base_url('finance/addForm/paiement'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter un nouveau paiement">
                                    <i class="fa fa-plus"></i> Nouveau paiement
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Elève</th>
                                        <th>Frais</th>
                                        <th>Montant</th>
                                        <th>USD</th>
                                        <th>CDF</th>
                                        <th>Solde</th>
                                        <th width="1px">Détails</th><th>Statut</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($payments) && !empty($payments)):
                                        foreach ($payments as $key => $value):
                                            $status = (!empty(esc($value['payment_statut'])) ? esc($value['payment_statut']) : 'validee');

                                            $taux = (!empty(($value['payment_taux'])) ? esc($value['payment_taux']) : '0');
                                            $devise = esc($value['payment_devise']);

                                            $montant_versement_dollars = esc($value['payment_dollars']);
                                            $montant_versement_francs = esc($value['payment_francs']);
                                            ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase small font-weight-bold">

                                                    <?= esc($value['etudiant_nom']); ?>
                                                    <?= esc($value['etudiant_postnom']); ?>
                                                    <?= esc($value['etudiant_prenom']); ?>
                                                    |<?= esc($value['etudiant_matricule']); ?>
                                                </td>

                                                <td class="text-uppercase small">
                                                    <?= esc($value['typesfrai_libelle']); ?>|
                                                    <?= ($value['typesfrai_nature'] == 'Mensuelle') ? $value['payment_mois_uid'] : ''; ?></td>
                                                <td class="text-uppercase text-center">
                                                    <?= number_format(esc($value['payment_montant_complet']), 2, ',', ' '); ?>
                                                </td>

                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_dollars, 2, ',', ' '); ?>
                                                </td>

                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_francs, 2, ',', ' '); ?>
                                                </td>

                                                <td class="text-capitalize">
                                                    <a data-toggle="modal"
                                                       data-target="#update_<?= $count; ?>"
                                                       href="#" class="btn btn-xs btn-default">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information"
                                                              class="badge  <?= (($status) == 'validé') ? 'badge-info' : 'badge-warning'; ?> text-capitalize">
                                                            <i class="fa <?= (($status) == 'validé') ? 'fa-check-circle' : 'fa-edit'; ?>"></i> <?= number_format(esc($value['payment_montant_restant']), 2, ',', ' '); ?></span>
                                                    </a>
                                                </td>

                                                <td  class="text-center" width="1px">
                                                    <a href="<?= base_url('finance/details/paiement/' . esc($value['payment_uid'])); ?>"
                                                       class="btn btn-sm btn-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-info-circle fa-lg"></i>
                                                    </a>
                                                </td>
                                                <td  class="text-center" width="1px">
                                                    <a href="<?= site_url('finance/cancelItemPayment/' . $value['payment_uid']); ?>"
                                                       class="btn btn-sm  <?= (($status) == 'validé') ? 'btn-success' : 'btn-danger'; ?> text-uppercase"
                                                       onclick="return confirm('Etes-vous sûr de vouloir annuler ce paiement?');false">
                                                        <?= ($status); ?> </a>
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