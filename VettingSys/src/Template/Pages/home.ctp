<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
</head>
<body class="home">
    <header>
        <div class="header-image">
            <?= $this->Html->link($this->Html->image('https://www.rightscon.org/past-events/assets/AccessNow_logo_whitewash.png',['width'=> 640] ),['controller' => 'pages', 'action' => 'display'], ['escape' => false]); ?>
            <h1>Vetting System</h1>
        </div>
    </header>
    <div id="content">
        <div class="row">
            <div class="columns large-12 ctp-warning checks">
                <?php
                echo $this->Html->link('Home' , ['controller' => 'pages', 'action' => 'display'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Users' , ['controller' => 'users', 'action' => 'index'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Clients' , ['controller' => 'clients', 'action' => 'index'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Organizations' , ['controller' => 'organizations', 'action' => 'index'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Vetting Records' , ['controller' => 'vetting', 'action' => 'index'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Advanced Search' , ['controller' => 'pages', 'action' => 'search'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Stats' , ['controller'=> 'stats' ,'action'=> 'showStats'], ['escape' => false]). '   |   ';
                ?>
                <ul class="right">
                    <?php if($loggedIn) : ?>
                       <?php
                        echo 'Hi,  ', $this->request->session()->read('Auth.User')['username'];
                        ?>
                        <li><?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']); ?></li>
                    <?php else : ?>
                        <li><?= $this->Html->link('Register', ['controller' => 'users', 'action' => 'register']); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="columns large-12 checks">
                <h4 align="center"> Quick Client Search</h4>

                <?php
               // $var = $_POST['Name'];
                echo $this->Form->create($page, ['type' => 'get','url' =>['controller'=> 'clients' ,'action'=> 'quicksearch']]);
                echo $this->Form->input('Name', array('placeholder' => 'Search by Name'));
                echo $this->Form->input('Email',array('placeholder' => 'Search by Email','type' => 'email'));
                echo $this->Form->submit('Search');
                echo $this->Form->end();
                ?>

            </div>
        </div>
    </div>
</body>
</html>
