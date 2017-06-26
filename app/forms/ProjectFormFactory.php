<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Model;
use Tomaj\Form\Renderer\BootstrapVerticalRenderer;

class ProjectFormFactory {
    
    const
            MAX_USERS_IN_TEAM = 20;

    use Nette\SmartObject;

    /** @var FormFactory */
    private $factory;

    /** @var Model\FormManager */
    private $manager;

    public function __construct(FormFactory $factory, Model\FormManager $manager) {
        $this->factory = $factory;
        $this->manager = $manager;
    }

    public function create(callable $onSuccess, $id) {
        $editData = $this->setDefaults($id);
        $usersList = $this->manager->getUsers();

        $form = $this->factory->create();
        $form->setRenderer(new BootstrapVerticalRenderer);

        $form->addHidden("id")
                ->setValue($editData["id"]);
                

        $form->addText("name", "Název projektu:")
                ->setRequired("Vyplňte název projektu")
                ->addRule(Form::MAX_LENGTH, "Název projektu může mít maximálně %d znaků.", 200)
                ->setValue($editData["name"]);
        

        $form->addText("date", "Datum odevzdání projektu:")
                ->setOption("description", "DD.MM.RRRR")
                ->setRequired("Vyplňte datum")
                ->setValue($editData["date"]);
        

        $type = [0 => "časově omezený", 1 => "kontinuální",];
        $form->addRadioList("type", "Typ projektu:", $type)
                ->setRequired("Vyberte typ projektu")
                ->setValue($editData["type"]);

        $form->addCheckbox("webProject", "Webový projekt")
                ->setValue($editData["webProject"]);
        
        
        $con1 = $form->addContainer("users");
        $users = $editData["users"];
        
        for ($i=0; $i<self::MAX_USERS_IN_TEAM; $i++) {
            $users[$i] = isset($users[$i]) ? $users[$i] : null;
            $con1->addSelect($i, null, $usersList)
                ->setPrompt("Vyberte pracovníka")
                ->setValue($users[$i]);
        }

        $form->addsubmit("send", "Vložit");

        $form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
            $sepDate = explode(".", $values->date);
            $date = date("Y-m-d", strtotime(preg_replace('/\s+/', '', $values->date)));
            
            if (!checkdate($sepDate[1],$sepDate[0],$sepDate[2])) {
                $form->addError("Neplatný datum");
                return;
            }
            
            if ($values->id) {
                $this->manager->update($values->id, $values->name, $date, $values->type, $values->webProject, $values->users);
            } else {
                $this->manager->add($values->name, $date, $values->type, $values->webProject, $values->users);
            }
            $onSuccess();
        };
        
        return $form;
    }
    
    private function setDefaults($id) {
        if ($id) {
           
        $userList = $this->manager->getUsersId($id);
        $editData = $this->manager->getData($id);  
        $default = [
            "id" => $editData->id,
            "name" => $editData->name,
            "date" => date("d.m.Y", strtotime(preg_replace('/\s+/', '', $editData->deadline))),
            "type" => $editData->type,
            "webProject" => $editData->webProject,
            "users" => $userList
        ];
        
        } else {
            $default = [
            "id" => null,
            "name" => null,
            "date" => null,
            "type" => null,
            "webProject" => null,
            "users" => null
        ];
        }
        return $default;
    }

}
