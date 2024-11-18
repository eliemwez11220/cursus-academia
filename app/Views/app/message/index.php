<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Messages et communiques</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Messages</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                        class="far fa-square"></i>
                            </button>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="card-tools">
                            <a href="<?= base_url('message/compose'); ?>" class="btn btn-info btn-block btn-sm">
                                Nouveau Message
                            </a>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive mailbox-messages">
                            <table id="datatablesExample2"
                                   class="table table-sm table-striped table-hover table-head-fixed">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($messages) && !empty($messages)):
                                    $count = 1;
                                    foreach ($messages as $key => $value):
                                        $degres = esc($value['message_degres']);
                                        $attache = esc($value['message_attaches']);
                                        $etat = esc($value['message_attaches']);
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="badge badge-info">
                                                    <?= esc($value['message_etat']); ?>
                                                </div>
                                            </td>
                                            <td class="mailbox-star">
                                                <a href="<?= base_url('message/details/' . esc($value['message_uid'])); ?>">
                                                    <i class="fas fa-star <?= ($degres == 'urgent') ? 'text-danger' : 'text-warning' ?>"></i>
                                                </a>
                                            </td>
                                            <td class="mailbox-name">
                                                <a href="<?= base_url('message/details/' . esc($value['message_uid'])); ?>">
                                                    <?= esc($value['message_created_by']); ?>
                                                </a>
                                            </td>
                                            <td class="mailbox-subject">
                                                <a href="<?= base_url('message/details/' . esc($value['message_uid'])); ?>">
                                                    <b><?= character_limiter(esc($value['message_objet']), 50); ?></b> </a>
                                            </td>
                                            <td class="mailbox-attachment">
                                                <i class="<?= (!empty($attache)) ? 'fa fa-paperclip' : '' ?>"></i>
                                            </td>
                                            <td class="mailbox-date"><?= esc($value['message_created_at']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </filiere>
    <!-- /.content -->
</div>

