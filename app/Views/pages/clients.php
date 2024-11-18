<?php
    $validation = \Config\Services::validation();
    $session = \Config\Services::session();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
    <filiere class="content">
        <div class="container-fluid">
			<div class="form-holder has-shadow mt-5">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card mt-5" style="border-radius: 10px!important;">
                            <div class="card-header">
								<h3 class="card-title text-uppercase font-weight-bold">S'abonner à l'application Eduschool</h3>
                            </div>
                            <div class="card-body">
								<h5 class="text-uppercase">Comment ça marche</h5>
								<p>
									Pour s'abonner, veuillez remplir le formulaire ci-dessous afin de créer la fiche de votre 
									école en saisissant les informations requises. Une fois valider votre fiche, le système
									va confirmer votre abonnement.
								</p>
								<p>
									Si votre abonnement est validé, le système vous dira ce qui va suivre afin de terminer 
									le processus complet.
									Si vous rencontrez de difficulter lors de l'inscription, veuillez consulter la page 
									<a href="<?= base_url('p/contact') ?>"> contact </a> pour discuter avec un expert.
								</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<div class="card">
            <div class="card-body">
			<?php
                //new code generated automatically
                
				$validation = \Config\Services::validation();
                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                echo form_open(base_url('page/register'), $attributes);
            ?>
                <div class="row">
				<div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="libelle_ecole" class="control-label">
                                            <span class="text-danger">*</span> Nom Ecole
                                        </label>
                                        <input type="text"
                                               class="form-control bg-light text-capitalize 
											   <?php if ($validation->hasError('libelle_ecole')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="libelle_ecole"
                                               id="libelle_ecole"
                                               value="<?= set_value('libelle_ecole') ?>" />
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'libelle_ecole'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="coordination_ecole" class="control-label">
                                            <span class="text-danger">*</span> Réseaux
                                        </label>
                                        <select id="coordination_ecole" name="coordination_ecole"
                                                class="form-control select2 select2-info text-capitalize <?php if ($validation->hasError('coordination_ecole')) {
                                                    echo 'is-invalid';
                                                } ?>" 
                                                data-dropdown-css-class="select2-info" required>
                                            <option selected="selected" disabled>-- Sélectionnez Réseau--
                                            </option>
                                            <?php
                                            $count = 1;
                                            if (isset($coordinations) && !empty($coordinations)):
                                                foreach ($coordinations as $key => $value): ?>
                                                    <option value="<?= esc($value['coordination_uid']); ?>" <?= set_select('coordination_ecole', esc($value['coordination_uid'])); ?>>
                                                        <?= ucfirst(esc($value['coordination_libelle'])); ?></option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun Réseau</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'coordination_ecole'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
								<div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="typeens_sid_ecole" class="control-label">
                                            <span class="text-danger">*</span> Type Enseignement
                                        </label>
                                        <select id="typeens_sid_ecole" name="typeens_sid"
										    data-dropdown-css-class="select2-info"
                                                class="form-control select2 select2-info text-capitalize 
												<?php if ($validation->hasError('typeens_sid')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                            <option selected="selected" disabled>-- Sélectionnez type --
                                            </option>
                                            <?php
                                            $count = 1;
                                            if (isset($typesens) && !empty($typesens)):
                                                foreach ($typesens as $key => $value): ?>
                                                    <option value="<?= esc($value['typesens_uid']); ?>" <?= set_select('typeens_sid', esc($value['typesens_uid'])); ?>>
                                                        <?= ucfirst(esc($value['typesens_libelle'])); ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun type </option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'typeens_sid'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="typeecole_sid" class="control-label">
                                            <span class="text-danger">*</span> Type Ecole
                                        </label>
                                        <select id="typeecole_sid" name="typeecole_sid"
                                                class="form-control select2 select2-info text-capitalize 
												<?php if ($validation->hasError('typeecole_sid')) {
                                                    echo 'is-invalid';
                                                } ?>" 
                                                data-dropdown-css-class="select2-info" required>
                                            <option selected="selected" disabled>-- Sélectionnez type ecole--</option>
                                            <?php
                                            $count = 1;
                                            if (isset($typesecoles) && !empty($typesecoles)):
                                                foreach ($typesecoles as $key => $value): ?>
                                                    <option value="<?= esc($value['typesecole_uid']); ?>" <?= set_select('typecole_sid', esc($value['typesecole_uid'])); ?>>
                                                        <?= ucfirst(esc($value['typesecole_libelle'])); ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <option>Aucun type</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'typecole_sid'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                        
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nom_client" class="control-label">
                                <span class="text-danger">*</span> Votre Nom
                            </label>
                            <input type="text"
                                   class="form-control bg-light text-capitalize 
								   <?php if ($validation->hasError('nom_client')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                   name="nom_client"
                                   id="nom_client"
                                   value="<?= set_value('nom_client') ?>"
                            />
							<?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'nom_client'); ?>
                                            </span>
                                        <?php endif; ?>
                        </div>
                    </div>
					<div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="type_client" class="control-label">
                                <span class="text-danger">*</span> Votre profil
                            </label>
                            <select class="select2  form-control <?php if ($validation->hasError('type_client')) {
                                                   echo 'is-invalid';
                                               } ?>" name="type_client" id="type_client">
                                <option disabled selected>-- Selectionnez un profil--</option>
                                <option value="coordonateur">Coordonateur - Coordination</option>
                                <option value="promoteur">Promoteur - Ecoles Privées</option>  
                                <option value="gestionnaire">Gestionnaire - Ecoles Entreprises</option>
								<option value="gestionnaire">Directeur - Ecoles Officielles</option>
                            </select>
							<?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'type_client'); ?>
                                            </span>
                                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="email_client" class="control-label">
                                <span class="text-danger">*</span> Votre Adresse mail
                            </label>
                            <input type="email"
                                   class="form-control text-lowercase 
								   <?php if ($validation->hasError('email_client')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                   name="email_client"
                                   id="email_client"
                                   value="<?= set_value('email_client') ?>" />
								   <?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'email_client'); ?>
                                            </span>
                                        <?php endif; ?>
                        </div>
                    </div>
                    
					
								
                   
                    </div>
            </div>
            <div class="card-footer text-center">
				<div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="terms_users" name="terms_users" 
						class="<?php if ($validation->hasError('terms_users')) {
                                                   echo 'is-invalid';
                                               } ?>">
                        <label for="terms_users">
                          En cliquant sur le bouton ci-dessous, vous acceptez nos 
						  <a href="<?= base_url('p/conditions') ?>"> conditions d'utilisation </a> et notre 
						   <a href="<?= base_url('p/privacypolicy') ?>"> politique de confidentialité. </a>
                        </label>
                   
					<?php if (isset($validation)): ?>
                                            <span class="invalid-feedback">
                                                <?= display_validation_error($validation, 'terms_users'); ?>
                                            </span>
                                        <?php endif; ?>
										</div>
                </div>
                <button type="submit" class="btn btn-info btn-lg text-uppercase">Inscrire mon école</button>
            </div>
            <?php echo form_close(); ?>
        </div>
		</div>
    </div>
</filiere>
</div>