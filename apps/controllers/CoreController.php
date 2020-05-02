<?php

use Phalcon\Mvc\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        $this->view->decks = Decks::find();

        $this->view->cards = Cards::find();

        
        
        $query = $this->request->getPost('name');

        if($query === ""){
            $sq = NULL;
        }
        else{
             $sq = $query;
        }

        $this->view->sq = $sq;
    }

    public function addAction(){

    }

    public function addconfirmAction(){

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
                     . implode('<br>', $deck->getMessages());
        }

        // passing a message to the view
        $this->view->message = $message;
    }

    public function searchAction(){

        $this->view->decks = Decks::find();

        $query = $this->request->getPost('name');

        $sq = $query;

        $this->view->sq = $sq;

    }
    
    public function addDeck(){

        
    }
}