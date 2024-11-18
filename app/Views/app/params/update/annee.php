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
                            <h5 class="font-weight-bold">Modification année scolaire <?= (isset($annee)) ? ($annee['annee_libelle']) : 'Aucun libelle'; ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Années Scolaires</li>
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
                    <?php
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('ecole/saveAnneeScolaire/update/' .(isset($annee) ? esc($annee['annee_uid']) :'')), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('ecole/view/annees'); ?>"
                                   class="btn btn-default btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-arrow-circle-left"></i> voir la liste
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-xs">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                       class="table table-sm  table-hover table-head-fixed">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th width="20%"> </th>
                                        <th width="80%"> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><label for="code_annee">Code Année</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control text-capitalize"
                                                   name="code_annee"
                                                   id="code_annee"
                                                   value="<?= (isset($annee)) ? esc($annee['annee_code']) : set_value('code_annee') ?>"
                                                   style="border-radius: 10px!important;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="annee_libelle">Libellé Année</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control text-capitalize"
                                                   name="libelle_annee"
                                                   id="annee_libelle"
                                                   value="<?= (isset($annee)) ? ($annee['annee_libelle']) : set_value('libelle_annee') ?>"
                                                   style="border-radius: 10px!important;"/>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><label for="date_debut_annee">Date d'ouveture de l'année:</label></td>
                                        <td>
                                            <div class="input-group date" id="date_debut_annee"
                                                 data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                       name="date_debut_annee"
                                                       id="date_debut_annee" data-target="#date_debut_annee"
                                                       value="<?= (isset($annee)) ? esc($annee['annee_date_ouverture']) :
                                                           set_value('date_debut_annee') ?>"/>
                                                <div class="input-group-append" data-target="#date_debut_annee"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="date_fin_annee">Date de clôture de l'année:</label></td>
                                        <td>
                                            <div class="input-group date" id="date_fin_annee"
                                                 data-target-input="nearest">
                                                <input type="text" name="date_fin_annee"
                                                       class="form-control datetimepicker-input"
                                                       data-target="#date_fin_annee" id="date_fin_annee"
                                                       value="<?= (isset($annee)) ? esc($annee['annee_date_cloture']) :
                                                           set_value('date_fin_annee') ?>"/>
                                                <div class="input-group-append" data-target="#date_fin_annee"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label for="commentaire_annee">Observation ou commentaire:</label></td>
                                        <td>
                                            <textarea name="commentaire_annee" class="form-control"
                                                      id="commentaire_annee" cols="30" rows="5"><?= (isset($annee)) ? ($annee['annee_comment']) :
                                                    set_value('commentaire_annee') ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <?= form_close(); ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </filiere>
    <!-- /.content -->
</div>
