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
                                            $selectedYear = isset($anneeChoosed)?$anneeChoosed:session()->yearlibelle;
                                            $count = 1;
                                            if (isset($annees) && !empty($annees)):
                                                foreach ($annees as $key => $value): 
                                                    if ($selectedYear == $value['annee_libelle']) { ?>
                                                        <option selected value="<?= esc($value['annee_uid']); ?>" <?= set_select('yr', esc($value['annee_uid'])); ?>>
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
                                                $selectedpromotion = isset($promotionChoosed['promotion_uid'])?$promotionChoosed['promotion_uid']:'';
                                                $count = 1;
                                                if (isset($promotions) && !empty($promotions)):
                                                    foreach ($promotions as $key => $value): 
                                                        if ($selectedpromotion == $value['promotion_uid']) { ?>
                                                            <option selected value="<?= esc($value['promotion_uid']); ?>" <?= set_select('cls', esc($value['promotion_uid'])); ?>>
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
                        <li class="breadcrumb-item active">Paiements</li>
                        <li class="breadcrumb-item active">Litiges</li>
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
                        </div> <div class="col-sm-6 invoice-col"> 
                            <address>
                                <span class="text-uppercase">
                                    <b>
                                              Année scolaire  :  
                                       <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase">
                                    <b>promotion:
                                        <?= isset($promotionChoosed)?$promotionChoosed['promotion_libelle']:'Toutes';?>
                                    </b>
                                </span>
                                <br> <span class="text-uppercase">
                                    <b>Cycle:
                                        <?= isset($promotionChoosed)?$promotionChoosed['cycle_libelle']:'Tous';?>
                                    </b>
                                </span>
                                <br>
                                
                                 <span class="text-uppercase">
                                    <b>
                                        filiere :
                                       <?= isset($promotionChoosed)?$promotionChoosed['filiere_libelle']:'Toutes';?>
                                    </b> 
                                    <br>
                                <span class="text-uppercase">
                                    <b>
                                        Option :
                                        <?= isset($promotionChoosed)?$promotionChoosed['option_libelle']:'Toutes';?>
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
                                Liste des litiges - Générale
                                <span class="badge badge-info"> 
                                    <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                </span>
                            </h5>
                            
                            <div class="card-tools">
                                <a href="#"
                       class="btn btn-success btn-rounded text-uppercase btn-xs printoff" onclick="print();">
                        <i class="fa fa-print"></i> Imprimer</a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">

                             <?php
                                if(isset($promotionChoosed)): ?>
                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom Elève</th>
                                        <th>Frais</th>
                                        <th>Montant</th>
                                        <th>CDF</th>
                                        <th>USD</th>
                                        <th>totla</th>
                                        <th>Reste</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                     $count = 1;

                                        if (isset($litigespromotions) && !empty($litigespromotions)):
                                            foreach ($litigespromotions as $key => $value):
                                                
                                            $devise = (! empty(($value['payment_devise']))?esc($value['payment_devise']):'');
                                            $taux = (! empty(($value['payment_taux']))?esc($value['payment_taux']):'0');

                                            $montant_complet_total = esc($value['payment_montant_complet']);
                                            $montant_versement_total = esc($value['payment_montant_paye']);

                                            $montant_versement_usd = esc($value['payment_dollars']);

                                            $montant_versement_cdf = esc($value['payment_francs']);

                                            $montant_reste = esc($value['payment_montant_restant']);

                                            if ($value['payment_montant_restant'] != 0):
                                                ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_matricule']); ?> 
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_nom']); ?>
                                                    <?= esc($value['etudiant_postnom']); ?>
                                                    <?= esc($value['etudiant_prenom']); ?>
                                                </td>
                                                
                                                <td class="text-uppercase">
                                                    <?= esc($value['typesfrai_libelle']); ?> |
                                                    <?= ($value['typesfrai_nature'] == 'Mensuelle')? $value['payment_mois_uid']:''; ?>
                                                </td>
                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_complet_total, 2, ',', ' '); ?>
                                                </td> 
                                                
                                                  <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_cdf, 2, ',', ' '); ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_usd, 2, ',', ' '); ?>
                                                </td>
                                                 <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_total, 2, ',', ' '); ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_reste, 2, ',', ' '); ?>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
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
                                        foreach ($promotions as $key => $ligne):?>

                                             <tr class="small">
                                                <td colspan="2" class="text-uppercase">promotion: <?= ($ligne['promotion_libelle']); ?></td>
                                                <td colspan="2"  class="text-uppercase">Cycle: <?= ($ligne['cycle_libelle']); ?></td>
                                                <td class="text-uppercase">filiere: <?= ($ligne['filiere_libelle']); ?></td>
                                                <td class="text-uppercase">Option: <?= ($ligne['option_libelle']); ?></td>
                                                <td class="text-uppercase">
                                                   
                                                    <span class="badge badge-info float-right"> <strong>Année Scolaire:</strong>
                                                    <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?></span>
                                                </td>
                                                </tr>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom Elève</th>
                                        <th>Frais</th>
                                        <th>Montant</th>
                                        <th>CDF</th>
                                        <th>USD</th>
                                        <th>Total</th>
                                        <th>Reste</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;

                                        if (isset($litiges) && !empty($litiges)):
                                            foreach ($litiges as $key => $value):
                                                if ($value['recu_promotion_uid'] == $ligne['promotion_uid']):
                                                
                                            $devise = (! empty(($value['payment_devise']))?esc($value['payment_devise']):'');
                                            $taux = (! empty(($value['payment_taux']))?esc($value['payment_taux']):'0');

                                            $montant_total = esc($value['payment_montant_complet']);
                                            $montant_versement_total = esc($value['payment_montant_paye']);

                                            $montant_versement_usd = esc($value['payment_dollars']);

                                            $montant_versement_cdf = esc($value['payment_francs']);

                                            $montant_reste = esc($value['payment_montant_restant']);

                                            if ($value['payment_montant_restant'] != 0):
                                                ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_matricule']); ?> 
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_nom']); ?>
                                                    <?= esc($value['etudiant_postnom']); ?>
                                                    <?= esc($value['etudiant_prenom']); ?>
                                                </td>
                                                
                                                <td class="text-uppercase">
                                                    <?= esc($value['typesfrai_libelle']); ?> |
                                                    <?= ($value['typesfrai_nature'] == 'Mensuelle')? $value['payment_mois_uid']:'-'; ?>
                                                </td>
                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_total, 2, ',', ' '); ?>
                                                </td>
                                                  <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_cdf, 2, ',', ' '); ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_usd, 2, ',', ' '); ?>
                                                </td>
                                                 <td class="font-weight-bold">
                                                    <?= number_format($montant_versement_total, 2, ',', ' '); ?>
                                                </td>
                                                
                                                <td class="font-weight-bold">
                                                    <?= number_format($montant_reste, 2, ',', ' '); ?>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>

                                            <tr style="page-break-before:always!important; " class="alert alert-secondary">
                                     <td colspan="8"></td>
                                </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <?php endforeach; 
                                    ?>
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
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>