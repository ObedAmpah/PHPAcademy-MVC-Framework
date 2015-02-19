<?php
	
	// This is the default controller/method // 
	
	class Home extends Controller
	{
		public function index($name = '')
		{
			// Load in a model efficiently
			$user = $this->model('User');
			$user->name = $name;
			
			// Pulls the name parameter from the url and injects it into our view script 
			$this->view('home/index', ['name' => $user->name]);
		}
	}