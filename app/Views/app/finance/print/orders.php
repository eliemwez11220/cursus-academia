<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">

                    <a href="<?= base_url('finance/view/paiements'); ?>"
                       class="btn btn-default btn-rounded text-uppercase btn-xs">
                        <i class="fa fa-arrow-circle-left"></i> Voir la liste
                    </a> | <a href="<?= base_url('finance/addForm/paiement'); ?>"
                              class="btn btn-info btn-rounded text-uppercase btn-xs">
                        <i class="fa fa-plus"></i> Création
                    </a> |
                    <a href="javascript:void();"
                       class="btn btn-success btn-rounded text-uppercase btn-xs printoff" onclick="window.print();">
                        <i class="fa fa-print"></i> Imprimer</a>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Recus</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <?php
    $taux_du_jour = 0;
    if (isset($taux) && (!empty($taux))) {
        $taux_du_jour = $taux['taux_value'];
    }
    ?>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-lg-3 printoff"></div>
                <div class="col-lg-6 col-sm-12 col-xs-12 mt-sm-1">

                    <div class="card" id="print-area">
                        <div class="card-header">
                            <!-- Main content invoice-->
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-5 invoice-col small border-right">
                                    <h5 class="page-header">
                                        <?php
                                        if (isset($recu) && !empty($recu)) {
                                            ?>
                                            <b class="text-uppercase">Recu</b><br>
                                            <span class="small">
                                            <b>No #<?= $recu['recu_numero_uid']; ?></b>  
                                            <br>
                                            <b>Date #<?= $recu['recu_date']; ?></b> 
                                            <br>
                                            <b>Caisse : <?= isset($caisse) ? $caisse['caisse_libelle'] : ''; ?></b>
                                        </span>

                                        <?php } ?>
                                    </h5>
                                </div>
                                <div class="col-sm-7 invoice-col small">

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
                                        Téléphone: <?= isset($ecole) ? esc($ecole['ecole_telephone']) : ''; ?><br>
                                        Email: <?= isset($ecole) ? esc($ecole['ecole_email']) : ''; ?>
                                    </address>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-sm-5 col-5 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            promotion
                                        </h5>
                                        <div class="description-text">
                                            <b><?= isset($etudiant) ? esc($etudiant['promotion_libelle']) : ''; ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-7">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            etudiant No :
                                            <b><?= isset($etudiant) ? esc($etudiant['etudiant_matricule']) : ''; ?></b>
                                        </h5>
                                        <div class="description-text text-uppercase">

                                            <?= isset($etudiant) ? esc($etudiant['etudiant_nom']) : ''; ?>
                                            <?= isset($etudiant) ? esc($etudiant['etudiant_postnom']) . ' ' . esc($etudiant['etudiant_prenom']) : ''; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions"
                                       class="table table-sm  table-hover table-head-fixed table-bordered">
                                    <thead>
                                    <tr class="small text-uppercase">
                                        <th class="text-center">#</th>
                                        <th>Libellé</th>
                                        <th class="text-right">Montant</th>
                                        <th class="text-right">Versement</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    $montant_total_cdf = 0;
                                    $montant_total_usd = 0;
                                    $montant_total_solde = 0;
                                    $payment_taux = 0;
                                    if (isset($paiements_etudiants) && !empty($paiements_etudiants)):
                                        foreach ($paiements_etudiants as $paiements_el):
                                            $payment_taux = (!empty($paiements_el['payment_taux'])) ? $paiements_el['payment_taux'] : $taux_du_jour;
                                            $montant_paye = $paiements_el['payment_montant_paye'];


                                            $montant_total_cdf += $paiements_el['payment_francs'];
                                            $montant_total_usd += $paiements_el['payment_dollars'];
                                            ?>
                                            <tr class="small">
                                                <td class="text-center"><?= $count++; ?></td>
                                                <td class="text-uppercase">
                                                    <?= $paiements_el['typesfrai_libelle']; ?>
                                                    <?= ($paiements_el['typesfrai_nature'] == 'Mensuelle') ? $paiements_el['payment_mois_uid'] : ''; ?>
                                                </td>
                                                <td class="text-uppercase text-right">
                                                    <?= number_format(esc($paiements_el['payment_montant_complet']), 2, ',', ' '); ?>
                                                </td>

                                                <td class="text-uppercase text-right">
                                                    <?= number_format(($montant_paye), 2, ',', ' '); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php $montant_total_solde = ($montant_total_usd * $payment_taux) + $montant_total_cdf; ?>

                                    <tr class="small text-dark">
                                        <td colspan="4" class="text-uppercase">
                                            <strong>Versement CDF
                                                <span class="float-right">
                                                     <?= number_format($montant_total_cdf, 2, ',', ' '); ?>
                                                    </span></strong>
                                        </td>
                                    </tr>
                                    <tr class="small text-dark">
                                        <td colspan="4" class="text-uppercase">
                                            <strong>Versement USD
                                                <span class="float-right">
                                                    <?= number_format($montant_total_usd, 2, ',', ' '); ?>
                                                    </span></strong>
                                        </td>
                                    </tr>
                                    <tr class="small text-dark">
                                        <td colspan="4" class="text-uppercase">
                                            <strong>Versement Total
                                                <span class="float-right">
                                                    <?= number_format($montant_total_solde, 2, ',', ' '); ?>
                                                    </span></strong>
                                        </td>
                                    </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-12">
                                    <h5 class="text-muted well well-sm shadow-none text-center">
                                        Merci pour votre confiance !
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 col-3">

                                </div>

                                <div class="col-sm-6 col-6">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <?= (!empty($montant_total_solde)) ? number_format($montant_total_solde, 2, ',', ' ') : '...'; ?>
                                            FC
                                        </h5>
                                        <span class="description-text text-uppercase">Net versé</span>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-3 col-lg-3 printoff"></div>
            </div>
        </div>
        <!-- /.row -->
    </filiere>
    <!-- /.col -->
</div>
<!---->
<script>
    window.addEventListener("load", window.print());
</script>

