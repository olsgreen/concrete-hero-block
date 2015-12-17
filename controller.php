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
    protected $pkgHandle = 'hero_block';
    
    protected $appVersionRequired = '5.7.1';

    protected $pkgVersion = '0.9.7';

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

        /*
         * Parallax
         */
        $al->register(
            'javascript', 'jquery-parallax', 'assets/jquery.parallax-1.1.3.js',
            array(
                'version' => '1.1.3', 'position' => Asset::ASSET_POSITION_FOOTER, 
                'minify' => true, 'combine' => true
            ), $this
        );

        /*
         * Hero Block Manager
         */
        $al->register(
            'javascript', 'hero-block-manager', 'assets/hero-block-manager.js',
            array(
                'version' => $this->pkgVersion, 'position' => Asset::ASSET_POSITION_HEADER, 
                'minify' => true, 'combine' => true
            ), $this
        );

        /*
         * Bootstrap Tabs
         */
        $al->register(
            'javascript',
            'bootstrap/tab',
            'assets/bootstrap.tab.js',
            array(
                'version' => '3.3.1', 'position' => Asset::ASSET_POSITION_FOOTER, 
                'minify' => true, 'combine' => true
            ),
            $this
        );

        /*
         * Switchery
         */
        $al->register(
            'javascript',
            'switchery/js',
            'assets/switchery.js',
            array(
                'version' => '0.7.0', 'position' => Asset::ASSET_POSITION_FOOTER, 
                'minify' => true, 'combine' => true
            ),
            $this
        );

        $al->register(
            'css',
            'switchery/css',
            'assets/switchery.css',
            array(
                'version' => '0.7.0', 'position' => Asset::ASSET_POSITION_HEADER, 
                'minify' => true, 'combine' => true
            ),
            $this
        );

        $al->registerGroup(
            'switchery',
            array(
                array('css', 'switchery/css'),
                array('javascript', 'switchery/js')
            )
        );
    }
}
