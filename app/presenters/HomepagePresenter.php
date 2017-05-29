<?php

namespace App\Presenters;

use Nette;
use App\Model;
use App\Forms;



class HomepagePresenter extends BasePresenter
{
    
    /** @var Forms\ProjectFormFactory @inject */
    public $formFactory;
    
    private $homepageRepository;   
    public function __construct(\HomepageRepository $homepage) {
        $this->homepageRepository = $homepage;
    }
    
    private $id = null;

    
    public function renderDefault()
    {
        $this->template->projectsList = $this->homepageRepository->ProjectsList();
    }
    
    public function renderNewProject() {
        
    }
    
    public function actionDeleteProject($id)
    {
        if($this->homepageRepository->deleteProject($id)) {
            $this->flashMessage("Projekt byl odstraněn", "success");
            $this->redirect("Homepage:");
        } else {
            $this->flashMessage("Projekt se nepodařilo odstranit", "danger");
            $this->redirect("Homepage:");
        }
    }
    
    public function actionEditProject($id) {
        $this->id = $id;
    }
    
    
    protected function createComponentProjectForm() {
        $id = $this->id;
        return $this->formFactory->create(function () {
            $this->redirect("Homepage:");
            $this->flashMessage("Projekt úspěšně uložen", "success");
        }, $id);
    }
   
    

}
