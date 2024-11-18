<?php
//compression de donnees MySQL dqns PHP
//Si aucune compression n'a deja ete effectuee, lancee automatiquement
if (!ob_start("ob_gzhandler")) ob_start();
?>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= (isset($title)) ? $title : 'Management'; ?> - ESP-UNILU
    </title>
    <link rel="icon" type="image/png" href="<?= base_url('global/logo/favicon.png'); ?>"/>
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/bootstrap/css/bootstrap.css'); ?>"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('global/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('global/css/styles.css'); ?>">

</head>
<!--  background:RGB(0,0,40);  -->
<body style="background-image:url(<?= base_url('global/img/espbg.png'); ?>); 
background-size:cover; background-repeat:no-repeat; 
font-family: Roboto, Segoe UI, sans-serif!important;">
<?php
if (isset($_view) && $_view)
    echo view($_view);
?>

<script>
    function showPass() {
        let input = document.getElementById('password');
        let icon = document.getElementById('eyepass');
        let passmsg = document.getElementById('passmsg');
        if (input.type === 'password') {
            input.type = 'text';
            passmsg.innerText = 'Masquer le mot de passe';
            icon.classList.add('fa-eye');
            icon.classList.remove('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            passmsg.innerText = 'Afficher le mot de passe';
        }
    }
</script>
</body>
</html>
