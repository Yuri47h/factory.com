<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'manufactory' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Manufactory',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'storage' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Storage',
        'children' => array(
            'guest',          // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Admin',
        'children' => array(
            'manufactory', 
            'storage',     // позволим админу всё, что позволено manufactory и storage
        ),
        'bizRule' => null,
        'data' => null
    ),
);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

