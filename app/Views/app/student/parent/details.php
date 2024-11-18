<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Apr-21
 * Time: 10:20 AM
 */
 -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">
                                Détails fiche parent
                            </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Parents</li>
                            </ol>
                        </div>
                    </div>
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
                                <a href="<?= base_url('etudiant/dossier/parent'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <a href="<?= base_url('etudiant/editForm/parent/'.(isset($parent) ? esc($parent['parent_uid']):'')); ?>"
                                   class="btn btn-warning btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-edit"></i> mettre à jour infos
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
                                    <tbody class="small">
                                    <tr>
                                        <td>Identifiant Tuteur</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_code']) : 'Aucun libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td> Téléphone Parent SMS </td>
                                        <td class="text-uppercase">

                                                <?= (isset($parent)) ? esc($parent['parent_phone_sms']) : 'Aucun libelle'; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Email Parent </td>
                                        <td class="text-lowercase"> 
                                            <a href="mailto:<?= (isset($parent)) ? esc($parent['parent_email']) : ''; ?>">
                                                <?= (isset($parent)) ? esc($parent['parent_email']) : 'Aucun libelle'; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Adresse résidence Tuteur</td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_adresse']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                     <tr>
                                        <td> Nom du père </td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_nom_pere']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Profession du père </td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_profession_pere']) : 'Aucun libelle'; ?></td>
                                    </tr>


                                    <tr>
                                        <td> Téléphone du père </td>
                                        <td class="text-uppercase">
                                            <a href="tel:<?= (isset($parent)) ? esc($parent['parent_phone_pere']) : ''; ?>">
                                                <?= (isset($parent)) ? esc($parent['parent_phone_pere']) : 'Aucun libelle'; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Téléphone sécondaire du père  </td>
                                        <td class="text-uppercase">
                                            <a href="tel:<?= (isset($parent)) ? esc($parent['parent_phone_pere2']) : ''; ?>">
                                                <?= (isset($parent)) ? esc($parent['parent_phone_pere2']) : 'Aucun libelle'; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Nom de la mère </td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_nom_mere']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Profession de la mère </td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_profession_mere']) : 'Aucun libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td> Téléphone de la mère </td>
                                        <td class="text-uppercase">
                                            <a href="tel:<?= (isset($parent)) ? esc($parent['parent_phone_mere']) : ''; ?>">
                                                <?= (isset($parent)) ? esc($parent['parent_phone_mere']) : 'Aucun libelle'; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nom Tuteur</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_nom_tuteur']) : 'Aucun'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Profession Tuteur </td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_profession_tuteur']) : 'Aucun libelle'; ?></td>
                                    </tr>

                                    <tr>
                                        <td> Téléphone Tuteur </td>
                                        <td class="text-uppercase">
                                            <a href="tel:<?= (isset($parent)) ? esc($parent['parent_phone_tuteur']) : ''; ?>">
                                                <?= (isset($parent)) ? esc($parent['parent_phone_tuteur']) : 'Aucun libelle'; ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Lien parenté du Tuteur </td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_lien_tuteur']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Autres personnes en charge de l'enfant </td>
                                        <td class="text-uppercase">  <?= (isset($parent)) ? esc($parent['parent_autre_personnee']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="timepicker">Statut visibilite:</label></td>
                                        <td class="text-uppercase">
                                            <span class="badge badge-info">
                                                <?= (isset($parent)) ? esc($parent['parent_statut']) : 'Aucun libelle'; ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Crée le</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_created_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Crée par</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_created_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour le</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_updated_at']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mise à jour par</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_updated_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supprimé le</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_deleted_at']) : 'Aucun libelle'; ?></td>
                                    </tr><tr>
                                        <td>Supprimé par</td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_deleted_by']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label for="commentaire_annee">Observation ou commentaire:</label></td>
                                        <td class="text-uppercase"><?= (isset($parent)) ? esc($parent['parent_comment']) : 'Aucun libelle'; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

             <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title text-uppercase">
                                Liste de ses enfants
                            </div>
                            
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Noms Elève</th>
                                        <th>Sexe</th>
                                        <th>promotion</th>
                                        <th>Année</th>
                                        <th>Inscription</th>
                                        <th>Etat</th>
                                        <th>Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody class="small">
                                    <?php
                                    $count = 1;
                                    if (isset($enfants) && !empty($enfants)):
                                        foreach ($enfants as $key => $value):
                                            $status = (!empty(esc($value['etudiant_statut'])) ? esc($value['etudiant_statut']) : 'inactif');
                                            ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>

                                                <td class="text-uppercase"><?= ($value['etudiant_matricule']); ?></td>
                                                <td class="text-uppercase"><?= ($value['etudiant_nom']); ?> <?= ($value['etudiant_postnom']); ?> <?= ($value['etudiant_prenom']); ?></td>
                                                <td class="text-uppercase"><?= ($value['etudiant_sexe']); ?></td>
                                                <td class="text-uppercase"><?= ($value['promotion_libelle']); ?> <?= ($value['cycle_libelle']); ?></td>
                                                <td class="text-uppercase"><?= ($value['annee_libelle']); ?></td>
                                                <td class="text-uppercase"><?= ($value['inscription_date']); ?></td>

                                                <td>
                                                    <a href="#">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td width="2px" class="text-center">
                                                    <a href="<?= base_url('etudiant/details/inscription/' . esc($value['etudiant_uid']) . '/' . esc($value['inscription_promotion_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-info-circle fa-2x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="9" class="text-uppercase">
                                                <strong>Aucun enfant </strong>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    </tbody>
                                
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
