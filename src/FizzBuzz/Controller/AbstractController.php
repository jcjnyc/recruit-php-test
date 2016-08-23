<?php

namespace FizzBuzz\Controller;

use FizzBuzz\Renderer;
use Smrtr\SpawnPoint\AbstractController as SpawnAbstractController;
use Smrtr\SpawnPoint\App;

abstract class AbstractController extends SpawnAbstractController
{
    /**
     * @var \FizzBuzz\Renderer
     */
    protected $tpl;

    public function __construct()
    {
        $this->tpl = new Renderer;
    }

    public function setApp(App $app) {
    	parent::setApp($app);

    	$sectionsRepository = $this->app->container->get('SectionsRepository');
    	$sections = $sectionsRepository->findAll();

    	if (!is_array($sections) or !count($sections)) {
    		$this->tpl->sections = null;
    	} else {
    		$this->tpl->sections = $sections;
    	}

    }
}
