<?php

use Phalcon\Mvc\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        $this->view->decks = Decks::find();

        $this->view->cards = Cards::find();

        $skip = $this->request->getPost('skip');
        $reset = $this->request->getPost('reset');
        $edit = $this->request->getPost('edit');
        $good = $this->request->getPost('good');
        $easy = $this->request->getPost('easy');

        if($skip === 'go'){
            $cards = Cards::find();

            foreach($cards as $card){
                $time = $card->time;
                if($time > 0){
                    $time -= 1;
                }
                $card->assign(array(
                    'time' => $time
                ));
                $success = $card->save();
            }
        }

        if($reset === 'go'){
            $cards = Cards::find();

            foreach($cards as $card){
                $time = 0;
                $weight = 1;
                $card->assign(array(
                    'time' => $time,
                    'weight' => $weight
                ));
                $success = $card->save();
            }
        }

        
        if($edit === 'go'){
            $weightgood = Weights::findFirstById(2);
            $weightgood->assign(array(
                'weight' => $good
            ));
            $success = $weightgood->save();

            
            $weighteasy = Weights::findFirstById(3);
            $weighteasy->assign(array(
                'weight' => $easy
            ));
            $success = $weighteasy->save();

        }
        
        $query = $this->request->getPost('name');

        if($query === ""){
            $sq = NULL;
        }
        else{
             $sq = $query;
        }

        $this->view->sq = $sq;
    }

    public function editAction(){
        

    }

    public function addAction(){

    }

    public function skipAction(){
        
        
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