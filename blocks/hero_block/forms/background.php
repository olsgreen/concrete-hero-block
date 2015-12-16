<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div role="tabpanel" class="tab-pane" id="background">

    <!-- Background !-->
    <fieldset>

        <!-- Background Type !-->
        <div class="form-group" id="background_type_group">
            <?php echo $form->label('background_type', t('Background Type'))?>
            <?php echo $form->select('background_type', $background_type_attributes, $background_type); ?>
        </div>

        <!-- Colour !-->
        <div class="form-group" id="background_colour_group">
            <?php echo $form->label('background_colour', t('Base Background Colour'))?>
            <?php echo Loader::helper('form/color')->output('background_colour', $background_colour);?>
        </div>

        <!-- Image !-->
        <div class="form-group" id="background_image_group">
            <?php echo $form->label('image_file_id', t('Image'))?>
            <?php echo $al->image('ccm-a-image', 'image_file_id', t('Choose Image'), $image_file);?>
        </div>

        <!-- Background Position !-->
        <div class="form-group" id="background_position_group">
            <?php echo $form->label('background_image_position', t('Image Position'))?>
            <?php echo $form->select('background_image_position', $background_image_positions, $background_image_position); ?>
        </div>

        <!-- Background Size !-->
        <div class="form-group" id="background_size_group">
            <?php echo $form->label('background_image_size', t('Image Size'))?>
            <?php echo $form->select('background_image_size', $background_image_sizes, $background_image_size); ?>
        </div>

        <!-- Background Attachment !-->
        <div class="form-group" id="background_attachment_group">
            <?php echo $form->label('background_image_attachment', t('Image Attachment'))?>
            <?php echo $form->select('background_image_attachment', $background_image_attachments, $background_image_attachment); ?>
        </div>

        <!-- Background Parallax Speed !-->
        <div class="form-group" id="background_speed_group">
            <?php echo $form->label('background_parallax_speed', t('Parallax Speed'))?>
            <?php echo $form->text('background_parallax_speed', $background_parallax_speed); ?>
            <p class="help-text">Values between -0.3 - 0.5 usually work best.</p>
        </div>

        <!-- Video !-->
        <div class="form-group" id="background_video_group">
            <?php echo $form->label('video_url', t('Video URL'))?>
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

    </fieldset>

</div>

<script type="text/javascript">
    $(function() {

        $background = $('#background');
        $background_type = $('#background_type_group');

        $background_colour       = $('#background_colour_group');
        $background_video        = $('#background_video_group');
        $background_image        = $('#background_image_group');
        $background_position     = $('#background_position_group');
        $background_size         = $('#background_size_group');
        $background_attachment   = $('#background_attachment_group');
        $background_speed        = $('#background_speed_group');

        function hide()
        {
            $background.find('.form-group').hide();
            $background_type.show();
        }

        $background_type.find('select').change(function(event) {

            switch ($(this).val())
            {
                case 'colour':
                    hide();
                    $background_colour.show();
                break;
                case 'image':
                    hide();
                    $background_colour.show();
                    $background_image.show();
                    $background_position.show();
                    $background_size.show();
                    $background_attachment.show();
                break;
                case 'parallax':
                    hide();
                    $background_colour.show();
                    $background_image.show();
                    $background_speed.show();
                break;
                case 'video':
                    hide();
                    $background_video.show();
                    $background_image.show();
                    $background_size.find('select').val('auto');
                break;

            }


        }).trigger('change');

    });
</script>