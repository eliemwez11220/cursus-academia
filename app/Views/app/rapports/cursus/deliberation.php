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
                                            <option disabled>-- Année --</option>
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
                        <li class="breadcrumb-item active">Documents</li>
                        <li class="breadcrumb-item active">Délibération</li>
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
                            <h5 class="card-title text-uppercase font-weight-bold"> 
                                Délibération - 
                                <span class="badge badge-info"> 
                                    <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                </span>
                            </h5>

                            <div class="card-tools">
                                <a href="#" class="btn btn-success btn-rounded text-uppercase btn-xs printoff" onclick="print();">
                        <i class="fa fa-print"></i> Imprimer</a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body shadow-lg">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered">
                                    <thead>
                                    <?php
                                    if (isset($promotions_intables) && !empty($promotions_intables)):
                                        foreach ($promotions_intables as $key => $ligne):?>
                                         <tr class="small border border-bottom" style="text-decoration:underline!important;">
                                                <td colspan="4" class="font-weight-bold text-uppercase">
                                                    Promotion: 
                                                    <?= ($ligne['promotion_libelle']); ?> <?= ($ligne['cycle_libelle']); ?></td>
                                                <td colspan="4" class="font-weight-bold text-uppercase">
                                                <?php if(!empty($ligne['option_libelle'])):?>
                                                    Option: <?= ($ligne['filiere_libelle']); ?>|
                                                    <?= ($ligne['option_libelle']); ?></td>
                                                    <?php endif; ?>
                                            </tr>
                                    </thead>
                                    <tbody>
                                       <?php if (isset($matieres) && !empty($matieres)):?>
                                        <tr class="text-uppercase small">
                                            <th colspan="3">
                                                <p class="font-weight-bold text-center"> 
                                                    Grille de Délibération pour l'année académique 
                                                    <span class="badge badge-info"> 
                                                        <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                                    </span>
                                                </p>
                                            </th>
                                                <?php foreach ($matieres as $key => $matiere): ?>
                                                     <th colspan="2" class="small text-uppercase font-weight-bold">
                                                        <?= ($matiere['branche_libelle']); ?>  
                                                    </th>
                                                <?php endforeach; ?>
                                                <th class="text-center">TOTAL GEN.</th>
                                                <th class="text-center">TOTAL PONDERE</th>
                                                <th>Pourcentage</th>
                                                <th>Nombre d'échecs</th>
                                                <th>Nombre d'échecs < 8 </th>
                                            </tr>
                                             <tr>
                                                <th colspan="3">Pondération</th>
                                                <?php 
                                                foreach ($matieres as $key => $matierepond):?>
                                                        <th colspan="2" class="small text-center font-weight-bold">
                                                            <?= ($matierepond['matiere_ponderation']); ?>  
                                                        </th>
                                                <?php endforeach; ?>
                                                <th></th>
                                                <th></th>
                                                <th>%</th>
                                                <th></th>
                                                <th></th>
                                             </tr>
                                             <tr class="small font-weight-bold text-uppercase">
                                                <th class="small font-weight-bold">No</th>
                                                <th class="small font-weight-bold">Identifiant</th>
                                                <th class="small font-weight-bold">Nom & Postnom</th>
                                                <?php 
                                                $totaux_generaux_credit = 0;
                                                $totaux_generaux_volume = 0;
                                                $pourcentage_total = 0;

                                                $totaux_echecs = 0;
                                                $totaux_echecs_profonds = 0;

                                                foreach ($matieres as $keyp => $matierecredit): 
                                                    $credit = $matierecredit['matiere_credit_horaire'];
                                                    $totaux_generaux_credit += $matierecredit['matiere_credit_horaire'];
                                                    $totaux_generaux_volume += $matierecredit['matiere_volume_horaire'];
                                                    $pourcentage_total = ($totaux_generaux_volume/$totaux_generaux_volume)*100;

                                                    $totaux_echecs += (($credit < 10) && ($credit > 7));
                                                    $totaux_echecs_profonds += ($credit < 8);
                                                ?>
                                                        <th class="small font-weight-bold">
                                                            <?= ($matierecredit['matiere_credit_horaire']); ?>  
                                                        </th>
                                                         <th class="small font-weight-bold">
                                                            <?= ($matierecredit['matiere_volume_horaire']); ?>  
                                                        </th>
                                                <?php endforeach; ?>
                                                <th><?= $totaux_generaux_credit; ?></th>
                                                <th><?= $totaux_generaux_volume; ?></th>
                                                <th><?= $pourcentage_total; ?></th>
                                                <th><?= $totaux_echecs; ?></th>
                                                <th><?= $totaux_echecs_profonds; ?></th>
                                             </tr>
                                            <?php
                                            $count = 1;
                                            if (isset($etudiants) && !empty($etudiants)):
                                                foreach ($etudiants as $key => $etudiant):
                                                    if ($etudiant['inscription_promotion_uid'] == $ligne['promotion_uid']):?>
                                                    <tr class="small">
                                                        <td class="small"><?= $count++; ?></td>
                                                        <td class="small text-uppercase"> <?= ($etudiant['etudiant_matricule']); ?> </td>
                                                        <td class="small text-uppercase"> 
                                                            <?= ($etudiant['etudiant_nom']); ?>  <?= ($etudiant['etudiant_postnom']); ?>  </td>
                                                        
                                                    <?php
                                                    $totalgen = 0; 
                                                     $totalgenpond = 0;
                                                     $pourcpond = 0;
                                                     $total_obtenue = 0;
                                                     $total_echecs = 0;
                                                     $total = 0;
                                                       foreach ($matieres as $keymm => $matierecote):
                                                            foreach ($cotes as $keyc => $cote):
                                                                if ($matierecote['matiere_uid']== $cote['cote_matiere_uid']):
                                                        
                                                                    $cote_obtenue = ($cote['cote_point_obtenu']);
                                                                    $ponderation = $cote['matiere_ponderation'];
                                                                    $total = ($cote_obtenue * $ponderation);
                                                      
                                                         $total_obtenue += ($cote['cote_point_obtenu']);
                                                         $moitie = ($cote['matiere_credit_horaire'] /2);
                                                         $totalgenpond += $total;
                                                         $pourcentage = ($totalgenpond/$totalgenpond)*100;
                                                    
                                                        ?>
                                                        
                                                       
                                                        <td class="text-center">
                                                            <?= ($etudiant['etudiant_uid'] == $cote['cote_etudiant_uid']) ? ($cote['cote_point_obtenu']):0; ?> 
                                                                </td>
                                                        <td class="text-center"> 
                                                            <?= ($etudiant['etudiant_uid'] == $cote['cote_etudiant_uid']) ? ($cote['cote_point_obtenu'] * $cote['matiere_ponderation']):0; ?>  
                                                                </td>
                                                        <?php endif; ?> <!-- endif students promotions -->
                                                        <?php endforeach; ?> <!-- end foreach cotes -->
                                                        <?php endforeach; ?> <!-- end foreach cotes -->
        
                                                    </tr>
                                                    <?php endif; ?> <!-- endif students promotions -->
                                                <?php endforeach; ?><!-- endforeach students -->
                                            <?php endif; ?> <!-- endif students -->
                                            <?php endif; ?>
                                    </tbody>
                                    <?php endforeach; ?>
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