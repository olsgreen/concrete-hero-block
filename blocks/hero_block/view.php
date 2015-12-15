<?php defined('C5_EXECUTE') or die("Access Denied."); 

    $md = new Mobile_Detect();
    $im = Core::make('helper/image');

    /*
     * Background Image
     */
    if ($image_file) {
        $background_url = $image_file->getUrl();
    }

    /*
     * Mask
     */
    if ($mask_image_file) {
        $mask_url = $mask_image_file->getUrl();
    }

    if ($mask_colour) {
        $rgb = array_map(function ($v) { return trim($v); }, explode(',', substr($mask_colour, 4, -1)));
        $opacity = round($mask_colour_opacity / 100, 2);
        $mask_rgba = "rgba($rgb[0], $rgb[1], $rgb[2], $opacity)";
    }

    /*
     * Content Animations
     */
    if (strlen($content_animation_class) > 0) {
        $content_animation_class = 'animated-css-class animated ' . $content_animation_class; 
    }

    $has_animations = strlen($content_animation_class) > 0 && defined('CSS3_ANIMATION_PACKAGE');
    $content_container_class = ('1' === $content_container ? 'container' : '');
    $content_container_class .= ($has_animations ? ' ' . $content_animation_class : '');

?>
<style>
    #heroStage<?php echo $bID; ?> {
        background-color: <?php echo ($background_colour) ? $background_colour : 'transparent'; ?>;
        background-image: <?php echo (isset($background_url) ? 'url(' . $background_url . ')' : 'none'); ?>;
        background-position: <?php echo ($background_image_position ? $background_image_position : '0% 0%'); ?>;
        background-attachment: <?php echo ($background_image_attachment ? $background_image_attachment : 'scroll'); ?>;
        background-size: <?php echo ($background_image_size ? $background_image_size : 'auto'); ?>;
    }

    #heroStage<?php echo $bID; ?> .hero-mask {
        background-color: <?php echo $mask_colour ? $mask_rgba : 'transparent'; ?>;
        background-image: <?php echo isset($mask_url) ? 'url(' . $mask_url . ')' : 'none'; ?>;
        background-position: <?php echo ($mask_image_position ? $mask_image_position : '0% 0%'); ?>;
        background-attachment: <?php echo ($mask_image_attachment ? $mask_image_attachment : 'scroll'); ?>;
        background-size: <?php echo ($mask_image_size ? $mask_image_size : 'auto'); ?>;
    }

    #heroStage<?php echo $bID; ?> .hero-table {
        min-height: <?php echo ($min_height > 0) ? $min_height : 0; ?>px;
    }

    #heroStage<?php echo $bID; ?> .hero-table .hero-table-row .hero-table-cell {
        vertical-align: <?php echo ('1' === $center_content) ? 'middle' : 'baseline'; ?>;
    }
</style>

<div id="heroStage<?php echo $bID; ?>" class="hero-stage">

    <div class="hero-table">
        <div class="hero-table-row">
            <div class="hero-table-cell hero-content">
                <div class="<?php echo $content_container_class; ?>">
                    <?php echo $content; ?>

                    <div class="hero-stack-content">
                        <?php
                            if ($stack) {
                                $stack->display();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-mask"></div>

</div>

<script>
    (function ($, w) {
        var block = {
            bID                 : '<?php echo $bID; ?>',
            video               : '<?php echo $video_url; ?>',
            poster              : '<?php echo (isset($background_url) ? $background_url : ""); ?>',
            parallax            : '<?php echo "parallax" === $background_type ? "1" : "0"; ?>',
            fill_screen         : '<?php echo $fill_screen; ?>',
            fill_screen_offset  : '<?php echo $fill_screen_offset; ?>',
            mobile              : '<?php echo $md->isMobile() ? "1" : "0"; ?>',
            $stage              : $('#heroStage<?php echo $bID; ?>'),
            $content            : $('#heroStage<?php echo $bID; ?> .hero-content').first()
        };

        (function boot() {
            if (typeof HeroBlockManager === 'undefined') {
                setTimeout(boot, 100);
                return;
            }
            new HeroBlockManager(block);
        }());

    }(jQuery, window));
</script>