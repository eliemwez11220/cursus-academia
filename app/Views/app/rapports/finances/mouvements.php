<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Finances - Mouvements Caisses</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/types/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Rapports</li>
                        <li class="breadcrumb-item active">Mouvements</li>
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
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Mouvements caisses</h5>
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
                                        <th>CAISSE</th>
                                        <th>MONTANT</th>
                                        <th>TYPE</th>
                                        <th>DATE</th>
                                        <th>OBSERVATION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($mouvements) && !empty($mouvements)):
                                        foreach ($mouvements as $key => $value):?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['caisse_libelle']); ?></td>
                                                <td class="text-uppercase"><?= number_format(esc($value['mouvement_montant']), 2, ',', ' '); ?>
                                                    <?= esc($value['mouvement_devise']); ?>
                                                </td>
                                                <td class="text-uppercase">
                                                  <span class="badge <?= (esc($value['mouvement_type']) == 'depense')?'badge-warning':'badge-info'; ?> text-center">
                                                       <?= esc($value['mouvement_type']); ?>
                                                  </span>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= esc($value['mouvement_created_at']); ?></td>

                                                <td class="text-uppercase small">
                                                   <?= (esc($value['mouvement_type']) == 'depense')?$value['mouvement_motif']:$value['mouvement_comment']; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-secondary small">
                                            <td colspan="9" class="text-uppercase">
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