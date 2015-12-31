<?php

namespace Concrete\Package\ConcreteHeroBlock\Block\HeroBlock;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Page\Stack\Stack;
use Concrete\Core\Page\Stack\StackList;
use Core;
use File;
use Loader;
use Page;

defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Hero block controller
 *
 * @author Oliver Green <dubious@codeblog.co.uk>
 * @link http://www.codeblog.co.uk
 * @license http://www.gnu.org/licenses/gpl.html GPLs
 */
class Controller extends BlockController
{
    /**
     * Frontend Helpers.
     *
     * @var array
     */
    public $helpers = array('form');

    /**
     * Add / Edit interface width.
     *
     * @var integer
     */
    protected $btInterfaceWidth = 800;

    /**
     * Add / Edit interface height.
     *
     * @var integer
     */
    protected $btInterfaceHeight = 520;

    /**
     * Cache the block record?
     *
     * @var boolean
     */
    protected $btCacheBlockRecord = false;

    /**
     * Cache the block output?
     *
     * @var boolean
     */
    protected $btCacheBlockOutput = false;

    /**
     * Cache block output during a POST request?
     *
     * @var boolean
     */
    protected $btCacheBlockOutputOnPost = false;

    /**
     * Cache block for registered users?
     *
     * @var boolean
     */
    protected $btCacheBlockOutputForRegisteredUsers = false;

    /**
     * Block data table.
     *
     * @var string
     */
    protected $btTable = 'btHeroBlock';

    /**
     * Block editor control set.
     *
     * @var string
     */
    protected $btDefaultSet = 'basic';

    /**
     * Get the block name.
     *
     * @return string
     */
    public function getBlockTypeName()
    {
        return t("Hero");
    }

    /**
     * Get the block description.
     *
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t("Displays a block of context as a callout / hero unit with either a fixed or parallax image or background video.");
    }

    /**
     * Register the blocks view assets.
     *
     * @param  string $outputContent
     * @return void
     */
    public function registerViewAssets()
    {
        $this->requireAsset('javascript', 'jquery-parallax');
        $this->requireAsset('javascript', 'hero-block-manager');

        if ($stack = $this->getStackObject()) {
            $this->addHeaderItem($stack->outputCustomStyleHeaderItems(true));
        }
    }

    /**
     * Show the add view.
     *
     * @return  void [<description>]
     */
    public function add()
    {
        $this->edit();
    }

    /**
     * Show the edit view.
     *
     * @return void
     */
    public function edit()
    {
        $al = Loader::helper('concrete/asset_library');
        $this->setFiles();

        $this->requireAsset('javascript', 'bootstrap/tab');

        $this->set('stacks', $this->getStacks());
        $this->set('al', $al);
    }

    /**
     * Show the view.
     *
     * @return void
     */
    public function view()
    {
        $this->set('stack', $this->getStackObject());

        $this->setFiles();
    }

    /**
     * Get the blocks searchable content.
     *
     * @return string
     */
    public function getSearchableContent()
    {
        return $this->content;
    }

    /**
     * Pre-proccess the block data before save.
     *
     * @param  array $args
     * @return array
     */
    public function save($args)
    {
        if ('parallax' === $args['background_type']) {
            $args['background_image_position'] = 'center';
            $args['background_image_size'] = 'cover';
            $args['background_image_attachment'] = 'fixed';
        }
        elseif ('video' === $args['background_type']) {
            $args['background_image_position'] = 'top left';
            $args['background_image_size'] = 'cover';
            $args['background_image_attachment'] = 'scroll';
        }

        if ('video' !== $args['background_type']){
            $args['video_url'] = '';
        }

        if ('parallax' === $args['mask_type']) {
            $args['mask_image_position'] = 'center';
            $args['mask_image_size'] = 'auto';
            $args['mask_image_attachment'] = 'fixed';
        }
        elseif ('none' === $args['mask_type']) {
            $args['mask_image_file_id'] = 0;
        }

        parent::save($args);
    }

    /**
     * Set the required file instances to the view.
     *
     * @return  void
     */
    protected function setFiles()
    {
        $this->set('image_file', $this->getImageFileObject());
        $this->set('video_file', $this->getVideoFileObject());
        $this->set('mask_image_file', $this->getMaskImageFileObject());
    }

    /**
     * Get the image file object.
     *
     * @return null|\Concrete\Core\File\File
     */
    public function getImageFileObject()
    {
        if($this->image_file_id) {
            return File::getByID($this->image_file_id);
        }
        else {
            return null;
        }
    }

    /**
     * Get the video file object.
     *
     * @return null|\Concrete\Core\File\File
     */
    public function getVideoFileObject()
    {
        if($this->video_file_id) {
            return File::getByID($this->video_file_id);
        }
        else {
            return null;
        }
    }

    /**
     * Get the image mask file object.
     *
     * @return null|\Concrete\Core\File\File
     */
    public function getMaskImageFileObject()
    {
        if($this->mask_image_file_id) {
            return File::getByID($this->mask_image_file_id);
        }
        else {
            return null;
        }
    }

    /**
     * Get a list of stacks available.
     *
     * @return \Concrete\Core\Page\Stack\StackList
     */
    public function getStacks()
    {
        $list = new StackList();

        $list->filterByUserAdded();

        return $list->get();
    }

    /**
     * Get the stack object.
     *
     * @return null|\Concrete\Core\Page\Stack\Stack
     */
    public function getStackObject()
    {
        if ($this->stack_id > 0) {
            return Stack::getById($this->stack_id);
        }
    }

}