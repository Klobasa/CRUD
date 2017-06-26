<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Model;
use Tomaj\Form\Renderer\BootstrapVerticalRenderer;

class UserFormFactory {
    use Nette\SmartObject;
    
    /** @var FormFactory */
    private $factory;
    
    /** @var Model\UserFormManager */
    private $manager;
    
    public function __construct(FormFactory $factory, Model\UserFormManager $manager) {
        $this->factory = $factory;
        $this->manager = $manager;
    }
    
    public function create(callable $onSuccess, $id) {
        $editData = $this->setDefaults($id);
        $form = $this->factory->create();
        $form->setRenderer(new BootstrapVerticalRenderer);
        
        $form->addHidden("id")
                ->setValue($editData["id"]);
        
        $form->addText("name", "Jméno:")
                ->setRequired()
                ->addRule(Form::MAX_LENGTH, "Jméno uživatele může mít maximálně %d znaků.", 200)
                ->setValue($editData["name"]);
        
        $form->addSubmit("send", "Vložit");
        $form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
            
            if ($values->id) {
                $this->manager->updateUser($values->id, $values->name);
            } else {
                $this->manager->addUser($values->name);
            }
            
            $onSuccess();
        };
        return $form;
    }
    
        private function setDefaults($id) {
        if ($id) {
        $editData = $this->manager->getData($id);  
        $default = [
            "id" => $editData->id,
            "name" => $editData->name
        ];
        
        } else {
            $default = [
            "id" => null,
            "name" => null
        ];
        }
        return $default;
    }
}