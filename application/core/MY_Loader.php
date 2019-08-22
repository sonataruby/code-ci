<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */

require_once CMS_HMVCPATH."Loader.php";
use \Sonata\Components;
class MY_Loader extends MX_Loader {
    protected $template = 'default';
    protected $_setups = false;
    protected $debug = false;
    protected $register = [];

	/** Load a module view **/
    function __construct()
    {
        parent::__construct();
        $this->_ci_view_paths = [];
        
        //$this->config->set_item("base_url",BASE_URL);
        //$this->config->set_item("index_page","");
        $this->components = new Components;

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
        if(defined("IS_FRONTEND") ){
            $settemplate = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR;
            if(is_dir($settemplate)) $this->_ci_view_paths[$settemplate] = true;
        }
        $this->_setups = true;
    }

    public function registerView($path){
        $settemplate = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR;
        if(is_dir($settemplate)) $this->register[$settemplate] = true;
        $this->register[$path . DIRECTORY_SEPARATOR] = true;
        return $this;
    }
    
    public function view($view, $vars = array(), $return = FALSE, $channel=false)
    {
        
        if(!$this->_setups) $this->_setups();

        if(defined("IS_PLUGINS")){
            /*
            $this->_ci_view_paths = [];
            $settemplate = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . "plugins" . DIRECTORY_SEPARATOR;
            if(is_dir($settemplate)) $this->_ci_view_paths[$settemplate] = true;
            if(is_dir(CMS_SHAREPATH .  DIRECTORY_SEPARATOR . "plugins" . DIRECTORY_SEPARATOR)) $this->_ci_view_paths[CMS_SHAREPATH.  DIRECTORY_SEPARATOR . "plugins" . DIRECTORY_SEPARATOR] = true;

            */
            foreach ($this->_ci_plugins as $key => $value) {
                if($value == true){
                    list($path, $_plugin) = explode('/', $key);
                    $f_path = array_keys(CMS_MODULESPATH)[0];
                    $plugin_view = $f_path.$path."/views/";
                    $this->register[$plugin_view] = true;
                    //$this->_ci_view_paths = array_merge($this->_ci_view_paths,array($plugin_view => TRUE)) ;
                }
            }
            
            
        }

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

        

        
        
        /*
        Move to channel
        */
        if($channel){
            foreach ($this->_ci_view_paths as $key => $value) {
              
                if(file_exists($key."channel/".$channel."/{$view}.php")){
                    $view = "channel/".$channel ."/". $view;
                    
                }
                 

            }
        }

        $this->_ci_view_paths = array_merge($this->_ci_view_paths, $this->register);

        if(is_dir(CMS_SHAREPATH)) $this->_ci_view_paths[CMS_SHAREPATH] = true;

        if($this->debug){
            print_r($this->_ci_view_paths);
        }
        $dataOutput = $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => ((method_exists($this,'_ci_object_to_array')) ? $this->_ci_object_to_array($vars) : $this->_ci_prepare_view_vars($vars)), '_ci_return' => $return));


        if(!defined("BASE_ENTERPRISE") ){

            preg_match_all(
                '#'.preg_quote('{').'components=(.+?)'.preg_quote('}').'(.+?)'.preg_quote('{/components}').'#s',
                $dataOutput,
                $matches,
                PREG_SET_ORDER
            );
            $search = [];
            $replace = [];
            if(isset($matches[0]) && $matches[0]){
                list($source, $name, $options) = @$matches[0];
                $dataOptions = url_toarray($options);
                $type = (@$dataOptions["type"] ? $dataOptions["type"] : "");

                $search[] = $source;
                ob_start();
                $this->components->{$name}($type,$dataOptions);
                $replaceData = ob_get_clean();
                $replace[] = $replaceData;
            }
            $dataOutput = str_replace($search, $replace, $dataOutput);
            
            
        }

        return $dataOutput;
    }


    public function getPlugin($plugin, $options=[], $content=""){
        
        if(!$plugin) return "";
        /*
        Detach Plugins Install
        */
        $libplugin = array_keys((array)config_item("plugins"));

        if(!in_array($plugin, $libplugin)) return false;


        /*
        Call Plugins Function
        */
        $this->plugin($plugin);
        
        $pluginData = ucfirst(basename($plugin))."_pi";
        if(class_exists($pluginData)){
            $pluginData = new $pluginData;
            return $pluginData->data($options, $content);
        }
        return "";
    }

    public function getModuleName(){
        return $this->_module;
    }



    public function debug($type=false){
       $this->debug = $type;
    }


}