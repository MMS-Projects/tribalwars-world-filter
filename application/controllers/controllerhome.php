<?php
class ControllerHome extends Controller {
	public function actionDefault ($query) 
	{
		$this->addTemplateVar('time', time());
	}
}