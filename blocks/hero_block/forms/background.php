<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div role="tabpanel" class="tab-pane" id="background">

    <!-- Background !-->
    <fieldset>

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

        <!-- Background Parallax Speed !-->
        <div class="form-group">
            <?php echo $form->label('background_parallax_speed', t('Background Parallax Speed'))?>
            <?php echo $form->text('background_parallax_speed', $background_parallax_speed); ?>
        </div>

        <!-- Video !-->
        <div class="form-group">
            <?php echo $form->label('video_url', t('Background Video Url'))?>
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

</div>

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