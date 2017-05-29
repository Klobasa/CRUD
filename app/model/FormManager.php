<?php

namespace App\Model;

use Nette;

class FormManager {

    use Nette\SmartObject;

    const 
            TABLE_NAME = "projects",
            COLUMN_ID = "id",
            COLUMN_PROJECT_NAME = "name",
            COLUMN_DEADLINE = "deadline",
            COLUMN_PROJECT_TYPE = "type",
            COLUMN_WEB_PROJECT = "webProject";
    

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }
    
    
    public function add($name, $deadline, $type, $webProject) {
        $this->database->table(self::TABLE_NAME)->insert([
            self::COLUMN_PROJECT_NAME => $name,
            self::COLUMN_DEADLINE => $deadline,
            self::COLUMN_PROJECT_TYPE => $type,
            self::COLUMN_WEB_PROJECT => $webProject
        ]);
    }
    
    public function update($id, $name, $deadline, $type, $webProject){
        $this->database->table(self::TABLE_NAME)
                ->where("id = ?", $id)
                ->update([self::COLUMN_PROJECT_NAME => $name,
                    self::COLUMN_DEADLINE => $deadline,
                    self::COLUMN_PROJECT_TYPE => $type,
                    self::COLUMN_WEB_PROJECT => $webProject
        ]);
    }
        
    public function getData($id) {
        if ($id) {
        $data = $this->database->table(self::TABLE_NAME)
                ->get($id);
        } else {
            $data->name = "1";
        }
        return $data;
    }
}
