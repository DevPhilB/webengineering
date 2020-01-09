<?php
    require_once("model/Graph.class.php");
    // 1. a)
    class Getter{
        private $basicLink = "http://morgal.informatik.uni-ulm.de:8000/line/";

        // 1. a)
        function requestData($url){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        // 1. b)
        function getStopList(){
            return $this->requestData("http://morgal.informatik.uni-ulm.de:8000/line/stop/");
        }

        // 1. c)
        function getGraph(){
            // TODO: Construct Graph object
            return $this->requestData("http://morgal.informatik.uni-ulm.de:8000/line/data/");
        }
    }

    $gtter = new Getter();
    $ret = $gtter->getGraph();
    print_r($ret);
?>
