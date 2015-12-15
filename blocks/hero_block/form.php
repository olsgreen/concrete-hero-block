<?php defined('C5_EXECUTE') or die("Access Denied.");

$background_type_attributes = array(
    'colour'    => t('Solid Colour'),
    'image'     => t('Image'),
    'parallax'  => t('Parallax Image'),
    'video'     => t('Video'),
);

$background_image_positions = array(
    'top'    => t('Top'),
    'center' => t('Center'),
    'bottom' => t('Bottom'),
);

$background_image_sizes = array(
    'auto' => t('Auto'),
    'cover'  => t('Cover'),
    'contain'    => t('Contain'),
);

$background_image_attachments = array(
    'scroll' => t('Scroll'),
    'fixed'  => t('Fixed'),
);


$yes_no_options =  array(
    '0' => t('No'),
    '1' => t('Yes'),
);

require 'forms/content.php';
require 'forms/background.php';
require 'forms/mask.php';
require 'forms/layout.php';

?>