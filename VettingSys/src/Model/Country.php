<?php
/**
 * Created by PhpStorm.
 * User: mcalderon
 * Date: 06/01/17
 * Time: 12:02 AM
 */

## /Model/.php

class Country extends AppModel {
    public $hasMany= array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'id_Country'
        )
    );
}