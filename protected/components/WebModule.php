<?php

class WebModule extends CWebModule
{
    private $_assetsPath;
    public $forcePublish = false;

    protected function init()
    {
        $id = $this->getId();

        $this->setImport(array(
            $id.'.components.*',
            $id.'.controllers.*',
            $id.'.models.*',
        ));

        parent::init();
    }

    public function getAssetsPath()
    {
        if($this->_assetsPath!==null)
            return $this->_assetsPath;
        else
            return $this->_assetsPath=$this->getBasePath().DIRECTORY_SEPARATOR.'assets';
    }
}