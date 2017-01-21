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
<html xmlns:float="http://www.w3.org/1999/xhtml">
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
                echo $this->Html->link('Vet Client' , ['controller' => 'pages', 'action' => 'Vetting'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Advanced Search' , ['controller' => 'pages', 'action' => 'search'], ['escape' => false]). '   |   ';
                echo $this->Html->link('Stats' , ['controller'=> 'stats' ,'action'=> 'showStats'], ['escape' => false]);
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
            <?php
            $mysqli = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");

            /* check connection */
            if ($mysqli->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            }

            $query = "call sp_getClientsTotal()";
            $result = $mysqli->query($query);
            if (!$result) {
                $message = 'Invalid query: ' . mysqli_connect_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $dataTotal[] = array(
                    "totalVetted" => $row["totalVetted"],
                    "totalNotVetted" => $row["totalNotVetted"]
                );
            }
            $totalVetted = $dataTotal[0]['totalVetted'];
            $totalNotVetted = $dataTotal[0]['totalNotVetted'];
            $totalClients = $totalVetted + $totalNotVetted;
            $mysqli->close();

            $mysqli1 = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");

            /* check connection */
            if ($mysqli1->connect_errno) {
                printf("Connect failed: %s\n", $mysqli1->connect_error);
                exit();
            }

            $query1 = "call sp_getOrgsTotal()";
            $result1 = $mysqli1->query($query1);
            if (!$result1) {
                $message1 = 'Invalid query: ' . mysqli_connect_error() . "\n";
                $message1 .= 'Whole query: ' . $query1;
                die($message1);
            }
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $dataTotal1[] = array(
                    "totalVetted" => $row1["totalVetted"],
                    "totalNotVetted" => $row1["totalNotVetted"]
                );
            }
            $totalVetted1 = $dataTotal1[0]['totalVetted'];
            $totalNotVetted1 = $dataTotal1[0]['totalNotVetted'];
            $orgsTotal = $totalVetted1 + $totalNotVetted1;
            $mysqli1->close();
            ?>
            <div class="columns large-12 checks">
                <h4 align="center"> STATS</h4>
                <h5 align="left" style="float: left"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    CLIENTS IN TOTAL: <?php echo $totalClients?></h5>
                <h5 align="right" >  ORGANIZATIONS IN TOTAL: <?php echo $orgsTotal ?>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h5>


            </div>
        </div>
    </div>


    <div class="charts1">
        <div id="piechartClients" style="float: left; width: 600px; height: 300px;"></div>
        <div id="piechartOrgs"  style="float: right; width: 600px; height: 300px;"></div>
    </div>
    <div class="charts2">
        <div id="piechartClientsXCountry" style="float: left; width: 600px; height: 300px;"></div>
        <div id="piechartOrgsXCountry" style="float: right; width: 600px; height: 300px;"></div>
    </div>
    <div class="charts3">
        <div id="piechartClientsNotXCountry" style="float: left; width: 600px; height: 300px;"></div>
        <div id="piechartOrgsNotXCountry" style="float: right; width: 600px; height: 300px;"></div>
    </div>

</body>
</html>
