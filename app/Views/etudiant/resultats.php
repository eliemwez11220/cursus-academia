<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <filiere class="content mt-5">
        <div class="container-fluid">
            <div class="card mt-5">
                <div class="card-header">
                        <h5 class="card-title text-uppercase font-weight-bold">
                            Résultats de déliberation
                        </h5>
                        <div class="card-tools printoff">
                            <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-xs printoff" onclick="window.print();">
                                    <i class="fa fa-print"></i> Imprimer la liste</a>
                        </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="table_achats">
                                            <thead>
                                                <tr class="text-uppercase small">
                                                    <th colspan="3">Etudiant</th>
                                                    
                                                    <th colspan="4" class="text-center">Promotion</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                             if (isset($etudiants) && !empty($etudiants)):
                                                 foreach ($etudiants as $key => $line):
                                                if (isset($cotes) && !empty($cotes)):?>
                                                    <tr class="alert alert-dark text-uppercase small">
                                                    <td colspan="3"><?= esc($line['etudiant_matricule']); ?>
                                                        <?= esc($line['etudiant_nom']); ?>
                                                        <?= esc($line['etudiant_postnom']); ?>
                                                        <?= esc($line['etudiant_prenom']); ?>
                                                    </td>
                                                    <td colspan="3">
                                                       <?= esc($line['promotion_libelle']); ?>
                                                       <?= ($line['cycle_libelle']); ?>
                                                       <?= ($line['option_libelle']); ?></td>
                                                    </tr>
                                                    <tr class="text-uppercase small">
                                                   <th>No</th>
                                                    <th>COURS</th>
                                                    <th class="text-center">COTE OBTENUE</th>
                                                    <th class="text-center">PONDERATION</th>
                                                    <th class="text-center">TOTAL GEN.</th>
                                                    <th class="text-center">TOTAL PONDERE</th>
                                                    <th>Etat</th>
                                                </tr>
                                                     <?php
                                                     $totalgen = 0; 
                                                     $totalgenpond = 0;
                                                     $pourcpond = 0;
                                                     $total_obtenue = 0;
                                                     $total_echecs = 1;
                                                      $count = 1;
                                                    foreach ($cotes as $key => $value):
                                                        //if ($line['etudiant_uid'] == $value['cote_etudiant_uid']):
                                                      $total = ($value['cote_point_obtenu'])*$value['matiere_ponderation'];
                                                        $totalgen += $value['matiere_credit_horaire'];
                                                        $totalgenpond +=$value['matiere_volume_horaire'];
                                                        $pourcpond = ($totalgenpond/$totalgenpond)*100;
                                                        $total_obtenue += ($value['cote_point_obtenu']);
                                                        $moitie = ($value['matiere_credit_horaire'] /2);
                                                        $totalechecs = ($value['cote_point_obtenu'] >= $moitie);
                                                        $total_echecs += $totalechecs;
                                                        ?>
                                                    <tr class="small">
                                                        <td><?= $count++;  ?></td>
                                                        <td><?= esc($value['branche_libelle']); ?></td>
                                                        <td class="text-center">
                                                            <?= esc($value['cote_point_obtenu']); ?>
                                                        </td>
                                                        <td class="text-center"><?= esc($value['matiere_ponderation']); ?></td>
                                                       
                                                        <td class="text-center">
                                                            <?= esc($value['cote_point_obtenu']); ?>/
                                                            <?= ($value['matiere_credit_horaire']); ?>
                                                        </td>
                                                       
                                                       <td class="text-center">
                                                            <?= $total; ?>/
                                                            <?= ($value['matiere_volume_horaire']); ?>
                                                        </td>
                                                        <td>
                                                            <?= (($value['cote_point_obtenu']) >= $moitie)? 'OK':'Echec' ; ?>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php endforeach; ?>
                                                 <tr class="small text-dark">
                                            <td colspan="5" class="text-uppercase">
                                                <strong>Totaux Généraux
                                                    <span class="float-right">
                                                        <?= number_format($totalgen, 2, ',', ' '); ?>
                                                    </span></strong>
                                            </td>
                                        </tr>
                                        <tr class="small text-dark">
                                            <td colspan="5" class="text-uppercase">
                                                <strong>Totaux Pondérés
                                                    <span class="float-right">
                                                        <?= number_format($totalgenpond, 2, ',', ' '); ?>
                                                    </span></strong>
                                            </td>
                                        </tr>
                                        <tr class="small text-dark">
                                            <td colspan="5" class="text-uppercase">
                                                <strong>Total Echecs
                                                    <span class="float-right">
                                                        <?= ($total_echecs); ?>
                                                    </span></strong>
                                            </td>
                                        </tr>
                                        <tr class="small text-dark">
                                            <td colspan="5" class="text-uppercase">
                                                <strong>Pourcentage Pondéré
                                                    <span class="float-right">
                                                        <?= number_format($total_obtenue, 2, ',', ' ')."(%)"; ?>
                                                    </span></strong>
                                            </td>
                                        </tr>
                                            <?php endif; ?>
                                             <?php endforeach; ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                        </div>

                                    </div>
                                </div>
                                </div><!-- /.container-fluid -->
    </filiere> </div><!-- /.container-fluid -->