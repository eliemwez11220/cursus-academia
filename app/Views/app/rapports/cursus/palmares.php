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
                        <li class="breadcrumb-item active">Palmarès</li>
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
                                    <b>
                                        CYCLES :
                                    </b>
                                </span>
                                <br>
                                <?php
                                    if (isset($cycles) && !empty($cycles)):
                                        foreach ($cycles as $key => $value):?>
                                          
                                                <b class="text-uppercase pt-0">
                                                    <?= ($value['cycle_libelle']); ?> - </b>
                                            
                                        <?php endforeach;?>
                                <?php endif;?> 
                                <br>
                                 <span class="text-uppercase">
                                    <b>
                                        EFFECTIF etudiants :
                                        <?= isset($nb_etudiants)?$nb_etudiants:0; ?>
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
                                Palmarès - général
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
                                <table id="datatablesReportingActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>PostNom</th>
                                        <th>Prenom</th>
                                        <th>Sexe</th>
                                        <th>promotion</th>
                                        <th>Pourcentage (%)</th>
                                        <th>Place</th>
                                        <th>Décision</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($resultats) && !empty($resultats)):
                                        foreach ($resultats as $key => $value):?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['etudiant_nom']); ?>
                                                </td><td class="text-uppercase">
                                                    <?= esc($value['etudiant_postnom']); ?>
                                                </td><td class="text-uppercase">
                                                    <?= esc($value['etudiant_prenom']); ?>
                                                </td>
                                                <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                
                                                <td class="text-uppercase"><?= esc($value['promotion_libelle']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['resultat_pourcentage']); ?></td>

                                                <td class="text-uppercase"><?= esc($value['resultat_place']); ?></td> <td class="text-uppercase"><?= esc($value['resultat_mention']); ?></td>

                                                
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="10" class="text-uppercase">
                                                <strong>Aucun étudiant</strong>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>