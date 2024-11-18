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
                                Suivi Minerval - 
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
                                    <tr class="text-uppercase text-center small">
                                        <th>No</th>
                                        <th colspan="2">Elève</th>
                                        <th colspan="12">Mois</th>
                                    </tr>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Noms </th>
                                        <th>Sept.</th>
                                        <th>Oct.</th>
                                        <th>Nov.</th>
                                        <th>Dec.</th>
                                        <th>Jan.</th>
                                        <th>Fev.</th>
                                        <th>Mars</th>
                                        <th>Avril</th>
                                        <th>Mai</th>
                                        <th>Juin</th>
                                        <th>Juil.</th>
                                        <th>Aout</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                     $count = 1;
                                     if (isset($etudiantspromotions) && !empty($etudiantspromotions)):
                                        foreach ($etudiantspromotions as $key => $etudiant):
                                            //if ($etudiant['inscription_promotion_uid'] == $promotionChoosed['promotion_uid']):?>
                                             <tr class="small">
                                                <td><?= $count++; ?></td>
                                                
                                                <td class="small text-uppercase font-weight-bold">
                                                    <?= esc($etudiant['etudiant_matricule']); ?> 
                                                </td>
                                                <td class="small text-uppercase font-weight-bold">
                                                    <?= esc($etudiant['etudiant_nom']); ?>
                                                    <?= esc($etudiant['etudiant_postnom']); ?>
                                                </td>
                                                
                                            <?php
                                            if (isset($minerval) && !empty($minerval)):
                                                foreach ($minerval as $key => $value):

                                               // if ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid']):?>  
                                                
                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])? number_format($value['septembre'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['octobre'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['novembre'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['decembre'], 2, ',', ' '):'0'; ?>
                                                </td> 

                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['janvier'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['fevrier'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['mars'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['avril'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['mai'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['juin'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['juillet'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid'])?number_format($value['aout'], 2, ',', ' '):'0'; ?>
                                                </td>
                                           <?php //endif; ?>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                         </tr> 
                                 <?php// endif; ?>
                                <?php endforeach; ?>
                                    <?php endif; ?> 
                                    </tbody>
                                </table>
                                <?php else: ?>



                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <?php
                                    
                                    if (isset($promotions) && !empty($promotions)):
                                        foreach ($promotions as $key => $ligne):?>
                                            <tr class="small">
                                                <td colspan="3" class="text-uppercase">promotion: <?= ($ligne['promotion_libelle']); ?></td>
                                                <td colspan="4"  class="text-uppercase">Cycle: <?= ($ligne['cycle_libelle']); ?></td>
                                                <td colspan="4" class="text-uppercase">filiere: <?= ($ligne['filiere_libelle']); ?></td>
                                                <td colspan="4" class="text-uppercase">Option: <?= ($ligne['option_libelle']); ?></td>
                                                
                                        </tr>
                                    <tr class="text-uppercase text-center small">
                                        <th>No</th>
                                        <th colspan="2">etudiant</th>
                                        <th colspan="12">Mois</th>
                                    </tr>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Noms </th>
                                        <th>Sept.</th>
                                        <th>Oct.</th>
                                        <th>Nov.</th>
                                        <th>Dec.</th>
                                        <th>Jan.</th>
                                        <th>Fev.</th>
                                        <th>Mars</th>
                                        <th>Avril</th>
                                        <th>Mai</th>
                                        <th>Juin</th>
                                        <th>Juil.</th>
                                        <th>Aout</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($etudiants) && !empty($etudiants)):
                                       
                                        foreach ($etudiants as $key => $etudiant):
                                            if ($etudiant['inscription_promotion_uid'] == $ligne['promotion_uid']):?>
                                             <tr class="small">
                                                <td><?= $count++; ?></td>
                                                
                                               
                                                <td class="small text-uppercase font-weight-bold">
                                                    <?= esc($etudiant['etudiant_matricule']); ?> 
                                                </td>
                                                <td class="small text-uppercase font-weight-bold">
                                                    <?= esc($etudiant['etudiant_nom']); ?>
                                                    <?= esc($etudiant['etudiant_postnom']); ?>
                                                </td>
                                                
                                            <?php
                                            if (isset($minerval) && !empty($minerval)):
                                                foreach ($minerval as $key => $value):

                                                if ($etudiant['etudiant_uid'] == $value['recu_etudiant_uid']):
                                                ?>  
                                                
                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['septembre']))? number_format($value['septembre'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['octobre']))?number_format($value['octobre'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['novembre']))?number_format($value['novembre'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['decembre']))?number_format($value['decembre'], 2, ',', ' '):'0'; ?>
                                                </td> 

                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['janvier']))?number_format($value['janvier'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['fevrier']))?number_format($value['fevrier'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['mars']))?number_format($value['mars'], 2, ',', ' '):'0'; ?>
                                                </td> 
                                                <td class="font-weight-bold">
                                                    <?= (!empty($value['avril']))?number_format($value['avril'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= (!empty($value['mai']))?number_format($value['mai'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= (!empty($value['juin']))?number_format($value['juin'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= (!empty($value['juillet']))?number_format($value['juillet'], 2, ',', ' '):'0'; ?>
                                                </td><td class="font-weight-bold">
                                                    <?= (!empty($value['aout']))?number_format($value['aout'], 2, ',', ' '):'0'; ?>
                                                </td>
                                               
                                           <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?> 
                                </tr> 
                                 <?php endif; ?>
                                <?php endforeach; ?>

                                <tr style="page-break-before:always!important; " class="border-bottom">
                                     <td colspan="15"></td>
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
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>