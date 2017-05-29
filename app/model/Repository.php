<?php


abstract class Repository extends Nette\Object {
    //Připojení k databázi
    
    /** @var Nette\Database\Context */
    protected $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }
}