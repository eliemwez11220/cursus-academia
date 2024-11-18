
 <?php $validation = \Config\Services::validation();?>
   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="printoff">FICHE - etudiant</div>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Rapports</li>
                        <li class="breadcrumb-item active">Fiche</li>
                        <li class="breadcrumb-item active">Elèves</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </filiere>
    <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 invoice-col border-right"> 
                            <address>
                                <span class="text-uppercase">
                                    <b>
                                                
                                       <?= session()->get('schoolname'); ?> | 
                                        <?= isset($ecole) ? esc($ecole['ecole_code']) : ''; ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-capitalize">
                                    <?= isset($ecole) ? esc($ecole['ecole_ville']) . ' , ' . esc($ecole['ecole_province']) : ''; ?>
                                </span>
                                <br>
                                <span class="text-capitalize">
                                    <?= isset($ecole) ? esc($ecole['ecole_adresse']) : ''; ?>
                                </span>
                                <br>
                                <p>
                                      Téléphone: <?= isset($ecole) ? esc($ecole['ecole_telephone']) : ''; ?><br>
                                        Email: <?= isset($ecole) ? esc($ecole['ecole_email']) : ''; ?>
                                </p> 
                            </address>
                        </div> <div class="col-sm-6 invoice-col"> 
                            <address>
                                <span class="text-uppercase">
                                    <b>
                                              Année scolaire  :  
                                       <?= isset($anneeChoosed)?$anneeChoosed:session()->get('yearlibelle'); ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase">
                                    <b>
                                        CYCLES :
                                    </b>
                                </span>
                                <br>
                                <?php
                                    if (isset($cycles) && !empty($cycles)):
                                        foreach ($cycles as $key => $value):?>
                                          
                                                <b class="text-uppercase pt-0">
                                                    <?= ($value['cycle_libelle']); ?> - </b>
                                            
                                        <?php endforeach;?>
                                <?php endif;?> 
                                <br>
                                 <span class="text-uppercase">
                                    <b>
                                        EFFECTIF etudiants :
                                        <?= isset($nb_etudiants)?$nb_etudiants:0; ?>
                                    </b>
                                </span>
                               
                            </address>
                        </div> 
                    </div> 
                </div> 
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-uppercase font-weight-bold"> 
                               fiche de renseignement sur étudiant
                               </h5>

                            <div class="card-tools printoff">
                               <button class="btn btn-success btn-rounded text-uppercase btn-xs" onclick="print()">
                                    <i class="fa fa-print"></i> Imprimer</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-dark">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm  table-hover table-head-fixed">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="10%"></th>
                                        <th width="25%"></th>

                                        <th width="10%"></th>
                                        <th width="20%"></th> 

                                        <th width="10%"></th>
                                        <th width="25%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                   
                                    <tr>
                                        <td><label for="nometudiant"><span class="text-dark">*Nom Elève</span></label>
                                        </td>
                                        <td class="text-uppercase text-dark">
                                            <div class="form-group">

                                                <input type="text" name="nometudiant" id="nometudiant"
                                                       class="form-control text-dark"
                                                       placeholder="Nom etudiant"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_nom']) : set_value('nometudiant'); ?>">

                                            </div>
                                        </td>
                                   
                                        <td>
                                            <label for="postnometudiant"><span class="text-danger"></span>
                                                PostNom Elève</label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text" name="postnometudiant" id="postnometudiant"
                                                       class="form-control <?= ($validation->hasError('postnometudiant')) ? ' is-invalid' : '' ?>"
                                                       placeholder="PostNom etudiant"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_postnom']) : set_value('postnometudiant'); ?>">

                                           

                                            </div> <!-- prenom etudiant -->
                                        </td>
                                    
                                        <td><label for="prenometudiant"><span class="text-danger"></span>Prenom
                                                Elève</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                                <input type="text" name="prenometudiant" id="prenometudiant"
                                                       class="form-control <?= ($validation->hasError('prenometudiant')) ? ' is-invalid' : '' ?>"
                                                       placeholder="PreNom etudiant"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_prenom']) : set_value('prenometudiant'); ?>">

                                            </div>
                                        </td>
                                   </tr>
                                    <tr>
                                        <td><label><span class="text-danger">*</span>Sexe Elève : </label></td>
                                        <td class="text-uppercase">
                                            
                                            <div class="form-group">

                                                <div class="icheck-success d-inline">
                                                    <input type="radio"
                                                           name="sexeetudiant" 
                                                           id="radioSuccess1"
                                                           value="masculin">
                                                    <label for="radioSuccess1">
                                                        Masculin
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <input type="radio"
                                                           name="sexeetudiant" 
                                                           id="radioSuccess2" value="feminin">
                                                    <label for="radioSuccess2">
                                                        Feminin
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <input type="radio"
                                                           name="sexeetudiant" 
                                                           id="radioSuccess3" value="transgenre">
                                                    <label for="radioSuccess3">
                                                        Transgenre
                                                    </label>
                                                </div>
                                              
                                            </div>

                                        </td>
                                    
                                        <td><label for="dateNaissanceetudiant"><span class="text-danger"></span>Date de
                                                naissance:</label></td>
                                        <td class="text-uppercase">

                                            <div class="form-group">

                                                <div class="input-group date" id="date_format_abrege"
                                                     data-target-input="nearest">
                                                    <input type="text"
                                                           class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissanceetudiant')) ? ' is-invalid' : '' ?>"
                                                           id="dateNaissanceetudiant"
                                                           value="<?= isset($etudiant) ? esc($etudiant['etudiant_date_naissance']) : set_value('dateNaissanceetudiant') ?>"
                                                           data-target="#date_format_abrege" name="dateNaissanceetudiant"/>
                                                    <div class="input-group-append" data-target="#date_format_abrege"
                                                         data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                          
                                            </div>
                                        </td>
                                    
                                        <td><label for="lieuNaissanceetudiant"><span class="text-danger"></span>Lieu
                                                Naissance
                                                Elève</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="lieuNaissanceetudiant" id="nometudiant"
                                                       class="form-control <?= ($validation->hasError('lieuNaissanceetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_lieu_naissance']) : set_value('lieuNaissanceetudiant'); ?>">

                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td><label class="telephoneetudiant">Numéro téléphone
                                                :</label></td>
                                        <td class="text-uppercase">

                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="telephoneetudiant"
                                                           id="telephoneetudiant"
                                                           value="<?= isset($etudiant) ? esc($etudiant['etudiant_telephone']) : set_value('telephoneetudiant') ?>"
                                                           data-inputmask='"mask": "+243999999999"'
                                                           data-mask
                                                           placeholder="Ex: 858533285">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </td>
                                   
                                        <td><label for="emailetudiant">Adresse Mail Elève :</label>
                                        </td>
                                        <td class="text-uppercase">

                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control" name="emailetudiant"
                                                           id="emailetudiant"
                                                           value="<?= isset($etudiant) ? esc($etudiant['etudiant_email']) : set_value('emailetudiant') ?>">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </td>
                                    
                                        <td><label for="villeetudiant">Ville Résidence :</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="villeetudiant" id="villeetudiant"
                                                       class="form-control <?= ($validation->hasError('villeetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_ville']) : set_value('villeetudiant'); ?>">

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="provinceetudiant"><span class="text-danger"></span>Province
                                                Résidence :</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="provinceetudiant" id="provinceetudiant"
                                                       class="form-control <?= ($validation->hasError('provinceetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_province']) : set_value('provinceetudiant'); ?>">

                                            </div>
                                        </td>
                                    
                                        <td><label for="adresseetudiant">Adresse Résidence Elève :</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="adresseetudiant"
                                                           id="adresseetudiant"
                                                           value="<?= isset($etudiant) ? esc($etudiant['etudiant_adresse']) : set_value('adresseetudiant') ?>">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </td>
                                        <td><label for="groupeSanguinetudiant">Groupe Sanguin </label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="groupeSanguinetudiant" id="groupeSanguinetudiant"
                                                       class="form-control <?= ($validation->hasError('groupeSanguinetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_groupe_sanguin']) : set_value('groupeSanguinetudiant'); ?>">

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="caracteristiquesetudiant">Profil (Intellectuel, caractères)</label>
                                        </td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                            <textarea name="caracteristiquesetudiant" id="caracteristiquesetudiant" cols="30"
                                                      rows="3"
                                                      class="form-control"
                                                      autocomplete="off"><?= (isset($etudiant) ? esc($etudiant['etudiant_caracteristiques']) : ''); ?></textarea>
                                            </div>
                                        </td>
                                    
                                        <td><label for="observationetudiant">Observation Générale et Santé</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                            <textarea name="observationetudiant" id="observationetudiant" cols="30" rows="3"
                                                      class="form-control"
                                                      autocomplete="off"><?= (isset($etudiant) ? esc($etudiant['etudiant_observation']) : ''); ?></textarea>
                                            </div>
                                        </td>
                                    
                                        <td><label for="poidsetudiant">Poids Elève en KG</label></td>

                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="poidsetudiant" id="poidsetudiant"
                                                       class="form-control <?= ($validation->hasError('poidsetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_poids']) : set_value('poidsetudiant'); ?>">

                                            </div>
                                        </td>
                                   </tr>

                                    <tr>
                                        <td><label for="tailleetudiant">Taille Elève en CM</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">

                                                <input type="text" name="tailleetudiant" id="tailleetudiant"
                                                       class="form-control <?= ($validation->hasError('tailleetudiant')) ? ' is-invalid' : '' ?>"
                                                       value="<?= isset($etudiant) ? esc($etudiant['etudiant_taille']) : set_value('tailleetudiant'); ?>">

                                            </div>
                                        </td>
                                    
                                        <td><label for="attitudeetudiant">Attitude Elève</label></td>
                                        <td class="text-uppercase">
                                            <div class="form-group">
                                            <textarea name="attitudeetudiant" id="attitudeetudiant" cols="30" rows="3"
                                                      class="form-control"
                                                      autocomplete="off"><?= (isset($etudiant) ? esc($etudiant['etudiant_attitude']) : ''); ?></textarea>
                                            </div>
                                        </td>
                                    
                                        <td><label for="nom_parent">Nom du Père</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="nom_parent"
                                                   id="nom_parent"
                                                   value="<?= (!empty($nompar)) ? esc($nompar) : set_value('nom_parent') ?>"
                                                   style="border-radius: 10px!important;"/>
                                            <?php if (isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'nom_parent'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </td>
                        </tr>

                                    <tr>
                                        <td><label for="prenom_parent">Prénom du Père</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="prenom_parent"
                                                   id="prenom_parent"
                                                   value="<?= (!empty($prenompar)) ? substr($prenompar, 1) : set_value('prenom_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                            <?php if (isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'prenom_parent'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </td>
                                    
                                        <td><label for="profession_parent">Profession du Père</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />

                                        </td>
                                   
                                        <td><label for="email_parent">Email du Père</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="text"
                                                       class="form-control bg-light text-lowercase"
                                                       name="email_parent"
                                                       id="email_parent"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_email']) : set_value('email_parent') ?>"
                                                />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="telephone_ecole">Numéro Téléphone du Père</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="telephone_parent"
                                                       id="telephone_parent"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_telephone']), 4) : set_value('telephone_parent') ?>"/>
                                            </div>
                                        </td>
                                    
                                        <td><label for="nom_parent">Nom de la Mère</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="nom_parent"
                                                   id="nom_parent"
                                                   value="<?= (!empty($nompar)) ? esc($nompar) : set_value('nom_parent') ?>"
                                                   style="border-radius: 10px!important;"/>
                                            <?php if (isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'nom_parent'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </td>
                                    
                                        <td><label for="prenom_parent">Prénom Mère</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="prenom_parent"
                                                   id="prenom_parent"
                                                   value="<?= (!empty($prenompar)) ? substr($prenompar, 1) : set_value('prenom_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                            <?php if (isset($validation)): ?>
                                                <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'prenom_parent'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </td>
                                   </tr>
                                    <tr>
                                        <td><label for="profession_parent">Profession Mère</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />

                                        </td>
                                    
                                        <td><label for="email_parent">Email Mère</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="text"
                                                       class="form-control bg-light text-lowercase"
                                                       name="email_parent"
                                                       id="email_parent"
                                                       value="<?= (isset($parent)) ? esc($parent['parent_email']) : set_value('email_parent') ?>"
                                                />
                                            </div>
                                        </td>
                                   
                                        <td><label for="telephone_ecole">Numéro Téléphone Mère</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="telephone_parent"
                                                       id="telephone_parent"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($parent)) ? substr(esc($parent['parent_telephone']), 4) : set_value('telephone_parent') ?>"/>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="profession_parent">Nom du tuteur</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capiatalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td>
                                        <td><label for="profession_parent">Téléphone du tuteur</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td>
                                   
                                        <td><label for="profession_parent">Profession du tuteur</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td>
                                         </tr>
                                    <tr>
                                        <td><label for="profession_parent">Lien de parenté tuteur</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td>
                                    
                                        <td><label for="profession_parent">Nom du responsqble</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td><td><label for="profession_parent">Numéro téléphone responsable</label></td>

                                        
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td>
                              </tr>
                                    <tr>
                                        <td><label for="profession_parent">Email du responsable</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td> <td><label for="profession_parent">Adresse du responsable</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td>
                                    
                                        <td><label for="profession_parent">Autres personnes</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="profession_parent"
                                                   id="profession_parent"
                                                   value="<?= (isset($parent)) ? esc($parent['parent_profession']) : set_value('profession_parent') ?>"
                                                   style="border-radius: 10px!important;"
                                            />
                                        </td>
                              </tr>
                                    
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p class="text-center">
                                Nom et Signature du Responsable
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>


