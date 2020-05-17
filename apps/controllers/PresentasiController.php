<?php

use Phalcon\Mvc\Controller;
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class PresentasiController extends Controller
{

    protected function getTranslation(): NativeArray
    {
        // Ask browser what is the best language
        $language = $this->request->getBestLanguage();
        $messages = [];
        
        $translationFile = '../apps/messages/' . $language . '.php';

        if (true !== file_exists($translationFile)) {
            $translationFile = '../apps/messages/fr.php';
        }
        
        require $translationFile;

        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);
        
        return $factory->newInstance(
            'array',
            [
                'content' => $messages,
            ]
        );
    }

    public function indexAction()
    {
        $this->view->name = 'Irshad';
        $this->view->t    = $this->getTranslation();
    }

    
}