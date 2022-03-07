<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'S4T Services for Telecom';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'style', 'pictures']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="top-nav">
        <div class="top-nav-title" id="tn0">
            <a id="tn1" href="<?= $this->Url->build('/') ?>"><span>S4T</span> Services for Telecom</a>
            <!--<a id="tn2" href="<?= $this->Url->build('/') ?>"><span>Maciek</span> co buduje wieże</a>-->
        </div>
        <div class="top-nav-links">

            <?php
            $current_user = $this->request->getAttribute('identity');
            $isAdmin = $current_user['role'] == 'admin';
            $isBiurowy = $current_user['role'] == 'pracownik_biurowy';
            $isPolowy = $current_user['role'] == 'pracownik_polowy';
            ?>

            <?php if ($isAdmin) : ?>
                <?= $this->Html->link('Generuj pismo', ['controller' => 'pages', 'action' => 'index'], ['class' => 'button', 'style' => 'color: white']) ?>
                <?= $this->Html->link('Wieże', ['controller' => 'towers', 'action' => 'index']) ?>
                <span class="nav-item dropdown">
                    <span class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-family: Raleway, sans-serif; font-weight: 700; cursor: pointer ">
                        Uczestnicy projektu
                    </span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width: 170px; font-size: 1em">
                        <li><?= $this->Html->link('Inwestorzy', ['controller' => 'investors', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= $this->Html->link('Inspektorzy', ['controller' => 'inspectors', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= $this->Html->link('Kierownicy', ['controller' => 'managers', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= $this->Html->link('Przedstawiciele', ['controller' => 'representatives', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                    </ul>
                </span>
                <?= $this->Html->link('Wzory pism', ['controller' => 'templates', 'action' => 'index']) ?>
                <?= $this->Html->link('Zdjęcia', ['controller' => 'uploads']) ?>
                <?= $this->Html->link('Dokumenty', ['controller' => 'documents', 'action' => 'index']) ?>
                <br>
                <?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], ['style' => 'float: right']) ?>
                <?= $this->Html->link('Użytkownicy', ['controller' => 'users', 'action' => 'index'], ['style' => 'float: right']) ?>
            <?php endif; ?>

            <?php if ($isBiurowy) : ?>
                <?= $this->Html->link('Generuj pismo', ['controller' => 'pages', 'action' => 'index'], ['class' => 'button', 'style' => 'color: white']) ?>
                <?= $this->Html->link('Wieże', ['controller' => 'towers', 'action' => 'index']) ?>
                <span class="nav-item dropdown">
                    <span class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-family: Raleway, sans-serif; font-weight: 700; cursor: pointer ">
                        Uczestnicy projektu
                    </span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width: 170px; font-size: 1em">
                        <li><?= $this->Html->link('Inwestorzy', ['controller' => 'investors', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= $this->Html->link('Inspektorzy', ['controller' => 'inspectors', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= $this->Html->link('Kierownicy', ['controller' => 'managers', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= $this->Html->link('Przedstawiciele', ['controller' => 'representatives', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                    </ul>
                </span>
                <?= $this->Html->link('Wzory pism', ['controller' => 'templates', 'action' => 'index']) ?>
                <?= $this->Html->link('Zdjęcia', ['controller' => 'uploads']) ?>
                <?= $this->Html->link('Dokumenty', ['controller' => 'documents', 'action' => 'index']) ?>
                <br>
                <?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], ['style' => 'float: right']) ?>
                <?= $this->Html->link('Profil', ['controller' => 'users', 'action' => 'edit', $current_user['id']], ['style' => 'float: right']) ?>
            <?php endif; ?>

            <?php if ($isPolowy) : ?>
                <?= $this->Html->link('Zdjęcia', ['controller' => 'uploads'], ['class' => 'button', 'style' => 'color: white']) ?>
                <?= $this->Html->link('Wieże', ['controller' => 'towers', 'action' => 'index']) ?>
                <?= $this->Html->link('Dokumenty', ['controller' => 'documents', 'action' => 'index']) ?>
                <br>
                <?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], ['style' => 'float: right']) ?>
                <?= $this->Html->link('Profil', ['controller' => 'users', 'action' => 'edit', $current_user['id']], ['style' => 'float: right']) ?>
            <?php endif; ?>

        </div>
    </nav>
    <main class="main">
        <div class="container" id="cont">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <!--<div id="obrazekmacka">
            <img src="webroot/img/maciek1.jpg" alt="Jestem Maciek">
        </div>-->
    </main>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="webroot/js/dodatkowyskrypt.js"></script>
    <?= $this->Html->script('pictures'); ?>

</body>

</html>