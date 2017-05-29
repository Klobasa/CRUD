<?php
// source: C:\xampp\htdocs\CRUD\app\presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template86e8d589b0 extends Latte\Runtime\Template
{
	public $blocks = [
		'title' => 'blockTitle',
		'content' => 'blockContent',
		'head' => 'blockHead',
		'script' => 'blockScript',
	];

	public $blockTypes = [
		'title' => 'html',
		'content' => 'html',
		'head' => 'html',
		'script' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('title', get_defined_vars());
		$this->renderBlock('content', get_defined_vars());
?>

<?php
		$this->renderBlock('head', get_defined_vars());
?>

<?php
		$this->renderBlock('script', get_defined_vars());
?>


<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['project'])) trigger_error('Variable $project overwritten in foreach on line 22');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
		?>Přehled<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="container">

    <div class="page">
        <h1>Přehled projektů</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Název</th>
                    <th>Datum odevzdání</th>
                    <th>Typ projektu</th>
                    <th>Webový projekt</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <tr>
<?php
		if ($projectsList != null) {
			$iterations = 0;
			foreach ($projectsList as $project) {
?>
                        <tr>
                            <td><?php echo LR\Filters::escapeHtmlText($project->id) /* line 24 */ ?></td>
                            <td><?php echo LR\Filters::escapeHtmlText($project->name) /* line 25 */ ?></td>
                            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $project->deadline, "d.m.Y")) /* line 26 */ ?></td>
                            <td><?php
				if ($project->type == 0) {
					?>Časově omezený<?php
				}
				else {
					?>Kontinuální<?php
				}
?></td>
                            <td><?php
				if ($project->webProject == 1) {
					?>Ano<?php
				}
				else {
					?>Ne<?php
				}
?></td>
                            <td>
                                <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:EditProject", [$project->id])) ?>"<button type="button" class="btn btn-warning btn-xs">Upravit</button></a>
                                <a class="deleteButton" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:DeleteProject", [$project->id])) ?>" data-message="<?php
				echo LR\Filters::escapeHtmlAttr($project->name) /* line 31 */ ?>"><button type="button" class="btn btn-danger btn-xs">Smazat</button></a>
                            </td>
                        </tr>
<?php
				$iterations++;
			}
		}
		else {
?>
                    <tr>
                        <td colspan="6">V databázi není uložen žádný projekt</td>
                    </tr>
<?php
		}
?>
                </tr>
            </tbody>
        </table>

    </div>

    <div id="dialog-confirm" title="Odstranit projekt?">
        <p id="deleteAlert"></p>
    </div>

</div>
<?php
	}


	function blockHead($_args)
	{
?><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php
	}


	function blockScript($_args)
	{
		extract($_args);
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 59 */ ?>/js/deleteDialog.js"></script>
<?php
	}

}
