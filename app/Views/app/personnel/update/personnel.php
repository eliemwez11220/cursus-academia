<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Modification Agent: <?= (isset($agent)?esc($agent['agent_matricule']).' - '.esc($agent['agent_nom']):''); ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard')?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Personnel</li>
                        <li class="breadcrumb-item active">Agent</li>
                        
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
                    <!-- form start -->
                    <?php
                        
                        //form validation services call
                        $validation = \Config\Services::validation(); 

                        //form
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url() . '/agent/saveAgent/update/'.(isset($agent)?esc($agent['agent_uid']):''), $attributes);
                    ?>
                    <input type="hidden" name="instoken" value="<?= isset($etudiant)?esc($etudiant['inscription_uid']): ''?>">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-tools float-left">
                                    <a href="<?= base_url('agent/view/personnels'); ?>"
                                       class="btn btn-default btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-arrow-circle-left fa-lg"></i> voir la liste
                                    </a>
                                </div>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-sm">
                                    <i class="fa fa-save"></i> <strong>Enregistrer les modifications</strong> </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                         <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm  table-hover table-head-fixed">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="30%"></th>
                                        <th width="20%"></th>
                                        <th width="30%"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="alert alert-secondary">
                                        <td colspan="4" class="text-uppercase">
                                            <strong>
                                            Informations sur Fonction | Grade | Secteur
                                              </strong>
                                        </td>
                                    </tr>
                               
                                <tr>
                                    <td>
                                        <label for="fonction"><span class="text-danger">*</span>
                                            Fonction Agent
                                    </label>
                                    </td>
                                   <td class="text-uppercase">
                                    <div class="form-group">
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('fonction')) ? ' is-invalid' : '' ?>"
                                                id="fonction"
                                                name="fonction"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez une promotion --</option>
                                            <?php
                                            
                                            $count = 1;
                                            if (isset($fonctions) && !empty($fonctions)):
                                                foreach ($fonctions as $key => $value): 
                                                    if(isset($agent)){ 

                                                    if (esc($agent['agent_fonction_uid']) == esc($value['fonction_uid'])) { ?>
                                                        <option selected value="<?= esc($value['fonction_uid']); ?>" <?= set_select('fonction', esc($value['fonction_uid'])); ?>>
                                                        <?= ucfirst(esc($value['fonction_libelle'])); ?>
                                                    </option>
                                                   <?php } } ?>
                                                    <option value="<?= esc($value['fonction_uid']); ?>" <?= set_select('fonction', esc($value['fonction_uid'])); ?>>
                                                        <?= ucfirst(esc($value['fonction_libelle'])); ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('fonction')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('fonction'); ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                               
                                    <td>
                                        <label for="grade"><span class="text-danger">*</span>
                                            Grade Agent
                                    </label>
                                    </td>
                                   <td class="text-uppercase">
                                    <div class="form-group">
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('grade')) ? ' is-invalid' : '' ?>"
                                                id="grade"
                                                name="grade"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option disabled>-- Selectionnez un grade --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($grades) && !empty($grades)):
                                                foreach ($grades as $key => $value): 
                                                    if(isset($agent)){ 

                                                    if (esc($agent['agent_grade_uid']) == esc($value['grade_uid'])) { ?>
                                                        <option selected value="<?= esc($value['grade_uid']); ?>" <?= set_select('grade', esc($value['grade_uid'])); ?>>
                                                        <?= ucfirst(esc($value['grade_libelle'])); ?>
                                                    </option>
                                                   <?php } } ?>
                                                    <option value="<?= esc($value['grade_uid']); ?>" <?= set_select('grade', esc($value['grade_uid'])); ?>>
                                                        <?= ucfirst(esc($value['grade_libelle'])); ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('grade')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('grade'); ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="fonction"><span class="text-danger">*</span>
                                            Secteur d'activité
                                    </label>
                                    </td>
                                   <td class="text-uppercase">
                                   

                                    <div class="form-group">
                                        
                                        <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('secteur')) ? ' is-invalid' : '' ?>"
                                                id="secteur"
                                                name="secteur"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez un secteur --</option>
                                            <?php
                                            
                                            $count = 1;
                                            if (isset($secteurs) && !empty($secteurs)):
                                                foreach ($secteurs as $key => $value): 
                                                    if(isset($agent)){ 

                                                    if (esc($agent['agent_secteur_uid']) == esc($value['secteur_uid'])) { ?>
                                                        <option selected value="<?= esc($value['secteur_uid']); ?>" <?= set_select('secteur', esc($value['secteur_uid'])); ?>>
                                                        <?= ucfirst(esc($value['secteur_libelle'])); ?>
                                                    </option>
                                                   <?php } } ?>
                                                    <option value="<?= esc($value['secteur_uid']); ?>" <?= set_select('secteur', esc($value['secteur_uid'])); ?>>
                                                        <?= ucfirst(esc($value['secteur_libelle'])); ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('secteur')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('secteur'); ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                                
                                <td><label for="statutetudiant"><span class="text-danger">*</span> Statut agent</label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                        <select id="statut" name="statut"
                                                class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('statut')) ? ' is-invalid' : '' ?>"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                            
                                            <?php
                                                
                                            if (isset($agent)):
                                               
                                                if (!empty(esc($agent['agent_statut']))) { ?>
                                                    <option selected value="<?= esc($agent['agent_statut']); ?>" <?= set_select('statut', esc($agent['agent_statut'])); ?>>
                                                        <?= ucfirst(esc($agent['agent_statut'])); ?>
                                                    </option>
                                                <?php } ?>
                                            <?php else: ?>
                                            
                                            <option selected="selected" disabled>-- Sélectionnez un statut --
                                            </option>
                                            <?php endif; ?>
                                            <option value="actif" <?= set_select('statut', 'actif'); ?>>Actif</option>
                                            <option value="inactif" <?= set_select('statut', 'inactif'); ?>>Inactif</option>
                                                
                                        </select>
                                        <?php if ($validation->hasError('statut')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('statut'); ?></span>
                                        <?php } ?>
                                    </div>
                               
                                     </td>
                                </tr>
                                <tr>
                                    <td> <label for="matricule">
                                        <span class="text-danger">*</span> Matricule agent
                                            </label>
                                        </td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                            <input type="text" name="matricule" id="matricule"
                                               class="form-control <?= ($validation->hasError('matricule')) ? ' is-invalid' : '' ?>"
                                               placeholder="Matricule"
                                               value="<?= isset($agent)?esc($agent['agent_matricule']): set_value('matricule') ?>">

                                        <?php if ($validation->hasError('matricule')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('matricule'); ?></span>
                                        <?php } ?>
                                    </div>
                                    </td>
                              
                                    <td> <label for="nom"><span class="text-danger">*</span>Nom Agent</label>
                                    </td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="nom" id="nom"
                                               class="form-control <?= ($validation->hasError('nom')) ? ' is-invalid' : '' ?>"
                                               placeholder="Nom agent" value="<?= isset($agent)?esc($agent['agent_nom']):set_value('nom'); ?>">

                                        <?php if ($validation->hasError('nom')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('nom'); ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                                </tr>   

                                <tr>
                                    <td>
                                        <label for="postnom"><span class="text-danger">*</span>
                                        Postnom Agent</label>
                                    </td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                            <input type="text" name="postnom" id="postnom"
                                                   class="form-control <?= ($validation->hasError('postnom')) ? ' is-invalid' : '' ?>"
                                                   placeholder="Postnom Agent" value="<?= isset($agent)?esc($agent['agent_postnom']):set_value('postnom'); ?>">

                                            <?php if ($validation->hasError('postnom')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('postnom'); ?></span>
                                            <?php } ?>

                                        </div> <!-- prenom etudiant --> 
                                    </td>
                                
                                    <td> <label for="prenom"><span class="text-danger">*</span>Prénom
                                            Agent</label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                            <input type="text" name="prenom" id="prenom"
                                               class="form-control <?= ($validation->hasError('prenom')) ? ' is-invalid' : '' ?>"
                                               placeholder="Prenom Agent" value="<?= isset($agent)?esc($agent['agent_prenom']):set_value('prenom'); ?>">

                                            <?php if ($validation->hasError('prenom')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('prenom'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <label for="dateNaissance"><span class="text-danger"></span>Date de
                                            naissance:</label></td>
                                    <td class="text-uppercase">

                                        <div class="form-group">
                                       
                                        <div class="input-group date" id="date_format_abrege"
                                             data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissance')) ? ' is-invalid' : '' ?>"
                                                   id="dateNaissance" value="<?= isset($agent)?esc($agent['agent_date_naissance']):set_value('dateNaissance') ?>"
                                                   data-target="#date_format_abrege" name="dateNaissance"/>
                                            <div class="input-group-append" data-target="#date_format_abrege"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if ($validation->hasError('dateNaissance')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('dateNaissance'); ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                               
                                <td> <label for="lieuNaissanceetudiant"><span class="text-danger"></span>Lieu Naissance </label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="lieuNaissance" id="lieuNaissance"
                                               class="form-control <?= ($validation->hasError('lieuNaissance')) ? ' is-invalid' : '' ?>"
                                               value="<?= isset($agent)?esc($agent['agent_lieu_naissance']):set_value('lieuNaissanceetudiant'); ?>">

                                        <?php if ($validation->hasError('lieuNaissance')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('lieuNaissance'); ?></span>
                                        <?php } ?>
                                    </div>
                                 </td>
                                 </tr>
                                <tr>
                                 <td>  <label for="date_engagement"><span class="text-danger"></span>Date d'engagement:</label></td>
                                    <!-- Date -->
                                     <td><div class="form-group">
                                       
                                        <div class="input-group date" id="date_debut_annee"
                                             data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input <?= ($validation->hasError('date_engagement')) ? ' is-invalid' : '' ?>"
                                                   id="date_engagement" value="<?= isset($agent)?esc($agent['agent_date_embauche']):set_value('date_engagement') ?>"
                                                   data-target="#date_debut_annee" name="date_engagement"/>
                                            <div class="input-group-append" data-target="#date_debut_annee"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <?php if ($validation->hasError('date_engagement')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('date_engagement'); ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                                
                                <td>   
                                    <label for="lieu_engagement"><span class="text-danger"></span>Lieu d'engagement</label>
                                </td>
                                    <!-- Date -->
                                <td>
                                    <!-- Nom etudiant -->
                                    <div class="form-group">
                                        <input type="text" name="lieu_engagement" id="lieu_engagement"
                                               class="form-control <?= ($validation->hasError('lieu_engagement')) ? ' is-invalid' : '' ?>"
                                                    value="<?= isset($agent)?esc($agent['agent_lieu_embauche']):set_value('lieu_engagement'); ?>">

                                        <?php if ($validation->hasError('lieu_engagement')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('lieu_engagement'); ?></span>
                                        <?php } ?>
                                    </div>
                                 </td>
                                </tr>

                                <tr>
                                 <td> <label><span class="text-danger">*</span>Sexe Agent : </label></td>
                                    <td class="text-uppercase small">
                                        <?php if(isset($agent)){$sexe = esc($agent['agent_sexe']); ?>
                                    <div class="form-group">
                                       
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="sexe" <?= ($sexe =='masculin')?'checked':''; ?> id="radioSuccess1"
                                                   value="masculin">
                                            <label for="radioSuccess1">
                                                Masculin
                                            </label>
                                        </div>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="sexe" <?= ($sexe =='feminin')?'checked':''; ?> id="radioSuccess2" value="feminin">
                                            <label for="radioSuccess2">
                                                Feminin
                                            </label>
                                        </div>
                                        
                                        <?php if ($validation->hasError('sexe')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('sexe'); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                </td>
                                    <td><label for="nom_conjoint">Nom conjoint (e) </label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="nom_conjoint" id="nom_conjoint"
                                               class="form-control <?= ($validation->hasError('nom_conjoint')) ? ' is-invalid' : '' ?>"
                                               value="<?= isset($agent)?esc($agent['agent_nom_conjoint']):set_value('nom_conjoint'); ?>">

                                    </div>
                                 </td>   
                                 </tr>   

                                 <tr>
                                    <td><label for="nombre_enfants">Nombre Enfants </label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="number" name="nombre_enfants" id="nombre_enfants"
                                               class="form-control" min="0"
                                               value="<?= isset($agent)?esc($agent['agent_nombre_enfants']):set_value('nombre_enfants'); ?>">

                                    </div>
                                 </td> 
                                
                                    <td> <label for="numero_securite">
                                        Numéro Sécurite sociale</label></td>
                               
                                    <td class="text-uppercase"> 
                                    <div class="form-group">
                                            <input type="text" name="numero_securite" id="numero_securite"
                                               class="form-control <?= ($validation->hasError('numero_securite')) ? ' is-invalid' : '' ?>"
                                                value="<?= isset($agent)?esc($agent['agent_numero_securite']):set_value('numero_securite'); ?>">

                                            <?php if ($validation->hasError('numero_securite')) { ?>
                                                <span class="invalid-feedback"> <?= $validation->getError('numero_securite'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                 
                                <tr>
                                    <td><label class="telephone">Numéro téléphone
                                            :</label></td>
                                   <td class="text-uppercase">

                                      <div class="form-group">
                                     
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone"
                                                   id="telephoneetudiant" value="<?= isset($agent)?esc($agent['agent_telephone']):set_value('telephone') ?>"
                                                   data-inputmask='"mask": "+243999999999"'
                                                   data-mask
                                                   placeholder="Ex: 858533285">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>
                              
                                    <td><label for="email">Adresse Mail :</label>
                                    </td>
                                    <td class="text-uppercase">

                                        <div class="form-group">
                                        
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email" id="email" value="<?= isset($agent)?esc($agent['agent_email']):set_value('email') ?>">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>
                                </tr>
                               
                                <tr>
                                    <td> <label for="ville">Ville Résidence :</label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="ville" id="ville"
                                               class="form-control <?= ($validation->hasError('ville')) ? ' is-invalid' : '' ?>"
                                               value="<?= isset($agent)?esc($agent['agent_ville']):set_value('ville'); ?>">

                                        <?php if ($validation->hasError('ville')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('ville'); ?></span>
                                        <?php } ?>
                                    </div>
                                     </td>
                             
                                    <td> <label for="province"><span class="text-danger"></span>Province Résidence :</label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="province" id="province"
                                               class="form-control <?= ($validation->hasError('province')) ? ' is-invalid' : '' ?>"
                                               value="<?= isset($agent)?esc($agent['agent_province']):set_value('province'); ?>">

                                        <?php if ($validation->hasError('province')) { ?>
                                            <span class="invalid-feedback"> <?= $validation->getError('province'); ?></span>
                                        <?php } ?>
                                    </div>
                                 </td> 
                                </tr>
                                 <tr>
                                    <td> <label for="adresse">Adresse Résidence :</label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="adresse" id="adresseetudiant" value="<?= isset($agent)?esc($agent['agent_adresse']):set_value('adresse') ?>">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>
                               
                                    <td><label for="groupeSanguin">Groupe Sanguin </label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="groupeSanguin" id="groupeSanguin"
                                               class="form-control <?= ($validation->hasError('groupeSanguin')) ? ' is-invalid' : '' ?>"
                                               value="<?= isset($agent)?esc($agent['agent_groupe_sanguin']):set_value('groupeSanguin'); ?>">

                                    </div>
                                 </td> 

                                </tr>
                                <tr>
                                    <td><label for="caracteristiques">Profil (Intellectuel, caractères)</label></td>
                                    <td class="text-uppercase">
                                          <div class="form-group">
                                            <textarea name="caracteristiques" id="caracteristiques" cols="30" rows="3"
                                                      class="form-control" autocomplete="off"><?= (isset($agent)?esc($agent['agent_caracteristiques']):''); ?></textarea>
                                    </div>
                                     </td>
                               
                                    <td><label for="observation">Observation Générale et santé</label></td>
                                    <td class="text-uppercase">
                                          <div class="form-group">
                                            <textarea name="observation" id="observation" cols="30" rows="3"
                                                      class="form-control" autocomplete="off"><?= (isset($agent)?esc($agent['agent_observation']):''); ?></textarea>
                                    </div>
                                </td>
                                </tr>
                                
                                <tr>
                                    <td><label for="poids">Poids en KG</label></td>

                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="poids" id="poids"
                                               class="form-control <?= ($validation->hasError('poids')) ? ' is-invalid' : '' ?>"
                                               value="<?= isset($agent)?esc($agent['agent_poids']):set_value('poids'); ?>">

                                    </div>
                                 </td> 
                              
                                    <td><label for="taille">Taille en CM</label></td>
                                    <td class="text-uppercase">
                                        <div class="form-group">
                                       
                                        <input type="text" name="taille" id="taille"
                                               class="form-control <?= ($validation->hasError('taille')) ? ' is-invalid' : '' ?>"
                                               value="<?= isset($agent)?esc($agent['agent_taille']):set_value('taille'); ?>">

                                    </div>
                                 </td> 
                                </tr>
                              
                                <tr>
                                    <td><label for="application">Application ou Rigueur de travail</label></td>

                                    <td class="text-uppercase">
                                          <div class="form-group">
                                            <textarea name="application" id="application" cols="30" rows="3"
                                                      class="form-control" autocomplete="off"><?= (isset($agent)?esc($agent['agent_application']):''); ?></textarea>
                                    </div>
                                </td>

                                
                                    <td><label for="attitude">Attitude </label></td>
                                     <td class="text-uppercase">
                                          <div class="form-group">
                                            <textarea name="attitude" id="attitude" cols="30" rows="3"
                                                      class="form-control" autocomplete="off"><?= (isset($agent)?esc($agent['agent_attitude']):''); ?></textarea>
                                    </div>
                                </td>
                                </tr>
                            
                            </table>
                        </div>
                        </div>
                        <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-sm">
                                    <i class="fa fa-chech-circle fa-lg"></i> <strong>Enregistrer les modifications</strong> </button>
                            </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                     <?= form_close(); ?>
                    <!-- /.col (right) -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>


