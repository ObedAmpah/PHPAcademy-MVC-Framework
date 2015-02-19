<?php
	
	// A class that we call a new instance of -- Reason for not creating a bunch of new files, is handled in controllers
	
	class App 
	{
		
		// Default values when we run the App //
		protected $controller 	= 'home';
		
		protected $method 		= 'index';
		
		protected $params 		= []; 
		
		// Construct magic method called upon every instantiation
		public function __construct()
		{
			$url = $this->parseUrl();
						
			// 1. Check if the controller exists, if not, use the default
			if(file_exists('../app/controllers/' . $url[0] . '.php')) 
			{	
				
				// 2. If controller exists, set protected $controller to $url[0], then unset/remove from array
				$this->controller = $url[0];
				unset($url[0]);
				
			}
			
			// 3. Immediately require-in the controller that we have 
			require_once '../app/controllers/' . $this->controller . '.php';
			
			// 4. Replace controller with new instance of the controller, create new object
			$this->controller = new $this->controller;
			
			// 5. Check if the 2nd param (method) has been passed
			if(isset($url[1])) 
			{
				// 6. If the method exists on this controller
				if(method_exists($this->controller, $url[1]))
				{
					
					// 7. Set the method we have to the protected $method, then unset/remove from array
					$this->method = $url[1];
					unset($url[1]);
				}
			}
			
			// 8. Set the parameters with a check for the url having content
			$this->params = $url ? array_values($url) : []; //Pass the values into an empty array, if no rebase
			
			// 9. Call the controller and method
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
		
		// Explodes the url and parses out the controller, method and params
		public function parseUrl()
		{
			if(isset($_GET['url'])) 
			{
				// 1st, we rtrim, to remove trailing whitespace and foreward slash, 
				return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
			}
		}
	}
	