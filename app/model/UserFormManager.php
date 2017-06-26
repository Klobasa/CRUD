<?php

namespace App\Model;

use Nette;

class UserFormManager {
    use Nette\SmartObject;
    
    const         
            TABLE_USERS = "users",
            COLUMN_USERNAME = "name";
    
        /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }
    
    public function addUser($name) {
        $this->database->table(self::TABLE_USERS)
                ->insert([self::COLUMN_USERNAME => $name]);
    }
    
    public function updateUser($id, $name) {
        $this->database->table(self::TABLE_USERS)
                ->where("id = ?", $id)
                ->update([self::COLUMN_USERNAME => $name]);
    }
    
    public function getData($id) {
        if ($id) {
            $data = $this->database->table(self::TABLE_USERS)
                    ->get($id);
        return $data;
        }
    }
}

