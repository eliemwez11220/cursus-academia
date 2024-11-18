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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered table-hover">
                                    <thead>
                                    <?php
                                    
                                    if (isset($promotions_intables) && !empty($promotions_intables)):
                                        foreach ($promotions_intables as $key => $ligne):?>
                                         <tr class="small border border-bottom" style="text-decoration:underline!important;">
                                                <td colspan="3" class="font-weight-bold text-uppercase">
                                                    Promotion: 
                                                    <?= ($ligne['promotion_libelle']); ?> <?= ($ligne['cycle_libelle']); ?></td>
                                                <td colspan="4" class="font-weight-bold text-uppercase">
                                                <?php if(!empty($ligne['option_libelle'])):?>
                                                    Option: <?= ($ligne['filiere_libelle']); ?>|
                                                    <?= ($ligne['option_libelle']); ?></td>
                                                    <?php endif; ?>
                                                
                                        </tr>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th class="font-weight-bold small">Matricule</th>
                                        <th class="font-weight-bold small">Noms & Postnoms </th>
                                        <?php 
                                        $totalCours = 0;
                                        if (isset($cours) && !empty($cours)):
                                            $totalCoursCount=0;
                                            foreach ($cours as $key => $cour): 
                                            $totalCoursCount++; $totalCours+=$totalCoursCount; ?>
                                                <th class="font-weight-bold small">
                                                    <?= ($cour['branche_libelle']); ?> 
                                                </th>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <th class="text-center">TOTAL GEN.</th>
                                                    <th class="text-center">TOTAL PONDERE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                    $count = 1;
                                    if (isset($etudiants) && !empty($etudiants)):
                                       
                                        foreach ($etudiants as $key => $etudiant):
                                            if ($etudiant['inscription_promotion_uid'] == $ligne['promotion_uid']):?>
                                             <tr class="small">
                                             <td class="small">
                                                 <?= $count++; ?></td>
                                                <td class="small text-uppercase font-weight-bold">
                                                    <?= esc($etudiant['etudiant_matricule']); ?> 
                                                </td>
                                                <td class="small text-uppercase font-weight-bold">
                                                    <?= esc($etudiant['etudiant_nom']); ?>
                                                    <?= esc($etudiant['etudiant_postnom']); ?>
                                                </td>
                                                <?php
                                                     $totalgen = 0; 
                                                     $totalgenpond = 0;
                                                     $pourcpond = 0;
                                                     $total_obtenue = 0;
                                                     $total_echecs = 0;
                                                    foreach ($cotes as $key => $value):
                                                        if ($etudiant['etudiant_uid'] == $value['cote_etudiant_uid']):
                                                      
                                                         foreach ($matieres as $key => $matiere):
                                                            if ($matiere['matiere_uid'] == $value['cote_matiere_uid']):
                                                            for($i=1; $i<=$totalCours; $i++):
                                                                $total = ($value['cote_point_obtenu'][$i])*$value['matiere_ponderation'][$i];
                                                        $totalgen += $value['matiere_credit_horaire'][$i];
                                                         $totalgenpond +=$value['matiere_volume_horaire'][$i];
                                                        $pourcpond = ($totalgenpond/$totalgenpond)*100;
                                                         $total_obtenue += ($value['cote_point_obtenu'][$i]);
                                                         $moitie = ($value['matiere_credit_horaire'][$i] /2);
                                                        ?>
                                                        
                                                        <td class="text-center">
                                                            <?= ($value['cote_point_obtenu'][$i]); ?>
                                                        </td>
                                                         <td class="text-center">
                                                            <?= ($value['matiere_ponderation'][$i]); ?></td>
                                                       
                                                        <td class="text-center">
                                                            <?= ($value['cote_point_obtenu'][$i]); ?>/
                                                            <?= ($value['matiere_credit_horaire'][$i]); ?>
                                                        </td>
                                                       
                                                       <td class="text-center">
                                                            <?= $total; ?>/
                                                            <?= ($value['matiere_volume_horaire'][$i]); ?>
                                                        </td>
                                                        <td>
                                                            <?= (($value['cote_point_obtenu'][$i]) >= $moitie)? 'OK':'Echec' ; ?>
                                                        </td>
                                                        <?php endfor; ?>
                                                         <?php endif; ?>
                                                    <?php endforeach; ?>
                                                     <?php endif; ?>
                                                <?php endforeach; ?>
                                </tr> 
                                 <?php endif; ?>
                                <?php endforeach; ?>
<!-- 
                                <tr style="page-break-before:always!important;">
                                     <td colspan="15"></td>
                                </tr> -->

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