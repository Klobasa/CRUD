<?php

namespace App\Presenters;

use Nette;
use App\Model;
use App\Forms;



class HomepagePresenter extends BasePresenter
{
    
    /** @var Forms\ProjectFormFactory @inject */
    public $formFactory;
    
    /** @var Forms\UserFormFactory @inject */
    public $userFormFactory;
    
    private $homepageRepository;   
    public function __construct(\HomepageRepository $homepage) {
        $this->homepageRepository = $homepage;
    }
    
    private $id = null;
    private $userId = null;

    
    public function renderDefault()
    {
        $this->template->projectsList = $this->homepageRepository->ProjectsList();
    }
    
    public function renderNewProject() {
        
    }
    
    public function renderUsers() {
        $this->template->userList = $this->homepageRepository->UserList();
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
    
    public function actionEditUser($id) {
        $this->userId = $id;
    }
    
    protected function createComponentUserForm() {
        $userId = $this->userId;
        return $this->userFormFactory->create(function () {
            $this->redirect("Homepage:Users");
            $this->flashMessage("Pracovník uložen", "success");
        }, $userId);
    }
    
    public function actionDeleteUser($userId) {
        $this->homepageRepository->deleteUser($userId);
        $this->flashMessage("Pracovník byl odsraněn", "success");
        $this->redirect("Homepage:Users");
    }
   
    

}
