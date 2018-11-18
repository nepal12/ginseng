<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo URLROOT; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>css/style.css" rel="stylesheet">
    <title><?php echo SITENAME;?></title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark rounded bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo URLROOT;?>">Ginseng</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT;?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT;?>reservation">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT;?>shares">Shareboard</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Members</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="<?php echo URLROOT. 'users/login'; ?>">Login</a>
                    <a class="dropdown-item" href="<?php echo URLROOT. 'users/register';?>">Regster</a>
                    
                    </div>
                </li>
                </ul>
                
            </div>
        </div>
    </nav>
    <!--End of Nav-->
</div>