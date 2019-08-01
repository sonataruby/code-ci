<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */

require_once CMS_HMVCPATH."Loader.php";

class MY_Loader extends MX_Loader {
    protected $template = 'default';
    protected $_setups = false;
	/** Load a module view **/
    function __construct()
    {
        parent::__construct();
        $this->_ci_view_paths = [];
        $base_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')) ?  "https" : "http";
        $base_url .= "://".$_SERVER['HTTP_HOST'];
        $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

       
        $this->config->set_item("base_url",$base_url);
        $this->config->set_item("index_page","");
        

    }
    public function setTemplate($arv=""){
        $this->template = $arv;
    }
    protected function _setups(){
       
        
        
        
        //$this->_ci_view_paths = [];

        if(defined("BASE_ENTERPRISE")){
            $this->_ci_view_paths[CMS_THEME_ENTERPRISE_PATH] = true;
        }
        
        if(defined("BASE_PERSONAL")){
            $this->_ci_view_paths[CMS_THEME_PERSONAL_PATH] = true;
        }

        /*Load template*/
        $settemplate = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR;
        if(is_dir($settemplate)) $this->_ci_view_paths[$settemplate] = true;
        $this->_setups = true;
    }

    public function view($view, $vars = array(), $return = FALSE)
    {
        
        if(!$this->_setups) $this->_setups();
        list($path, $_view) = Modules::find($view, $this->_module, 'views/');

        if ($path != FALSE)
        {
            if(defined("IS_ADMIN")){
                $this->_ci_view_paths = $this->_ci_view_paths + array($path . "admin/" => TRUE) ;
            }else{
                $this->_ci_view_paths = $this->_ci_view_paths + array($path => TRUE) ;
            }
            
            $view = $_view;
        }
        if(is_dir(CMS_SHAREPATH)) $this->_ci_view_paths[CMS_SHAREPATH] = true;
        
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => ((method_exists($this,'_ci_object_to_array')) ? $this->_ci_object_to_array($vars) : $this->_ci_prepare_view_vars($vars)), '_ci_return' => $return));
    }
}