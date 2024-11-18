<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Messagerie</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Nouveau Message</li>
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
                    echo form_open_multipart(base_url() . '/message/saveNewMessage', $attributes);
                    ?>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('message'); ?>"
                                   class="btn btn-default btn-block btn-sm text-uppercase">
                                    Voir les Messages
                                </a>
                            </div>
                            <div class="card-tools">
                                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                    <i class="far fa-envelope"></i> Enregistrer et Envoyer
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-6">
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

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cycle_audience"><span class="text-danger">*</span>Cycle des étudiants
                                            concernes</label>
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('cycle_audience')) ? ' is-invalid' : '' ?>"
                                                id="cycle_audience"
                                                name="cycle_audience"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez une promotion --</option>
                                            <option value="all" <?= set_select('cycle_audience', 'all'); ?>>Tous les
                                                cycles
                                            </option>
                                            <option value="all" <?= set_select('cycle_audience', 'all'); ?>>Aucun
                                                cycle
                                            </option>
                                            <?php
                                            $count = 1;
                                            if (isset($cycles) && !empty($cycles)):
                                                foreach ($cycles as $key => $value): ?>
                                                    <option value="<?= esc($value['cycle_uid']); ?>" <?= set_select('cycle_audience', esc($value['cycle_uid'])); ?>>
                                                        <?= ucfirst(($value['cycle_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('cycle_audience')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('cycle_audience'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="type_message"><span class="text-danger">*</span>Type de
                                            message</label>
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('type_message')) ? ' is-invalid' : '' ?>"
                                                id="type_message"
                                                name="type_message"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Selectionnez un type --</option>
                                            <option value="invitations" <?= set_select('type_message', 'invitations'); ?>>
                                                Invitation
                                            </option>
                                            <option value="convocation" <?= set_select('type_message', 'convocation'); ?>>
                                                Convocation
                                            </option>
                                            <option value="reunion" <?= set_select('type_message', 'reunion'); ?>>
                                                Réunion
                                            </option>
                                            <option value="annonces" <?= set_select('type_message', 'avis'); ?>>
                                                Communiqué
                                            </option>
                                            <option value="avis" <?= set_select('type_message', 'avis'); ?>> Annonces
                                            </option>
                                        </select>
                                        <?php if ($validation->hasError('type_message')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('type_message'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="attache_message">Pièce Jointe du message</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                                            </div>
                                            <input type="file" class="form-control" name="attache_message"
                                                   id="attache_message" value="<?= old('attache_message') ?>"/>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Max. 10MB</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- radio -->
                                    <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>Mode d'envoie : </label>
                                        <div class="icheck-info d-inline">
                                            <input type="checkbox" name="sms" id="radioSuccess1" >
                                            <label for="radioSuccess1">
                                                SMS
                                            </label>
                                        </div>
                                        <div class="icheck-info d-inline">
                                            <input type="checkbox" name="email" id="radioSuccess2" value="email"
                                                   checked>
                                            <label for="radioSuccess2">
                                                EMAIL
                                            </label>
                                        </div>
                                        <?php if ($validation->hasError('mode_envoie')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('mode_envoie'); ?></span>
                                        <?php } ?>
                                    </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>Degrès d'urgence : </label>
                                        <div class="icheck-info d-inline">
                                            <input type="radio" name="degres_urgence" id="radioSuccess11"
                                                   value="urgent">
                                            <label for="radioSuccess11">
                                                Urgent
                                            </label>
                                        </div>
                                        <div class="icheck-info d-inline">
                                            <input type="radio" name="degres_urgence" id="radioSuccess22" value="faible"
                                                   checked>
                                            <label for="radioSuccess22">
                                                Non urgent
                                            </label>
                                        </div>
                                        <?php if ($validation->hasError('degres_urgence')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('degres_urgence'); ?></span>
                                        <?php } ?>
                                    </div>  
                                </div>  
                            </div>
                        </div>
                                
                                <?php
                                if (isset($errormsg)):
                                    ?>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="objet_message"> <span class="text-danger">*</span> Objet du
                                                message</label>
                                            <input class="form-control" placeholder="Subject:" name="objet_message"
                                                   id="objet_message" value="<?= $titlemsg; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="composemessage"> <span class="text-danger">*</span> Contenu du
                                                message</label>
                                            <textarea id="composemessage" name="contenu_message" class="form-control"
                                                      rows="10" style="height: 500px!important;"
                                                      placeholder="Decrivez le contenu du message ici..."><?= $bodymsg; ?></textarea>
                                        </div>

                                    </div>
                                <?php
                                else:
                                    ?>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="objet_message"> <span class="text-danger">*</span> Objet du
                                                message</label>
                                            <input class="form-control" placeholder="Subject:" name="objet_message"
                                                   id="objet_message" value="<?= old('objet_message'); ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="composemessage"> <span class="text-danger">*</span> Contenu du
                                                message</label>
                                            <textarea id="composemessage" name="contenu_message" class="form-control"
                                                      rows="10" style="height: 500px!important;"
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