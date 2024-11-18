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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="text-uppercase font-weight-bold"> Liste des Agents</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('agent/addform/personnel'); ?>"
                                   class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle promotion">
                                        <i class="fa fa-plus"></i> Nouvel Agent
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom Agent</th>
                                        <th>Sexe</th>
                                        <th>Fonction</th>
                                        <th>Grade</th>
                                       
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
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

                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('agent/editForm/personnel/' . esc($value['agent_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('agent/details/personnel/' . esc($value['agent_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les details">
                                                <i class="fa fa-info-circle fa-2x"></i></span>
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
