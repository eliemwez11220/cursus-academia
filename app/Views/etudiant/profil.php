<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">
                        Profil étudiant
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Accueil</a>
                        </li>
                        
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

              <div class="widget-user-image mb-5">
                <img class="img-circle elevation-4 mb-5" 
                src="<?= (isset($etudiant) && (!empty($etudiant['etudiant_photo'])))? $etudiant['etudiant_photo'] : 
                base_url('global/img/esp.webp'); ?>" alt="Avatar" style="height: 100px; width: 100px">
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
                    <div class="card">
                        
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
                                        <td>Matricule</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_matricule']) : ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Code d'accès</td>
                                        <td class="text-lowercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_pseudo']) : ''); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Nom</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_nom']) : ''); ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Postnom</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_postnom']) : ''); ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>Prenom</td>
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
                                        <td>Statut</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_statut']) : ''); ?> </td>
                                    </tr>
                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                                Infos sur la promotion
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Promotion</td>
                                        <td class="text-uppercase"><?= (isset($promotion) ? ($promotion['promotion_libelle']) : ''); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Cycle</td>
                                        <td class="text-uppercase"><?= (isset($promotion) ? ($promotion['cycle_libelle']) : ''); ?> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Option</td>
                                        <td class="text-uppercase"><?= (isset($promotion) ? ($promotion['option_libelle']) : ''); ?> </td>
                                    </tr>
                                    
                                    <tr class="alert alert-secondary">
                                        <td colspan="2" class="text-uppercase">
                                            <strong>
                                                Contact & Localisation
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
                                                Journalisation des actions effectuées sur
                                            </strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Date Inscription</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_created_at']) : ''); ?> </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Dernière modification</td>
                                        <td class="text-uppercase"><?= (isset($etudiant) ? esc($etudiant['etudiant_updated_at']) : ''); ?> </td>
                                    </tr>
                                   
                                </tbody>
                                </table>
                            </div>
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
