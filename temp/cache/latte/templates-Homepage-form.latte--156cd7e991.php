<?php
// source: C:\xampp\htdocs\CRUD\app\presenters/templates/Homepage/form.latte

use Latte\Runtime as LR;

class Template156cd7e991 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="container">

    <div class="page">
<?php
		$this->renderBlock('title', get_defined_vars());
?>
        <div class="form">
            <div class="panel panel-default">
<?php
		/* line 8 */ $_tmp = $this->global->uiControl->getComponent("projectForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
?>
            </div>
        </div>
    </div>

</div>
<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?>        <h1>Nový projekt</h1>
<?php
	}

}
