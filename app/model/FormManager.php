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
            COLUMN_WEB_PROJECT = "webProject",
            TABLE_NAME_USERS = "users",
            TABLE_NAME_P_U = "project_user",
            COLUMN_USER_ID = "user",
            COLUMN_PROJECT_ID = "project";

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    /** Přidává nový projekt do databáze
     * 
     * @param string $name - jméno projektu
     * @param date $deadline - datum odevzdání projektu
     * @param bool $type - typ projektu
     * @param bool $webProject - je projekt webový projekt?
     * @param array $users - pracovníci u projektu
     */
    public function add($name, $deadline, $type, $webProject, $users) {
        $row = $this->database->table(self::TABLE_NAME)->insert([
            self::COLUMN_PROJECT_NAME => $name,
            self::COLUMN_DEADLINE => $deadline,
            self::COLUMN_PROJECT_TYPE => $type,
            self::COLUMN_WEB_PROJECT => $webProject
        ]);

        $this->insertUsersToProject($users);
    }

    /** Aktualizuje projekt v databázi
     * 
     * @param int $id - id projektu v databázi
     * @param date $deadline - datum odevzdání projektu
     * @param bool $type - typ projektu
     * @param bool $webProject - je projekt webový projekt?
     * @param array $users - pracovníci u projektu
     */
    public function update($id, $name, $deadline, $type, $webProject, $users) {
        $this->database->table(self::TABLE_NAME)
                ->where("id = ?", $id)
                ->update([self::COLUMN_PROJECT_NAME => $name,
                    self::COLUMN_DEADLINE => $deadline,
                    self::COLUMN_PROJECT_TYPE => $type,
                    self::COLUMN_WEB_PROJECT => $webProject
        ]);
        $this->database->table(self::TABLE_NAME_P_U)
                ->where("project = ?", $id)
                ->delete();

        $this->insertUsersToProject($users);
    }

    /** Přiřazuje čelny týmu k projektu
     * 
     * @param array $users - členové týmu
     */
    private function insertUsersToProject($users) {
        $users = array_unique((array) $users); //odstraní duplicitní uživatele
        foreach ($users as $user) {
            if ($user) {
                $this->database->table(self::TABLE_NAME_P_U)->insert([
                    self::COLUMN_PROJECT_ID => $id,
                    self::COLUMN_USER_ID => $user
                ]);
            }
        }
    }

    /** Získává projekt z databáze na základě id
     * 
     * @param int $id - id projektu
     * @return array|null
     */
    public function getData($id) {
        if ($id) {
            $data = $this->database->table(self::TABLE_NAME)
                    ->get($id);
            return $data;
        } else {
            return null;
        }
    }

    
    public function getUsers() {
        $data = $this->database->table(self::TABLE_NAME_USERS)
                ->fetchPairs("id", "name");
        return $data;
    }

    public function getUsersId($projectId) {
        $data = $this->database->table(self::TABLE_NAME_P_U)->where("project", $projectId)->fetchPairs("user", "user");

        return array_keys($data);
    }

}
