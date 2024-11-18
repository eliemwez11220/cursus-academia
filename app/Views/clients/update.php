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
                            <h5 class="font-weight-bold">Modification Client <?= (isset($client)) ? esc($client['client_name']) :'' ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Clients</li>
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
                    echo form_open_multipart(base_url() . '/client/saveAbonnement/update/'.(isset($client) ? esc($client['client_uid']): ''), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                
                                    <a href="<?= base_url('client'); ?>"
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
                                        <th width="20%"></th>
                                        <th width="80%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td><label for="client_name"> <span class="text-danger">*</span> Nom Client</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="nom_client"
                                                   id="client_name"
                                                   value="<?= (isset($client)) ? ($client['client_name']) :set_value('nom_client') ?>"
                                                   style="border-radius: 10px!important;"
                                                   required/>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <label for="client_type" class="control-label">
                                <span class="text-danger">*</span> Type client
                            </label>
                                        </td>
                                        <td>
                                             <div class="form-group">
                            
                            <select class="select2  form-control" name="type_client" id="client_type">
                                <option disabled >-- Selectionnez --</option>
                                <option selected value="<?= (isset($client)) ? ($client['client_type']) :''?>">
                                    <?= (isset($client)) ? ($client['client_type']) :''?>
                                </option>

                                <option value="coordinateur">Coordinateur - Coordination</option>
                                <option value="promoteur">Promoteur - Ecoles Privees</option>  
                                <option value="entreprise">Entreprise - Ecoles Entreprises</option>
                            </select>
                        </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td><label for="client_email">Email du client</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                            <input type="text"
                                                   class="form-control bg-light text-lowercase"
                                                   name="email_client"
                                                   id="client_email"
                                                   value="<?= (isset($client)) ? esc($client['client_email']) :set_value('email_client') ?>"
                                                   />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="client_phone">Numero Téléphone Client</label></td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone_client" id="client_phone"
                                                       data-inputmask='"mask": "+243999999999"'
                                                       data-mask placeholder="Ex: 858533285"
                                                       value="<?= (isset($client)) ? esc($client['client_phone']) :set_value('phone_client') ?>" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="client_city">Ville du client</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="client_city"
                                                   id="client_city"
                                                   value="<?= (isset($client)) ? esc($client['client_city']) :set_value('client_city') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="client_country">Province du client</label></td>
                                        <td>
                                            <input type="text"
                                                   class="form-control bg-light text-capitalize"
                                                   name="client_country"
                                                   id="client_country"
                                                   value="<?= (isset($client)) ? esc($client['client_country']) :set_value('client_country') ?>"
                                                   style="border-radius: 10px!important;"
                                                   />
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <td><label for="client_address">Adresse Physique:</label></td>
                                        <td>
                                            <textarea name="client_address" class="form-control"
                                                      id="client_address" cols="30" rows="5"><?= (isset($client)) ? esc($client['client_address']) :set_value('client_address') ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="client_comment">Observation ou commentaire:</label></td>
                                        <td>
                                            <textarea name="client_comment" class="form-control"
                                                      id="client_comment" cols="30" rows="5"><?= (isset($client)) ? esc($client['client_comment']) :set_value('client_comment') ?></textarea>
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
