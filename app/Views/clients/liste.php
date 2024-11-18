<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <filiere class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">Abonnement</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Liste &nbsp; des clients </h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element" data-backdrop="static" 
                                data-keyboard="false"
                                   href="#" class="btn btn-info btn-xs  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer un nouveau client">
                                        <i class="fa fa-plus"></i> Nouveau  &nbsp; client
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
                                        <th>Nom Client</th>
                                        <th>Email</th>
                                         <th>Téléphone</th>
                                        <th>Type</th>
                                       
                                        <th>Statut</th>
                                        <th width="1px">Edition</th>
                                        <th width="1px">Détails</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($clients) && !empty($clients)):
                                        foreach ($clients as $key => $value):
                                        $status = (! empty(esc($value['client_statut']))?esc($value['client_statut']):'inactif');
                                        ?>
                                        <tr class="small">
                                            <td><?= $count++; ?></td>
                                             <td class="text-uppercase"><?= esc($value['client_name']); ?></td>
                                            <td class="text-lowercase">
                                                <a href="mailto:<?= ($value['client_email']); ?>">
                                                    <?= ($value['client_email']); ?>
                                                </a>
                                            </td> <td class="text-uppercase"><?= ($value['client_phone']); ?></td>
                                            <td class="text-uppercase"><?= ($value['client_type']); ?></td>
                                           
                                            <td>
                                                <a href="<?= base_url('admin/changeStatus/client/'.esc($status).'/'.esc($value['client_uid'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) =='actif') ? 'badge-info':'badge-danger';?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td width="1px" class="text-center">
                                                <a href="<?= base_url('client/update/'.esc($value['client_uid'])); ?>" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                               <i class="fa fa-edit fa-2x"></i>
                                               </span>
                                                </a>
                                            </td>
                                            <td width="1px" class="text-center">
                                                <a href="<?= base_url('client/details/'.esc($value['client_uid'])); ?>"
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
<div class="modal fade" id="nouvel_element" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajout d'un nouveau client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
                //new code generated automatically
                $aleatoire_value = "0123456789";
                $new_code_generate = "c" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5)."c";
                $validation = \Config\Services::validation();
                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                echo form_open(base_url().'/client/saveAbonnement/create/', $attributes);
				
				//generate client password
				$password = $new_code_generate.'*Adm'.time();
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nom_client" class="control-label">
                                <span class="text-danger">*</span> Nom du client
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize"
                                   name="nom_client"
                                   id="nom_client"
                                   value="<?= set_value('nom_client') ?>"
                                   style="border-radius: 10px!important;" required
                            />
                        </div>
                    </div>
					<div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="type_client" class="control-label">
                                <span class="text-danger">*</span> Type client
                            </label>
                            <select class="select2  form-control" name="type_client" id="type_client">
                                <option disabled selected>-- Selectionnez --</option>
                                <option value="coordinateur">Coordonateur - Coordination</option>
                                <option value="promoteur">Promoteur - Ecoles Privées</option>  
                                <option value="entreprise">Entreprise - Ecoles Entreprises</option>
								<option value="gestionnaire">Gestionnaire - Ecoles Officielles</option>  
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="email_client" class="control-label">
                                <span class="text-danger"></span> Adresse mail du client
                            </label>
                            <input type="email"
                                   class="form-control text-lowercase"
                                   name="email_client"
                                   id="email_client"
                                   value="<?= set_value('email_client') ?>"
                                   style="border-radius: 10px!important;"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="phone_client" class="control-label">
                                <span class="text-danger"></span> Numéro téléphone du client
                            </label>
                            <input type="text"
                                   class="form-control text-capitalize"
                                   name="phone_client"
                                   id="phone_client"
                                   value="<?= set_value('phone_client') ?>"
                                   style="border-radius: 10px!important;"/>
                        </div>
                    </div>
               
                        <div class="col-lg-12 col-sm-12">
                           
                               
                                    <div class="alert alert-info text-center text-uppercase">
                                        <h5>
                                            <span class="fa fa-info-circle"> </span>
                                            Configurer le compte d'acces du client
                                        </h5>
                                    </div>
                                
                        
                            </div>
                       
                        <div class="col-lg-6 col-sm-6">
                           <label for="username" class="control-label">
                                <span class="text-danger">*</span> Identifiant de connexion client  (non modifiable)
                            </label>
                            <div class="input-group">
                                <input type="text" name="username" id="username" autocomplete="off"
                                       class="form-control-lg form-control"
                                       placeholder="Pseudo login"
                                       value="<?= (! empty($new_code_generate)) ? $new_code_generate : set_value('username'); ?>" required readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                     
                        <div class="col-lg-6 col-sm-6">
                             <label for="password" class="control-label">
                                <span class="text-danger">*</span> Mot de passe (non modifiable)
                              </label>
                            <div class="input-group">
                                <input type="text" name="password" id="password" autocomplete="off"
                                       class="form-control-lg form-control"
                                       placeholder="Creez un mot de passe" required value="<?= (! empty($password)) ? $password : set_value('username'); ?>" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="small text-danger text-center mt-2">
                            N.B: L'identifiant et le mot de passe ne doivent pas etre modifié. 
							Copiez puis envoyer au client correpondant soit le systeme devra envoyé directement 
							par mail a l'adresse qui sera indiquée
                        </h5>
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
