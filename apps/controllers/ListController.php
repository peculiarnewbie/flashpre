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

        $query = $this->request->getPost('name');

        if($query === ""){
            $sq = NULL;
        }
        else{
             $sq = $query;
        }

        $this->view->sq = $sq;
    }

    public function addAction($deck_id, $weight = 1){
        $card = new Cards();

        //assign value from the form to $user
        $card->assign(
            [
                'deck_id' => $deck_id,
                'weight' => $weight,
                'time' => 0,
            ]
        );
        $card->assign(
            $this->request->getPost(),
            [
                'front',
                'back',
                
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
        $this->view->deck_id = $deck_id;
    }

    public function searchAction(){

        $this->view->cards = Cards::find();

        $query = $this->request->getPost('name');

        $sq = $query;

        $this->view->sq = $sq;

    }

    public function editAction($deck_id, $id){

        echo $deck_id;
        echo "whaat";
        echo $id;

    }

    public function learnAction($deck_id){

        if($this->request->isPost()){
            
            //$query = $this->request->getPost("card_id", "weight");
            $card_id = $this->request->getPost("card_id");
            $weight = $this->request->getPost("weight");
            $time = $this->request->getPost("time");

            //updatetime($card_id, $weight);
            $update = Cards::findFirstById($card_id);
            
            if($update){
                $update->assign(array(
                    'weight' => $weight,
                    'time' => $time,
                ));
            }
            $success = $update->save();
            $this->view->success = $success;

            $this->view->card_id = $card_id;
            if ($success) {
                $message = "Card time updated!";
            } else {
                $message = "Sorry, the following problems were generated:<br>"
                         . implode('<br>', $user->getMessages());
            }
    
            // passing a message to the view
            $this->view->message = $message;
            
        }
        $this->view->success = $success;
        $this->view->message = $message;

        $this->view->cards = Cards::find();

        $conditions = ['time'=>0, 'deck_id'=>$deck_id];
        $this->view->currentCard = Cards::findFirst(
            [
                
                'conditions' => 'time=:time: AND deck_id=:deck_id:',
                'bind' => $conditions,

            ]
            );
        $this->view->weights = Weights::find();
        
        $this->view->deck_id = $deck_id;


        
    }

    public function revealAction($deck_id, $card_id){
        
        $this->view->success = $success;
        $this->view->message = $message;

        $this->view->cards = Cards::find();

        $conditions = ['time'=>0, 'deck_id'=>$deck_id];
        $this->view->currentCard = Cards::findFirst(
            [
                
                'conditions' => 'time=:time: AND deck_id=:deck_id:',
                'bind' => $conditions,

            ]
            );
        $this->view->weights = Weights::find();
        
        $this->view->deck_id = $deck_id;
    }
}