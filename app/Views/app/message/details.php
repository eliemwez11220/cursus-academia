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
                        <li class="breadcrumb-item active">Détails Message</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Description du message</h3>

                            <div class="card-tools">
                                <a href="<?= base_url('message'); ?>"
                                   class="btn btn-default btn-block btn-sm text-uppercase">
                                    Voir tous les Messages
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="mailbox-read-info">
                                <h5 class="font-weight-bold text-uppercase">Objet
                                    : <?= (isset($message) ? esc($message['message_objet']) : 'Aucun') ?></h5>
                                <h6 class="text-lowercase">Ecole
                                    : <?= (isset($message) ? session()->get('schoolname') : 'Aucun') ?>
                                    <span class="mailbox-read-time float-right"><?= (isset($message) ? esc($message['message_created_at']) : 'Aucun') ?></span>
                                </h6>
                            </div>
                            <!-- /.mailbox-read-info -->
                            <div class="mailbox-controls with-border text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                            data-container="body" title="Delete">
                                        <i class="far fa-trash-alt"></i></button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"
                                        onclick="print();">
                                    <i class="fas fa-print"></i></button>
                            </div>
                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <?= (isset($message) ? ($message['message_contenu']) : 'Aucun') ?>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-white text-center">
                            <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                <li>
                                    <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                                    <div class="mailbox-attachment-info">
                                        <a href="<?= base_url(isset($message) ? esc($message['message_attaches']) : 'Aucun') ?>"
                                           target="_blank" class="mailbox-attachment-name"><i
                                                    class="fas fa-paperclip"></i> Piece Jointe</a>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="<?= base_url(isset($message) ? esc($message['message_attaches']) : 'Aucun') ?>"
                             target="_blank" class="btn btn-default btn-sm float-right"><i
                                      class="fas fa-cloud-download-alt"></i></a>
                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Supprimer
                            </button>
                            <button type="button" class="btn btn-default" onclick="print();"><i
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