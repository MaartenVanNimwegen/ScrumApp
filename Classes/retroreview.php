<?php

class retro {
    public $id;             // (int)
    public $userId;         // (int)
    public $groepId;        // (int)
    public $scrummasterId;  // (int)
    public $coatchId;       // (int)
    public $datum;          // (datetime)
    public $bijdrage;       // (tekst)
    public $meerwaarden;    // (tekst)
    public $tegenaan;       // (tekst)
    public $tips;           // (tekst)
    public $tops;           // (tekst)
}

class review {
    public $id;             // (int)
    public $userId;         // (int)
    public $groepId;        // (int)
    public $scrummasterId;  // (int)
    public $productownerId; // (int)
    public $datum;          // Aanmaak datum (datetime)
    public $backlogitems;   //Alle items van de sptints bijelkaar (array)   
    public $demonstreren;   //Dit gaan we demonstreren (tekst)
    public $samenwerking;   //Hoe is de samenwerking gegaan (tekst)
    public $todoitems;      //Alle items van de sprint in een (array) 
}