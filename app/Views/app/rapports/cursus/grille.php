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
                                
                                <div class="input-group-append">
                                    <select id="promotionuid" name="cls"
                                            class="form-control select2 select2-info"
                                            data-dropdown-css-class="select2-info">
                                        <option value="all" selected>Toutes les promotions</option>
                                        <?php
                                        $selectedpromotion = isset($promotionChoosed['promotion_uid']) ? $promotionChoosed['promotion_uid'] : '';
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
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Documents</li>
                        <li class="breadcrumb-item active">Grille</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
        <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
<div class="card">
    <div class="card-header">
                            <h5 class="card-title text-uppercase font-weight-bold">
                                Grille de déliberation
                                <span class="badge badge-info"> 
                                    <?= isset($anneeChoosed) ? $anneeChoosed : session()->get('yearlibelle'); ?>
                                </span>
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