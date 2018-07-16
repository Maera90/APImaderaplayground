<?php
/**
 * Created by PhpStorm.
 * User: maera
 * Date: 14/07/2018
 * Time: 8:25
 */

namespace App\Helpers;


class PlaygroundCryptography
{

    public function decrypt($data){
        $pass = "lTuJryvmP2UotAIcg6Wnrbu9pkvzyShJzCgRYB1DuLPLboNfkyszxLyMVUbiAjPZJWGvlxWD6Cf7QQbYcroA0KcMscSSjxIQjc9vyVWun1s1GrQGI26zA79T7RBee9Sm";
        $encodedClean = str_replace($pass,"",$data);
        $decoded = base64_decode($encodedClean);
        return $decoded;
    }
}