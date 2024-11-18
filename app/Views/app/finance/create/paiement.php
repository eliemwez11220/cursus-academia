<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 25-Apr-21
 * Time: 12:47 PM
 */-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-4">
                    <a href="<?= base_url('finance/view/paiements'); ?>"
                       class="btn btn-default btn-rounded text-uppercase btn-sm">
                        <i class="fa fa-arrow-circle-left"></i> voir la liste
                    </a>
                </div>
                <div class="col-sm-8">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                    href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Finances</li>
                        <li class="breadcrumb-item active">Paiement Frais</li>
                    </ol>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <?php

                    $taux_du_jour = 0;

                    if (isset($taux) && (!empty($taux))) {
                        $taux_du_jour = $taux['taux_value'];
                    }

                    //new code generated automatically
                    $aleatoire_value = "0123456789";
                    $new_code_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5).date('y');

                    //form validation manager
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('finance/savePaymentFrais/create'), $attributes);

                    $numero_recu_auto = (isset(session()->recu) ? session()->recu : $new_code_generate);
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-sm-4 col-lg-4">
                                    <div class="description-block border-right">
                                        <div class="description-header">
                                            <input id="numero_recu" data-toggle="tooltip" data-placement="top"
                                                   title="Numero Recu"
                                                   type="text" name="numero_recu" class="form-control font-weight-bold"
                                                   value="<?= (!empty($numero_recu_auto)) ? $numero_recu_auto : old('code_payment') ?>"
                                                   readonly>

                                            <!--DATE RECU IN HIDDEN -->
                                            <input id="date_paiement"
                                                   type="hidden" name="date_paiement" value="<?= date('Y-m-d'); ?>"
                                                   readonly>
                                        </div>

                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-lg-4">
                                    <div class="description-block border-right">
                                        <div class="description-header">
                                            <select data-toggle="tooltip" data-placement="top"
                                                    title="Caisse" name="caisse_uid_payment" id="caisse_uid_payment"
                                                    class="form-control select2 select2-info"
                                                    data-dropdown-css-class="select2-info">
                                                <option disabled>Choisissez une caisse</option>
                                                <?php
                                                if (isset($caisses) && !empty($caisses)):
                                                    foreach ($caisses as $key => $value) :
                                                        if (session()->get('caisse') == esc($value['caisse_uid'])) { ?>
                                                            <option selected
                                                                    value="<?= esc($value['caisse_uid']); ?>" <?= set_select('caisse_uid_payment', esc($value['caisse_uid'])); ?>>
                                                                <?= strtoupper($value['caisse_libelle']); ?>
                                                            </option>
                                                        <?php } ?>

                                                        <option value="<?= esc($value['caisse_uid']); ?>" <?= set_select('caisse_uid_payment', esc($value['caisse_uid'])); ?>>
                                                            <?= strtoupper($value['caisse_libelle']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-lg-4">
                                    <div class="description-block">

                                        <div class="description-header">
                                            <div class="input-group input-group" style="width: 100%!important;">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span>1$</span>
                                                    </div>
                                                </div>
                                                <input data-toggle="tooltip" data-placement="top"
                                                       title="TAUX DEVISE: Vous pouvez modifier" id="taux_journalier"
                                                       type="text" step="0.00" name="taux_journalier" min="0"
                                                       max="1000000000"
                                                       class="form-control font-weight-bold" autofocus
                                                       value="<?= (!empty($taux_du_jour)) ? $taux_du_jour : set_value('taux_journalier'); ?>"
                                                       required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span>CDF</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 col-sm-8 col-xs-12">
                                    <div class="form-group">

                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('etudiant_uid_payment')) ? ' is-invalid' : '' ?>"
                                                id="etudiant_uid_payment"
                                                name="etudiant_uid_payment"
                                                data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                            <option selected disabled>
                                                <span class="text-danger">*</span>Elève
                                            </option>
                                            <option disabled>-- Sélectionnez un étudiant --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($etudiants) && (!empty($etudiants))):
                                                foreach ($etudiants as $key => $value):?>
                                                    
                                                    <option value="<?= esc($value['etudiant_uid']); ?>" 
                                                    <?= (session()->get('etudiant') == esc($value['etudiant_uid']))? 'selected': set_select('etudiant_uid_payment', esc($value['etudiant_uid'])); ?>>
                                                        <?= ucfirst(esc($value['etudiant_nom'])); ?>
                                                        <?= ucfirst(esc($value['etudiant_prenom'])); ?>
                                                        <?= ucfirst(esc($value['etudiant_postnom'])); ?> -
                                                        <?= ucfirst(esc($value['etudiant_matricule'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('etudiant_uid_payment')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('etudiant_uid_payment'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            
                                <div class="col-lg-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <input id="promotion_etudiant" type="text" name="promotion_etudiant"
                                               value="<?= session()->etudiantpromotion; ?>" readonly class="form-control"
                                               placeholder="promotion(*)" data-toggle="tooltip" data-placement="top"
                                               title="promotion">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <select name="typefrais_uid_payment" id="typefrais_uid_payment"
                                                class="form-control select2 select2-info" title="type frais"
                                                data-dropdown-css-class="select2-info" required>
                                            <option disabled selected>
                                               Type frais(*) 
                                            </option>
                                            <option disabled>-- Choisissez le frais --</option>
                                            <?php
                                            if (isset($typesfrais) && !empty($typesfrais)):
                                                foreach ($typesfrais as $frais) :
                                                    $cycle = ($frais['cycle_libelle']);
                                                    $devise = esc($frais['typesfrai_devise']);
                                                    $montant = esc($frais['typesfrai_montant']);

                                                    if ((session()->etudiantpromotioncycle == ($frais['cycle_uid'])) OR ($frais['cycle_code'] == "all")):?>
                                                        <option value="<?= esc($frais['typesfrai_uid']); ?>" 
                                                        <?= (session()->get('frais') == esc($frais['typesfrai_uid']))? 'selected': set_select('typefrais_uid_payment', esc($frais['typesfrai_uid'])); ?>
                                                                data-toggle="tooltip" data-placement="right"
                                                                title="tooltip">
                                                            <?= strtoupper($frais['typesfrai_libelle']) . " |CDF:"; ?>
                                                            <?php echo ($devise == "USD") ? number_format(($montant * $taux_du_jour), 2, ',', ' ') : number_format($montant, 2, ',', ' '); ?>
                                                            
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('typefrais_uid_payment')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('typefrais_uid_payment'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <select name="mois_uid_payment" id="mois_uid_payment" title="mois"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info" required>
                                            <option value="none" selected> Aucun Mois</option>
                                            <option disabled>Choisissez le mois</option>
                                            <?php
                                            if (isset($mois) && !empty($mois)):
                                                foreach ($mois as $moisvalue) : ?>
                                                    <option value="<?= esc($moisvalue['mois_libelle']); ?>" <?= set_select('mois_uid_payment', esc($moisvalue['mois_libelle'])); ?>>
                                                        <?= ucfirst($moisvalue['mois_libelle']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('typefrais_uid_payment')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('typefrais_uid_payment'); ?></span>
                                        <?php } ?>

                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-sm-6 col-xs-12">

                                    <div class="input-group">

                                        <input class="form-control " type="text" name="montant_versement_cdf"
                                               id="montant_versement_cdf" placeholder="0.00" 
                                               data-toggle="tooltip" data-placement="top"
                                               title="Montant Versé en CDF"
                                               value="<?= old('montant_versement_cdf'); ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text">CDF</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input class="form-control " type="text" name="montant_versement_usd"
                                               id="montant_versement_usd" placeholder="0.00" 
                                               data-toggle="tooltip" data-placement="top"
                                               title="Montant Versé en USD"
                                               value="<?= old('montant_versement_usd'); ?>">

                                        <div class="input-group-append">
                                            <span class="input-group-text">USD</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="solde_dollars" type="text" name="solde_dollars"
                                                   class="form-control font-weight-bold"
                                                   value="<?= old('solde_dollars'); ?>" readonly data-toggle="tooltip"
                                                   data-placement="top" title="Montant devise converti en CDF">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn btn-info text-uppercase"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="cliquez pour ajouter ce paiement">
                                                    <i class="fa fa-check-circle fa-lg"></i>Valider
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- -->
                            </div>
                            <hr class="border border-dark">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered" id="table_achats">
                                            <thead>
                                            <tr class="small">
                                                <th>#</th>
                                                <th>LIBELLE</th>
                                                <th>MOIS</th>
                                                <th class="text-right">MONTANT</th>
                                                <th class="text-right">USD</th>
                                                <th class="text-right">CDF</th>
                                                <th width="1px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (isset($paiements_etudiants) && !empty($paiements_etudiants)):
                                                $count = 1;
                                                $montant_total_cdf = 0;
                                                $montant_total_usd = 0;
                                                $montant_total_solde = 0;
                                                foreach ($paiements_etudiants as $key => $valuePay):

                                                    $taux_payment = $valuePay['payment_taux'];

                                                    $montant_paye = $valuePay['payment_montant_paye'];

                                                    $montant_total_cdf += $valuePay['payment_francs'];
                                                    $montant_total_usd += $valuePay['payment_dollars'];
                                                    ?>
                                                    <tr class="small">
                                                        <td class="text-left">
                                                            <?= $count++; ?></td>
                                                        <td class="text-uppercase">
                                                            <?= $valuePay['typesfrai_libelle']; ?>
                                                        </td>

                                                        <td class="text-uppercase text-left">
                                                            <?= ($valuePay['typesfrai_nature'] == 'minerval') ? $valuePay['payment_mois_uid'] : ' - '; ?>
                                                        </td>
                                                        <td class="text-uppercase text-right">
                                                            <?= number_format($valuePay['payment_montant_complet'], 2, ',', ' '); ?>
                                                        </td>
                                                        <td class="text-uppercase text-right">
                                                            <?= number_format($valuePay['payment_dollars'], 2, ',', ' '); ?>
                                                        </td>
                                                        <td class="text-uppercase text-right">
                                                            <?= number_format($valuePay['payment_francs'], 2, ',', ' '); ?>
                                                        </td>
                                                        <td width="1px">
                                                            <a href="<?= site_url('finance/cancelItemPayment/' . $valuePay['payment_uid']); ?>"
                                                               class="btn btn-sm btn-danger text-uppercase"
                                                               onclick="return confirm('Annuler cette ligne de paiement?');false">
                                                                <span class="fa fa-trash"></span> </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="small alert alert-info">
                                                    <td colspan="6" class="text-uppercase small">
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                            <tfoot class="text-dark">
                                            <?php
                                            $montant_total_dollars = (!empty($montant_total_usd)) ? ($montant_total_usd * $taux_payment) : 0;

                                            $montant_total_versement = (!empty($montant_total_cdf)) ? ($montant_total_dollars + $montant_total_cdf) : $montant_total_dollars;
                                            ?>
                                            <tr class="small">
                                                <td colspan="4" class="text-uppercase"></td>
                                                <td class="text-uppercase">
                                                    <strong>
                                                        <span class="float-right">Versement CDF </span>
                                                    </strong>
                                                </td>
                                                <td class="text-uppercase">
                                                    <strong>
                                                        <span class="float-right">
                                                       <?= (!empty($montant_total_cdf)) ? number_format($montant_total_cdf, 2, ',', ' ') : 0.00; ?>
                                                    </span></strong>
                                                </td>
                                            </tr>
                                            <tr class="small">
                                                <td colspan="4" class="text-uppercase"></td>
                                                <td class="text-uppercase">
                                                    <strong><span class="float-right">Versement USD </span></strong>
                                                </td>
                                                <td class="text-uppercase">
                                                    <strong>
                                                    <span class="float-right">
                                                    <?= (!empty($montant_total_usd)) ? number_format($montant_total_usd, 2, ',', ' ') : 0.00; ?>
                                                    </span></strong>
                                                </td>
                                            </tr>
                                            <tr class="small">
                                                <td colspan="4" class="text-uppercase"></td>
                                                <td class="text-uppercase">
                                                    <strong><span class="float-right">Versement Total </span></strong>
                                                </td>
                                                <td class="text-uppercase">
                                                    <strong>
                                                        <span class="float-right">
                                                    <?= number_format($montant_total_versement, 2, ',', ' '); ?>
                                                    </span></strong>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div><!-- /.table responsive -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div> <!-- /.card-body -->
                        <?php if (isset(session()->recu)) { ?>
                            <div class="card-footer text-right">
                                <a href="<?= site_url('finance/printInvoice/' . session()->etudiant . '/' . date('Y-m-d') . '/' . session()->recu); ?>"
                                   class="btn btn-sm btn-success text-uppercase">
                                    <span class="fa fa-print"></span> Imprimer reçu</a>
                        
                                <a href="<?= site_url('finance/newInvoicing'); ?>"
                                   class="btn btn-sm btn-info text-uppercase" onclick="return confirm('Etes-vous sûr de vouloir créer un nouveau reçu sans imprimer celui qui est encours?'); false;">
                                    <span class="fa fa-plus"></span> Créer nouveau reçu</a>
                            </div>
                        <?php } ?>
                        <?php echo form_close(); ?>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="col-sm-4">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-uppercase"><b>Situation de paiements de cet étudiant</b></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered" id="table_achats">
                                            <thead>
                                            <tr class="small">
                                                <th class="text-center">Date</th>
                                                <th>Frais</th>
                                                <th class="text-center">Montant Versé</th>
                                                <th class="text-center">Solde</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (isset($payments) && !empty($payments)):
                                                $count = 1;
                                                foreach ($payments as $paiements_el):
                                                    $status = (!empty(esc($paiements_el['payment_statut'])) ? esc($paiements_el['payment_statut']) : 'validee');

                                                    $taux = (!empty(($paiements_el['payment_taux'])) ? esc($paiements_el['payment_taux']) : '0');
                                                    $devise = esc($paiements_el['payment_devise']);
                                                    $montant_versement_dollars = esc($paiements_el['payment_dollars']);
                                                    $montant_versement_francs = esc($paiements_el['payment_francs']);
                                                    ?>

                                                    <tr class="small">
                                                        <td class="text-center text-uppercase">
                                                            <a data-toggle="modal" data-target="#update_<?= $count; ?>"
                                                               href="javascript:void();"><?= $paiements_el['payment_date']; ?></a>
                                                        </td>

                                                        <td class="text-uppercase small">
                                                        <?= ($paiements_el['typesfrai_nature'] == 'Mensuelle') ? $paiements_el['payment_mois_uid'] : ''; ?>
                                                        <?= $paiements_el['typesfrai_libelle']; ?>
                                                             
                                                        </td>

                                                        <td class="text-uppercase text-center">
                                                            <?= number_format($paiements_el['payment_montant_paye'], 2, ',', ' '); ?>
                                                        </td>

                                                        <td class="text-center text-uppercase">
                                                            <a data-toggle="modal"
                                                               data-target="#update_<?= $count; ?>"
                                                               href="#" class="btn btn-xs btn-default">
                                                        <span  class="badge  <?= (($status) == 'validé') ? 'badge-info' : 'badge-warning'; ?> text-capitalize">
                                                            <i class="fa <?= (($status) == 'validé') ? 'fa-check-circle' : 'fa-edit'; ?>"></i> <?= number_format(esc($paiements_el['payment_montant_restant']), 2, ',', ' '); ?></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <!-- update year modal -->
                                                    <div class="modal fade" id="update_<?= $count; ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-center">

                                                                    <h4 class="modal-title d-inline-flex text-uppercase font-weight-bold">
                                                                        frais

                                                                        <?= esc($paiements_el['typesfrai_libelle']); ?> -
                                                                        <?= number_format(esc($paiements_el['typesfrai_montant']), 2, ',', ' '); ?>
                                                                        <?= esc($paiements_el['typesfrai_devise']); ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                                    </button>
                                                                </div>
                                                                <?php
                                                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                                echo form_open('finance/savePaymentsCompleted/update/' . esc($paiements_el['payment_uid']), $attributes);
                                                                ?>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="montant_payment"><span
                                                                                            class="text-danger">*</span>Montant
                                                                                    déjà payé</label>
                                                                                <div class="input-group"
                                                                                     style="width: 100%!important;">
                                                                                    <input data-toggle="tooltip"
                                                                                           data-placement="top"
                                                                                           title="En chiffre SVP!" readonly
                                                                                           type="number" step="0.00"
                                                                                           name="montant_paye" min="0"
                                                                                           max="1000000000"
                                                                                           class="form-control font-weight-bold"
                                                                                           value="<?= !empty(esc($paiements_el['payment_montant_paye'])) ? esc($paiements_el['payment_montant_paye']) : set_value('montant_payment'); ?>"
                                                                                           required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text">CDF</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="montant_restant"><span
                                                                                            class="text-danger">*</span>Montant
                                                                                    restant à compléter</label>
                                                                                <div class="input-group"
                                                                                     style="width: 100%!important;">
                                                                                    <input data-toggle="tooltip"
                                                                                           data-placement="top"
                                                                                           title="En chiffre SVP!"
                                                                                           type="number" step="0.00"
                                                                                           name="montant_restant" min="0"
                                                                                           max="1000000000"
                                                                                           class="form-control font-weight-bold"
                                                                                           value="<?= (!empty(esc($paiements_el['payment_montant_restant']))) ? esc($paiements_el['payment_montant_restant']) : set_value('montant_restant'); ?>"
                                                                                           required>
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text">CDF</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                            <label for="montant_restant"><span
                                                                                        class="text-danger">*</span>Numéro Reçu
                                                                                du paiement</label>
                                                                            <input id="numero_recu_paiement"
                                                                                   data-toggle="tooltip" data-placement="top"
                                                                                   title="Numero Reçu"
                                                                                   type="text" name="numero_recu_paiement"
                                                                                   class="form-control font-weight-bold"
                                                                                   value="<?= (!empty($numero_recu_auto)) ? $numero_recu_auto : old('code_payment') ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <?php if ($status != 'validé'): ?>
                                                                        <button type="submit"
                                                                                class="btn btn-info btn-sm text-uppercase">
                                                                            Compléter le paiement
                                                                        </button>
                                                                    <?php endif; ?>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                            data-dismiss="modal">Fermer
                                                                    </button>
                                                                </div>
                                                                <?php echo form_close(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end update year modal -->
                                                    <?php //endif;
                                                    ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr class="small alert alert-warning">
                                                    <td colspan="8" class="text-uppercase small">
                                                        <strong>Aucun paiement</strong>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>

