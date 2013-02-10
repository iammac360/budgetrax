<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	//Page info
	protected $data = array();
	protected $pageName = FALSE;
	protected $template = "main";
	protected $hasNav = TRUE;
	protected $useHeader = TRUE;
	protected $useBasejs = TRUE;
	protected $useFBjs = FALSE;
	
	//Page contents
	protected $javascript = array();
	protected $jstmpl = array();
	protected $css = array();
	protected $fonts = array();

	//Page Meta
	protected $title = FALSE;
	protected $description = FALSE;
	protected $keywords = FALSE;
	protected $author = FALSE;

	//Facebook
	protected $graph_url = "https://graph.facebook.com/";
	protected $user_id;
	protected $user_info;
	protected $login_url;
	protected $logout_url;
	
	function __construct()
	{	
		parent::__construct();
		
		$this->login_url = $this->facebook->getLoginURL(
			$params = array(
				'redirect_uri' => site_url('home')
			)
		);
		$this->logout_url = site_url('logout');
		$this->data["uri_segment_1"] = $this->uri->segment(1);
		$this->data["uri_segment_2"] = $this->uri->segment(2);
		$this->title = $this->config->item('site_title');
		$this->description = $this->config->item('site_description');
		$this->keywords = $this->config->item('site_keywords');
		$this->author = $this->config->item('site_author');
		
		$this->pageName = strToLower(get_class($this));
	}
	 
	
	protected function _render($view) {
		//static
		$toTpl["javascript"] = $this->javascript;
		$toTpl["css"] = $this->css;
		$toTpl["fonts"] = $this->fonts;
		
		//meta
		$toTpl["title"] = $this->title;
		$toTpl["description"] = $this->description;
		$toTpl["keywords"] = $this->keywords;
		$toTpl["author"] = $this->author;
		
		//data
		$toBody["content_body"] = $this->load->view($view,array_merge($this->data,$toTpl),true);

		if($this->useFBjs)
		{
			$toBody["fbinitjs"] = $this->load->view("template/fbinitjs", $this->data, true);
		}
		
		//nav menu
		if($this->hasNav) {
			$this->load->helper("nav");
			$toNav["pageName"] = $this->pageName;
			$toNav["logout_url"] = $this->logout_url;
			$toHeader["nav"] = $this->load->view("template/nav",$toNav,true);
		}
		
		if($this->useHeader)
		{
			if($this->useBasejs) $toHeader["basejs"] = $this->load->view("template/basejs",$this->data,true);
			$toBody["header"] = $this->load->view("template/header",$toHeader,true);
		}
		else
		{
			if($this->useBasejs) $toBody["basejs"] = $this->load->view("template/basejs",$this->data,true);
	
			foreach($this->jstmpl as $js)
			{
				$toBody["jstmpl"] = $this->load->view($js,$this->data,true);
			}
		}
		$toBody["footer"] = $this->load->view("template/footer",'',true);
		
		$toTpl["body"] = $this->load->view("template/".$this->template,$toBody,true);
		
		
		//render view
		$this->load->view("template/skeleton",$toTpl);
		
	}

	protected function _facebook_auth($user)
	{
		$this->user_id = $user;
		
		if(empty($this->user_id)) 
		{
			echo '<script type="text/javascript">top.location.href="'.site_url('login').'";</script>';
	        exit;
    	}
    	else 
    	{
			try 
			{
				// Fetch the viewer's vasic information
				$this->user_info = $this->facebook->api('/me');
				// Create User if not exists in the database
				User::create_user_if_not_exists($this->user_info);
			} catch (FacebookApiException $e) {
				header('Location: '. getUrl($_SERVER['REQUEST_URI']));
				exit();
			}
		}
	}
}
