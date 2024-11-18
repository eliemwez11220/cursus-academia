<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
    <div class="container-fluid">
        <div class="card mb-3 bg-gray-200 printoff">
            <div class="card-body">
                <?php 
                $request = \Config\Services::request(); 

                $start = $request->getGet('start_date');
                $end = $request->getGet('end_date');

                $validation = \Config\Services::validation(); ?>
                <form role="form" id="annee_scolaire_filter" method="get">
                <?= csrf_field(); ?>
                <div class="row">
                <div class="col-sm-3">
                        <div class="form-floating mb-2">
                        <label for="start_date">Date début<span
                                        class="text-danger">(*)</span></label>
                            <input
                                    type="date"
                                    class="form-control <?= ($validation->hasError('start_date')) ? ' is-invalid' : '' ?>"
                                    id="start_date" name="start_date"
                                    aria-describedby="start_date" required
                                    value="<?= (!empty($start))? $start :set_value('start_date'); ?>"
                            />
                            
                            <div id="start_date" class="form-text">
                                <span class="text-danger"><?= display_validation_error($validation, 'start_date'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-floating mb-2">
                        <label for="end_date">Date fin<span
                                        class="text-danger">(*)</span></label>
                            <input
                                    type="date"
                                    class="form-control <?= ($validation->hasError('end_date')) ? ' is-invalid' : '' ?>"
                                    id="end_date" placeholder="Patient" name="end_date"
                                    aria-describedby="end_date" required
                                    value="<?= (!empty($end))? $end : set_value('end_date'); ?>"
                            />
                           
                            <div id="end_date" class="form-text">
                                <span class="text-danger"><?= display_validation_error($validation, 'end_date'); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                    <label for="typefrais_uid_payment">Type frais<span class="text-danger">(*)</span></label>
                    <select name="typefrais" id="typefrais_uid_payment" title="frais"
                                                class="form-control select2 select2-info" title="type frais"
                                                data-dropdown-css-class="select2-info" required>
                                           
                                            <option  disabled>-- Choisissez le Type frais(*)  --</option>
                                            <option  selected value="all">Tous les frais</option>
                                            <?php
                                            if (isset($typesfrais) && !empty($typesfrais)):
                                                foreach ($typesfrais as $frais) :?>
                                                        <option value="<?= esc($frais['typesfrai_uid']); ?>" 
                                                        <?= (session()->get('frais') == esc($frais['typesfrai_uid']))? 'selected': set_select('typefrais_uid_payment', esc($frais['typesfrai_uid'])); ?>
                                                                data-toggle="tooltip" data-placement="right"
                                                                title="tooltip">
                                                            <?= strtoupper($frais['typesfrai_libelle']); ?>
                                                            
                                                        </option>
                                                   
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('typefrais_uid_payment')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('typefrais_uid_payment'); ?></span>
                                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                    <label for="end_date">promotion<span class="text-danger">(*)</span></label>
                    <div class="input-group">
                   
                                    <select id="promotionuid" name="cls" title="promotion"
                                            class="form-control select2 select2-info"
                                            data-dropdown-css-class="select2-info">
                                        <option disabled >-- Choisir une promotion --</option>
                                        <option selected value="all">Toutes les promotions</option>
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
                                
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary text-uppercase" title="Bouton de recherche">
                                        <i class="fa fa-search"></i> valider
                                    </button>
                                </div>
                                </div>
                  
                        
                    </div>
                </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto printoff">
                            <?php if (isset($enddate)): ?>
                                <a class="btn btn-dark btnrounded text-uppercase  btn-xs"
                                   href=" <?= base_url('rapport/finances/versements'); ?>">
                                    <i class="fas fa-window-close"></i> Annuler le filtrage</a>
                            <?php endif; ?>
                            <a class="btn btn-success btn-rounded text-uppercase btn-xs" href="javascript:void();" onclick="window.print();">
                                <i class="fas fa-print"></i> Imprimer ce rapport</a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div>
    </div><!-- /.container-fluid -->
    </filiere>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-9 invoice-col border-right">
                            <address>
                                <span class="text-uppercase">
                                    <b>       
                                       <?= session()->get('schoolname'); ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-capitalize">
                                    <?= isset($ecole) ? esc($ecole['ecole_adresse']) : ''; ?>
                                </span>
                                <br>
                            </address>
                        </div>
                        <div class="col-sm-3 invoice-col small text-right">
                            <address>
                                <span class="text-uppercase">
                                    <b>Début:
                                        <?= isset($startdate) ? $startdate: date('d/m/Y'); ?>
                                    </b>
                                </span>
                                <br> 
                                <span class="text-uppercase">
                                    <b>Fin:
                                        <?= isset($enddate) ? $enddate: date('d/m/Y'); ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase">
                                    <b> Année  :
                                        <?= isset($anneeChoosed) ? $anneeChoosed : session()->get('yearlibelle'); ?>
                                    </b>
                                </span>
                            </address>
                        </div>
            
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                <div class="text-center">
                                <h5 class="font-weight-bold text-uppercase text-center" style="text-decoration:underline">
                                    Versement - Elèves</h5>
                            </div>
                    <div class="card">
                    
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions"
                                       class="table table-sm">
                                    <thead>
                                    <tr class="small text-uppercase">
                                        <th>Date</th>
                                        <th>Matricule</th>
                                        <th>Noms</th>
                                        <th>promotion</th>
                                        <th>Frais</th>
                                        <th>Mois</th>
                                        <th>USD</th>
                                        <th>CDF</th>
                                        <th>Recu</th>
                                        <th>Etat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    $montant_total_percu_usd = 0;
                                    $montant_total_percu_cdf = 0;
                                    $versements_total = 0;

                                    //if (isset($typesfrais) && !empty($typesfrais)):
                                       // foreach ($typesfrais as $key => $ligne): ?>
                                            
                                            <?php
                                            $listVersements = isset($versementspromotions) ? $versementspromotions : $versements;
                                            if (!empty($listVersements)):
                                                foreach ($listVersements as $key => $value):
                                                    $devise = (!empty(($value['payment_devise'])) ? esc($value['payment_devise']) : '');
                                                    $taux = (!empty(($value['payment_taux'])) ? esc($value['payment_taux']) : '0');

                                                    $montant_versement_usd = esc($value['payment_dollars']);
                                                    $montant_versement_cdf = esc($value['payment_francs']);

                                                    $montant_versement = esc($value['payment_montant_paye']);

                                                    //if ($value['payment_frais_uid'] == $value['typesfrai_uid']):

                                                        $montant_total_percu_usd += ($value['payment_statut'] !="inactif")?$montant_versement_usd:0;

                                                        $montant_total_percu_cdf += ($value['payment_statut'] !="inactif")?$montant_versement_cdf:0;
                                                        $versements_total += ($value['payment_statut'] !="inactif")?$montant_versement:0;

                                                        ?>
                                                        <tr class="small"> 
                                                            
                                                       
                                                            <td class="text-uppercase"><?= utf8_encode(strftime("%d/%m/%Y", strtotime(esc($value['payment_date'])))); ?></b></td>
                                                            <td class="text-uppercase">
                                                                <?= ($value['etudiant_matricule']); ?>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= ($value['etudiant_nom']); ?>
                                                                <?= ($value['etudiant_postnom']); ?>
                                                            </td>
                                                            
                                                            <td class="text-uppercase">
                                                                <?= ($value['promotion_libelle']); ?> <?= ($value['cycle_libelle']); ?>
                                                            </td>
                                                            <td class="text-uppercase small"> 
                                                                <span class="font-weight-bold">  
                                                                  <?= ($value['typesfrai_libelle']); ?>  
                                                                 </span> 
                                                            </td> 
                                                            <td class="text-capitalize">
                                                                <?= ($value['typesfrai_nature'] == 'minerval') ? $value['payment_mois_uid'] : '-'; ?>
                                                            </td>
                                                            
                                                            <td class="font-weight-bold">
                                                                <?= number_format($montant_versement_usd, 2, ',', ' '); ?>
                                                            </td>

                                                            <td class="font-weight-bold">
                                                                <?= number_format($montant_versement_cdf, 2, ',', ' '); ?>
                                                            </td>
                                                            
                                                            <td>
                                                                <?= ($value['payment_numero_recu']); ?>
                                                            </td>
                                                            <td class="text-capitalize">
                                                                <?= ($value['payment_statut'] == 'inactif') ? "annulé" : '-'; ?>
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                    <?php //endif; ?>
                                                <?php //endforeach; ?>
                                            <?php //endif; //break;?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <tr class="text-center">
                                    <td colspan="2"></td>
                                        <td class="text-uppercase">Total versement:</td>
                                        <td class="text-uppercase" colspan="3">
                                                    <span class="font-weight-bold">
                                                         USD : $<?= number_format(($montant_total_percu_usd), 2, ',', ' '); ?>
                                                    </span>
                                        </td>
                                        <td class="text-uppercase"  colspan="4">
                                                    <span class="font-weight-bold">
                                                         CDF: <?= number_format(($montant_total_percu_cdf), 2, ',', ' '); ?>
                                                        Fc</span>
                                        </td>
                                    </tr>
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

             <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Fonctionnement</h5>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered">
                                    <thead>
                                    <tr class="small text-uppercase">
                                        <th>LIBELLE</th>
                                        <th>Entrée</th>
                                        <th>Sortie cdf</th>
                                        <th>Sortie usd</th>
                                        <th>DATE</th>
                                        <th>OBSERVATION</th>
                                        <th>ETAT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    
                                    $tot_usd = 0;
                                    $tot_cdf = 0;
                                    $total_entree_usd =0;
                                    $total_entree_cdf =0;
                                    if (isset($mouvements) && !empty($mouvements)):
                                        foreach ($mouvements as $key => $value):
                                            $tauxChange = (isset($taux_du_jour)) ? $taux_du_jour:2000;
                                            $status = ($value['mouvement_statut']);
                                            $entree_cdf = (($status == 'actif')&& (! empty($value['mouvement_montant'])) && (strtolower($value['mouvement_devise']) == "cdf")) ?($value['mouvement_montant']) : 0;
                                            $entree_usd = (($status == 'actif')&& (! empty($value['mouvement_montant'])) && (strtolower($value['mouvement_devise']) == "usd")) ?($value['mouvement_montant']) : 0;
                                            
                                            $sorti_cdf = ($status == 'actif') ?($value['montant_sorti_cdf']):0;
                                            $sorti_usd = ($status == 'actif') ?($value['montant_sorti_usd']):0;

                                            $devise_sortie = ($sorti_cdf == 0)?'usd':'cdf';
                                            $tot_sorti = ($sorti_cdf == 0)?$sorti_usd:$sorti_cdf;

                                            
                                    $tot_usd += $sorti_usd;
                                    $tot_cdf += $sorti_cdf;
                                    $total_entree_cdf +=  $entree_cdf;
                                    $total_entree_usd += $entree_usd;
                                    ?>
                                            <tr class="small">
                                                
                                                <td>
                                                <?= (esc($value['mouvement_libelle'])); ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= number_format(esc($value['mouvement_montant']), 2, ',', ' '); ?>
                                                    <?= esc($value['mouvement_devise']); ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= number_format($value['montant_sorti_cdf'], 2, ',', ' '); ?>
                                                    
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= number_format($value['montant_sorti_usd'], 2, ',', ' '); ?>
                                                    
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['mouvement_created_at']); ?></td>

                                                <td class="text-uppercase small">
                                                   <?= (esc($value['mouvement_type']) == 'depense')?$value['mouvement_motif']:$value['mouvement_comment']; ?>
                                                </td>
                                                <td class="text-capitalize">
                                                                <?= ($value['mouvement_statut'] == 'inactif') ? "annulé" : '-'; ?>
                                                            </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <tr class="text-uppercase">
                                        
                                            <td class="text-uppercase text-right" rowspan="2">Totaux:</td>
                                            <td class="text-uppercase" >
                                                    <span class="font-weight-bold">
                                                           USD : $ <?= number_format($total_entree_usd, 2, ',', ' '); ?>
                                                    </span>
                                                    </td>
                                                    
                                                    </tr>
                                                    <tr class="text-uppercase"><td class="text-uppercase">
                                                <span class="font-weight-bold">
                                                 CDF: <?= number_format($total_entree_cdf, 2, ',', ' '); ?>
                                                    Fc</span>
                                            </td>
                                            
                                        <td class="text-uppercase">
                                                <span class="font-weight-bold">
                                                 CDF: <?= number_format($tot_cdf, 2, ',', ' '); ?>
                                                    Fc</span>
                                            </td>
                                            <td class="text-uppercase" >
                                                    <span class="font-weight-bold">
                                                           USD : $<?= number_format($tot_usd, 2, ',', ' '); ?>
                                                    </span>
                                                    </td>
                                            </tr>
                                            <tr> <td class="text-uppercase text-right" colspan="2">Total Fonctionnement:</td>
                                           <td class="text-uppercase">
                                                <span class="font-weight-bold">
                                                 CDF: <?= number_format($total_entree_cdf - $tot_cdf, 2, ',', ' '); ?>
                                                    Fc</span>
                                            </td>
                                            <td class="text-uppercase" >
                                                    <span class="font-weight-bold">
                                                           USD : $ <?= number_format($total_entree_usd - $tot_usd, 2, ',', ' '); ?>
                                                    </span>
                                                    </td>
                                            </tr>

                                    <?php else: ?>
                                        <tr class="alert alert-secondary small">
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
                  
                        <div class="card-footer">
                            <div class="card-title">
                                <h5 class="text-uppercase">TOTAL général =  
                                    <span class="font-weight-bold">
                                        USD: $<?= number_format(($montant_total_percu_usd + $total_entree_usd - $tot_usd), 2, ',', ' '); ?>
                                                    </span> | <span class="font-weight-bold">
                                                          CDF: <?= number_format(($montant_total_percu_cdf + $total_entree_cdf - $tot_cdf), 2, ',', ' '); ?>
                                                    Fc</span>
                                    </h5>
                            </div>
                        </div>
                       
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <div class="text-center printoff">
            <a class="btn btn-success btn-rounded text-uppercase btn-xs" href="javascript:void();" onclick="window.print();">
                                <i class="fas fa-print"></i> Imprimer ce rapport</a>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>