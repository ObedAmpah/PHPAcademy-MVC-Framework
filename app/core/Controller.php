<?php
	
	/*
	** Core controller 
	*/
	
	
	class Controller
	{
		// This method loads a model in by name 
		public function model($model)
		{
			// In order to use the model, we need to require them into this controller via
			require_once '../app/models/' . $model . '.php';
			
			// Return the new model object 
			return new $model();
		}
		
		// This method loads a view 
		public function view($view, $data = [])
		{
			// In order to use the view, we need to require it into this controller
			require_once '../app/views/' . $view . '.php';
		}
	}