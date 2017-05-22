<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 19:58
 */

namespace View;


class PersonJsonView implements View
{

    public function show(array $data)
    {
        header('Content-Type: application/json');

        if(isset($data['person'])) {
            $person = $data['person'];
            echo json_encode(['persoonID' => $person->getId(), 'person_name' => $person->getName(), 'person_email'=> $person->getE_mail()]);
        }else {
            echo 'error in PersonJsonView';
        }
    }
}