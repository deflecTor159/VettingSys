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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <?php if($loggedIn) :
            echo  'Hi,  ', $this->request->session()->read('Auth.User')['username'];?>
                <br>
            <?= $this->Html->image('https://www.rightscon.org/past-events/assets/AccessNow_logo_whitewash.png',['width'=> 180] );
            endif; ?>
            </ul>
        <?php if($loggedIn) : ?>
        <div class="top-bar-section" align="left" >
                    <?php
                            echo $this->Html->link('Home' , ['controller' => 'pages', 'action' => 'display'], ['escape' => false]). '   |   ';
                            echo $this->Html->link('Users' , ['controller' => 'users', 'action' => 'index'], ['escape' => false]). '   |   ';
                            echo $this->Html->link('Clients' , ['controller' => 'clients', 'action' => 'index'], ['escape' => false]). '   |   ';
                            echo $this->Html->link('Organizations' , ['controller' => 'organizations', 'action' => 'index'], ['escape' => false]). '   |   ';
                            echo $this->Html->link('Vetting Records' , ['controller' => 'vetting', 'action' => 'index'], ['escape' => false]). '   |   ';
                            echo $this->Html->link('Advanced Search' , ['controller' => 'pages', 'action' => 'search'], ['escape' => false]). '   |   ';
                    echo $this->Html->link('Stats' , ['controller'=> 'stats' ,'action'=> 'showStats'], ['escape' => false]). '   |   ';
                            ?>
        </div>
        <div class="top-bar-section" align="right">
                        <li><?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']); ?></li>
                <?php else : ?>
                        <li><?= $this->Html->link('Register', ['controller' => 'users', 'action' => 'register']); ?></li>
                <?php endif; ?>
        </div>

    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
