<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Invitations parents</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Détails Message</li>
                        <li class="breadcrumb-item active">
                            <a href="<?= base_url('message'); ?>" class="btn btn-default btn-block btn-sm text-uppercase">
                                Voir tous les Messages
                            </a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body p-0">
                            <div class="mailbox-read-info">
                                <h3 class="font-weight-bold text-uppercase">
                                    Titre invitation : <?= (isset($message) ? esc($message['message_objet']) : 'Aucun') ?>
                                </h3><h5 class="font-weight-bold text-capitalize">
                                    Parent invitation : <?= (isset($message) ? esc($message['parent_nom_tuteur']) : 'Aucun') ?>
                                </h5>
                            </div>
                            <!-- /.mailbox-read-info -->
                            <div class="mailbox-controls with-border text-center">

                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <?= (isset($message) ? ($message['message_contenu']) : 'Aucun') ?>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card-footer -->
                        <div class="card-footer printoff">
                            <a href="<?= base_url('message/copyInvitation/'.$message['message_uid']); ?>" class="btn btn-primary">
                                <i class="fa fa-copy"></i> Copier
                            </a>
                            <button type="button" class="btn btn-success" onclick="window.print();"><i
                                        class="fas fa-print"></i> Imprimer
                            </button>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </filiere>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->