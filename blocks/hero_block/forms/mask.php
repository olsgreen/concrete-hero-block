<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div role="tabpanel" class="tab-pane" id="mask">

    <!-- Mask !-->
    <fieldset>

        <!-- Mask Colour !-->
        <div class="form-group" id="mask_colour_group">
            <?php echo $form->label('mask_colour', t('Colour'))?>
            <?php echo Loader::helper('form/color')->output('mask_colour', $mask_colour);?>
        </div>

        <!-- Mask Colour Opacity !-->
        <div class="form-group" id="mask_opacity_group">
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

        <!-- Mask Image Type !-->
        <div class="form-group" id="mask_type_group">
            <?php echo $form->label('mask_type', t('Mask Image Type'))?>
            <?php echo $form->select('mask_type', array('none' => t('None'), 'image' => t('Static Image'), 'parallax' => t('Parallax Image')), $mask_type); ?>
        </div>

        <!-- Mask Image !-->
        <div class="form-group" id="mask_image_group">
            <?php echo $form->label('mask_image_file_id', t('Image'))?>
            <?php echo $al->image('ccm-b-image', 'mask_image_file_id', t('Choose Image'), $mask_image_file);?>
        </div>

        <!-- Mask Image Repeat !-->
        <div class="form-group" id="mask_repeat_group">
            <?php echo $form->label('mask_image_repeat', t('Image Repeat'))?>
            <?php echo $form->select('mask_image_repeat', array('none' => t('None'), 'repeat' => t('Repeat')), $mask_image_repeat); ?>
        </div>

        <!-- Mask Image Position !-->
        <div class="form-group" id="mask_position_group">
            <?php echo $form->label('mask_image_position', t('Mask Image Position'))?>
            <?php echo $form->select('mask_image_position', $background_image_positions, $mask_image_position); ?>
        </div>

        <!-- Mask Image Size !-->
        <div class="form-group" id="mask_size_group">
            <?php echo $form->label('mask_image_size', t('Mask Image Size'))?>
            <?php echo $form->select('mask_image_size', $background_image_sizes, $mask_image_size); ?>
        </div>

        <!-- Mask Image Attachment !-->
        <div class="form-group" id="mask_attachment_group">
            <?php echo $form->label('mask_image_attachment', t('Mask Image Attachment'))?>
            <?php echo $form->select('mask_image_attachment', $background_image_attachments, $mask_image_attachment); ?>
        </div>

        <!-- Mask Parallax Speed !-->
        <div class="form-group" id="mask_speed_group">
            <?php echo $form->label('mask_parallax_speed', t('Mask Parallax Speed'))?>
            <?php echo $form->text('mask_parallax_speed', $mask_parallax_speed); ?>
        </div>

    </fieldset>

<script type="text/javascript">
    $(function() {

        $mask = $('#mask');
        $mask_type = $('#mask_type_group');

        $mask_colour       = $('#mask_colour_group');
        $mask_opacity      = $('#mask_opacity_group');
        $mask_video        = $('#mask_video_group');
        $mask_image        = $('#mask_image_group');
        $mask_position     = $('#mask_position_group');
        $mask_size         = $('#mask_size_group');
        $mask_attachment   = $('#mask_attachment_group');
        $mask_speed        = $('#mask_speed_group');

        function hide()
        {
            $mask.find('.form-group').hide();
            $mask_type.show();
            $mask_colour.show();
            $mask_opacity.show();
        }

        $mask_type.find('select').change(function(event) {

            switch ($(this).val())
            {
                case 'none':
                    hide();
                break;
                case 'image':
                    hide();
                    $mask_image.show();
                    $mask_position.show();
                    $mask_size.show();
                    $mask_attachment.show();
                break;
                case 'parallax':
                    hide();
                    $mask_image.show();
                    $mask_speed.show();
                break;

            }


        }).trigger('change');

    });
</script>

</div>