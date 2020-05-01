<?php

use Phalcon\Mvc\Controller;

class LearnController extends Controller
{
    public function indexAction()
    {
        
    }

    public function flipAction(){
        $deck = new Decks();

        //assign value from the form to $user
        $deck->assign(
            $this->request->getPost(),
            [
                'name',
                'size'
            ]
        );

        // Store and check for errors
        $success = $deck->save();

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "deck added";
        } else {
            $message = "Sorry, the following problems were generated:<br>"
                     . implode('<br>', $user->getMessages());
        }

        // passing a message to the view
        $this->view->message = $message;
    }
}