<?php
abstract class Controller {
	public $model;
	public $name;
	public $templateVars = array();
	
	abstract public function actionDefault ($query);
	
	protected function addTemplateVar ($name, $val)
	{
		$this->templateVars[$name] = $val;
	}
	public function __destruct()
	{
		foreach ($this->templateVars as $key => $val) {
			$$key = $val;
		}
		
		if (file_exists(ROOT . "/application/views/" . $this->name . "/header.php")) {
			require_once ROOT . "/application/views/" . $this->name . "/header.php";
		} else {
			require_once ROOT . "/application/views/header.php";
		}
		require_once ROOT . "/application/views/" . $this->name . "/" . $this->action . ".php";
		if (file_exists(ROOT . "/application/views/" . $this->name . "/footer.php")) {
			require_once ROOT . "/application/views/" . $this->name . "/footer.php";
		} else {
			require_once ROOT . "/application/views/footer.php";
		}
	}
}