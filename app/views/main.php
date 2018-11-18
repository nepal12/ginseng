<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo URLROOT; ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/css/style.css" rel="stylesheet">
    <title><?php echo SITENAME;?></title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark rounded bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo ROOT_URL;?>">Ginseng</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL;?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL;?>">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL;?>shares">Shareboard</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-3">
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="<?php echo ROOT_URL;?>users">Member</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--End of Nav-->
</div>
    <?php require $view;?>
<h1> This is the new view template</h1>

<script src="<?php echo URLROOT; ?>/js/jquery-3.3.1.slim.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/bootstrap.js"></script>
<script src="<?php echo URLROOT; ?>/js/main.js"></script>

</body>
</html>