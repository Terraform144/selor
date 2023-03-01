<?php

class Saver {

    protected $xml_stats = "stats-94685125.xml";
    protected $xml;

    function __construct() {
        $this->xml = simplexml_load_file($this->xml_stats);
    }

    public function saveXML($stats) 
    {
        $stats = $this->xml->keys;
        
        $date = new DateTimeImmutable();
        $this.saveStats($_SESSION['key'], $stats, $date->getTimestamp()); 
        
        $xml->asXML($xml_stats);
    }

    private function saveStats($key, $stats) {
        // todo this - check if key still exists then update or create if not
        
    }

}
