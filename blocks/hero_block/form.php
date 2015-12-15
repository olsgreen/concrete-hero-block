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

?>

<style>
    .tab-pane > fieldset:first-child {
        margin-top: 20px;
    }
</style>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#content" aria-controls="content" role="tab" data-toggle="tab"><?php echo t('Content'); ?></a></li>
        <li role="presentation"><a href="#background" aria-controls="background" role="tab" data-toggle="tab"><?php echo t('Background'); ?></a></li>
        <li role="presentation"><a href="#mask" aria-controls="mask" role="tab" data-toggle="tab"><?php echo t('Mask'); ?></a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><?php echo t('Settings / Layout'); ?></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <?php
            require 'forms/content.php';
            require 'forms/background.php';
            require 'forms/mask.php';
            require 'forms/layout.php';
        ?>
    </div>
</div>