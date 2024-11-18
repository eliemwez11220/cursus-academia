<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Administration - Nouveau compte</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Creation compte agent</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>

    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card">
                        <div class="card-body">
                            <!-- form start -->
                            <form role="form" method="get">
                                <div class="form-group">
                                    <label for="agtAcc" class="text-uppercase">Agent</label>
                                    <div class="input-group input-group" style="width: 100%!important;">
                                        <select id="agtAcc" name="agtAcc"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Sélectionnez un agent --</option>
                                            <?php
                                            if (isset($agents) && !empty($agents)):
                                                foreach ($agents as $key => $value):?>

                                                    <option value="<?= esc($value['agent_uid']); ?>" <?= set_select('agtAcc', esc($value['agent_uid'])); ?>>
                                                        <?= ucfirst(esc($value['agent_matricule'])); ?> -
                                                        <?= esc($value['agent_nom']); ?>
                                                        -<?= esc($value['agent_postnom']); ?>
                                                        -<?= esc($value['agent_prenom']); ?>
                                                        | <?= ucfirst(esc($value['fonction_libelle'])); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info text-uppercase">
                                                <i class="fa fa-filter"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <?php
            if (isset($agent) && !empty($agent)): ?>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php
                        //form validation services call
                        $validation = \Config\Services::validation();

                        //form
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url() . '/admin/saveCompteAgent/create/' . esc($agent['agent_uid']), $attributes);
                        ?>
                        <div class="card card-light">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="card-tools float-left">
                                        <a href="<?= base_url('admin/view/account'); ?>"
                                           class="btn btn-default btn-sm btn-rounded text-uppercase">
                                            <i class="fa fa-arrow-circle-left"></i> voir la liste
                                        </a>
                                    </div>
                                </div>

                                <div class="card-tools float-right">

                                    <button type="submit" class="btn btn-info btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-check-circle fa-lg"></i> Créer le compte
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-sm-4">
                                        <!-- Matricule etudiant -->
                                        <div class="form-group">
                                            <label for="matricule"><span class="text-danger">*</span> Matricule
                                                agent (en lecture)</label>
                                            <input type="text" name="matricule" id="matricule"
                                                   class="form-control <?= ($validation->hasError('matricule')) ? ' is-invalid' : '' ?>"
                                                   placeholder="Matricule Agent" readonly
                                                   value="<?= (!empty(esc($agent['agent_matricule']))) ? esc($agent['agent_matricule']) : set_value('matricule') ?>">
                                        </div>
                                    </div><!-- left column -->
                                    <div class="col-sm-4">
                                        <?php $fullname = esc($agent['agent_nom']) . '-' . esc($agent['agent_postnom']) . '-' . esc($agent['agent_prenom']); ?>
                                        <!-- Nom etudiant -->
                                        <div class="form-group">
                                            <label for="nom"><span class="text-danger">*</span>Nom Complet Agent (en
                                                lecture)</label>

                                            <input type="text" name="fullname" id="fullname"
                                                   class="form-control text-capitalize <?= ($validation->hasError('fullname')) ? ' is-invalid' : '' ?>"
                                                   placeholder="Nom Agent" readonly
                                                   value="<?= !empty($fullname) ? $fullname : set_value('fullname'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="prenom"><span class="text-danger">*</span>Fonction Agent (en
                                                lecture)
                                            </label>

                                            <input type="text" name="prenom" id="prenom"
                                                   class="form-control text-capitalize"
                                                   placeholder="Prenom Agent" readonly
                                                   value="<?= (!empty(esc($agent['fonction_libelle']))) ? esc($agent['fonction_libelle']) : set_value('prenom'); ?>">

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="prenom"><span class="text-danger">*</span>Grade Agent (en
                                                lecture)
                                            </label>

                                            <input type="text" name="prenom" id="prenom"
                                                   class="form-control text-capitalize "
                                                   placeholder="Prenom Agent" readonly
                                                   value="<?= (!empty(esc($agent['grade_libelle']))) ? esc($agent['grade_libelle']) : set_value('prenom'); ?>">

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="prenom"><span class="text-danger">*</span>Secteur d'activité (en
                                                lecture)
                                            </label>
                                            <input type="text" name="prenom" id="prenom"
                                                   class="form-control text-capitalize"
                                                   placeholder="Prenom Agent" readonly
                                                   value="<?= (!empty(esc($agent['secteur_libelle']))) ? esc($agent['secteur_libelle']) : set_value('prenom'); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email"><span class="text-danger"></span>Adresse Mail :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email"
                                                       class="form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                                       name="email" id="email"
                                                       value="<?= (!empty(esc($agent['agent_email']))) ? esc($agent['agent_email']) :set_value('email') ?>">
                                            </div>
                                            <?php if ($validation->hasError('email')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('email'); ?></span>
                                            <?php } ?>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="username"><span class="text-danger">*</span>Identifiant ou
                                                pseudo de connexion :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text"
                                                       class="form-control <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                                       name="username" id="username"
                                                       value="<?= set_value('username') ?>">
                                            </div>
                                            <?php if ($validation->hasError('username')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('username'); ?></span>
                                            <?php } ?>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-sm-7 col-xs-7">
                                        <?php
                                        $aleatoire_value = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz*@$#";
                                        $new_pass_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(20, 20))), 0, 20);
                                        ?>
                                        <div class="form-group">
                                            <label for="asset_password" class="control-label">
                                                <span class="text-danger">*</span> Mot de passe
                                                <span class="small">(Vous pouvez le modifier
                                                                    en cas de besoin avant d'envoyer au correspondant)</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control text-capitalize <?= ($validation->hasError('asset_password')) ? ' is-invalid' : '' ?>"
                                                   name="asset_password"
                                                   id="asset_password"
                                                   value="<?= (!empty($new_pass_generate)) ? $new_pass_generate : set_value('asset_password') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                            <?php if ($validation->hasError('asset_password')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('asset_password'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="groupe" class="control-label">
                                                <span class="text-danger">*</span> Groupe
                                            </label>
                                            <select id="groupe" name="groupe"
                                                    class="form-control select2 select2-info <?php if($validation->hasError( 'groupe')){echo 'is-invalid';} ?>"
                                                    data-dropdown-css-class="select2-info">
                                                <option selected="selected" disabled>-- Sélectionnez un groupe --</option>
                                                <?php
                                                $count = 1;
                                                if (isset($groupes) && !empty($groupes)):
                                                    foreach ($groupes as $key => $value): ?>
                                                        <option value="<?= esc($value['groupe_uid']); ?>" <?= set_select('groupe', esc($value['groupe_uid'])); ?>>
                                                            <?= ucfirst(esc($value['groupe_libelle'])); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option>Aucune donnee</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php if(isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'groupe'); ?>
                                            </span>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <br>
                                            <br>
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="pass_expire"
                                                       id="pass_expire"
                                                       checked="checked">
                                                <label for="pass_expire">
                                                    Le mot de passe expire à la prémiere
                                                    connecxion
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?= form_close(); ?>
                        <!-- /.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </filiere>
</div><!-- /.container-fluid -->

