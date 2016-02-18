<?php
namespace Concrete\Package\ConcreteHeroBlock;

use AssetList;
use Asset;
use BlockType;
use Package;
use Database;

defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Package adding hero block type.
 * 
 * @author Oliver Green <dubious@codeblog.co.uk>
 * @link http://www.codeblog.co.uk
 * @license http://www.gnu.org/licenses/gpl.html GPLs
 */
class Controller extends Package
{
    /**
     * Package handle.
     *
     * @var string
     */
    protected $pkgHandle = 'concrete-hero-block';

    /**
     * Minimum concrete5 version.
     *
     * @var string
     */
    protected $appVersionRequired = '5.7.1';

    /**
     * Package version.
     *
     * @var string
     */
    protected $pkgVersion = '0.9.8';

    /**
     * On CMS boot.
     *
     * @return void
     */
    public function on_start()
    {
        $this->registerAssets();
    }

    /**
     * Get the package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t("Hero Block Components Package");
    }

    /**
     * Get the package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
    	return t("Package adding hero block type to concrete.");
    }

    /**
     * Install routine.
     *
     * @return \Concrete\Core\Package\Package
     */
    public function install()
    {
        $pkg = parent::install();

        $bt = BlockType::installBlockTypeFromPackage('hero_block', $pkg);

        return $pkg;
    }

    /**
     * Removal routine.
     *
     * @return void
     */
    public function uninstall()
    {
        parent::uninstall();
        $db = Database::get();
        $db->exec('DROP TABLE btHeroBlock;');
    }

    /**
     * Register the assets that the package provides.
     *
     * @return void
     */
    protected function registerAssets()
    {
        $al = AssetList::getInstance();

        /*
         * Parallax
         */
        $al->register(
            'javascript', 'jquery-parallax', 'assets/jquery.parallax-1.1.3.js',
            array(
                'version' => '1.1.3', 'position' => Asset::ASSET_POSITION_HEADER,
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
    }
}
