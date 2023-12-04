<?php

namespace App\Traits;

trait ApiResponse {

    function success_resposnes($result,$cood=200,$message="Successful"){
        return response()->json(

            data: [
                "status" => true,
                "code" => $cood,
                "message" =>$message,
                "data" => $result
            ],
            status: $cood
        );
    }

    function fiald_resposnes($cood=404,$message="fiald"){
        return response()->json(

            data: [
                "status" => false,
                "code" => $cood,
                "message" => $message,
                "data" => null
            ],
            status: $cood
        );
    }
}