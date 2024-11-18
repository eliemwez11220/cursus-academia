<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Années Académiques</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Années Académiques</li>
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
                                <h5 class="text-uppercase font-weight-bold">Liste des années</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvelle_annee"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle annee">
                                        <i class="fa fa-plus"></i> Nouvelle Année Académique
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Libellé</th>
                                        <th>Statut</th>
                                        <th>Ouverture</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $count = 1;
                                    if (isset($annees) && !empty($annees)):
                                        foreach ($annees as $key => $value):
                                            $status = (!empty(esc($value['annee_statut'])) ? esc($value['annee_statut']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['annee_code']); ?></td>
                                                <td class="text-uppercase"><?= ($value['annee_libelle']); ?></td>

                                                <td>
                                                    <a href="<?= base_url('ecole/changeStatus/annee/' . esc($status) . '/' . esc($value['annee_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= ($status == 'actif') ? 'Ouverte' : 'Fermee'; ?> </span>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= esc($value['annee_date_ouverture']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('ecole/editForm/annee/' . esc($value['annee_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('ecole/details/annees/' . esc($value['annee_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les details">
                                                <i class="fa fa-info-circle fa-2x"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-info">
                                            <td colspan="8" class="text-uppercase">
                                                <strong>Aucune donnée</strong>
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
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvelle_annee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lancement d'une nouvelle année</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $last_year = '';
            $new_year = '';
            $mounth = date('m');
            switch ($mounth) {
                case '07':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    break;
                case '08':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    break;
                case '09':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    break;
                case '10':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    break;
                case '12':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    break;
                default:
                    $last_year = date('Y') - 1;
                    $new_year = date('Y');
            }
            $school_year = $last_year . '-' . $new_year;
            //new code generated automatically
            $aleatoire_value = "0123456789";
            $new_code_generate = "ANN" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);

            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url() . '/ecole/lancerNouvelleAnneeScolaire/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="libelle_annee_scolaire_save" class="control-label">
                                <span class="text-danger">*</span> Année Académique
                                <span class="small">(Cette année a été généré automatiquement. Vous pouvez modifier manuellement
                                                                    en cas de besoin avant d'enregistrer pour son lancement)</span>
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="libelle_annee"
                                   id="libelle_annee_scolaire_save"
                                   value="<?= (!empty($school_year)) ? $school_year : set_value('libelle_annee') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="code_annee_scolaire" class="control-label">
                                <span class="text-danger">*</span> Code Année Académique
                                <span class="small">
                                    (Ce code a été généré automatiquement.
                                    Vous pouvez modifier manuellement en cas de besoin avant d'enregistrer)
                                </span>
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="code_annee"
                                   id="code_annee_scolaire"
                                   value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_annee') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Lancer l'année Académique</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
