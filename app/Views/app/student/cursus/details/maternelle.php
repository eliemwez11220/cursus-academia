<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                   <a href="<?= base_url('etudiant/cursus/bulletins') ?>" class="text-uppercase btn btn-default btn-xs printoff">
                                    <i class="fa fa-arrow-circle-left"></i> VOIR LA LISTE</a>
                </div>
                <div class="col-sm-8">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Suivi scolaire</li>
                        <li class="breadcrumb-item active">Bulletin</li>
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
                        <div class="card-header printoff">
                            <div class="card-title">
                                <h5 class="text-uppercase font-weight-bold">
                                   Bulletin de l'étudiant : <?= isset($etudiant) ? esc($etudiant['etudiant_nom']) : ''; ?>
                                    <?= isset($etudiant) ? esc($etudiant['etudiant_postnom']) : ''; ?>
                                    <?= isset($etudiant) ? esc($etudiant['etudiant_prenom']) : ''; ?>
                                </h5>
                            </div>
                            <div class="card-tools">
                                <a href="#"
                                   class="btn btn-success btn-rounded text-uppercase btn-xs printoff" onclick="print();">
                                    <i class="fa fa-print"></i> Imprimer</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table width="100%">
                                <tr>
                                    <td rowspan="3" width="55px"><img
                                                src="<?= base_url('global/flags/cd_flag.png'); ?>" width="50px"/>
                                    </td>
                                    <td rowspan="3" style="text-align: center; vertical-align: middle;">
                                        <b>
                                            REPUBLIQUE DEMOCRATIQUE DU CONGO<br>
                                        MINISTERE DE L'ENSEIGNEMENT PRIMAIRE, SECONDAIRE ET PROFESSIONNEL
                                        </b>
                                    </td>
                                    <td rowspan="3" width="55px"><img
                                                src="<?= base_url('global/flags/cd_arms.png'); ?>" width="50px"
                                                class="fr"/></td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                   <td width="50%">N° ID: <b><?= isset($etudiant) ? esc($etudiant['etudiant_numero_serni']) : ''; ?></b></td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td width="50%">PROVINCE :<b><?= isset($etudiant) ? esc($etudiant['etudiant_province']) : ''; ?></b></td>
                                    <td width="50%">etudiant : <span class="font-weight-bold text-uppercase">
                                        <?= isset($etudiant) ? esc($etudiant['etudiant_nom']) : ''; ?>
                                        <?= isset($etudiant) ? esc($etudiant['etudiant_postnom']) : ''; ?>
                                        <?= isset($etudiant) ? esc($etudiant['etudiant_prenom']) : ''; ?>
                                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">VILLE : <b><?= isset($etudiant) ? esc($etudiant['etudiant_ville']) : ''; ?></b></td>
                                    <td width="50%">NE(E) A :<b><?= isset($etudiant) ? esc($etudiant['etudiant_lieu_naissance']) : ''; ?></b>, le <b><?= isset($etudiant) ? utf8_encode(strftime("%d/%m/%Y", strtotime(esc($etudiant['etudiant_date_naissance'])))) : ''; ?></b></td>
                                </tr>
                                <tr>
                                    <td width="50%" class="small text-uppercase">COMMUNE / TER.(1) : <b><?= isset($etudiant) ? esc($etudiant['etudiant_adresse']) : ''; ?></b></td>
                                    <td width="50%" class="small text-uppercase">promotion :<b>
                                        <?= isset($promotion) ? ($promotion['promotion_libelle']) : ''; ?> / 
                                        <?= isset($promotion) ? ($promotion['option_libelle']) : ''; ?> /
                                        <?= isset($promotion) ? ($promotion['cycle_libelle']) : ''; ?>
                                            
                                        </b></td>
                                </tr>
                                <tr>
                                    <td width="50%" class="text-uppercase">ECOLE : <b><?= session()->get('schoolname'); ?></b></td>
                                    <td width="50%">N° PERM. : <b><?= isset($etudiant) ? esc($etudiant['etudiant_matricule']) : ''; ?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><br></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align: center; vertical-align: middle;">
                                    BULLETIN DE LA  <b>
                                        <span class="text-uppercase">
                                            <?= isset($promotion) ? ($promotion['promotion_libelle']) : ''; ?>
                                            <?= isset($promotion) ? ($promotion['filiere_libelle']) : ''; ?>
                                        </span> 
                                       </b> - ANNEE SCOLAIRE <b><?= session()->get('yearlibelle'); ?></b>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" class="table table-sm table-bordered">
                                <thead>
                                            <tr class="text-center">
                                                <td style="text-align: center;" colspan="2" align="center" valign="middle">
                                                    <b>TRIMESTRE</b>
                                                </td>
                                                <td style="text-align: center;" align="center" valign="middle">
                                                    <b>PREMIER</b>
                                                </td>
                                                <td style="text-align: center;" align="center" valign="middle">
                                                    <b>DEUXIEME</b>
                                                </td>
                                                <td style="text-align: center;" align="center" valign="middle">
                                                    <b>TROISIEME</b>
                                                </td>
                                                <td style="text-align: center;" align="center" valign="middle">
                                                    <b>TOTAL</b>
                                                </td>
                                                <td style="text-align: center;" align="center" valign="middle">
                                                    <b>QUAL.</b>
                                                </td>
                                                <td style="text-align: center;" align="center" valign="middle">
                                                    <b>COUL.</b>
                                                </td>
                                            </tr>
                               
                                <?php  
                                   
                                if (isset($maximas) && !empty($maximas)):
                                    foreach ($maximas as $key => $max): 
                                        $exam_total = $max['maxima_max_examen'];
                                        $per_total = $max['maxima_max_periode'];
                                        ?>
                                        <tr class="alert alert-secondary small">
                                            <td class="text-uppercase small font-weight-bold text-center"> 
                                            <?= ($max['maxima_libelle']); ?> </td>
                                            
                                            <td class="text-center">MAXIMA</td>
                                            <td class="text-center"><?= $exam_total + $per_total; ?></td>
                                            <td class="text-center"><?= $exam_total + $per_total; ?></td>
                                            <td class="text-center"><?= $exam_total + $per_total; ?></td>
                                            <td class="text-center"><?= ($exam_total + $per_total)*3; ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                 </thead>
                                <tbody> 

                                <?php     
                                $count = 1;
                                $tot1 = 0;
                                $tot2 = 0;
                                $tot3 = 0;
                                $totgen = 0;
                                $per1 = 0;
                                $per2 = 0;
                                $per3 = 0;
                                $per4 = 0;
                                $per5 = 0;
                                $per6 = 0;
                                $exam1 = 0;
                                $exam2 = 0;
                                $exam3 = 0;

                                if (isset($cotes) && !empty($cotes)):
                                    foreach ($cotes as $key => $value):
                                        if ($value['matiere_maxima_uid'] == $max['maxima_uid']):

                                    $per1 = !empty($value['bulletin_cote_per1'])?$value['bulletin_cote_per1']:0; 
                                    $per2 = !empty($value['bulletin_cote_per2'])?$value['bulletin_cote_per2']:0; 
 
                                    $per3 = !empty($value['bulletin_cote_per3'])?$value['bulletin_cote_per3']:0;  
                                    $per4 = !empty($value['bulletin_cote_per4'])?$value['bulletin_cote_per4']:0; 

                                    $per5 = !empty($value['bulletin_cote_per5'])?$value['bulletin_cote_per5']:0;  
                                    $per6 = !empty($value['bulletin_cote_per6'])?$value['bulletin_cote_per6']:0;

                                    $exam1 = !empty($value['bulletin_cote_exam1'])?$value['bulletin_cote_exam1']:0; 
                                    $exam2 = !empty($value['bulletin_cote_exam2'])?$value['bulletin_cote_exam2']:0;
                                    $exam3 = !empty($value['bulletin_cote_exam3'])?$value['bulletin_cote_exam3']:0;
                                    

                                    $tot1 = $per1+$per2+$exam1;
                                    $tot2 = $per3+$per4+$exam2;
                                    $tot3 = $per5+$per6+$exam3;
                                    

                                    $totgen = $tot1 + $tot2 + $tot3; 
                                
                                ?> 
                                    <tr>
                                       <td colspan="2" class="text-uppercase small"><?= ($value['branche_libelle']); ?> </td>
                                       <!-- trim1 -->
                                       <td class="text-center"><?= $tot1; ?></td>
                                       <!-- trim2 -->
                                       <td class="text-center"><?= $tot2; ?></td>
                                      <!-- trim3 -->
                                       <td class="text-center"><?= $tot3; ?></td>
                                       <!-- totaux -->
                                       <td class="text-center"><?= $totgen; ?></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <th colspan="2">SOUS-TOTAL</th>

                                        <td></td>
                                        <td></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                             <?php endif; ?>
                                <tr>
                                    <td rowspan="4" align="middle" class="text-center">Appréciation Générale</td>
                                </tr>
                                <tr>
                                    <td>Total Gén.</td>
                                    <td></td>
                                        <td></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                </tr>
                                <tr>
                                    <td>Qualité</td>
                                    <td></td>
                                        <td></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td> 
                                </tr>
                                <tr>
                                    <td>Couleur</td>
                                    <td></td>
                                        <td></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                </tr>
                               <tr>
                                        <th class="text-center" colspan="2">Signatures</th>

                                        <td></td>
                                        <td></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <th>Trimestre</th>
                                        <td>Instructeur</td>
                                        <td>Parent Elite</td>

                                        <td>T.B</td>
                                        <td>Bon</td>
                                        <td>A.B</td>
                                        <td>Med.</td>
                                        <td></td>
                                    </tr>
                                     <tr>
                                        <th>1er Trimestre</th>
                                        <td></td>
                                        <td></td>

                                        <td>Jaune</td>
                                        <td>Bleu</td>
                                        <td>Jaune</td>
                                        <td>Noire</td>
                                        <td></td>
                                    </tr><tr>
                                        <th>2e Trimestre</th>
                                        <td></td>
                                        <td></td>

                                        <td>Jaune</td>
                                        <td>Bleu</td>
                                        <td>Jaune</td>
                                        <td>Noire</td>
                                        <td></td>
                                    </tr><tr>
                                        <th>3e Trimestre</th>
                                        <td></td>
                                        <td></td>

                                        <td>Jaune</td>
                                        <td>Bleu</td>
                                        <td>Jaune</td>
                                        <td>Noire</td>
                                        <td></td>
                                    </tr>
                                <tr>
                                        <th colspan="2">Légende Qual. : Appréciation générale</th>

                                        <td></td>
                                        <td></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr><tr>
                                        <th colspan="2">Coul. :  Couleur correspondante</th>

                                        <td></td>
                                        <td></td> 
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                   
                               <tr rowspan="2">
                                    <td colspan="3">
                                       Observation :
                                        <br>
                                       </td>
                                     <td colspan="6" class="text-uppercase">
                                        <span class="float-right">
                                           Fait à .................................... Le .............................................
                                        </span>
                                    </td>
                                </tr>
                                 <tr rowspan="2">
                                    
                                    <td colspan="8" class="text-uppercase">
                                         <span class="float-right">
                                          <b>Le chef de l'établissement <br>
                                            Nom et signature</b>
                                        </span>
                                    </td>
                                </tr>
                                <tr rowspan="2">
                                   
                                    <td colspan="4" class="text-uppercase">
                                         <span class="float-right">
                                         <b>Sceau de l'école</b>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" width="100%">
                                            <p>
                                                (1) Biffer la mention inutile.
                                                <br>
                                                Note importante: Le bulletin est sans valeur s'il est raturé ou
                                                surchargé.
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="footer">.</div>
                    </div>
                </div>
            </div>
        </div>
    </filiere>
</div>
