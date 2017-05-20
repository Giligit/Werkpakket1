<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 17/05/2017
 * Time: 12:47
 */

namespace view;


class EventJsonView
{

    public function __construct()
    {
    }

    public function convertEventArrayToJson($arr){
        return $this->convert($arr);
    }

    private function convert($arr) {
        if(!is_array($arr)) {
            $return = array(
                            );
        }
    }
}