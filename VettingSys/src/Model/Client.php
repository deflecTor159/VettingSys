<?php
/**
 * Created by PhpStorm.
 * User: mcalderon
 * Date: 06/01/17
 * Time: 12:02 AM
 */

## /Model/Article.php

class Client extends AppModel {
    public $hasOne= array(
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'id_Country'
        )
    );
}

?>