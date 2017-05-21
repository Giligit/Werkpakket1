<?php

namespace view;

class PersonJsonView implements view
{
    public function convertPersonArrayToJson($arr){
        return $this->convert($arr);
    }

    private function convert($arg) {
        if(!is_array($arg)) {
            $return = array('id' => $arg->getId(), 'name' => $arg->getName(), 'e-mail' => $arg->getEmail());
        }else{
            $return =$arg;
        }
        return json_encode($return);
    }


    public function show(array $data)
    {
        // TODO: Implement show() method.
        header('Content-type: application/json');

        if(isset($data['persons'])) {
            $persons = $data['persons'];
            echo json_encode($persons);
        }else {
            echo '{}';
        }
    }
}
