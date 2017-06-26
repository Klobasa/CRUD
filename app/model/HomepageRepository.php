<?php

class HomepageRepository extends Repository {

    /** Název tabulky v databázi */
    const TABLE_PROJECTS = "projects",
            TABLE_USERS = "users",
            TABLE_P_U = "project_user";

    /** Vrátí seznam projektů */
    public function ProjectsList() {
        $list = $this->database->table(self::TABLE_PROJECTS)
                ->select("*")
                ->order("id");
        
        /** Pokud v databázi není žádný projekt, vrátí se null
         *  Slouží pro snadné vykreslení hlášky v Latte
         */
        if (count($list) == 0) {
            return null;
        }
        return $list;
    }

    /** Smaže projekt z databáze * */
    public function deleteProject($id) {
        $this->database->table(self::TABLE_P_U)
                ->where("project", $id)->delete();
        $deleted = $this->database->table(self::TABLE_PROJECTS)
                ->where("id", $id)->delete();
        
        if ($deleted) {
            return true;
        } else {
            return false;
        }
    }

    /** Maže pracovníka z databáze **/
    public function deleteUser($userId) {
        $this->database->table(self::TABLE_P_U)
                ->where("user", $userId)->delete();
        
        $this->database->table(self::TABLE_USERS)
                ->where("id", $userId)->delete();
    }

    /** Vrrátí seznam pracovníků v databázi **/
    public function UserList() {
        $list = $this->database->table(self::TABLE_USERS)
                ->select("*")
                ->order("id");

        if (count($list) == 0) {
            $list = null;
        }
        return $list;
    }

}
