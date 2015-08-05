<?php
class SetAdReply extends AppModel {
     public $useTable = 'axi_fxchng';

    public $schema = Array(
        'id' => array(
                'type' => 'string',
                'key' => 'primary'
            ),
        'doc_type' => array(
                'type' => 'string'
            ),
        'ad_id' => array(
                'type' => 'string'
            ),
        'ad_fb_id' => array(
                'type' => 'string'
            ),
        'sender_fb_id' => array(
                'type' => 'string'
            ),
        'name' => array(
                'type' => 'string'
            ),
        'mobile' => array(
                'type' => 'string'
            ),
        'email' => array(
                'type' => 'string'
            ),
        'message' => array(
                'type' => 'string'
            ),
        'created' => array(
            'type' => 'datetime'
            ),
        'created_timestamp' => array(
            'type' => 'biginteger'
            ),
        'primary_photo' => array (
            'type' => 'string'
            )
        );
}
?>