<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Création d'une nouvelle invitation</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Communication</li>
                        <li class="breadcrumb-item active">Nouvelle invitation</li>
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
                    <?php
                    $validation = \CodeIgniter\Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('message/createInvitation'), $attributes);
                    ?>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('message/invitations'); ?>"
                                   class="btn btn-default btn-block btn-sm text-uppercase">
                                    Voir les invitations
                                </a>
                            </div>
                            <div class="card-tools">
                                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                    <i class="far fa-check-circle"></i> Créer l'invitation
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="parent"><span class="text-danger">*</span>Parent </label>
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('parent')) ? ' is-invalid' : '' ?>"
                                                id="parent"
                                                name="parent"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez un tuteur --</option>
                                            <option value="all">Tous les parents</option>
                                            <?php
                                            $count = 1;
                                            if (isset($parents) && !empty($parents)):
                                                foreach ($parents as $key => $value): ?>
                                                    <option value="<?= esc($value['parent_uid']); ?>" <?= set_select('parent', esc($value['parent_uid'])); ?>>
                                                        Père: <?= ucfirst(strtolower($value['parent_nom_pere'])); ?> | Mère: <?= ucfirst(strtolower($value['parent_nom_mere'])); ?> | <?= (esc($value['parent_phone'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('parent')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('parent'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php if (isset($errormsg)):?>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="objet_message"> <span class="text-danger">*</span>
                                            Titre de l'invitation </label>
                                            <input class="form-control" placeholder="Ex: convocation" name="objet_message"
                                                   id="objet_message" value="<?= $titlemsg; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="composemessage"> <span class="text-danger">*</span>
                                            Détails de l'invitation</label>
                                            <textarea id="composemessage" name="contenu_message" class="form-control"
                                                      rows="10" style="height: 300px!important;"
                                                      placeholder="Decrivez le contenu du message ici..."><?= $bodymsg; ?></textarea>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="objet_message"> <span class="text-danger">*</span> Titre de l'invitation </label>
                                            <input class="form-control" placeholder="Ex: avis de communiqué" name="objet_message"
                                                   id="objet_message" value="<?= old('objet_message'); ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="composemessage"> <span class="text-danger">*</span> Détails de l'invitation</label>
                                            <textarea id="composemessage" name="contenu_message" class="form-control"
                                                      rows="10" style="height: 300px!important;"
                                                      placeholder="Decrivez le contenu du message ici..."><?= old('contenu_message'); ?></textarea>
                                        </div>

                                    </div>
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    <?= form_close(); ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </filiere>

</div><!-- /.container-fluid -->