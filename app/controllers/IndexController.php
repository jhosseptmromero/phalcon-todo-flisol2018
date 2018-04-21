<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
    	$this->assets->addCss("css/index.css");

    	$this->assets->addJs("//cdn.jsdelivr.net/npm/vue/dist/vue.js", true);
    	$this->assets->addJs("//cdn.jsdelivr.net/npm/vue-resource@1.5.0", true);
    	$this->assets->addJs("js/index.js");

    }

}

