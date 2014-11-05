<?php if(!defined('ABSPATH')) die('Direct access is not allowed.');

/*
    Detect installed addons.
 */
$addons = $this->detectAddons();

?>

<div class="socialbox-options  socialbox-addons">

    <!-- Heading -->
    <div class="socialbox-options__section socialbox-options__section--header">
        <h3><?php _e('Addons for SocialBox', 'socialbox') ?></h3>
        <p class="socialbox-options__section__description"><?php _e('Need some additional styles? Well, here you go!', 'socialbox') ?></p>
    </div>

    <!-- Addons -->
    <div class="socialbox-addons__list">

        <div class="socialbox-addons__item">
            <img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/addons/flat-styles.png' ?>" alt="Flat Styles Theme Addon" />
            <h3 class="socialbox-addons__item__title">
                Flat Styles <span>Theme Addon</span>
            </h3>
            <div class="socialbox-addons__item__actions">
                <a class="button" href="http://codecanyon.net/item/flat-styles-addon-for-socialbox/7585389?ref=jdpowered">Get for $4</a>
                <?php if($addons['flat-styles']): ?>
                    <span class="dashicons dashicons-yes"></span>
                <? else: ?>
                    <span class="dashicons dashicons-lock"></span>
                <?php endif ?>
            </div>
        </div>

        <div class="socialbox-addons__item">
            <img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/addons/bubble-styles.png' ?>" alt="Bubble Styles Theme Addon" />
            <h3 class="socialbox-addons__item__title">
                Bubble Styles <span>Theme Addon</span>
            </h3>
            <div class="socialbox-addons__item__actions">
                <a class="button" href="http://codecanyon.net/item/bubble-styles-addon-for-socialbox/8231052?ref=jdpowered">Get for $4</a>
                <?php if($addons['bubble-styles']): ?>
                    <span class="dashicons dashicons-yes"></span>
                <? else: ?>
                    <span class="dashicons dashicons-lock"></span>
                <?php endif ?>
            </div>
        </div>

        <div class="socialbox-addons__item">
            <img src="<?php echo JD_SOCIALBOX_URL . '/assets/img/addons/custom-styles.png' ?>" alt="Custom Theme Addon" />
            <h3 class="socialbox-addons__item__title">
                Custom <span>Theme Addon</span>
            </h3>
            <div class="socialbox-addons__item__actions">
                <a class="button" href="http://envatostudio.go2cloud.org/SH2o">Get quote</a>
                <?php if($addons['custom-styles']): ?>
                    <span class="dashicons dashicons-yes"></span>
                <? else: ?>
                    <span class="dashicons dashicons-lock"></span>
                <?php endif ?>
            </div>
        </div>



    </div>

</div>
