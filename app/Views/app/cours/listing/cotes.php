<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Cotes des étudiants</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/dashboard') ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Cotations</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-uppercase font-weight-bold">Liste des cotes des étudiants</h5>
                            </div>

                            <div class="card-tools float-right">

                                <a href="<?= base_url('cours/addForm/cote'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle côte">
                                    <i class="fa fa-plus"></i> Nouvelle cotation
                                </a>
                            </div>
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
   

<div class="card">
    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-sm table-bordered" id="table_achats">
                                            <thead>
                                                <tr class="text-uppercase small">
                                                    <th colspan="3">Etudiant</th>
                                                    
                                                    <th colspan="3" class="text-center">Promotion</th>
                                                    
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
                                                     $total_echecs = 0;
                                                    foreach ($cotes as $key => $value):
                                                        if ($line['etudiant_uid'] == $value['cote_etudiant_uid']):
                                                      $total = ($value['cote_point_obtenu'])*$value['matiere_ponderation'];
                                                        $totalgen += $value['matiere_credit_horaire'];
                                                         $totalgenpond +=$value['matiere_volume_horaire'];
                                                        $pourcpond = ($totalgenpond/$totalgenpond)*100;
                                                         $total_obtenue += ($value['cote_point_obtenu']);
                                                         $moitie = ($value['matiere_credit_horaire'] /2);
                                                        ?>
                                                    <tr class="small">
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
                                                     <?php endif; ?>
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
                                                <strong>Pourcentage Pondéré(%)
                                                    <span class="float-right">
                                                        <?= ($total_obtenue)."/". number_format($pourcpond, 2, ',', ' '); ?>
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