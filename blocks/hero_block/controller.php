<?php

namespace Concrete\Package\HeroBlock\Block\HeroBlock;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Page\Stack\Stack;
use Concrete\Core\Page\Stack\StackList;
use Core;
use File;
use Loader;
use Page;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends BlockController
{
    public $helpers = array('form');

    protected $btInterfaceWidth = 800;
    protected $btCacheBlockRecord = false;
    protected $btCacheBlockOutput = false;
    protected $btCacheBlockOutputOnPost = false;
    protected $btCacheBlockOutputForRegisteredUsers = false;
    protected $btInterfaceHeight = 520;
    protected $btTable = 'btHeroBlock';
    protected $btDefaultSet = 'basic';

    public function getBlockTypeDescription()
    {
        return t("Displays a block of context as a callout / hero unit with either a fixed or parallax image or background video.");
    }

    public function getBlockTypeName()
    {
        return t("Hero");
    }

    public function registerViewAssets($outputContent = '')
    {
        $this->requireAsset('javascript', 'jquery-parallax');
        $this->requireAsset('javascript', 'hero-block-manager');

        if ($stack = $this->getStackObject()) {
            $this->addHeaderItem($stack->outputCustomStyleHeaderItems(true));
        }
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
        $al = Loader::helper('concrete/asset_library');
        $this->setFiles();

        $this->requireAsset('javascript', 'bootstrap/tab');

        $this->set('stacks', $this->getStacks());
        $this->set('al', $al);
    }

    public function view()
    {
        $this->set('stack', $this->getStackObject());

        $this->setFiles();
    }

    public function getSearchableContent()
    {
        return $this->paragraph;
    }

    public function save($args)
    {
        if ('parallax' === $args['background_type']) {
            $args['background_image_position'] = 'center';
            $args['background_image_size'] = 'cover';
            $args['background_image_attachment'] = 'fixed';
        } 
        elseif ('video' === $args['background_type']) {
            $args['background_image_position'] = 'top center';
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

    protected function setFiles()
    {
        $this->set('image_file', $this->getImageFileObject());
        $this->set('video_file', $this->getVideoFileObject());
        $this->set('mask_image_file', $this->getMaskImageFileObject());
    }

    public function getImageFileObject()
    {
        if($this->image_file_id) {
            return File::getByID($this->image_file_id);
        }
        else {
            return null;
        }
    }

    public function getVideoFileObject()
    {
        if($this->video_file_id) {
            return File::getByID($this->video_file_id);
        }
        else {
            return null;
        }
    }

    public function getMaskImageFileObject()
    {
        if($this->mask_image_file_id) {
            return File::getByID($this->mask_image_file_id);
        }
        else {
            return null;
        }
    }

    public function getStacks()
    {
        $list = new StackList();

        $list->filterByUserAdded();

        return $list->get();
    }

    public function getStackObject()
    {
        if ($this->stack_id > 0) {
            return Stack::getById($this->stack_id);
        }
    }

}