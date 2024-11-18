<?php
if (session()->get('status') == 'lockscreen') {
    return redirect()->to(base_url('profile/lockscreen'));
}

$uri = service('uri');
$totalSegments = $uri->getTotalSegments();
$urlParam1 = ($totalSegments > 0) ? $uri->getSegment(1) : '';
$urlParam2 = ($totalSegments > 1) ? $uri->getSegment(2) : '';
$urlParam3 = ($totalSegments > 3) ? $uri->getSegment(3) : '';
$urlParams = $uri->getSegments();
$urlCurrent = (uri_string());

$request = \Config\Services::request();
$session = \Config\Services::session();

$theme = esc($request->getGet('theme') != '') ? esc($request->getGet('theme')) : $session->get('theme');
$urlThemeAdded = base_url() . '/' . (uri_string());

$navbar = '';
$sidebar = '';

switch ($theme) {
    case 'black':
        $navbar = 'navbar-dark';
        $sidebar = 'sidebar-dark';
        break;
    case 'success':
        $navbar = 'navbar-dark navbar-success';
        $sidebar = 'sidebar-light-green';
        break;
    case 'orange':
        $navbar = 'navbar-dark navbar-warning';
        $sidebar = 'sidebar-dark-warning';
        break;
    case 'blue':
        $navbar = 'navbar-dark navbar-primary';
        $sidebar = 'sidebar-dark-primary';
        break;
    case 'light':
        $navbar = 'navbar-white navbar-light';
        $sidebar = 'sidebar-light-gray';
        break;
    default:
        $navbar = 'navbar-dark navbar-info';
        $sidebar = 'sidebar-dark-light';
        //$sidebar = 'sidebar-light-gray';
}
$dataTheme = array(
    'navbar' => $navbar,
    'sidebar' => $sidebar,
    'theme' => $theme,
);
$session->set($dataTheme);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- FOR XSS ATTACKS -->
    <meta charset="utf-8">
    <?= csrf_meta() ?>
    <!-- Locale -->
    <!-- To the Future  Meta Tags -->
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= (isset($title)) ? $title : 'Impression reçu paiements'; ?>
    </title>
    <link rel="icon" type="image/png" href="<?= base_url('global/logo/favicon.png'); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/fontawesome-free/css/all.min.css'); ?>">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('global/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables  -->
    <link rel="stylesheet" href="<?= base_url('global/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('global/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('global/dist/css/adminlte.min.css'); ?>">
    <!-- table {
        size: landscape;
    }
    table {
        writing-mode: tb-rl;
    }@page {size: landscape}

    .fit-to-page {
    height: calc(100vh - 20mm) !important;
}
    .fit-to-page {
    height: calc(100vh - 20mm) !important;
}-->
    <style type="text/css" media="print">
        @media print {
            .printoff {
                display: none !important;
            }
           
            body {
                margin: 0 !important;
                padding: 0 !important;
                page-break-before: avoid;
                width: 100% !important;
                height: 100% !important;
                zoom:100% !important;
            }

            @page {
                size: 5.8in 8.5in;
                size: portrait !important;
                max-height: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .content-wrapper {
                width: 100%;
                height: 100%;
                display: block;
            }

            table {
                display: block !important;
                zoom: 105% !important;
            }
        }

        /*
        @media print {
            @page {
                size: 5.5in 8.5in;
                size: portrait;
            }

            .printoff {
                display: none !important;
            }

            html,
            body {
                width: calc(100vw - 20mm);
                position: absolute ! important;
                top: 0px ! important;
                bottom: 0 ! important;
                margin: 0 ! important;
                margin-top: 0 ! important;
                border: 1px ! important;
            }

            .fit-to-page {
                height: calc(100vh - 20mm);
            }

            table {
                display: block !important;
            }
        }*/
    </style>
</head>

<body class="fit-to-page" style="font-family: Trebuchet MS!important;">

    <!--  style="font-family: Roboto,sans-serif!important;" Content Wrapper. Contains page content -->
    <div class="container">
        <!-- Content Header (Page header) -->
        <filiere class="printoff container mt-5">
            <div class="row mb-2">
                <div class="col-sm-8">

                    <a href="<?= base_url('rapport/finances/invoices'); ?>" class="btn btn-default btn-rounded text-uppercase btn-xs">
                        <i class="fa fa-arrow-circle-left"></i> Fermer
                    </a> | <a href="<?= base_url('finance/addForm/paiement'); ?>" class="btn btn-info btn-rounded text-uppercase btn-xs">
                        <i class="fa fa-plus"></i> Créer nouveau paiement
                    </a> |
                    <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-xs printoff" onclick="window.print();">
                        <i class="fa fa-print"></i> Imprimer reçu</a>
                </div>

            </div>
        </filiere>
        <!-- Main content -->
        <div class="container" id="printinvoice">
            <div class="row">
                <div class="col-lg-5 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Main content invoice-->
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-12 invoice-col">
                                    <address>
                                        <span class="text-uppercase text-center">
                                            <b><?= session()->get('schoolname'); ?></b>
                                        </span>
                                        <br>
                                        <span class="text-capitalize text-center">
                                            <?= isset($ecole) ? ($ecole['ecole_adresse']) : ''; ?>
                                        </span>
                                        <br>
                                        Email: <small><?= isset($ecole) ? ($ecole['ecole_email']) : ''; ?></small>
                                    </address>
                                </div>
                            </div>
                            <hr>
                            <div class="row invoice-info">
                                <address class="col-sm-12 invoice-col">
                                    <h5 class="page-header text-uppercase">
                                        <?php if (isset($recu) && !empty($recu)) { ?>
                                            <b class="font-weight-bold">Recu N°:<?= $recu['recu_numero_uid']; ?></b>
                                            <br>
                                            <span class="small">
                                                <b>Date: <?= $recu['recu_date']; ?>. <b>Caisse : <?= isset($caisse) ? $caisse['caisse_libelle'] : ''; ?></b>
                                            </span>
                                        <?php } ?>
                                    </h5>
                                    <hr>
                                    <h5 class="description-header text-uppercase">
                                        <?= isset($etudiant) ? ($etudiant['etudiant_nom']) : ''; ?>
                                        <?= isset($etudiant) ? ($etudiant['etudiant_postnom']) . ' ' . ($etudiant['etudiant_prenom']) : ''; ?>
                                        - <?= isset($etudiant) ? ($etudiant['etudiant_matricule']) : ''; ?>
                                    </h5>
                                    <h6 class="description-text text-uppercase">
                                        promotion :<b>
                                            <?= isset($etudiant) ? ($etudiant['promotion_libelle']) : ''; ?>
                                            <?= isset($etudiant) ? ($etudiant['cycle_libelle']) : ''; ?>
                                        </b>
                                    </h6>
                                </address>
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions" class="table table-sm table-responsive table-bordered">
                                    <thead>
                                        <tr class="small text-uppercase">
                                            <th>Libellé</th>
                                            <th>Montant</th>
                                            <th>Versement</th>
                                            <th>Solde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $montant_total_cdf = 0;
                                        $montant_total_usd = 0;
                                        $montant_total_solde = 0;
                                        $payment_taux = 0;
                                        if (isset($paiements_etudiants) && !empty($paiements_etudiants)) :
                                            foreach ($paiements_etudiants as $paiements_el) :
                                                $payment_taux = (!empty($paiements_el['payment_taux'])) ? $paiements_el['payment_taux'] : $taux_du_jour;
                                                $montant_paye = $paiements_el['payment_montant_paye'];
                                                $montant_total_cdf += $paiements_el['payment_francs'];
                                                $montant_total_usd += $paiements_el['payment_dollars'];

                                                $mois = $paiements_el['payment_mois_uid'] . '-' . date('Y');
                                        ?>
                                                <tr class="small">

                                                    <td class="text-uppercase small">
                                                        <?= $mois; ?>
                                                        <?= $paiements_el['typesfrai_libelle']; ?>
                                                    </td>
                                                    <td class="text-uppercase small">
                                                        <?= number_format(esc($paiements_el['payment_montant_complet']), 2, ',', ' '); ?>
                                                    </td>

                                                    <td class="text-uppercase small">
                                                        <?= number_format(($montant_paye), 2, ',', ' '); ?>
                                                    </td>

                                                    <td class="text-uppercase small">
                                                        <?= number_format(esc($paiements_el['payment_montant_restant']), 2, ',', ' '); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php $montant_total_solde = ($montant_total_usd * $payment_taux) + $montant_total_cdf; ?>

                                        <tr class="small text-dark">
                                            <td colspan="5" class="text-uppercase">
                                                <strong>Francs
                                                    <span class="float-right">
                                                        <?= number_format($montant_total_cdf, 2, ',', ' '); ?>
                                                    </span></strong>
                                            </td>
                                        </tr>
                                        <tr class="small text-dark">
                                            <td colspan="5" class="text-uppercase">
                                                <strong>Dollars
                                                    <span class="float-right">
                                                        <?= number_format($montant_total_usd, 2, ',', ' '); ?>
                                                    </span></strong>
                                            </td>
                                        </tr>
                                        <tr class="small text-dark">
                                            <td colspan="5" class="text-uppercase">
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
                        <div class="card-footer printoff">
                            <span class="font-weight-bold">Merci pour votre confiance !</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.addEventListener("load", window.print());
        </script>

        <!-- jQuery -->
        <script src="<?= base_url('global/plugins/jquery/jquery.min.js'); ?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= base_url('global/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>" defer></script>
        <!-- Select2 -->
        <script src="<?= base_url('global/plugins/select2/js/select2.full.min.js'); ?>" defer></script>


        <script src="<?= base_url('global/'); ?>plugins/datatables/jquery.dataTables.min.js" defer></script>
        <script src="<?= base_url('global/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>
        <script src="<?= base_url('global/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js" defer></script>
        <script src="<?= base_url('global/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js" defer></script>
        <script type="text/javascript">
            $(function() {
                $('#datatablesReportingActions').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": true,
                    "responsive": true,
                });
            });
        </script>
        <!-- Scroll to top -->
        <script src="<?= base_url('global/'); ?>dist/js/scrolltotop.js" defer></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('global/dist/js/adminlte.min.js'); ?>" defer></script>

</body>

</html>