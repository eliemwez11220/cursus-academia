<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Administration - Niveau Type d'accès</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Type d'accès</li>
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
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp; des accès</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer un nouveau groupe">
                                        <i class="fa fa-plus"></i> Nouveau  &nbsp; type d'accès
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
                                        <th>Libellé ou Objet Accès</th>
                                        <th>Mode Accès</th>
                                        <th>Date Ajout</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($acces) && !empty($acces)):
                                        foreach ($acces as $key => $value):
                                            $status = (!empty(esc($value['acces_status'])) ? esc($value['acces_status']) : 'inactif');
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase">
                                                    <?php
                                                    $objet = esc($value['acces_objet']);
                                                    switch ($objet):
                                                        case "dossiers": echo 'Dossiers Elèves';
                                                        break;case "cotes": echo 'Cotes & Epreuves';
                                                        break;case "branches": echo 'Branches & Matières';
                                                        break;case "personnels": echo 'Personnel';
                                                        break;case "finances": echo 'Finances';
                                                        break;case "communications": echo 'Communications';
                                                        break;case "configurations": echo 'Configuration';
                                                        break;case "administrations": echo 'Administration';
                                                        break;case "rapports": echo 'Rapports';
                                                        break;case "publications": echo 'Publication';
                                                        break;case "etudes": echo 'Etudes en ligne';
                                                        break;
                                                        default: echo "Accès a tous les modules";
                                                        break;
                                                    ?>

                                                    <?php endswitch;?>

                                                </td>
                                                <td>
                                                    <a href="<?= base_url('admin/changeStatus/acces/' . esc($status) . '/' . esc($value['acces_uid'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= (esc($status) == 'actif') ? 'accordé' : 'refusé'; ?> </span>
                                                    </a>
                                                </td>
                                                <td><?= esc($value['acces_created_at']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a data-toggle="modal"
                                                       data-target="#update_<?= $count; ?>"
                                                       href="#" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                                </td>
                                                <td width="1px" class="text-center">
                                                    <a href="<?= base_url('admin/details/access/' . esc($value['acces_uid'])); ?>"
                                                       class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les Dètails">
                                                <i class="fa fa-info-circle fa-2x"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- update year modal -->
                                            <div class="modal fade" id="update_<?= $count; ?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">

                                                            <h4 class="modal-title d-inline-flex text-uppercase font-weight-bold">
                                                                Modification
                                                                accès <?= esc($value['acces_libelle']); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                        <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <?php
                                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                        echo form_open('admin/saveAccess/update/' . esc($value['acces_uid']), $attributes);
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="objet_acces" class="control-label">
                                                                            <span class="text-danger">*</span> Nom ou Libellé Objet Module
                                                                        </label>
                                                                        <select id="objet_acces" name="objet_acces"
                                                                                class="form-control select2 select2-info"
                                                                                data-dropdown-css-class="select2-info">
                                                                            <option disabled>-- Selectionnez un objet --</option>

                                                                            <option value="dossiers" <?= (esc($value['acces_objet']) == 'dossiers')?"selected":''?>>Dossiers Elèves</option>
                                                                            <option value="cotes" <?= (esc($value['acces_objet']) == 'cotes')?"selected":''?>>Cotes & Epreuves</option>
                                                                            <option value="branches" <?= (esc($value['acces_objet']) == 'branches')?"selected":''?>>Branches & Matières</option>
                                                                            <option value="personnels" <?= (esc($value['acces_objet']) == 'personnels')?"selected":''?>>Personnels</option>
                                                                            <option value="finances" <?= (esc($value['acces_objet']) == 'finances')?"selected":''?>>Finances</option>
                                                                            <option value="configurations" <?= (esc($value['acces_objet']) == 'configurations')?"selected":''?>>Configuration</option>
                                                                            <option value="administrations" <?= (esc($value['acces_objet']) == 'administrations')?"selected":''?>>Administration</option>
                                                                            <option value="rapports" <?= (esc($value['acces_objet']) == 'rapports')?"selected":''?>>Rapports</option>
                                                                            <option value="communications" <?= (esc($value['acces_objet']) == 'communications')?"selected":''?>>Communications</option>
                                                                            <option value="publications" <?= (esc($value['acces_objet']) == 'publications')?"selected":''?>>Publication</option>
                                                                            <option value="etudes" <?= (esc($value['acces_objet']) == 'etudes')?"selected":''?>>Etudes en ligne</option>
                                                                            <option value="all" <?= (esc($value['acces_objet']) == 'all')?"selected":''?>>Tous les modules</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="observation_acces"
                                                                               class="control-label">
                                                                            <span class="text-danger"></span>
                                                                            observation ou commentaire de l'accès
                                                                        </label>
                                                                        <textarea name="observation_acces"
                                                                                  class="form-control text-capitalize"
                                                                                  id="observation_acces" cols="30"
                                                                                  rows="5"><?= (!empty(esc($value['acces_observation']))) ? esc($value['acces_observation']) : old('observation_acces') ?></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit"
                                                                    class="btn btn-info btn-sm text-uppercase">
                                                                Enregistrer les modifications
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                    data-dismiss="modal">Fermer
                                                            </button>
                                                        </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end update year modal -->
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
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-uppercase">Ajout d'un nouveau type d'accès</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open('admin/saveAccess/create/', $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="objet_acces" class="control-label">
                                <span class="text-danger">*</span> Nom ou Libellé Objet Module
                            </label>
                            <select id="objet_acces" name="objet_acces"
                                    class="form-control select2 select2-info"
                                    data-dropdown-css-class="select2-info">
                                <option disabled selected>-- Sélectionnez un objet --</option>
                                <option value="dossiers">Dossiers Elèves</option>
                                <option value="cotes">Cotes & Epreuves</option>
                                <option value="branches">Branches & Matières</option>
                                <option value="personnels">Personnels</option>
                                <option value="finances">Finances</option>
                                <option value="communications">Communications</option>
                                <option value="configurations">Configuration</option>
                                <option value="administrations">Administration</option>
                                <option value="rapports">Rapports</option>
                                <option value="publications">Publication</option>
                                <option value="etudes">Etudes en ligne</option>
                                <option value="all">Tous les modules</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="observation_acces" class="control-label">
                                <span class="text-danger"></span> Commentaire sur l'accès
                            </label>
                            <textarea name="observation_acces" class="form-control text-capitalize"
                                      id="observation_acces" cols="30"
                                      rows="5"><?= old('observation_acces') ?></textarea>
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
