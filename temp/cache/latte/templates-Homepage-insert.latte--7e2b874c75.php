<?php
// source: C:\xampp\htdocs\CRUD\app\presenters/templates/Homepage/insert.latte

use Latte\Runtime as LR;

class Template7e2b874c75 extends Latte\Runtime\Template
{
	public $blocks = [
		'title' => 'blockTitle',
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'title' => 'html',
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('title', get_defined_vars());
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
		?>Přehled<?php
	}


	function blockContent($_args)
	{
?><div class="container">

    <div class="page">
        <h1>Nový projekt</h1>
    </div>

</div>
<?php
	}

}
