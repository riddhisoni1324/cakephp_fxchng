<?php
class ItemType extends AppModel {
	 var $belongsTo = array('Parent'=> array('className' => 'ItemType', 'foreignKey'=>'type_id'));
	 public $actsAs = array(
        'Upload.Upload' => array(

            // Field in the table which will store the path of the image
            'image_file' => array(

                // Allowed mime types
                'mimetypes'=> array('image/jpg','image/jpeg', 'image/png'),

                // Use php for localhost or where imagick is not installed
                'thumbnailMethod'=>"php",

                // Allowed set of extensions
                'extensions'=> array('jpg','png','JPG','PNG','jpeg','JPEG'),

                // Specify the thumbnail sizes
                'thumbnailSizes' => array(
                    'sm' => '50x50',
                 ),

                // Map the directory path to specified field in the table
                'fields' => array(
                    'dir' => 'image_folder'
                )
            )
        )
    );
}
?>