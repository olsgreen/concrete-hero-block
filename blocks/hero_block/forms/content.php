<?php defined('C5_EXECUTE') or die("Access Denied.");

$stack_options = array(
    '0' => t('None')
);

foreach ($stacks as $stack) {
    $stack_options[$stack->getCollectionId()] = $stack->getStackName();
}

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
        <?php echo $form->select('stack_id', $stack_options, $stack_id); ?>
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