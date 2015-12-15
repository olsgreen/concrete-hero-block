<?php
namespace Concrete\Package\HeroBlock;

use AssetList;
use Asset;
use BlockType;
use Package;
use Database;

defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Package adding image box block type.
 *
 * @author Oliver Green <dubious@codeblog.co.uk>
 * @link http://www.codeblog.co.uk
 * @license http://www.gnu.org/licenses/gpl.html GPLs
 */
class Controller extends Package
{
    protected $pkgHandle = 'hero-block';
    
    protected $appVersionRequired = '5.7.0';

    protected $pkgVersion = '0.9.4';

    public function on_start()
    {
        $this->registerAssets();
    }

    public function getPackageDescription()
    {
    	return t("Package adding hero block type to concrete.");
    }

    public function getPackageName()
    {
    	return t("Hero Block Components Package");
    }

    public function install()
    {
        $pkg = parent::install();

        $bt = BlockType::installBlockTypeFromPackage('hero_block', $pkg);

        return $pkg;
    }

    public function uninstall()
    {
        parent::uninstall();
        $db = Database::get();
        $db->exec('DROP TABLE btHeroBlock;');
    }

    protected function registerAssets()
    {
        $al = AssetList::getInstance();

        // Images Loaded
        $al->register(
            'javascript', 'imagesloaded/js', 'assets/imagesloaded-3.2.0/imagesloaded.pkgd.min.js',
            array('version' => '3.2.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this
        );

        // Video.js
        $al->register(
            'css', 'video.js/css', 'assets/video.js-5.0.2/dist/video-js.min.css',
            array('version' => '5.0.2', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this
        );

        $al->register(
            'javascript', 'video.js/js', 'assets/video.js-5.0.2/dist/video.min.js',
            array('version' => '5.0.2', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this
        );

        // BigVideo.js
        $al->register(
            'javascript', 'bigvideo.js/js', 'assets/BigVideo.js-1.1.5/lib/bigvideo.js',
            array('version' => '1.1.5', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this
        );

        $al->registerGroup(
            'bigvideo',
            array(
                array('javascript', 'imagesloaded/js'),
                array('javascript', 'video.js/js'),
                array('javascript', 'bigvideo.js/js'),
                array('css', 'video.js/css'),
            )
        );

        // Parallax
        $al->register(
            'javascript', 'jquery-parallax', 'assets/jquery.parallax-1.1.3.js',
            array('version' => '1.1.3', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this
        );

        // Hero Block Manager
        $al->register(
            'javascript', 'hero-block-manager', 'assets/hero-block-manager.js',
            array('version' => '0.9.3', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this
        );
    }
}
