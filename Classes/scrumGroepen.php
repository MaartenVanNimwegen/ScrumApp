<?php

// voorbeeld om een object aan te maken op basis van een class met hierbij de constructor id.
$group = new ScrumGroep(1);

class ScrumGroep {
    public $id;
    public $name;
    public $project;
    public $scrummaster;
    public $startDate;
    public $endDate;
    public $archived;
    public $users = [];

    function __construct($id) {
        //print "In BaseClass constructor\n";
        $this->id = $id;
    }

    function get_id() {
        return $this->id;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
      }
    function set_project($project) {
        $this->project = $project;
      }
    function get_project() {
        return $this->project;
      }
    function set_scrummaster($scrummaster) {
        $this->scrummaster = $scrummaster;
    }
    function get_scrummaster() {
        return $this->scrummaster;
      }
      function set_startDate($startDate) {
        $this->startDate = $startDate;
    }
    function get_startDate() {
        return $this->startDate;
    }
    function set_endDate($endDate) {
        $this->endDate = $endDate;
    }
    function get_endDate() {
        return $this->endDate;
    }
    function set_archived($archived) {
        $this->archived = $archived;
    }
    function get_archived() {
        return $this->archived;
    }
    function add_user($user) {
        $this->users[] = $user;
    }
    function delete_user($user) {
        unset($this->users[$user]);
        //$this->users[] =;
    }
    function get_users() {
        //return $this->users[];
    }
}

?>