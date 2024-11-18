<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Détails dossier
                        étudiant </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active"></li>
                        Elèves
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

                                  <div class="text-center">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* promotions -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username text-uppercase font-weight-bold">
                    <?= (isset($etudiant) ? esc($etudiant['etudiant_nom']) : ''); ?>
                    <?= (isset($etudiant) ? esc($etudiant['etudiant_postnom']) : ''); ?>
                    <?= (isset($etudiant) ? esc($etudiant['etudiant_prenom']) : ''); ?>
                </h3>
                 <h5 class="widget-user-desc text-uppercase">
                    <?= (isset($promotion) ? ($promotion['promotion_libelle']) : ''); ?>
                    <?= (isset($promotion) ? ($promotion['cycle_libelle']) : ''); ?> |
                    <?= (isset($promotion) ? ($promotion['option_libelle']) : ''); ?>
                 </h5>
              </div>

              <div class="widget-user-image">
                <img class="img-circle elevation-4" src="<?= (isset($etudiant))? $etudiant['etudiant_photo'] : site_url('global/img/avatar.png'); ?>" alt="Avatar" style="height: 100px; width: 100px">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header text-capitalize">
                        <?= (isset($etudiant) ? esc($etudiant['etudiant_matricule']) : ''); ?>
                      </h5>

                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header text-lowercase">
                        <?= (isset($etudiant) ? esc($etudiant['etudiant_email']) : ''); ?>
                      </h5>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-tools float-left">
                                    <a href="<?= base_url('student/dossier/inscription'); ?>"
                                       class="btn btn-default btn-sm btn-rounded text-uppercase">
                                        <i class="fa fa-arrow-circle-left fa-lg"></i> voir la liste
                                    </a>
                                </div>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('student/editForm/inscription/' . (isset($etudiant) ? esc($etudiant['etudiant_uid']) : '')); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-sm">
                                    <i class="fa fa-edit fa-lg"></i> <strong>Mettre à jour</strong>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Matricule étudiant</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_matricule']) : ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Code d'accès étudiant</td>
                                        <td class="text-lowercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_pseudo']) : ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Numéro Serni</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_numero_serni']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Nom étudiant</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_nom']) : ''); ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Postnom étudiant</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_postnom']) : ''); ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>Prenom étudiant</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_prenom']) : ''); ?> </td>
                                    </tr>


                                    <tr>
                                        <td>Sexe</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_sexe']) : ''); ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Date de naissance</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_date_naissance']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Lieu de naissance</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_lieu_naissance']) : ''); ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Ecole provenance</td>
                                        <td class="text-uppercase"><?= (isset($inscription) ? esc($inscription['inscription_provenance']) : ''); ?>
                                    </td>
                                    </tr>

                                    <td>Catégorie</td>
                                    <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['typesetudiant_libelle']) : ''); ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Statut</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_statut']) : ''); ?> </td>
                                    </tr>
                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                                Infos sur promotion
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>promotion</td>
                                        <td class="text-uppercase"><?= (isset($promotion) ? ($promotion['promotion_libelle']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Cycle</td>
                                        <td class="text-uppercase"><?= (isset($promotion) ? ($promotion['cycle_libelle']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>filiere</td>
                                        <td class="text-uppercase"><?= (isset($promotion) ? ($promotion['filiere_libelle']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Option</td>
                                        <td class="text-uppercase"><?= (isset($promotion) ? ($promotion['option_libelle']) : ''); ?> </td>
                                    </tr>
                                    
                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                                Contact & Localisation Elèves
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Téléphone</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_telephone']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_email']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Adresse</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_adresse']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Ville</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_ville']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Province</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_province']) : ''); ?> </td>
                                    </tr>

                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                                Observation générale, Santé et application
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Groupe Sanguin</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_groupe_sanguin']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Profil (Intellectuel, caractère)</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_caracteristiques']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Observation Générale</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_observation']) : ''); ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Poids</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_poids']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Taille</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_taille']) : ''); ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Application</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_application']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Attitude</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_attitude']) : ''); ?> </td>
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
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_created_at']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Créée par</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_created_by']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Dernière modification</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_updated_at']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_updated_by']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Date suppression</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_deleted_at']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Supprimée par</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_deleted_by']) : ''); ?> </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">

                            <h5 class="text-uppercase font-weight-bold">Fiche de renseignement sur étudiant </h5>

                            <a href="<?= isset($etudiant) ? $etudiant['etudiant_fiche'] : ''; ?>" class="btn btn-default btn-sm text-uppercase" target="_blank">Voir les details de la fiche</a>
                                    <embed src="<?= isset($etudiant) ? $etudiant['etudiant_fiche'] : ''; ?>"
                                           type="application/pdf" controls
                                           style="height:50%!important;width:100%!important;">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
