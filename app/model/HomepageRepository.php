<?php


class HomepageRepository extends Repository {
    
    /** Název tabulky v databázi **/
    const TABLE_NAME= "projects";
    
    /** Vrátí seznam projektů **/
    public function ProjectsList() {
        $list = $this->database->table(self::TABLE_NAME)
                ->select("*")
                ->order("id");
        
        /** Pokud v databázi není žádný projekt, vrátí se null
         *  Slouží pro snadné vykreslení hlášky v Latte
         */
        if (count($list) == 0) {
            $list = null;
        }
        return $list;
    }
    
    /** Smaže projekt z databáze **/
    public function deleteProject($id) {
        $deleted = $this->database->table(self::TABLE_NAME)
                        ->where("id", $id)
                        ->delete(); 
        if($deleted){
            return true;
        } else {
            return false;
        }
    }
    
    
}


