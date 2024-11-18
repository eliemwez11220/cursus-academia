
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- for hacker -->
    <?= csrf_meta() ?>
    <meta charset="utf-8">
    <!-- Locale --> <!-- To the Future  Meta Tags -->
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=6"/>
    <title><?= (isset($title)) ? $title : 'Home'; ?> - Eduschool ERP</title>
    <link rel="icon" type="image/png" href="<?= base_url('asstes/images/logo/ditotase.jpg'); ?>"/>
    <!-- ========== All CSS files linkup ========= -->
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('asstes/vendors/fontawesome/css/all.css'); ?>">
    <!-- Bootstrap Framework 5.1.3-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('asstes/vendors/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Custom stylesheet - for all changes-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('asstes/css/main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('asstes/css/custom.css'); ?>">
    
</head>
<!--  background:RGB(0,0,40); d-flex h-100 text-center bg-primary text-white -->
<body style="font-family: Roboto, Segoe UI, sans-serif!important;">
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <!-- d-flex h-100 bg-danger text-white -->
                <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-center bg-primary  text-white">
                    <div class="auth-form-transparent py-3 card-radius card shadow-lg">
                        <!--  text-left p-3 -->
                        <div class="text-center">
                            <div class="brand-logo">
                                <a href="<?= base_url(); ?>" class="btn">
                                   <span class="text-white display-5 text-uppercase fw-bold">
                                        Eduschool ERP
                                    </span>
                                </a>
                            </div>
                        </div>
                        <?php
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('secure/login'), $attributes);
                        ?>
                        <?= csrf_field() ?>
                        <div class="py-5 pl-1">
                            <div class="form-group">
                                <label for="username" class="d-none form-label text-uppercase mr-1">E-mail ou Pseudo</label>

                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0 left-radius">
                                            <i class="fas fa-user text-white"></i></span>
                                    </div>
                                    <input type="text" 
                                    class="fw-bold text-white form-control input-p-35 right-radius border-left-0 <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                           id="username" placeholder="E-mail ou Pseudo" name="username" value="<?= set_value('username'); ?>" autofocus>
                                </div>
                                <span class="text-danger"><?= displayFormError($validation, 'username'); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="password" class="d-none text-uppercase mr-1">Mot de passe</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0 left-radius">
                                            <i class="fas fa-lock text-white"></i>
                                        </span>
                                    </div>
                                    <input type="password"
                                           class="fw-bold text-white password form-control input-p-35 border-left-0 <?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>"
                                           id="password" placeholder="Mot de passe" name="password"
                                           value="<?= set_value('password'); ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent right-radius" id="inputGroupPrepend">
                                        <button title="Afficher Password" onclick="showPass();" type="button" class="btn" style="border:none!important;">
                                            <i id="eyepass" class="fas fa-eye text-white"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                                <span class="text-danger"><?= displayFormError($validation, 'password'); ?></span>
                            </div>
                           
                            <div class="row">
                                 <div class="col text-start float-left">
                                
                                <a href="<?= base_url('password/forgot'); ?>" 
                                class="btn mt-2 text-danger  btnrounded text-uppercase">
                                 Mot de passe oublié ?</a>
                             </div>
                            <div class="col text-right text-end float-right">
                                    <button title="Connexion" class="btn btn-primary btn-lg py-3 btnrounded" type="submit">
                                    Accéder au système
                                </button>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <hr>
                                <P>
                                   <strong>Eduschool ERP, </strong> est un produit logiciel basé sur le mode opératoire 
                                   des écoles oeuvrant dans en Répubique Démocratique du Congo suivant le programme 
                                   de l'enseignement édicté par le ministère de l'éducation. 
                                </P>
                                <p>
                                    &copy; <?= date('Y'); ?> <strong>Eduschool ERP, </strong> Tous droits réservés !
                                <br>
                        <span class="text-sm">
                            Powered by <a href="https://ditotase.com" rel="nofollow"
                                          target="_blank" class="btn btn-danger btn-sm">ditotase Inc.</a>
                        </span> 
                                </p>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!-- background/background-1.jpg -->
                <div class="col-lg-6 col-sm-12 d-flex flex-row">
                    <div class="w-100 h-100 flex-grow text-center">
                        <img title="Background" class="w-100 h-100"
                     style="background-size: cover!important; background-repeat: no-repeat!important;" 
                             src="<?= base_url('asstes/images/background/background-1.jpg'); ?>" alt="ditotase Background">
                    </div>
                </div>
            </div>
        </div><!-- content-wrapper ends -->
    </div><!-- page-body-wrapper ends -->
</div>

<script type="text/javascript" src="<?= base_url('asstes/vendors/sweetalert/sweetalert.js'); ?>"></script>
<script>
    <?php
    $message = (session()->success != '') ? session()->success : session()->failed;
    $messageIcon = (session()->failed != '') ? 'error' : 'success';
    //$biIcon = (session()->failed != '') ? 'fa-x-circle' : 'fa-check-circle';
    $messageColor = (session()->failed != '') ? 'red' : 'green';
    if (!empty($message)):?>
    let timerInterval;
    Swal.fire({
        position: 'bottom-end',
        //title: 'Notification',
        text: '<?= $message; ?>',
        html:
            '<span style="color:<?= $messageColor; ?>" class="h5"><i class="<?= $messageIcon; ?>"></i><?= $message; ?></span>,',
        showConfirmButton: true,
        confirmButtonColor: '#ef6603',
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    });
    <?php
    session()->remove('failed');
    session()->remove('success');
    endif;
    ?>
</script>

<script>
    function showPass() {
        let inputs = document.getElementsByClassName('password');
        let icon = document.getElementById('eyepass');
        let passmsg = document.getElementById('passmsg');
        for (const input of inputs) {
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.add('fa-eye-slash');
                icon.classList.remove('fa-eye');
            }
            else if (input.type === 'text') {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    }
</script>

</body>
</html>