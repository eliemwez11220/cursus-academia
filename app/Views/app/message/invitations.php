<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase">Communication parents</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Communication</li>
                        <li class="breadcrumb-item active">Invitations</li>
                        <li class="breadcrumb-item active">Parents</li>
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
                                <h5 class="text-uppercase">Liste des invitations envoyées</h5>
                            </div>

                            <div class="card-tools float-right">
                                <a href="<?= base_url('message/createInvitation'); ?>"
                                   class="btn btn-info btn-sm text-uppercase"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="Cliquer pour ajouter une nouvelle invitation">
                                    <i class="fa fa-plus"></i> nouvelle invitation
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Parent</th>
                                        <th>Intitulé</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($invitations) && !empty($invitations)):
                                        foreach ($invitations as $key => $value):?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase"><?= esc($value['parent_nom_tuteur']); ?></td>
                                                <td class="mailbox-subject">
                                                    <a href="<?= base_url('message/details/' . esc($value['message_uid'].'/invitation')); ?>">
                                                        <b><?= character_limiter(esc($value['message_objet']), 50); ?></b> </a>
                                                </td>
                                                <td class="mailbox-date"><?= esc($value['message_created_at']); ?></td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('message/details/'. esc($value['message_uid'].'/invitation')); ?>"
                                                       class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-info-circle fa-2x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="8" class="text-uppercase">
                                                <strong>Aucune invitation</strong>
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