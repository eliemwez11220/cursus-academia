<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Détails Agent: <?= (isset($agent)?esc($agent['agent_matricule']).' - '.esc($agent['agent_nom']):''); ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard')?>">Accueil</a></li>
                        <li class="breadcrumb-item active"></li>
                        etudiants
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
                                <a href="<?= base_url('agent/editForm/personnel/'.(isset($agent)?esc($agent['agent_uid']):'')); ?>"
                                       class="btn btn-warning btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-edit"></i> Mettre à jour les infos
                                    </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                         <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm  table-hover table-head-fixed">
                                    <thead>
                                <tr class="text-uppercase">
                                    <th width="30%"></th>
                                    <th width="70%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
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
                                   <?= isset($agent)? esc($agent['fonction_libelle']):''; ?> 
                                </td>
                                </tr> <tr>
                                    <td>
                                        <label for="grade"><span class="text-danger">*</span>
                                            Grade Agent
                                    </label>
                                    </td>
                                   <td class="text-uppercase">
                                   <?= isset($agent)? esc($agent['grade_libelle']):''; ?> 
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="fonction"><span class="text-danger">*</span>
                                            Secteur d'activité
                                    </label>
                                    </td>
                                   <td class="text-uppercase">
                                     <?= isset($agent)? esc($agent['secteur_libelle']):''; ?> 
                                  </td>
                                </tr>
                               
                                
                                <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                             Informations sur  Agent
                                              </strong>
                                        </td>
                                    </tr>
                                <tr>
                               
                                  <tr>
                                    <td><label for="statutetudiant"><span class="text-danger">*</span> Statut agent</label></td>
                                    <td class="text-uppercase">
                                            
                                            <?= isset($agent)? esc($agent['agent_statut']):''; ?>
                                
                                     </td>
                                </tr>
                                <tr>
                                    <td> <label for="matricule">
                                        <span class="text-danger">*</span> Matricule agent
                                            </label>
                                        </td>
                                    <td class="text-uppercase">
                                       <?= isset($agent)?esc($agent['agent_matricule']): ('') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <label for="nom"><span class="text-danger">*</span>Nom Agent</label>
                                    </td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_nom']):(''); ?>
                                </td>
                                </tr>   

                                <tr>
                                    <td>
                                        <label for="postnom"><span class="text-danger">*</span>
                                        Postnom Agent</label>
                                    </td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_postnom']):(' '); ?>
                                    </td>
                                </tr> 
                                <tr>
                                    <td> <label for="prenom"><span class="text-danger">*</span>Prenom
                                            Agent
                                            </label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_prenom']):(''); ?>

                                    </td>
                                </tr>
                            
                                
                                <tr>
                                    <td> <label><span class="text-danger">*</span>Sexe Agent : </label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)? esc($agent['agent_sexe']):''?>
                                    
                                </td>
                                </tr>

                                <tr>
                                    <td> <label for="dateNaissance"><span class="text-danger">*</span>Date de
                                            naissance:</label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_date_naissance']):
                                        ('') ?>
                                </td>
                                </tr>
                                <tr>
                                    <td> <label for="lieuNaissanceetudiant"><span class="text-danger">*</span>Lieu Naissance </label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_lieu_naissance']):(''); ?>
                                 </td>
                                </tr>

                                <tr>
                                    <td> <label for="lieuNaissanceetudiant"><span class="text-danger">*</span>Date Embauche </label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_date_embauche']):(''); ?>
                                 </td>
                                </tr>
                                <tr>
                                    <td> <label for="lieuNaissanceetudiant"><span class="text-danger">*</span>Lieu Embauche </label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_lieu_embauche']):(''); ?>
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
                                        <?= isset($agent)?esc($agent['agent_nom_conjoint']):(''); ?>
                                 </td>   
                                 </tr>   

                                 <tr>
                                    <td><label for="nombre_enfants">Nombre Enfants </label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_nombre_enfants']):
                                        (''); ?>
                                 </td> 
                                 </tr> 
                                 <tr>
                                    <td> <label for="numero_securite">
                                        Numéro Sécurite sociale</label></td>
                               
                                    <td class="text-uppercase"> 
                                  <?= isset($agent)?esc($agent['agent_numero_securite']):(''); ?>
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
                                    <td><label class="telephone">Numéro téléphone
                                            :</label></td>
                                   <td class="text-uppercase">
                                    <?= isset($agent)?esc($agent['agent_telephone']):('') ?>
                                </td>
                                </tr>
                                <tr>
                                    <td><label for="email">Adresse Mail :</label>
                                    </td>
                                    <td class="text-uppercase">

                                        <?= isset($agent)?esc($agent['agent_email']):('') ?>
                                   
                                </td>
                                </tr>
                               
                                <tr>
                                    <td> <label for="ville">Ville Résidence :</label></td>
                                    <td class="text-uppercase">
                                    <?= isset($agent)?esc($agent['agent_ville']):(''); ?>
                                     </td>
                                </tr>
                                <tr>
                                    <td> <label for="province"><span class="text-danger"></span>Province Residence :</label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_province']):''; ?>
                                 </td> 
                                </tr>
                                 <tr>
                                    <td> <label for="adresse">Adresse Résidence :</label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_adresse']):'' ?>
                                    </div>
                                </td>
                                </tr>

                                 <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                             Observation générale, Santé et application
                                              </strong>
                                        </td>
                                    </tr>
                                <tr>
                                    <td><label for="groupeSanguin">Groupe Sanguin </label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_groupe_sanguin']):''; ?>
                                 </td> 

                                </tr>
                                <tr>
                                    <td><label for="caracteristiques">Profil (Intellectuel, caractères)</label></td>
                                    <td class="text-uppercase">
                                        <?= (isset($agent)?esc($agent['agent_caracteristiques']):''); ?>
                                    </div>
                                     </td>
                                </tr>
                                <tr>
                                    <td><label for="observation">Observation Générale et santé</label></td>
                                    <td class="text-uppercase">
                                        <?= (isset($agent)?esc($agent['agent_observation']):''); ?>
                                    </div>
                                </td>
                                </tr>
                                
                                <tr>
                                    <td><label for="poids">Poids en KG</label></td>

                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_poids']):''; ?>

                                    </div>
                                 </td> 
                                </tr>
                                <tr>
                                    <td><label for="taille">Taille en CM</label></td>
                                    <td class="text-uppercase">
                                        <?= isset($agent)?esc($agent['agent_taille']):''; ?>

                                    </div>
                                 </td> 
                                </tr>
                              
                                <tr>
                                    <td><label for="application">Application ou Rigueur de travail</label></td>

                                    <td class="text-uppercase">
                                        <?= (isset($agent)?esc($agent['agent_application']):''); ?>
                                </td>

                                </tr>
                                <tr>
                                    <td><label for="attitude">Attitude </label></td>
                                     <td class="text-uppercase">
                                        <?= (isset($agent)?esc($agent['agent_attitude']):''); ?>
                                </td>
                                </tr>
                            <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                             Journalisation des actions effectuées sur étudiants
                                              </strong>
                                        </td>
                                    </tr>

                              
                                <tr>
                                    <td>Date création</td>
                                    <td class="text-uppercase"><?= (isset($agent)?esc($agent['agent_created_at']):''); ?> </td>
                                </tr>
                                <tr>
                                    <td>Crée par</td>
                                    <td class="text-uppercase"><?= (isset($agent)?esc($agent['agent_created_by']):''); ?> </td>
                                </tr>
                                <tr>
                                    <td>Dernières modifications</td>
                                    <td class="text-uppercase"><?= (isset($agent)?esc($agent['agent_updated_at']):''); ?> </td>
                                </tr>
                                <tr>
                                    <td>Mise à jour par</td>
                                    <td class="text-uppercase"><?= (isset($agent)?esc($agent['agent_updated_by']):''); ?> </td>
                                </tr>
                                  <tr>
                                    <td>Date suppression</td>
                                  <td class="text-uppercase"><?= (isset($agent)?esc($agent['agent_deleted_at']):''); ?> </td>
                                </tr> <tr>
                                    <td>Supprimé par </td>
                                  <td class="text-uppercase"><?= (isset($agent)?esc($agent['agent_deleted_by']):''); ?> </td>
                                </tr>
                            

                            </table>
                        </div>
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




                                 

