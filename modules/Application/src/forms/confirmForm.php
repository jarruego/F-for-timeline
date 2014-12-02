<?php
$confirm_form = array(
    'si' =>
    array(
        'name'          => 'si',
        'type'          => 'submit',
        'defaultValue'  => 'Si', 
        'label'         => '¿Esta seguro de que quiere borrarlo?',
        'placeholder'   => '',
        'validation'    => array( ),
        'filters'       => array(),
        
    ),
    'no' =>
    array(
        'name'          => 'no',
        'type'          => 'submit',
        'defaultValue'  => 'No', 
        'label'         => '',
        'placeholder'   => '',
        'validation'    => array( ),
        'filters'       => array(),
        
    ),
    'id' =>
    array(
        'name'          => 'id',
        'type'          => 'hidden',
        'defaultValue'  => '-1',
        'id'            => 'id',
        'label'         => '',
        'placeholder'   => '',
        'validation'    => array( 'number'),
        'filters'       => array('stripTrim', 'stripTags', 'escape'),
    ),
);