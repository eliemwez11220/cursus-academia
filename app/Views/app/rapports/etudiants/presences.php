<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="printoff">
                                <form role="form" id="annee_scolaire_filter" method="get">
                                    <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="anneeScolaire" name="dayof"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled>-- Date Jour Présence --</option>
                                            <?php
                                            $selectedDate = isset($dateChoosed)?$dateChoosed:date('Y-m-d');
                                            $count = 1;
                                            if (isset($pointages) && !empty($pointages)):
                                                foreach ($pointages as $key => $value): 
                                                    if ($selectedDate == $value['presence_date']) { ?>
                                                        <option selected value="<?= esc($value['presence_date']); ?>" <?= set_select('dayof', esc($value['presence_date'])); ?>>
                                                        <?= ucfirst(esc($value['presence_date'])); ?>
                                                    </option>
                                                        <?php } ?>
                                                    <option value="<?= esc($value['presence_date']); ?>" <?= set_select('dayof', esc($value['presence_date'])); ?>>
                                                        <?= ucfirst(esc($value['presence_date'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="input-group-append">
                                            
                                            <select id="promotionuid" name="cls"
                                                    class="form-control select2 select2-info"
                                                    data-dropdown-css-class="select2-info">
                                                <option disabled selected>-- sélectionnez une promotion --</option>
                                                <option value="all">Toutes les promotions </option>
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
                        <li class="breadcrumb-item active">Présences</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content" id="contentprint">
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
                            <h5 class="card-title text-uppercase font-weight-bold">Liste de presences des etudiants du 
                                <span class="badge badge-info">
                                    <?= utf8_encode(strftime("%A, %d-%m-%Y", strtotime(isset($dateChoosed)?$dateChoosed:date('Y-m-d')))) ; ?>
                                </span>
                                <span class="badge badge-info"> 
                                    <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                </span>
                            </h5>

                            <div class="card-tools printoff">
                                <button class="btn btn-success btn-rounded text-uppercase btn-xs" onclick="print()">
                                    <i class="fa fa-print"></i> Imprimer</button>
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
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Postnom</th>
                                        <th>Prenom</th>
                                        <th>Sexe</th>
                                        <th>Lieu Naissance</th>
                                        <th>Date Naissance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                     $count = 1;
                                     if (isset($presences) && !empty($presences)):
                                            foreach ($presences as $key => $value): ?>
                                               <tr class="small">
                                                    <td><?= $count++; ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_postnom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_prenom']); ?></td>
                                                    <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                    <td class="text-uppercase"><?= utf8_encode(strftime("%d/%m/%Y", strtotime(esc($value['presence_date'])))); ?></b></td>
                                                    <td width="1px">
                                                        <span class="badge <?= (esc($value['presence_libelle']) =='Present')?'badge-info':'badge-danger'; ?>"> <?= esc($value['presence_libelle']); ?></span>
                                                    </td>
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
                                                <td colspan="8" class="text-uppercase text-dark">
                                                <span class="text-uppercase">promotion: <?= ($ligne['promotion_libelle']); ?> - </span>

                                                <span class="text-uppercase">Cycle: <?= ($ligne['cycle_libelle']); ?> - </span>

                                                <span class="text-uppercase">filiere: <?= ($ligne['filiere_libelle']); ?> - </span>

                                                <span class="text-uppercase">Option: <?= ($ligne['option_libelle']); ?> - </span>

                                                <span class="text-uppercase"><strong>Annee Scolaire:</strong>
                                                    <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                                </span>
                                                </td>
                                            </tr>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Postnom</th>
                                        <th>Prénom</th>
                                        <th>Sexe</th>
                                        <th>Date Jour</th>
                                        <th>Observation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $count = 1;
                                        if (isset($presences) && !empty($presences)):
                                                foreach ($presences as $key => $value):
                                                    if ($value['presence_promotion_uid'] == $ligne['promotion_uid']):?>
                                                    <tr class="small">
                                                        <td><?= $count++; ?></td>
                                                        <td class="text-uppercase"><?= esc($value['etudiant_matricule']); ?></td>
                                                        <td class="text-uppercase"><?= esc($value['etudiant_nom']); ?></td>
                                                        <td class="text-uppercase"><?= esc($value['etudiant_postnom']); ?></td>
                                                        <td class="text-uppercase"><?= esc($value['etudiant_prenom']); ?></td>
                                                        <td class="text-uppercase"><?= esc($value['etudiant_sexe']); ?></td>
                                                        <td class="text-uppercase"><?= utf8_encode(strftime("%d/%m/%Y", strtotime(esc($value['presence_date'])))); ?></b></td>
                                                        <td width="1px">
                                                            <span class="badge <?= (esc($value['presence_libelle']) =='Present')?'badge-info':'badge-danger'; ?>"><?= esc($value['presence_libelle']); ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>


                                                <tr style="page-break-before:always!important; " class="alert alert-secondary">
                                                 <td colspan="8">
                                                  
                                                 </td>
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>