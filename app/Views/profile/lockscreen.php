<!-- Content Wrapper. Contains page content -->


        <div class="container mt-5 ">
            <div class="row">
                <div class="col-lg-3 col-sm-3"> </div>
                <div class="col-lg-6 col-sm-6">

  <div class="card mt-5 bg-secondary" style="border-radius: 10px!important;">
                            <div class="card-header d-inline">
                                <div class="card-title">
                                  <div class="float-left">
                                    <a href="#">
                                    <img style="height:70px;" src="<?= (session()->get('schoollogo') != '') ? session()->get('schoollogo') : site_url('global/logo/favicon.png'); ?>" alt="Logo">
                                  </a>
                                  </div>
                                </div>
                               
                                <div class="card-tools">
                                    <div class="float-right">
                                        <h5 class="d-none d-sm-block text-uppercase"><strong>
                                          <span class="small"><?= session()->schoolname; ?></span>
                                        </strong></h5>
                                        <div class="lockscreen-name">
    <h5 class="text-uppercase small font-weight-bold text-center"><?= session()->fullname; ?> | <?= session()->role; ?> </h5>
  </div>
                                    </div>
                                </div>
                            </div>
                           

  

  <!-- START LOCK SCREEN ITEM -->
  <div class="card-body">
    <?php if (isset(session()->failed) OR isset($failed)): ?>
    <div class="alert alert-danger">
        <h3 class="text-center small text-uppercase">
          <?= (! empty($failed))? $failed : session()->failed; session()->essai?>
          Nombre d'essaie : <?= session()->essai; ?>
        </h3>

     </div>
<?php endif; ?>
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?= (session()->get('avatar') != '') ? session()->get('avatar') : site_url('global/img/avatar.png'); ?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->
    <!-- lockscreen credentials (contains the form) -->
      <?php
        $attibustes = array('role' => 'form', 'autocomplete' => 'off');
        echo form_open(site_url('profile/retreiveSession'), $attibustes);
      ?>
    <div class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control bg-light" placeholder="Mot de passe" name="password" autofocus required>
        <div class="input-group-append">
          <button type="submit" class="btn"><i class="fas fa-arrow-circle-right text-muted"></i></button>
        </div>
      </div>
    </div>
    <?= form_close(); ?>
    <!-- /.lockscreen credentials -->
  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Entrer le mot de passe pour retrouver votre session 
  </div>
  <div class="text-center">
    <a href="<?= base_url('secure/signIn'); ?>" class="btn btn-default btn-s>
m" target="_blank">Ou ouvrir une autre session avec un compte different</a>
  </div>
 
 </div>
 </div>
  <!-- User name -->
</div>  
 <div class="col-lg-3 col-sm-3"> </div>
 <!-- /.row -->
 </div>
        </div><!--/. container-fluid -->
    