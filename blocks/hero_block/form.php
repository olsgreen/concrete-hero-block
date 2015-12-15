<?php
defined('C5_EXECUTE') or die("Access Denied.");

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
    #s2id_content_animation_class {
        border: 1px solid #ccc;
    }
</style>
<!-- Content !-->
<fieldset>

    <legend><?php echo t('Content')?></legend>

    <!-- Content Editor !-->
    <div class="form-group">
        <?php echo $form->label('content', t('Content:'));?>
        <?php
        $editor = Core::make('editor');
        echo $editor->outputBlockEditModeEditor('content', $content);
        ?>
    </div>

    <!-- Stack Selector !-->
    <div class="form-group">
        <?php echo $form->label('stack_id', t('Also the content from the stack:'))?>
        <?php echo $form->select('stack_id', array('none' => t('None')) + array(), $stack_id); ?>
    </div>

    <?php if(defined('CSS3_ANIMATION_PACKAGE')) { ?>
        <!-- Content Animation !-->
        <div class="form-group">
            <div>
                <?php echo t('Content Load Animation')?>
                <input type="text" name="content_animation_class" id="content_animation_class" class="form-control" value="<?php echo $content_animation_class; ?>">
                <script>
                    $("#content_animation_class").select2({tags:window.cssAnimationsPackage.animations, separator: " "});
                </script>
            </div>
        </div>
    <?php } ?>

</fieldset>

<!-- Background !-->
<fieldset>

    <legend><?php echo t('Background')?></legend>

    <!-- Background Type !-->
    <div class="form-group">
        <?php echo $form->label('background_type', t('Type'))?>
        <?php echo $form->select('background_type', $background_type_attributes, $background_type); ?>
    </div>

    <!-- Image !-->
    <div class="form-group">
        <?php echo $form->label('image_file_id', t('Image'))?>
        <?php echo $al->image('ccm-a-image', 'image_file_id', t('Choose Image'), $image_file);?>
    </div>

    <!-- Background Position !-->
    <div class="form-group">
        <?php echo $form->label('background_image_position', t('Background Position'))?>
        <?php echo $form->select('background_image_position', $background_image_positions, $background_image_position); ?>
    </div>

    <!-- Background Size !-->
    <div class="form-group">
        <?php echo $form->label('background_image_size', t('Background Size'))?>
        <?php echo $form->select('background_image_size', $background_image_sizes, $background_image_size); ?>
    </div>

    <!-- Background Attachment !-->
    <div class="form-group">
        <?php echo $form->label('background_image_attachment', t('Background Attachment'))?>
        <?php echo $form->select('background_image_attachment', $background_image_attachments, $background_image_attachment); ?>
    </div>

    <!-- Video !-->
    <div class="form-group">
        <?php echo $form->label('video_url', t('Video Url'))?>
        <div class="input-group">
            <input type="text" name="video_url" id="video_url" class="form-control" value="<?php echo $video_url; ?>" placeholder="http://mysite.com/myvideo.mp4">
            <a href="#" data-action="choose-image-from-file-manager" class="btn btn-default input-group-addon">
                <i class="fa fa-search"></i>
            </a>
        </div>
        <script>
            $('a[data-action=choose-image-from-file-manager]').on('click', function(e) {
                e.preventDefault();
                ConcreteFileManager.launchDialog(function(data) {
                    jQuery.fn.dialog.showLoader();
                    ConcreteFileManager.getFileDetails(data.fID, function(r) {
                        jQuery.fn.dialog.hideLoader();
                        var file = r.files[0];
                        $('#video_url').val(file.url);
                    });
                }, { filters: [{field: 'type', type: 2}] });
            });
        </script>
    </div>

    <!-- Colour !-->
    <div class="form-group">
        <?php echo $form->label('background_colour', t('Colour'))?>
        <?php echo Loader::helper('form/color')->output('background_colour', $background_colour);?>
    </div>

</fieldset>

