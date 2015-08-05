<?php
	class ItemPhoto extends AppModel {

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
                    'sm' => '78x65',
                    'md' => '400x400',
                    'big' => '800x800',
                    'hd' => '1024x768'
                 ),

                // Map the directory path to specified field in the table
                'fields' => array(
                    'dir' => 'image_folder'
                )
            ),
            'resume_file' => array(
                'fields' => array(
                    'dir' => 'resume_folder',
                    'type' => 'resume_type',
                    'size' => 'resume_size',
                )
            ),
        )
    );
	}
?>