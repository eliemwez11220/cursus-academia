<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold small">Profile - Gérer compte</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview'); ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <?php
    $validation = \Config\Services::validation();
    $session = \Config\Services::session();
    $segment = \Config\Services::uri();
    ?>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle elevation-4"
                                     src="<?= (session()->get('avatar') != '') ? session()->get('avatar') : site_url('global/img/avatar.png'); ?>"
                                     alt="Avatar" style="height: 100px; width: 100px">
                            </div>
                            <h3 class="profile-username text-center text-uppercase">
                                <?= session()->get('fullname'); ?>
                            </h3>
                            <p class="text-muted text-center text-uppercase">
                                <?= session()->role; ?>
                            </p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a href="#">
                                        Pseudo
                                        <span class="float-right font-weight-bold text-capitalize small">
                                            <?= session()->username; ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Email <span class="float-right font-weight-bold text-lowercase">
                                            <?= session()->email; ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Derniere visite <span class="float-right font-weight-bold text-lowercase">
                                            <?= isset($compte) ? esc($compte['admin_lastlogout_at']) : "Aujourd'hui";?>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Modification compte <span class="float-right font-weight-bold text-lowercase">
                                            <?= isset($compte) ? esc($compte['admin_updated_at']) : "Aujourd'hui";?>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Changement Mot de passe <span class="float-right font-weight-bold text-lowercase">
                                            <?= isset($compte) ? esc($compte['admin_lastchange_pass']) : "Aujourd'hui";?>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header p-2">
                            <?php $linkActivated = ($segment->getTotalSegments() >= 2) ? $segment->getSegment('2') : '';?>
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link <?= ($linkActivated == 'updateProfile' OR $linkActivated == 'profile') ? 'active':'' ?>" href="#agent" data-toggle="tab">
                                    Mon Compte
                                        </a></li>
                                <li class="nav-item"><a class="nav-link <?= ($linkActivated == 'changePassword') ? 'active':'' ?>" href="#user" data-toggle="tab">Mot de passe
                                </a></li>
                                <li class="nav-item"><a class="nav-link <?= ($linkActivated == 'updatePicture') ? 'active':'' ?>" href="#biography" data-toggle="tab">
                                        Photo profile</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane <?= ($linkActivated == 'updateProfile' OR $linkActivated == 'profile') ? 'active':'' ?>" id="agent">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- form start -->
                                            <?php
                                            //form validation services call
                                            $validation = \Config\Services::validation();
                                            //form
                                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                            echo form_open(base_url() . '/admin/updateProfile/' . session()->usertoken, $attributes);
                                            ?>
                                            <div class="text-center">
                                                <h5 class="font-weight-bold text-uppercase">Fiche Identification</h5>
                                            </div>
                                          <div class="row">

                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="email"><span class="text-danger"></span>Adresse Mail
                                                        :</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email"
                                                               class="form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                                               name="email" id="email"
                                                               value="<?= (!empty(session()->email)) ? session()->email : set_value('email') ?>">
                                                    </div>
                                                    <?php if ($validation->hasError('email')) { ?>
                                                        <span class="invalid-feedback"> <?= $validation->getError('email'); ?></span>
                                                    <?php } ?>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="username"><span class="text-danger">*</span>Identifiant
                                                        ou
                                                        pseudo de connexion :</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                        class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text"
                                                               class="form-control <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                                               name="username" id="username"
                                                               value="<?= (!empty(session()->username)) ? session()->username : set_value('username') ?>">
                                                    </div>
                                                    <?php if ($validation->hasError('username')) { ?>
                                                        <span class="invalid-feedback"> <?= $validation->getError('username'); ?></span>
                                                    <?php } ?>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label for="question1" class="control-label">
                                                        <span class="text-danger"></span> Question secrète 1
                                                    </label>
                                                    <select id="question1" name="question1"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">
                                                        <option disabled selected>-- Sélectionnez une question --</option>

                                                        <option value="nom_fille_ainee" <?= (esc($compte['admin_question1']) == 'nom_fille_ainee') ? 'selected' : '' ?>>
                                                            Quel est le nom de votre fille ainée?
                                                        </option>
                                                        <option value="marque_voiture" <?= (esc($compte['admin_question1']) == 'marque_telephone') ? 'selected' : '' ?>>
                                                            Quelle marque de voiture
                                                            préférez-vous?
                                                        </option>
                                                        <option value="province_origine" <?= (esc($compte['admin_question1']) == 'province_origine') ? 'selected' : '' ?>>
                                                            Quelle est votre province d'origine?
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <div class="form-group">
                                                    <label for="reponse1" class="control-label">
                                                        <span class="text-danger"></span> Réponse Q1
                                                        
                                                    </label>

                                                    <input type="text" name="reponse1" class="form-control"
                                                           id="reponse1"
                                                           value="<?= (!empty(esc($compte['admin_reponse1']))) ? esc($compte['admin_reponse1']) : old('reponse1') ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label for="question2" class="control-label">
                                                        <span class="text-danger"></span> Question secrète 2
                                                    </label>
                                                    <select id="question2" name="question2"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">
                                                         <option disabled selected>-- Sélectionnez une question --</option>
                                                        <option value="date_engagement" <?= (esc($compte['admin_question2']) == 'date_engagement') ? 'selected' : '' ?>>
                                                            Quelle est la date de votre embauche
                                                        </option>
                                                        <option value="animal_domestique" <?= (esc($compte['admin_question2']) == 'animal_domestique') ? 'selected' : '' ?>>
                                                            Quel est votre animal domestique preferez-vous?
                                                        </option>
                                                        <option value="oiseau" <?= (esc($compte['admin_question2']) == 'oiseau') ? 'selected' : '' ?>>
                                                            Quel oiseau préférez-vous?
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <div class="form-group">
                                                    <label for="reponse2" class="control-label">
                                                        <span class="text-danger"></span> Réponse Q2
                                                    </label>

                                                    <input type="text" name="reponse2" class="form-control"
                                                           id="reponse2"
                                                           value="<?= (!empty(esc($compte['admin_reponse2']))) ? esc($compte['admin_reponse2']) : old('reponse2') ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label for="question3" class="control-label">
                                                        <span class="text-danger"></span> Question secrète 3
                                                    </label>
                                                    <select id="question3" name="question3"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">
                                                        <option disabled selected>-- Seéectionnez une question --</option>
                                                        <option value="date_engagement" <?= (esc($compte['admin_question3']) == 'date_engagement') ? 'selected' : '' ?>>
                                                           Quelle est la date de votre embauche
                                                        </option>
                                                        <option value="animal_domestique" <?= (esc($compte['admin_question3']) == 'animal_domestique') ? 'selected' : '' ?>>
                                                            Quel est votre animal domestique préférez-vous?
                                                        </option>
                                                        <option value="oiseau" <?= (esc($compte['admin_question3']) == 'oiseau') ? 'selected' : '' ?>>
                                                            Quel oiseau preferez-vous?
                                                        </option>
                                                        <option value="nom_fille_ainee" <?= (esc($compte['admin_question3']) == 'nom_fille_ainee') ? 'selected' : '' ?>>
                                                            Quel est le nom de votre fille ainée?
                                                        </option>
                                                        <option value="marque_voiture" <?= (esc($compte['admin_question3']) == 'marque_voiture') ? 'selected' : '' ?>>
                                                            Quelle marque de voiture
                                                            préférez-vous?
                                                        </option>
                                                        <option value="province_origine" <?= (esc($compte['admin_question3']) == 'province_origine') ? 'selected' : '' ?>>
                                                            Quelle est votre province d'origine?
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <div class="form-group">
                                                    <label for="reponse3" class="control-label">
                                                        <span class="text-danger"></span> Réponse Q3
                                                        
                                                    </label>

                                                    <input type="text" name="reponse3" class="form-control"
                                                           id="reponse3"
                                                           value="<?= (!empty(esc($compte['admin_reponse3']))) ? esc($compte['admin_reponse3']) : old('reponse3') ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="text-center form-group">
                                                <button type="submit"
                                                        class="btn btn-info btn-rounded text-uppercase btn-sm">
                                                    <i class="fa fa-chech-circle"></i> <strong>Enregistrer les
                                                        modifications</strong></button>
                                            </div>
                                        </div>
                                            <!-- /.card -->
                                            <?= form_close(); ?>
                                            <!-- /.col (right) -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                
                                <!-- /.tab-pane -->
                            <div class="tab-pane <?= ($linkActivated == 'changePassword') ? 'active':'' ?>" id="user">
                                    <div class="text-center">
                                                <h5 class="font-weight-bold text-uppercase">Changement mot de passe</h5>
                                            </div>
                                    <?php
                                    if (!empty(session()->usertoken)): ?>
                                        <?php
                                        //form validation services call
                                        $validation = \Config\Services::validation();
                                        //form
                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                        echo form_open(base_url() . '/admin/changePassword/' . session()->usertoken, $attributes);
                                        ?>
                               <div class="card-body">
                            
                                <div class="input-group mb-3">
                                    <input type="password" name="oldpass" class="form-control-lg form-control <?= $validation->hasError('oldpass') ? ' is-invalid' : '' ?>" placeholder="Ancien mot de passe">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-key"></span>
                                        </div>
                                    </div>
                                     <?php if (isset($validation)) {
                                        if ($validation->hasError('oldpass')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('oldpass') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="pass" class="form-control-lg form-control <?= $validation->hasError('pass') ? ' is-invalid' : '' ?>" placeholder="Nouveau mot de passe">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                     <?php if (isset($validation)) {
                                        if ($validation->hasError('pass')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('pass') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" name="cpass" class="form-control-lg form-control <?= $validation->hasError('cpass') ? ' is-invalid' : '' ?>" placeholder="Confirmer le nouveau mot de passe">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                     <?php if (isset($validation)) {
                                        if ($validation->hasError('cpass')) { ?>
                                            <span class="invalid-feedback"> <?= isset($validation) ? $validation->getError('cpass') : ''; ?></span>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-info text-uppercase">
                                        CHANGER MOT DE PASSE
                                    </button>
                                </div>
                            </div>

                                        <?= form_close(); ?>
                                        <!-- /.col (right) -->
                                    <?php endif; ?>
                                </div>
                                <!-- /.tab-pane -->


                                <!-- /.tab-pane Biographie -->
                                <div class="tab-pane <?= ($linkActivated == 'updatePicture') ? 'active':'' ?>" id="biography">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <!-- form start -->
                                            <?php
                                            //form validation services call
                                            $validation = \Config\Services::validation();
                                            //form
                                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                            echo form_open_multipart(base_url() . '/admin/updatePicture/' . session()->usertoken, $attributes);
                                            ?>
                                            <div class="text-center">
                                                <h5 class="font-weight-bold text-uppercase">Modification photo profile</h5>
                                            </div>
                                            <div class="input-group mb-3">
                                    <input type="file" name="photo_avatar" class="form-control-lg form-control <?= $validation->hasError('photo_avatar') ? ' is-invalid' : '' ?>" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-image"></span>
                                        </div>
                                    </div>
                                    
                                     <?php if (isset($validation)) {
                                        if ($validation->hasError('photo_avatar')) { ?>
                                             <span class="invalid-feedback">
                                              <?= isset($validation) ? $validation->getError('photo_avatar') : ''; ?></span>
                                        <?php }} ?>
                                      
                                    
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-info text-uppercase">
                                        CHANGER PHOTO
                                    </button>
                                </div>
                                <hr>
                                <div class="text-center">
                                <img class="profile-user-img img-fluid elevation-1"
                                     src="<?= (session()->get('avatar') != '') ? session()->get('avatar') : site_url('global/img/avatar.png'); ?>"
                                     alt="Avatar" style="height: 200px; width: 200px">
                            </div>
                                            <!-- /.card -->
                                            <?= form_close(); ?>
                                            <!-- /.col (right) -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
