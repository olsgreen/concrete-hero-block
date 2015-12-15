<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

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

    <!-- Hide Video Loading Spinner !-->
    <div class="form-group">
        <?php echo $form->label('hide_video_loading', t('Hide Video Loading Spinner?'))?>
        <?php echo $form->select('hide_video_loading', $yes_no_options, $hide_video_loading); ?>
    </div>

</fieldset>