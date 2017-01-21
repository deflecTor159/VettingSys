<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\CountryTable;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class SearchController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */


    public function results(){

        $status1= $_GET['Status1'];
        $search= $_GET['Search'];
        $location= $_GET["Country"];

        if($location=='ALL'){
            $id=0;
        }else{
            $mysqli = mysqli_connect("localhost", "root", "calderon150991", "VS_DB_SRS1");
            $query = "Select id_Country from country where name='". $location."';";
            $result = $mysqli->query($query);
            if (!$result) {
                $message = 'Invalid query: ' . mysqli_connect_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $id=$row['id_Country'];
            }
        }


        if($search == 0){
           $this->redirect( 'clients/advancedsearch?Search=0&Status1=&Status1='.@$status1.'&location='.@$id);
        }else{
            $this->redirect( 'organizations/advancedsearch?Search=0&Status1=&Status1='.@$status1.'&location='.@$id);
       }

    }

}
