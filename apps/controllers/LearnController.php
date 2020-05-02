<?php

use Phalcon\Mvc\Controller;

class LearnController extends Controller
{

    public function indexAction($deck_id, $weightChosen=0){

        
        $this->view->cards = Cards::find();
        $this->view->currentCard = Cards::findFirst("time = 0");
        $this->view->weights = Weights::find();
        $this->view->deck_id = $deck_id;

        if($this->request->isPost()){
            //$query = $this->request->getPost("card_id", "weight");
            $card_id = $this->request->getPost("card_id");
            $weight = $this->request->getPost("weight");
            //updatetime($card_id, $weight);
        }
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