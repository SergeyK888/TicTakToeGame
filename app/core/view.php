<?php
namespace app\core;

class View {

    public function generate($template_view){

        include 'app/views/'.$template_view;
    }

    public function returnData($data) {
        echo json_encode($data);
    }

    public function start($roomData, $player) {
        $data = [
            'roomid'=> $roomData['roomid'],
            'player' => $player,
            'whogoes' => 1,
            'id' => $roomData['id']
        ];
        echo json_encode($data);
    }


}