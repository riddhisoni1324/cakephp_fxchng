<?php
class AdPost extends AppModel {

    public $useTable = 'axi_fxchng';

    public $schema = Array (
    'id' => array(
            'type' => 'string',
            'key' => 'primary',
            'length' => 50
        ),
    'doc_type' => array(
            'type' => 'string'
        ),
    'i_want_to'  => array(
            'type' => 'string'
        ),
    'job_type' => array(
            'type' => 'string'
        ),
    'condition' => array(
            'type' => 'string'
        ),
    'you_are/i_am' => array(
            'type' => 'string'
        ),
    'item_type' => array(
            'type' => 'string'
        ),

    'item_category' => array(
            'type' => 'string'
        ),

    'brand' => array(
            'type' => 'string'
        ),

    'jobs' => array(
            'type' => 'string'
        ),

    'auto_model' => array(
            'type' => 'string'
        ),

    'year'=> array(
            'type' => 'string'
        ),
    'kms_driven' => array(
            'type' => 'string'
        ),
    'fuel_type' => array(
            'type' => 'string'
        ),
    'valid_till' => array(
            'type' => 'string'
        ),
    'vehicle_type' => array(
            'type' => 'string'
        ),
    'event_date' => array(
            'type' => 'string'
        ),
    'venue' => array(
            'type' => 'string'
        ),
    'real_estate' => array(
            'type' => 'string'
        ),

    'title' => array(
            'type' => 'string'
        ),
    'description' => array(
            'type' => 'string'
        ),
    'price' => array(
            'type' => 'integer'
        ),
    'negotiable' => array(
            'type' => 'integer'
        ),
    'usage' => array(
            'type' => 'string'
        ),
    'is_deleted' => array(
            'type' => 'integer'
        ),
    'is_completed' => array(
            'type' => 'integer'
        ),
    'personal_info' => array(
            'type' => 'string'
        ),

    'created' => array(
            'type' => 'datetime'
        ),
    'modified' => array(
            'type' => 'datetime'
        ),
    'photo' => array (
            'type' => 'string'
        ),
     'primary_photo' => array (
            'type' => 'string'
        ),
    'resume' => array (
            'type' => 'string'
        ),
    'status' => array(
            'type' => 'string'
        ),
    'created_timestamp' => array(
            'type' => 'biginteger'
        ),
    'included' => array(
            'type' => 'string'
        ),
    'visitors' => array(
            'type' => 'integer'
        )
    );
}
?>