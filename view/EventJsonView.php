<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 19:19
 */

namespace View;
include 'View.php';

class EventJsonView implements View
{

    public function show(array $data)
    {
        header('Content-Type: application/json');
        try{
            if(isset($data['event'])) {
                $event = $data['event'];
                echo json_encode(['eventID' => $event->getId(), 'name' => $event->getName(), 'startDate' => $event->getStartDate(), 'endDate' => $event->getEndDate(), 'person' => $event->getPerson()]);
            }else{
                echo json_encode(["fout" => "error in show json."], JSON_PRETTY_PRINT);
            }
        } catch(\Exception $exception){
            echo "Error in EventJsonView";
        }
    }
}