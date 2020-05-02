<?php

use Phalcon\Mvc\Controller;

class ListController extends Controller
{
    public function indexAction()
    {
        
        $this->view->cards = Cards::find();
    }

    public function cardsAction($deck_id)
    {
        $this->view->deck_id = $deck_id;
        $this->view->cards = Cards::find();
    }

    public function addAction($deck_id){
        $card = new Cards();

        //assign value from the form to $user
        $card->assign(
            $this->request->getPost(),
            [
                'front',
                'back'
            ]
        );

        // Store and check for errors
        $success = $card->save();

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "card added";
        } else {
            $message = "Sorry, the following problems were generated:<br>"
                     . implode('<br>', $card->getMessages());
        }

        // passing a message to the view
        $this->view->message = $message;
    }

    public function searchAction(){

        $this->view->cards = Cards::find();

        $query = $this->request->getPost('name');

        $sq = $query;

        $this->view->sq = $sq;

    }
}