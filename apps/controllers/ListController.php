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

            //updatetime($card_id, $weight);
            $update = Cards::findFirstById($card_id);
            
            if($update){
                $update->assign(array(
                    'time' => $weight
                ));
            }
            $success = $update->save();
            $this->view->success = $success;

            $this->view->card_id = $card_id;
            if ($success) {
                $message = "Thanks for registering!";
            } else {
                $message = "Sorry, the following problems were generated:<br>"
                         . implode('<br>', $user->getMessages());
            }
    
            // passing a message to the view
            $this->view->message = $message;
            
        }
        
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

    public function updatetimeAction($card_id, $weight){
        $servername = "localhost";
        $username = "root";
        $password = "secret";
        $dbname = "tutorial";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE `tutorial`.`cards` SET `time` = $weight WHERE (`id` = $card_id);";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    }
}