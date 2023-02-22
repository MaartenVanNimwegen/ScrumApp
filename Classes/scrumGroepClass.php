<?php

// voorbeeld om een object aan te maken op basis van een class met hierbij de constructor id.

class ScrumGroup {
    public $id;
    public $name;
    public $project;
    public $scrummaster;
    public $startDate;
    public $endDate;
    public $archived;
    public $teamleden = [];

    function __construct($id) {
        //print "In BaseClass constructor\n";
        $this->id = $id;
    }

}

?>