<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Apr-21
 * Time: 10:20 AM
 */
 -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">
                                Détails Paiement Frais : <?= (isset($payment)) ? esc($payment['typesfrai_libelle']) : 'Aucun'; ?>
                                <?= (isset($payment)) ? number_format(esc($payment['typesfrai_montant']), 2, ',', ' ') : 'Aucun'; ?>
                                <?= (isset($payment)) ? esc($payment['typesfrai_devise']) : 'Aucun'; ?>
                            </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Paiement Frais</li>
                            </ol>
                        </div>
                    </div>
                </div>

                 <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                
                                 <h5 class="description-header"> 
                                      <?= (isset($payment)) ?number_format(esc($payment['payment_dollars']), 2,',',' ') : '...'; ?>
                                </h5>
                                <span class="description-text">MONTANT USD</span>
                            </div>
                        </div> 

                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                
                                 <h5 class="description-header"> 
                                     <?= (isset($payment)) ?number_format(esc($payment['payment_francs']), 2,',',' ') : '...'; ?>
                                </h5>
                                <span class="description-text">MONTANT CDF</span>
                            </div>
                        </div> <div class="col-sm-4 col-6">
                            <div class="description-block">
                                
                                 <h5 class="description-header"> 
                                     <?= (isset($payment)) ?number_format(esc($payment['payment_taux']), 2,',',' ') : '...'; ?>
                                </h5>
                                <span class="description-text">TAUX USD</span>
                            </div>
                        </div> 
                        
                    </div>
                 </div> 
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
<?php 
                                    if (isset($payment)) {
                                       $devise = (! empty(($payment['payment_devise']))?esc($payment['payment_devise']):'');
                                        $taux = (! empty(($payment['payment_taux']))?esc($payment['payment_taux']):'0');
                                        $montant_versement_original = esc($payment['payment_montant_paye']);

                                        $montant_restant_original = esc($payment['payment_montant_restant']);
                                        $montant_solde_original = esc($payment['payment_montant_complet']);
                                    }
                                        
                                    ?>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('finance/view/paiements'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-sm">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a> | 
                                <a href="<?= base_url('finance/invoice/payment/'.esc($payment['payment_uid'])); ?>"
                                                       class="btn btn-sm btn-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-file-pdf fa-lg"></i> 
                                                        IMPRIMER RECU
                                                    </a>
                            </div>
                            <div class="card-tools float-right">
                                <h5 class="text-uppercase font-weight-bold text-right">  etudiant :
                                    <?= (isset($payment)) ?esc($payment['etudiant_matricule']):'...'; ?> - <?= (isset($payment)) ?esc($payment['etudiant_nom']):'...'; ?> 
                                    <?= (isset($payment)) ?esc($payment['etudiant_postnom']):'...'; ?> <?= (isset($payment)) ?esc($payment['etudiant_prenom']):'...'; ?>
                                </h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                                Informations sur le paiement
                                            </strong>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Référence paiement</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_code']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Type frais</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['typesfrai_libelle']) : 'Aucun'; ?> | 
                                            <?= (isset($payment)) ? esc($payment['payment_mois_uid']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Versement USD</td>
                                        <td class="text-uppercase">  
                                            <?= (isset($payment)) ? number_format(esc($payment['payment_dollars']),2,',', ' ') : '...'; ?>
                                            
                                        </td>
                                    </tr><tr>
                                        <td> Versement CDF</td>
                                        <td class="text-uppercase">  
                                            <?= (isset($payment)) ? number_format(esc($payment['payment_francs']),2,',', ' ') : '...'; ?>
                                            
                                        </td>
                                    </tr><tr>
                                        <td> Montant payé CDF</td>
                                        <td class="text-uppercase">  
                                            <?= (isset($payment)) ? number_format(esc($montant_versement_original),2,',', ' ') : '...'; ?>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Montant restant CDF</td>
                                        <td class="text-uppercase">
                                            <?= (isset($payment)) ? number_format(esc($montant_restant_original),2,',', ' ') : '...'; ?>
                                     
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Montant total </td>
                                        <td class="text-uppercase">
                                            <?= (isset($payment)) ? number_format(esc($montant_solde_original),2,',', ' ') : '...'; ?>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mode paiement</td>
                                        <td class="text-uppercase">
                                            <?= (isset($payment)) ? esc($payment['payment_mode']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date Paiement</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_date']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nom du payeur</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_nompayeur']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Statut Paiement </td>
                                        <td class="text-uppercase">  <?= (isset($payment)) ? esc($payment['payment_statut']) : 'Aucun '; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Validation  Paiement</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_validation']) : 'Aucun'; ?></td>
                                    </tr>

                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                                Journalisation des activités
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Crée le</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_created_at']) : 'Aucun'; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Crée par</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_created_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_updated_at']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_updated_by']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_deleted_at']) : 'Aucun'; ?></td>
                                    </tr><tr>
                                        <td>Supprimé par</td>
                                        <td class="text-uppercase"><?= (isset($payment)) ? esc($payment['payment_deleted_by']) : 'Aucun'; ?></td>
                                    </tr>
                                  
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
