<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration - Mois Scolaires</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Mois</li>
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
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp;  des mois</h5>
                            </div>
                             <!-- /.card-header
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle categorie">
                                        <i class="fa fa-plus"></i> Nouvelle  &nbsp; Categorie etudiants
                                    </span>
                                </a>
                            </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Libellé Mois</th>
                                        <th>Statut</th>
                                        <th>Crée le</th>
                                        <th>Modifié le</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($mois) && !empty($mois)):
                                    foreach ($mois as $key => $value):
                                    $status = (! empty(esc($value['mois_statut']))?esc($value['mois_statut']):'inactif');
                                    ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td class="text-uppercase"><?= esc($value['mois_libelle']); ?></td>
                                        <td>
                                            <a href="<?= base_url('finance/changeStatus/mois/'.esc($status).'/'.esc($value['mois_uid'])); ?>"
                                               onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) =='Actif') ? 'badge-info':'badge-danger';?> text-capitalize">
                                                            <?= $status; ?> </span>
                                            </a>
                                        </td>
                                        <td><?= esc($value['mois_created_at']); ?></td>
                                        <td><?= esc($value['mois_updated_at']); ?></td>
                                       
                                        <td class="text-center">
                                            <a href="<?= base_url('finance/changeStatus/mois/'.esc($status).'/'.esc($value['mois_uid'])); ?>"
                                               onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');" class="btn btn-xs btn-outline-danger">
                                                        <span class="text-capitalize">
                                                            <?= (esc($status) =='Actif') ? 'Masquer':'Afficher';?>  </span>
                                            </a>
                                        </td>
                                    </tr>
                                        
                                        <!-- end update year modal -->
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="alert alert-secondary small">
                                            <td colspan="4" class="text-uppercase">
                                                <strong>Aucune donnee</strong>
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
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajout d'une nouvelle catégorie d'étudiants</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            //new code generated automatically
            $aleatoire_value = "0123456789";
            $new_code_generate = "CCE" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open('ecole/saveCategorieetudiants/create/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="code_type_etudiant" class="control-label">
                                <span class="text-danger">*</span> Code catégorie étudiants
                                <span class="small">
                                    (Ce code a été généré automatiquement.
                                    Vous pouvez modifier manuellement en cas de besoin avant d'enregistrer)
                                </span>
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="code_type_etudiant"
                                   id="code_type_etudiant"
                                   value="<?= (!empty($new_code_generate)) ? $new_code_generate : set_value('code_type_etudiants') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="libelle_type_etudiants" class="control-label">
                                <span class="text-danger">*</span> Libellé categorie étudiants
                            </label>
                            <input type="text"
                                   class="form-control text-capitalize"
                                   name="libelle_type_etudiant"
                                   id="libelle_type_etudiants"
                                   value="<?= set_value('libelle_type_etudiant') ?>"
                                   style="border-radius: 10px!important;"
                                   required/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
