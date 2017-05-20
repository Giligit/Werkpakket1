<?php

namespace view;

class PersonJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['persons'])) {
            $persons = $data['persons'];
            echo json_encode($persons);
        } else {
            echo '{}';
        }
    }
}
