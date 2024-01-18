
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/public/css/dashboard.css">
    <script src="<?php echo BASE_URL; ?>app/public/js/dashboard.js"></script>
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>app/public/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/public/css/master.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet">

</head>

<ul class="menu">

    <li title="home"><a href="<?php echo BASE_URL; ?>" class="fa fa-home">Home</a></li>
    <li title="search"><a href="<?php echo BASE_URL; ?>/add" class="fa fa-plus">Adicionar Noticia</a></li>
    <li title="about"><a href="<?php echo BASE_URL.'profile/'.$_SESSION['user_id']; ?>" class="active about">Conta</a></li>
    <li title="about"><a href="<?php echo BASE_URL.'dump/' ?>" class="fa fa-database">Exportar Banco</a></li>
    <li title="about"><a href="<?php echo BASE_URL; ?>logout" class="fa fa-sign-out">Logout</a></li>

</ul>

<ul class="menu-bar">
    <li title="home"><a href="<?php echo BASE_URL; ?>" class="fa fa-home">Home</a></li>
    <li title="search"><a href="<?php echo BASE_URL; ?>/add" class="fa fa-plus">Adicionar Noticia</a></li>
    <li title="about"><a href="<?php echo BASE_URL.'profile/'.$_SESSION['user_id']; ?>" class="active about">Conta</a></li>
    <li title="about"><a href="<?php echo BASE_URL.'dump/' ?>" class="fa fa-database">Exportar Banco</a></li>
    <li title="about"><a href="<?php echo BASE_URL; ?>logout" class="fa fa-sign-out">Logout</a></li>
</ul>


