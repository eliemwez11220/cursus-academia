<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold small">Profile - Gerer compte</h5>
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
                                <?= isset($agent) ? esc($agent['agent_nom']) : '' ?>
                                <?= isset($agent) ? esc($agent['agent_postnom']) : '' ?>
                                <?= isset($agent) ? esc($agent['agent_prenom']) : '' ?>
                            </h3>
                            <p class="text-muted text-center text-uppercase"><?= session()->role; ?></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a href="#">
                                        Matricule
                                        <span class="float-right font-weight-bold text-capitalize small">
                                            <?= isset($agent) ? esc($agent['agent_matricule']) : '' ?></span>
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <a href="#">
                                        Telephone <span class="float-right font-weight-bold text-capitalize">
                                            <?= isset($agent) ? esc($agent['agent_telephone']) : '' ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Email <span class="float-right font-weight-bold text-lowercase">
                                            <?= isset($agent) ? esc($agent['agent_email']) : '' ?></span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Fonction
                                        <span class="float-right font-weight-bold text-capitalize small">
                                            <?= isset($agent) ? esc($agent['fonction_libelle']) : '' ?></span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Grade
                                        <span class="float-right font-weight-bold text-capitalize small">
                                            <?= isset($agent) ? esc($agent['grade_libelle']) : '' ?></span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Service
                                        <span class="float-right font-weight-bold text-capitalize small">
                                            <?= isset($agent) ? esc($agent['secteur_libelle']) : '' ?></span>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        Ecole
                                        <span class="float-right font-weight-bold text-capitalize small">
                                            <?= session()->schoolname; ?> - <?= session()->schoolcode; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- About Me Box -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">A PROPOS</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Localisation</strong>
                            <p class="text-muted">
                                <?= (isset($agent) && (!empty($agent['agent_adresse']))) ? esc($agent['agent_adresse']) : 'Lubumbashi, Haut-Katanga, RDC' ?>
                            </p>
                            <hr>
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>
                            <p class="text-muted">
                               <?= isset($agent) ? esc($agent['agent_education']) : '' ?>
                            </p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Competences</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger border-right">
                                  <?= isset($agent) ? esc($agent['agent_competences']) : '' ?>
                                </span>
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Biographie ou Notes</strong>
                            <p class="text-muted">
                              <?= isset($agent) ? esc($agent['agent_biographie']) : '' ?></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#agent" data-toggle="tab">Fiche
                                        Agent</a></li>
                                <li class="nav-item"><a class="nav-link" href="#user" data-toggle="tab">Compte
                                        Utilisateur</a></li>
                                <li class="nav-item"><a class="nav-link" href="#biography" data-toggle="tab">
                                        Biographie & Observation</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="agent">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- form start -->
                                            <?php
                                            //form validation services call
                                            $validation = \Config\Services::validation();
                                            //form
                                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                            echo form_open(base_url() . '/profile/updateFicheAgent/' . (isset($agent) ? esc($agent['agent_uid']) : ''), $attributes);
                                            ?>
                                            <div class="text-center">
                                                <h5 class="font-weight-bold text-uppercase">Fiche Identite Agent</h5>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="datatablesWithoutActions"
                                                       class="table table-sm  table-hover table-head-fixed">
                                                    <tbody>
                                                    <tr>
                                                        <td><label for="nom"><span class="text-danger">*</span>Nom
                                                            </label>
                                                        </td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">

                                                                <input type="text" name="nom" id="nom"
                                                                       class="form-control <?= ($validation->hasError('nom')) ? ' is-invalid' : '' ?>"
                                                                       placeholder="Nom agent"
                                                                       value="<?= isset($agent) ? esc($agent['agent_nom']) : set_value('nom'); ?>">

                                                                <?php if ($validation->hasError('nom')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('nom'); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="postnom"><span class="text-danger">*</span>
                                                                Postnom </label>
                                                        </td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                                <input type="text" name="postnom" id="postnom"
                                                                       class="form-control <?= ($validation->hasError('postnom')) ? ' is-invalid' : '' ?>"
                                                                       placeholder="Postnom Agent"
                                                                       value="<?= isset($agent) ? esc($agent['agent_postnom']) : set_value('postnom'); ?>">

                                                                <?php if ($validation->hasError('postnom')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('postnom'); ?></span>
                                                                <?php } ?>

                                                            </div> <!-- prenom etudiant -->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="prenom"><span class="text-danger">*</span>Prenom
                                                            </label></td>
                                                        <td class="text-capitalize">
                                                            <div class="form-group">
                                                                <input type="text" name="prenom" id="prenom"
                                                                       class="form-control <?= ($validation->hasError('prenom')) ? ' is-invalid' : '' ?>"
                                                                       placeholder="Prenom Agent"
                                                                       value="<?= isset($agent) ? esc($agent['agent_prenom']) : set_value('prenom'); ?>">

                                                                <?php if ($validation->hasError('prenom')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('prenom'); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label><span class="text-danger">*</span>Sexe : </label>
                                                        </td>
                                                        <td class="text-capitalize">
                                                            <?php if (isset($agent)) {
                                                                $sexe = esc($agent['agent_sexe']); ?>
                                                                <div class="form-group">

                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio"
                                                                               name="sexe" <?= ($sexe == 'masculin') ? 'checked' : ''; ?>
                                                                               id="radioSuccess1"
                                                                               value="masculin">
                                                                        <label for="radioSuccess1">
                                                                            M
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio"
                                                                               name="sexe" <?= ($sexe == 'feminin') ? 'checked' : ''; ?>
                                                                               id="radioSuccess2" value="feminin">
                                                                        <label for="radioSuccess2">
                                                                            F
                                                                        </label>
                                                                    </div>
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio"
                                                                               name="sexe" <?= ($sexe == 'transgenre') ? 'checked' : ''; ?>
                                                                               id="radioSuccess3" value="transgenre">
                                                                        <label for="radioSuccess3">
                                                                            Transgenre
                                                                        </label>
                                                                    </div>
                                                                    <?php if ($validation->hasError('sexe')) { ?>
                                                                        <span class="invalid-feedback"> <?= $validation->getError('sexe'); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="dateNaissance"><span
                                                                        class="text-danger">*</span>Date de
                                                                naissance:</label></td>
                                                        <td class="text-uppercase">

                                                            <div class="form-group">

                                                                <div class="input-group date" id="date_format_abrege"
                                                                     data-target-input="nearest">
                                                                    <input type="text"
                                                                           class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissance')) ? ' is-invalid' : '' ?>"
                                                                           id="dateNaissance"
                                                                           value="<?= isset($agent) ? esc($agent['agent_date_naissance']) : set_value('dateNaissance') ?>"
                                                                           data-target="#date_format_abrege"
                                                                           name="dateNaissance"/>
                                                                    <div class="input-group-append"
                                                                         data-target="#date_format_abrege"
                                                                         data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i
                                                                                    class="fa fa-calendar"></i></div>
                                                                    </div>
                                                                </div>
                                                                <?php if ($validation->hasError('dateNaissance')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('dateNaissance'); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="lieuNaissanceetudiant"><span
                                                                        class="text-danger">*</span>Lieu Naissance
                                                            </label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">

                                                                <input type="text" name="lieuNaissance"
                                                                       id="lieuNaissance"
                                                                       class="form-control <?= ($validation->hasError('lieuNaissance')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_lieu_naissance']) : set_value('lieuNaissanceetudiant'); ?>">

                                                                <?php if ($validation->hasError('lieuNaissance')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('lieuNaissance'); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="alert alert-secondary">
                                                        <td colspan="2" class="text-uppercase">
                                                            <strong>
                                                                Situation familiale
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="nom_conjoint">Nom conjoint (e) </label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">

                                                                <input type="text" name="nom_conjoint" id="nom_conjoint"
                                                                       class="form-control <?= ($validation->hasError('nom_conjoint')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_nom_conjoint']) : set_value('nom_conjoint'); ?>">

                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="nombre_enfants">Nombre Enfants </label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">

                                                                <input type="number" name="nombre_enfants"
                                                                       id="nombre_enfants"
                                                                       class="form-control" min="0"
                                                                       value="<?= isset($agent) ? esc($agent['agent_nombre_enfants']) : set_value('nombre_enfants'); ?>">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="numero_securite">
                                                                Numero Securite Sociale</label></td>

                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                                <input type="text" name="numero_securite"
                                                                       id="numero_securite"
                                                                       class="form-control <?= ($validation->hasError('numero_securite')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_numero_securite']) : set_value('numero_securite'); ?>">

                                                                <?php if ($validation->hasError('numero_securite')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('numero_securite'); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="alert alert-secondary">
                                                        <td colspan="2" class="text-uppercase">
                                                            <strong>
                                                                Contact & Localisation Agent
                                                            </strong>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label class="telephone">Numero telephone
                                                                :</label></td>
                                                        <td class="text-uppercase">

                                                            <div class="form-group">

                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                    class="fas fa-phone"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                           name="telephone"
                                                                           id="telephoneetudiant"
                                                                           value="<?= isset($agent) ? esc($agent['agent_telephone']) : set_value('telephone') ?>"
                                                                           data-inputmask='"mask": "+243999999999"'
                                                                           data-mask
                                                                           placeholder="Ex: 858533285">
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="email">Adresse Mail :</label>
                                                        </td>
                                                        <td class="text-uppercase">

                                                            <div class="form-group">

                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                    class="fas fa-envelope"></i></span>
                                                                    </div>
                                                                    <input type="email" class="form-control"
                                                                           name="email" id="email"
                                                                           value="<?= isset($agent) ? esc($agent['agent_email']) : set_value('email') ?>">
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="ville">Ville Residence :</label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">

                                                                <input type="text" name="ville" id="ville"
                                                                       class="form-control <?= ($validation->hasError('ville')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_ville']) : set_value('ville'); ?>">

                                                                <?php if ($validation->hasError('ville')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('ville'); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="province"><span class="text-danger"></span>Province
                                                                Residence :</label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">

                                                                <input type="text" name="province" id="province"
                                                                       class="form-control <?= ($validation->hasError('province')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_province']) : set_value('province'); ?>">

                                                                <?php if ($validation->hasError('province')) { ?>
                                                                    <span class="invalid-feedback"> <?= $validation->getError('province'); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="adresse">Adresse Residence :</label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">

                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                    class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                           name="adresse" id="adresseetudiant"
                                                                           value="<?= isset($agent) ? esc($agent['agent_adresse']) : set_value('adresse') ?>">
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td> <label for="groupeSanguin">Groupe Sanguin </label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                             
                                                                <input type="text" name="groupeSanguin"
                                                                       id="groupeSanguin"
                                                                       class="form-control <?= ($validation->hasError('groupeSanguin')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_groupe_sanguin']) : set_value('groupeSanguin'); ?>">

                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                      <td> <label for="poids">Poids en KG</label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                             
                                                                <input type="text" name="poids" id="poids"
                                                                       class="form-control <?= ($validation->hasError('poids')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_poids']) : set_value('poids'); ?>">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                       <td><label for="taille">Taille en CM</label></td>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                              
                                                                <input type="text" name="taille" id="taille"
                                                                       class="form-control <?= ($validation->hasError('taille')) ? ' is-invalid' : '' ?>"
                                                                       value="<?= isset($agent) ? esc($agent['agent_taille']) : set_value('taille'); ?>">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="text-center">
                                                                <button type="submit"
                                                                        class="btn btn-info btn-rounded text-uppercase btn-sm">
                                                                    <i class="fa fa-chech-circle"></i> <strong>Enregistrer
                                                                        les modifications</strong></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
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
                                <div class="tab-pane" id="user">
                                    <?php
                                    if (isset($compte) && !empty($compte)): ?>
                                        <?php
                                        //form validation services call
                                        $validation = \Config\Services::validation();
                                        //form
                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                        echo form_open_multipart(base_url() . '/profile/updateCompteAgent/' . esc($compte['compte_uid']), $attributes);
                                        ?>
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
                                                               value="<?= (!empty(esc($compte['agent_email']))) ? esc($compte['compte_email']) : set_value('email') ?>">
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
                                                               value="<?= (!empty(esc($compte['compte_username']))) ? esc($compte['compte_username']) : set_value('username') ?>">
                                                    </div>
                                                    <?php if ($validation->hasError('username')) { ?>
                                                        <span class="invalid-feedback"> <?= $validation->getError('username'); ?></span>
                                                    <?php } ?>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="question1" class="control-label">
                                                        <span class="text-danger"></span> Question secrete 1
                                                    </label>
                                                    <select id="question1" name="question1"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">
                                                        <option disabled>-- Selectionnez une question --</option>

                                                        <option value="nom_fille_ainee" <?= (esc($compte['compte_question1']) == 'nom_fille_ainee') ? 'selected' : '' ?>>
                                                            Quel est le nom de votre fille ainee?
                                                        </option>
                                                        <option value="marque_voiture" <?= (esc($compte['compte_question1']) == 'marque_telephone') ? 'selected' : '' ?>>
                                                            Quelle marque de voiture
                                                            preferez-vous?
                                                        </option>
                                                        <option value="province_origine" <?= (esc($compte['compte_question1']) == 'province_origine') ? 'selected' : '' ?>>
                                                            Quelle est votre province d'origine?
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="reponse1" class="control-label">
                                                        <span class="text-danger"></span> Reponse de la question secrete
                                                        1
                                                    </label>

                                                    <input type="text" name="reponse1" class="form-control"
                                                           id="reponse1"
                                                           value="<?= (!empty(esc($compte['compte_reponse1']))) ? esc($compte['compte_reponse1']) : old('reponse1') ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="question2" class="control-label">
                                                        <span class="text-danger"></span> Question secrete 2
                                                    </label>
                                                    <select id="question2" name="question2"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">
                                                        <option disabled>-- Selectionnez une question --</option>
                                                        <option value="date_engagement" <?= (esc($compte['compte_question2']) == 'date_engagement') ? 'selected' : '' ?>>
                                                            Quelle est la date a laquelle vous etiez engage
                                                        </option>
                                                        <option value="animal_domestique" <?= (esc($compte['compte_question2']) == 'animal_domestique') ? 'selected' : '' ?>>
                                                            Quel est votre animal domestique preferez-vous?
                                                        </option>
                                                        <option value="oiseau" <?= (esc($compte['compte_question2']) == 'oiseau') ? 'selected' : '' ?>>
                                                            Quel oiseau preferez-vous?
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="reponse2" class="control-label">
                                                        <span class="text-danger"></span> Reponse de la question secrete
                                                        2
                                                    </label>

                                                    <input type="text" name="reponse2" class="form-control"
                                                           id="reponse2"
                                                           value="<?= (!empty(esc($compte['compte_reponse2']))) ? esc($compte['compte_reponse2']) : old('reponse2') ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="question3" class="control-label">
                                                        <span class="text-danger"></span> Question secrete 3
                                                    </label>
                                                    <select id="question3" name="question3"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">
                                                        <option disabled>-- Selectionnez une question --</option>
                                                        <option value="date_engagement" <?= (esc($compte['compte_question3']) == 'date_engagement') ? 'selected' : '' ?>>
                                                            Quelle est la date a laquelle vous etiez engage
                                                        </option>
                                                        <option value="animal_domestique" <?= (esc($compte['compte_question3']) == 'animal_domestique') ? 'selected' : '' ?>>
                                                            Quel est votre animal domestique preferez-vous?
                                                        </option>
                                                        <option value="oiseau" <?= (esc($compte['compte_question3']) == 'oiseau') ? 'selected' : '' ?>>
                                                            Quel oiseau preferez-vous?
                                                        </option>
                                                        <option value="nom_fille_ainee" <?= (esc($compte['compte_question3']) == 'nom_fille_ainee') ? 'selected' : '' ?>>
                                                            Quel est le nom de votre fille ainee?
                                                        </option>
                                                        <option value="marque_voiture" <?= (esc($compte['compte_question3']) == 'marque_voiture') ? 'selected' : '' ?>>
                                                            Quelle marque de voiture
                                                            preferez-vous?
                                                        </option>
                                                        <option value="province_origine" <?= (esc($compte['compte_question3']) == 'province_origine') ? 'selected' : '' ?>>
                                                            Quelle est votre province d'origine?
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="reponse3" class="control-label">
                                                        <span class="text-danger"></span> Reponse de la question secrete
                                                        3
                                                    </label>

                                                    <input type="text" name="reponse3" class="form-control"
                                                           id="reponse3"
                                                           value="<?= (!empty(esc($compte['compte_reponse3']))) ? esc($compte['compte_reponse3']) : old('reponse3') ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="observation" class="control-label">
                                                        <span class="text-danger"></span> Observation ou commentaire
                                                    </label>
                                                    <textarea name="observation" class="form-control" id="observation"
                                                              cols="30"
                                                              rows="3"><?= (!empty(esc($compte['compte_observation']))) ? esc($compte['compte_observation']) : old('observation') ?></textarea>
                                                </div>
                                            </div>
                                            <div class="text-center form-group">
                                                <button type="submit"
                                                        class="btn btn-info btn-rounded text-uppercase btn-sm">
                                                    <i class="fa fa-chech-circle"></i> <strong>Enregistrer les
                                                        modifications</strong></button>
                                            </div>
                                        </div>
                                        <?= form_close(); ?>
                                        <!-- /.col (right) -->
                                    <?php endif; ?>
                                </div>
                                <!-- /.tab-pane -->


                                <!-- /.tab-pane Biographie -->
                                <div class="tab-pane" id="biography">
                                  <div class="active tab-pane" id="agent">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <!-- form start -->
                                            <?php
                                            //form validation services call
                                            $validation = \Config\Services::validation();
                                            //form
                                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                            echo form_open(base_url() . '/profile/updateNotesAgent/' . (isset($agent) ? esc($agent['agent_uid']) : ''), $attributes);
                                            ?>
                                            <div class="text-center">
                                                <h5 class="font-weight-bold text-uppercase">Biographie et Observation</h5>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="datatablesWithoutActions"
                                                       class="table table-sm  table-hover table-head-fixed">
                                                    <tbody>
                                                    
                                                    <tr>
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                              <label for="biographie">Biographie </label>
                                                              <textarea name="biographie" id="biographie" cols="30" rows="5" class="form-control" autocomplete="off"><?= (isset($agent) ? esc($agent['agent_biographie']) : set_value('biographie')); ?></textarea>

                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                       
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                              <label for="competences">Domaines de Competences </label>
                                                                <textarea name="competences" id="competences" cols="30" rows="5" class="form-control" autocomplete="off"><?= (isset($agent) ? esc($agent['agent_competences']) : set_value('competences')); ?></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                              <label for="education">Education (Etudes et Formation) </label>
                                                                <textarea name="education" id="education" cols="30" rows="5" class="form-control" autocomplete="off"><?= (isset($agent) ? esc($agent['agent_education']) : set_value('education')); ?></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                   
                                                    <tr>
                                                 
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                              <label for="caracteristiques">Profil (Intellectuel,
                                                                caractères)</label>
                                                                <textarea name="caracteristiques" id="caracteristiques" cols="30" rows="3" class="form-control" autocomplete="off"><?= (isset($agent) ? esc($agent['agent_caracteristiques']) : ''); ?></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                              <label for="observation">Observation Generale et
                                                                sante</label>
                                                                <textarea name="observation" id="observation" cols="30" rows="3" class="form-control" autocomplete="off"><?= (isset($agent) ? esc($agent['agent_observation']) : ''); ?></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        
                                                        <td class="text-uppercase">
                                                            <div class="form-group">
                                                              <label for="application">Application ou Rigueur de
                                                                travail</label>
                                                              <textarea name="application" id="application" cols="30" rows="3"
                                                      class="form-control" autocomplete="off"><?= (isset($agent) ? esc($agent['agent_application']) : ''); ?></textarea>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                       
                                                        <td class="text-uppercase">

                                                            <div class="form-group">
                                                              <label for="attitude">Attitude </label>
                                                              <textarea name="attitude" id="attitude" cols="30" rows="3"
                                                      class="form-control" autocomplete="off"><?= (isset($agent) ? esc($agent['agent_attitude']) : ''); ?></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-center">
                                                                <button type="submit"
                                                                        class="btn btn-info btn-rounded text-uppercase btn-sm">
                                                                    <i class="fa fa-chech-circle"></i> <strong>Enregistrer
                                                                        les modifications</strong></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
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
