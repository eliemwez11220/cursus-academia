<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Personnel - Agents</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Rapports</li>
                                <li class="breadcrumb-item active">Agents</li>
                            </ol>
                        </div>
                    </div>
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
                                      Telephone: <?= isset($ecole) ? esc($ecole['ecole_telephone']) : ''; ?><br>
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
                                
                               
                            </address>
                        </div> 
                    </div> 
                </div> 
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-uppercase font-weight-bold"> Liste des Agents</h5>
                            </div>
                            <div class="card-tools float-right">
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
                                        <th>Nom Agent</th>
                                        <th>Sexe</th>
                                        <th>Fonction</th>
                                        <th>Grade</th>
                                       
                                        <th width="1px">Téléphone</th>
                                        <th width="1px">Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($agents) && !empty($agents)):
                                        foreach ($agents as $key => $value): $sexe = esc($value['agent_sexe']); ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                 <td class="text-uppercase"><?= esc($value['agent_matricule']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['agent_nom']); ?>
                                                    - <?= esc($value['agent_postnom']); ?>
                                                    - <?= esc($value['agent_prenom']); ?></td>
                                                <td class="text-uppercase">
                                                    <?php switch ($sexe) {
                                                        case 'masculin': echo 'M';
                                                            break; 
                                                        case 'feminin': echo 'F';
                                                            break;
                                                        
                                                        default: echo 'M-F';
                                                            break;
                                                    } ?>
                                                        
                                                    </td>
                                                <td class="text-uppercase"><?= esc($value['fonction_libelle']); ?></td><td class="text-uppercase"><?= esc($value['grade_libelle']); ?></td>
                                                <td class="text-uppercase">
                                                    <a href="tel:<?= esc($value['agent_telephone']); ?>">
                                                        <?= esc($value['agent_telephone']); ?>
                                                    </a>
                                                </td>
                                                <td class="text-lowercase">
                                                    <a href="mailto:<?= esc($value['agent_email']); ?>">
                                                        <?= esc($value['agent_email']); ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="8" class="text-uppercase">
                                                <strong>Aucune donnée</strong>
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