<!-- Mask !-->
<fieldset>

    <legend><?php echo t('Mask')?></legend>

    <!-- Mask Colour !-->
    <div class="form-group">
        <?php echo $form->label('mask_colour', t('Colour'))?>
        <?php echo Loader::helper('form/color')->output('mask_colour', $mask_colour);?>
    </div>

    <!-- Mask Colour Opacity !-->
    <div class="form-group">
        <?php echo $form->label('mask_colour_opacity', t('Colour Opacity') . ' (' . ($mask_colour_opacity ? $mask_colour_opacity : 100) . '%)')?>
        <div>
            <div class="hero-slider"></div>
            <span>
                <input type="hidden" name="mask_colour_opacity" id="mask_colour_opacity" class="ccm-inline-style-slider-value" value="<?php echo $mask_colour_opacity ? $mask_colour_opacity : '100' ?>" autocomplete="off" />
            </span>
        </div>
        <script>
            $(function () {
                $('.hero-slider').slider({
                    min: 0,
                    max: 100,
                    value: '<?php echo $mask_colour_opacity ? $mask_colour_opacity : 100; ?>',
                    slide: function( event, ui ) {
                        $('#mask_colour_opacity').val(ui.value);
                        $('label[for="mask_colour_opacity"]').html('<?php echo t("Colour Opacity"); ?>' + ' (' + ui.value + '%)');
                    }
                });
            });
        </script>
    </div>

    <hr>

    <!-- Mask Image !-->
    <div class="form-group">
        <?php echo $form->label('mask_image_file_id', t('Image'))?>
        <?php echo $al->image('ccm-b-image', 'mask_image_file_id', t('Choose Image'), $mask_image_file);?>
    </div>

    <!-- Mask Image Repeat !-->
    <div class="form-group">
        <?php echo $form->label('mask_image_repeat', t('Image Repeat'))?>
        <?php echo $form->select('mask_image_repeat', array('none' => t('None'), 'repeat' => t('Repeat')), $mask_image_repeat); ?>
    </div>

    <!-- Mask Image Position !-->
    <div class="form-group">
        <?php echo $form->label('mask_image_position', t('Mask Image Position'))?>
        <?php echo $form->select('mask_image_position', $background_image_positions, $mask_image_position); ?>
    </div>

    <!-- Mask Image Size !-->
    <div class="form-group">
        <?php echo $form->label('mask_image_size', t('Mask Image Size'))?>
        <?php echo $form->select('mask_image_size', $background_image_sizes, $mask_image_size); ?>
    </div>

    <!-- Mask Image Attachment !-->
    <div class="form-group">
        <?php echo $form->label('mask_image_attachment', t('Mask Image Attachment'))?>
        <?php echo $form->select('mask_image_attachment', $background_image_attachments, $mask_image_attachment); ?>
    </div>

</fieldset>

<!-- Layout Options !-->
<fieldset>

    <legend><?php echo t('Layout Options')?></legend>

    <!-- Constrain mask to stage !-->
    <div class="form-group">
        <?php echo $form->label('fill_screen', t('Fill Screen'))?>
        <?php echo $form->select('fill_screen', $yes_no_options, $fill_screen); ?>
    </div>

    <!-- Min Height !-->
    <div class="form-group row">

        <div class="col-xs-12">
            <?php echo $form->label('fill_screen_offset', t('Fill Screen Offset'))?>
        </div>

        <div class="col-xs-2">
            <div class="input-group">
                <?php echo $form->text('fill_screen_offset', $fill_screen_offset); ?>
                <div class="input-group-addon">px</div>
            </div>
        </div>

    </div>

    <!-- Min Height !-->
    <div class="form-group row">

        <div class="col-xs-12">
            <?php echo $form->label('min_height', t('Minimum Height'))?>
        </div>

        <div class="col-xs-2">
            <div class="input-group">
                <?php echo $form->text('min_height', $min_height); ?>
                <div class="input-group-addon">px</div>
            </div>
        </div>
    </div>

    <!-- Center Content !-->
    <div class="form-group">
        <?php echo $form->label('center_content', t('Vertically Center Content'))?>
        <?php echo $form->select('center_content', $yes_no_options, $center_content); ?>
    </div>

    <!-- Use Container for Content !-->
    <div class="form-group">
        <?php echo $form->label('content_container', t('Use Container Class for Content ?'))?>
        <?php echo $form->select('content_container', $yes_no_options, $content_container); ?>
    </div>

</fieldset>


<script type="text/javascript">
    $(function() {

        $('select[name=background_type]').change(function(event) {

            $('label[for=image_file_id], label[for=background_image_position], label[for=video_file_id], label[for=background_colour]').parent().hide();

            if ('colour' === $(this).val()) {

                $('label[for=background_colour]').parent().show();

            } else if ('image' === $(this).val()) {

                $('label[for=image_file_id]').parent().show();
                $('label[for=background_image_position]').parent().show();

            } else if ('parallax' === $(this).val()) {

                $('label[for=image_file_id]').parent().show();

            } else if ('video' === $(this).val()) {

                $('label[for=image_file_id]').parent().show();
                $('label[for=video_file_id]').parent().show();

            }
        }).trigger('change');

    });
</script>
