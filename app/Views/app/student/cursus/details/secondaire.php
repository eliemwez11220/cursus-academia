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
                                    <td colspan="2" style="text-align: center; vertical-align: middle;">BULLETIN DE
                                        LA  <b>
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
                                <tr>
                                    <td style="text-align: center;" rowspan="3" align="center" valign="middle">
                                        <b>BRANCHES</b>
                                    </td>
                                    <td style="text-align: center;" colspan="4" align="center" valign="middle">
                                        PREMIER SEMESTRE
                                    </td>
                                    <td style="text-align: center;" colspan="4" align="center" valign="middle">
                                        SECOND SEMESTRE
                                    </td>
                                    <td style="text-align: center;" rowspan="3" align="center" valign="middle">T.G
                                    </td>
                                    <td style="text-align: center; background-color: black;" rowspan="3"
                                        align="center" valign="middle"></td>
                                    <td style="text-align: center;" rowspan="2" colspan="2" align="center"
                                        valign="middle">EXAMEN DE REP.
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="2">TRAV. JOUR.</td>
                                    <td rowspan="2">EXAM.</td>
                                    <td rowspan="2">TOT.</td>
                                    <td colspan="2">TRAV. JOUR.</td>
                                    <td rowspan="2">EXAM.</td>
                                    <td rowspan="2">TOT.</td>
                                </tr>
                                <tr class="text-center">
                                    <td>P1</td>
                                    <td>P2</td>
                                    <td>P3</td>
                                    <td>P4</td>
                                    <td>%</td>
                                    <td>SIGN. PROF.</td>
                                </tr>
                                <?php  
                                if (isset($maximas) && !empty($maximas)):
                                    foreach ($maximas as $key => $max): 
                                        $exam_total = $max['maxima_max_examen'];
                                        $per_total = $max['maxima_max_periode'];
                                        ?>
                                        <tr class="alert alert-secondary small">
                                    <td class="text-uppercase small font-weight-bold"> MAXIMA </td>
                                    <td class="text-center"><?= $per_total; ?></td>
                                    <td class="text-center"><?= $per_total; ?></td>
                                    <td class="text-center"><?= $exam_total; ?></td>
                                    <td class="text-center"><?= $per_total*4;; ?></td>
                                    <td class="text-center"><?= $per_total; ?></td>
                                    <td class="text-center"><?= $per_total; ?></td>
                                    <td class="text-center"><?= $exam_total; ?></td>
                                    <td class="text-center"><?= $per_total*4; ?></td>
                                    <td class="text-center"><?= $per_total*8; ?></td>
                                 </tr>
                                 </thead> 
                                
                                <tbody> 

                                <?php     
                                $count = 1;
                                $tot1 = 0;
                                $tot2 = 0;
                                $totgen = 0;
                                $per1 = 0;
                                $per2 = 0;
                                $per3 = 0;
                                $per4 = 0;
                                $exam1 = 0;
                                $exam2 = 0;
                                if (isset($cotes) && !empty($cotes)):
                                    foreach ($cotes as $key => $value):
                                        if ($value['matiere_maxima_uid'] == $max['maxima_uid']):
                                    $per1 = !empty($value['bulletin_cote_per1'])?$value['bulletin_cote_per1']:0; 

                                    $per2 = !empty($value['bulletin_cote_per2'])?$value['bulletin_cote_per2']:0; 
 

                                    $per3 = !empty($value['bulletin_cote_per3'])?$value['bulletin_cote_per3']:0;  

                                    $per4 = !empty($value['bulletin_cote_per4'])?$value['bulletin_cote_per4']:0; 

                                    $exam1 = !empty($value['bulletin_cote_exam1'])?$value['bulletin_cote_exam1']:0; 

                                    $exam2 = !empty($value['bulletin_cote_exam2'])?$value['bulletin_cote_exam2']:0;

                                    $tot1 = $per1+$per2+$exam1;
                                    $tot2 = $per3+$per4+$exam2;

                                    $totgen = $tot1 + $tot2; 
                                        ?> 
                                    <tr>
                                        <td class="text-uppercase small">
                                            <?= ($value['branche_libelle']); ?>
                                        </td>
                                       <td class="text-center"><?= $per1; ?></td>
                                       <td class="text-center"><?= $per2; ?></td><td class="text-center"><?= $exam1; ?></td>
                                       <td class="text-center"><?= $tot1; ?></td>
                                       <td class="text-center"><?= $per3; ?></td>
                                       <td class="text-center"><?= $per4; ?></td><td class="text-center"><?= $exam2; ?></td>
                                       <td class="text-center"><?= $tot2; ?></td><td class="text-center"><?= $totgen; ?></td>

                                    <td style="background-color: black;"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php endforeach; ?>
                             <?php endif; ?>
                                <tr>
                                    <th>MAXIMA GENER.</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="3" style="background-color: black;"></td>
                                </tr>
                                <tr>
                                    <th>TOTAUX</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="5" style="background-color: black;"></td>
                                    <td colspan="2" rowspan="6" valign="top">
                                        <p>
                                            - PASSE (1) <br>
                                            - DOUBLE (1)<br>
                                            - A ECHOUE (1)<br><br>
                                            Le Chef de <br>l'établissement<br>
                                            Sceau de l'école<br>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>POURCENTAGE</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>PLACE/NBRE etudiants.</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>APPLICATION</th>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2" rowspan="2" style="background-color: black;"></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="3" rowspan="2" style="background-color: black;">
                                </tr>
                                <tr>
                                    <th>CONDUITE</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th rowspan="2">SIGN. DU RESPONSABLE</th>
                                    <td rowspan="2" colspan="4"></td>
                                    <td rowspan="2" colspan="5"></td>
                                </tr>
                                <table>
                                    <tr>
                                        <td colspan="3" width="100%">
                                            <p>
                                                1. L'étudiant ne pourra passer dans la promotion supérieure s'il n'a subi
                                                avec succès un examen de repêchage en ..............
                                                ................... .............. .......... ..........
                                                ............ ................ ............... ............
                                                ........... ........... ........... ........... ...........
                                                <br>
                                                2. L'étudiant passe dans la promotion supérieure (1).
                                                <br>
                                                3. L'étudiant double sa promotion (1).
                                                <br>
                                                4. L'étudiant a échoué et est à réorienter vers
                                                ........................................... (1).
                                                <span class="fr">Fait à .................................... Le .............................................</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="6" valign="top" align="center">Signature de l'étudiant</td>
                                        <td rowspan="6" valign="top" align="center">Sceau de l'école</td>
                                        <td rowspan="6" valign="top" align="center">Le chef de l'établissement <br>
                                            Nom et signature
                                        </td>
                                    </tr>

                                </table>
                                <table>
                                    <tr>
                                        <td width="100%">
                                            <p>
                                                (1) Biffer la mention inutile.
                                                <br>
                                                Note importante: Le bulletin est sans valeur s'il est raturé ou
                                                surchargé.
                                            </p>
                                        </td>
                                    </tr>
                                </table>
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
