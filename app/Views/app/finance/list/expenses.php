<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Mouvements - Fonctionnement</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/types/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Fonctionnements</li>
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
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Liste des opérations</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('finance/addForm/expense'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle inscription">
                                    <i class="fa fa-plus"></i> Nouvelle opération
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        
                                        <th>Date</th>
                                        <th>Libellé</th>
                                        <th>Entrée</th>
                                        <th>Sortie</th>
                                        <th>Observation</th>
                                        <th width="1px">Statut</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($expenses) && !empty($expenses)):
                                        foreach ($expenses as $key => $value): 
                                        $status = ($value['mouvement_statut']);
                                        $montant = ($value['mouvement_montant']);
                                        $devise = ($value['mouvement_devise']);
                                        $mnt_sorti_usd = ($value['montant_sorti_usd']);
                                        $mnt_sorti_cdf = ($value['montant_sorti_cdf']);
                                        $devise_sortie = ($mnt_sorti_cdf == 0)?'usd':'cdf';
                                        $tot_sorti = ($mnt_sorti_cdf == 0)?$mnt_sorti_usd:$mnt_sorti_cdf;
                                        ?>
                                            <tr class="small">
                                               <td><?= ($value['mouvement_date']); ?></td>
                                                <td><?= ($value['mouvement_libelle']); ?></td>
                                                <td class="text-uppercase"> 
                                                    <?= number_format(esc($montant), 2, ',', ' ').$devise; ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= number_format(esc($tot_sorti), 2, ',', ' ').$devise_sortie; ?>
                                                </td>
                                                
                                                <td><?= ($value['mouvement_motif']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('finance/changeMouvementStatus/'. $status.'/'. esc($value['mouvement_uid'])); ?>"
                                                       class="btn btn-xs <?= ($value['mouvement_statut'] == "actif")?"btn-info":"btn-danger"; ?>" 
                                                       onclick="return confirm('Etes-vous sûr de vouloir annuler cette opération?');false">
                                                       <?= ($status == "actif")?'Validé':"Annulé"; ?>
                                                    </a>
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
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </filiere><!-- /.content -->
</div>