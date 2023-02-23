<?php


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
        $this->id = $id;
    }

}

?>