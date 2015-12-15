<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<!-- Mask !-->
<fieldset>

    <legend><?php echo t('Mask')?></legend>

    <!-- Mask Type !-->
    <div class="form-group">
        <?php echo $form->label('mask_type', t('Mask Image Type'))?>
        <?php echo $form->select('mask_type', array('none' => t('None'), 'image' => t('Static Image'), 'parallax' => t('Parallax Image')), $mask_type); ?>
    </div>

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

    <!-- Mask Parallax Speed !-->
    <div class="form-group">
        <?php echo $form->label('mask_parallax_speed', t('Mask Parallax Speed'))?>
        <?php echo $form->text('mask_parallax_speed', $mask_parallax_speed); ?>
    </div>

</fieldset>