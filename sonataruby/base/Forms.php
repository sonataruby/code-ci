<?php
defined('BASEPATH') OR exit('No direct script access allowed');
namespace Sonata;
use Exception;
use stdClass;

class Forms{
	protected $theme = 'bootstrap4';

    /**
     * Form Builder Theme By Class and other informations
     */
    protected $theme_templates = [
        
        'bootstrap4' => [
            // input and textarea and dropdown and multiselect
            'group_class' =>  'form-group',
            'group_class' =>  'form-group',
            'label_class' =>  '',
            'input_class' => 'form-control',
            'input_error_class' => 'is-invalid',
            'requried_text' => '<span style="color:red;">(*)</span>',
            // only checkbox and radio
            'check_group_class' => 'form-check',
            'inline_check_group_class' => 'form-check-inline',
            'check_label_class' => 'form-check-label',
            'check_input_class' => 'form-check-input',
            // field help text
            'help_text_class' => 'form-text text-muted',
            // submit and reset button class
            'submit_class' => 'btn btn-default'
        ]

        
    ];
    
    public function __construct() {
        $this->CI =& get_instance();
        // load codeigniter form helper
        $this->CI->load->helper('form');
        $this->style = $this->theme_templates["bootstrap4"];
        
    }

	public function text(array $params=[], $extract=[], $append=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $value = isset($params["value"]) ? $params["value"] : "";

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputText".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control"]);

        $group = isset($extract["group"]) ? true : false;

        $help = isset($extract["help"]) ? $extract["help"] : false;

        $append_before = isset($append[0]) ? $append[0] : false;
        $append_after = isset($append[1]) ? $append[1] : false;
        
        if(isset($extract["type"]) && $extract["type"] == "password"){
            $input = form_password($name, $value, $extract);
        }else{
            $input = form_input($name, $value, $extract);
        }
        $input = $append_before || $append_after ? '<div class="input-group">'.$append_before.$input.$append_after.'</div>' : $input;

        return  $this->group_start($group).
                $this->label($label, $extract["id"], $extract).
                $input.
                $this->validate($name, $label,$extract).
                $this->help($help, $extract["id"]).
                $this->group_end($group);
    }

    public function datetime(array $params=[], $extract=[]){
        $extract["data-provide"] = "datepicker";
        return $this->text($params, $extract);

        
    }

    public function upload(array $params=[], $extract=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $value = isset($params["value"]) ? $params["value"] : "";

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputText".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control"]);

        $group = isset($extract["group"]) ? true : false;
        $size = isset($extract["size"]) ? $extract["size"] : "480x250";
        $raito = isset($extract["raito"]) ? $extract["raito"] : false;
        if($raito){
            $size = image_raito($raito);
        }
        $help = isset($extract["help"]) ? $extract["help"] : false;
        $previewID = random_string('alnum', 16);

        $preview = (@$extract["preview"] ? 'upload-image-preview="'.@$extract["preview"].'"' : 'upload-image-preview="#Preview'.$previewID.'"');
        return  $this->group_start($group).
                $this->label($label, $extract["id"], $extract).
                '
                <div class="media">
                    <div id="Preview'.$previewID.'" class="img-thumbnail mr-3" style="width:120px;"><img src="'.site_url($value).'" alt="..." style="max-width:100%;"></div>
                    <div class="media-body">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" '.$preview.' data-size="'.$size.'" value="'.$value.'" class="custom-file-input" id="Upload'.$extract["id"].'" aria-describedby="UploadAddon'.$extract["id"].'">
                            <input type="hidden" name="'.$name.'" value="'.$value.'">
                            <label class="custom-file-label displayname" for="Upload'.$extract["id"].'">'.basename($value).'</label>
                          </div>
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="UploadAddon'.$extract["id"].'">Upload</button>
                          </div>
                        </div>
                    </div>
                </div>
                '.
                $this->validate($name, $label,$extract).
                $this->help($help, $extract["id"]).
                $this->group_end($group);
    }

    public function select(array $params=[], $extract=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $select = isset($params["value"]) ? $params["value"] : "";
        $item = isset($params["options"]) ? $params["options"] : [];
        $object = isset($params["object"]) ? $params["object"] : [];

        if($object && isset($object["object"]) && isset($object["value"]) && isset($object["label"])){

            foreach ($object["object"] as $key => $value) {
                $item[$value->{$object["value"]}] = $value->{$object["label"]};
                if(isset($value->item) && is_array($value->item)){
                    if(isset($extract["exit"])){
                        //print_r($value->item); exit();
                    }
                    foreach ($value->item as $key_item => $value_item) {
                        $item[$value_item->{$object["value"]}] = $value->{$object["label"]} . " > ".$value_item->{$object["label"]};
                    }

                }
            }
        }

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputSelect".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control custom-select"]);
        $group = isset($extract["group"]) ? true : false;
        $help = isset($extract["help"]) ? $extract["help"] : false;

        return  $this->group_start($group).
                $this->label($label, $extract["id"], $extract).
                form_dropdown($name, $item, $select, $extract).
                $this->help($help, $extract["id"]).
                $this->group_end($group);
    }


    public function country(array $params=[], $extract=[]){
        $this->CI->load->database();
        $data = json_decode(file_get_contents(CATALOG . "share/json/country/country.json"));
        $options = [];
        foreach ($data as $key => $value) {
            $options[$value->code] = $value->name;
        }

        $params["options"] = array_merge(isset($params["options"]) && is_array($params["options"]) ? $params["options"] : [], $options);
        
        return $this->select($params, $extract);
    }

    public function radio(array $params=[], $extract=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $select = isset($params["select"]) ? $params["select"] : "";
        $item = isset($params["options"]) ? $params["options"] : [];

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputRadio".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control"]);
        $group = isset($extract["group"]) ? true : false;
        $help = isset($extract["help"]) ? $extract["help"] : false;
        $js = isset($extract["js"]) ? $extract["js"] : [];


        $radio = '';
        if(is_array($item)){
            foreach ($item as $key => $value) {
                $dataRadio = [
                    "name" => $name,
                    "id" => $extract["id"]."_".$key,
                    "label" => $value["label"],
                    "value" => $value["value"],
                    "checked" => isset($params["value"]) && $params["value"] == $value["value"] ? true : false,
                    "class" => "custom-control-input"
                ];
                $dataRadio = array_merge($dataRadio, $js);

                $radio .= '<div class="custom-control custom-radio'.(@$extract["inline"] !== false ? " custom-control-inline" : "").'">'.form_radio($dataRadio).$this->label($dataRadio["label"], $dataRadio["id"],[],["class" => "custom-control-label"]).'</div>';
            }
        }
        
        return  $this->group_start($group).
                (@$extract["label"] !== false ? $this->label($label, $extract["id"], $extract) : "").
                $radio.
                $this->help($help, $extract["id"]).
                $this->group_end($group);
    }

    public function checkbox(array $params=[], $extract=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $select = isset($params["select"]) ? $params["select"] : "";
        $item = isset($params["options"]) ? $params["options"] : [];

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputRadio".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control"]);
        $group = isset($extract["group"]) ? true : false;
        $help = isset($extract["help"]) ? $extract["help"] : false;
        $js = isset($extract["js"]) ? $extract["js"] : [];


        $radio = '';
        if(is_array($item)){
            foreach ($item as $key => $value) {
                $dataRadio = [
                    "name" => $name,
                    "id" => $extract["id"]."_".$key,
                    "label" => $value["label"],
                    "value" => $value["value"],
                    "checked" => isset($params["value"]) && $params["value"] == $value["value"] ? true : false,
                    "class" => "custom-control-input"
                ];
                $dataRadio = array_merge($dataRadio, $js);

                $radio .= '<div class="custom-control custom-checkbox'.(@$extract["inline"] !== false ? " custom-control-inline" : "").'">'.form_checkbox($dataRadio).$this->label($dataRadio["label"], $dataRadio["id"],[],["class" => "custom-control-label"]).'</div>';
            }
        }
        
        return  $this->group_start($group).
                (@$extract["label"] !== false ? $this->label($label, $extract["id"], $extract) : "").
                $radio.
                $this->help($help, $extract["id"]).
                $this->group_end($group);

    }

    public function textarea(array $params=[], $extract=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $value = isset($params["value"]) ? $params["value"] : "";

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputTextarea".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control"]);

        $group = isset($extract["group"]) ? true : false;

        $help = isset($extract["help"]) ? $extract["help"] : false;

        return  $this->group_start($group).
                (@$extract["label"] !== false ? $this->label($label, $extract["id"], $extract) : "").
                form_textarea($name, $value, $extract).
                $this->help($help, $extract["id"]).
                $this->group_end($group);
    }

    public function textedit(){

    }


    public function button($params=[], $extract=[]){
         $name = isset($params["name"]) ? $params["name"] : "";
         $label = isset($params["label"]) ? $params["label"] : "Button";
         //$value = isset($extract["value"]) ? $extract["value"] : "";

         $extract["id"] = isset($extract["id"]) ? $extract["id"] : "Button".random_string('alnum', 16);
         $defaultClass = '';
         
         if($name == "edit"){
            $extract["class"] = isset($extract["class"]) ? $extract["class"] : "btn-success";
            $label = '<i class="la la-edit"></i> '.$label;
         }

         if($name == "save"){
            $extract["class"] = isset($extract["class"]) ? $extract["class"] : "btn-primary";
            $label = '<i class="la la-save"></i> '.$label;
         }

         if($name == "delete"){
            $extract["class"] = isset($extract["class"]) ? $extract["class"] : "btn-danger";
            $label = '<i class="la la-trash"></i> '.$label;
         }


         if(isset($extract["type"]) && $extract["type"] == "find"){
            $extract["class"] = isset($extract["class"]) ? $extract["class"] : "btn-success";
            $label = '<i class="la la-search"></i> '.$label;
         }

         $extract["class"] = isset($extract["class"]) ? "btn ". $extract["class"] : "btn";

         $data = form_button($name, $label, $extract);
         if(isset($extract["type"]) && ($extract["type"] == "submit" || $extract["type"] == "find")){
            $data = str_replace('type="button"', 'type="submit"', $data);
         }

         return $data;
         
    }

    

    public function form_start(){

    }
    

    public function form_close(){

    }


    public function gallery(array $params=[], $extract=[]){
        $numstart = 2;
        $name = (isset($params["name"]) ? $params["name"] : "gallery[]");
        $size = (isset($extract["size"]) ? $extract["size"] : "600x315");
        $resize = (isset($extract["resize"]) ? ' data-resize="'.$extract["resize"].'"' : "");

        $value = (isset($params["value"]) ? $params["value"] : []);

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputPreview".random_string('alnum', 16);
        $raito = isset($extract["raito"]) ? $extract["raito"] : false;
        $onChange = isset($extract["onChange"]) ? " onChange='".$extract["onChange"]."'" : "";
        if($raito){
            $size = image_raito($raito);
        }
        
        $thumb = '<div class="gallery-container">';
        if(!isset($extract["flat"])){
        $thumb .= '<div class="first-gallery"><div id="PreView'.$extract["id"].'"><img src="'.site_url((@$value[0] ? @$value[0] : "libs/image/nophoto.jpg")).'" class="w-100"></div><label class="custom-file-upload"><input type="file" upload-image-preview="#PreView'.$extract["id"].'" data-size="'.$size.'" '.$resize.$onChange.'/></label><input name="'.$name.'" value="'.@$value[0].'" type="hidden"><div><i class="la la-trash gallery-clear"></i></div></div>';
        }else{
            $numstart = 1;
        }


        $number = (@$extract["number"] ? $extract["number"] : 0);
        $style = (@$extract["style"] ? 'style="'.$extract["style"].'"' : 0);
        $append = (@$extract["append"] ? $extract["append"] : []);
        $class = (@$extract["class"] ? " ".$extract["class"] : "");

        $thumb .= '<ul>';
        for($i=$numstart; $i<=$number; $i++){
            $id = "ThumB".random_string('alnum', 16);
            $append_html = '';
            if(is_array($append) && $append){
                $append_html = str_replace('{value}',@$append[1][$i-1],@$append[0]);
            }

            $thumb .= '<li class="second-gallery'.$class.'" '.$style.'><dd style="position: relative;"><div id="'.$id.'"><img src="'.site_url((@$value[$i-1] ? @$value[$i-1] : "libs/image/nophoto.jpg")).'" class="img-100"></div><label class="custom-file-upload"><input type="file" upload-image-preview="#'.$id.'" data-size="'.$size.'" '.$resize.$onChange.'/></label><input name="'.$name.'" value="'.@$value[$i-1].'" type="hidden"><div><i class="la la-trash gallery-clear"></i></div></dd>'.$append_html.'</li>';
        }
        $thumb .= '</ul>';
         $thumb .= '</div>';
        return $thumb;
    }

    public function thumnail(array $params=[], $extract=[]){
        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputPreview".random_string('alnum', 16);
        $thumb = '<div id="PreView'.$extract["id"].'" style="position: absolute;width: 100%;height: 100%;border:1px solid #ddd;background:red;">'.$extract["id"].'</div>';
        $extract["preview"] = '#PreView'.$extract["id"]; 
        return $thumb.$this->upload($params, $extract);
    }

    public function label($name, $id="", $extract=[], $append=[]){
        if(isset($extract["data-spance"])) $name = $name." <em data-spance-lable>".$extract["data-spance"]."</em>";
        if(isset($extract["required"])) $name = $name ." ". $this->style["requried_text"];
        
        return form_label($name, $id,$append);
    }

    public function link($link, $label, $extract=[]){
        $name = isset($extract["type"]) ? $extract["type"] : "";
        $hide_text = isset($extract["hide"]) ? 1 : 0;
        

        if($name == "edit"){
            $extract["class"] = isset($extract["class"]) ? "btn btn-success ".$extract["class"] : "btn btn-success";
            $label = '<i class="la la-edit"></i> '.($hide_text == 0 ? $label : "");
        }


        if($name == "find"){
            $extract["class"] = isset($extract["class"]) ? $extract["class"] : "btn btn-success";
            $label = '<i class="la la-search"></i> '.($hide_text == 0 ? $label : "");
        }

        if($name == "create"){
            $extract["class"] = isset($extract["class"]) ? "btn btn-primary ".$extract["class"] : "btn btn-primary";
            $label = '<i class="la la-plus"></i> '.($hide_text == 0 ? $label : "");
        }

        if($name == "save"){
            $extract["class"] = isset($extract["class"]) ? "btn btn-primary ".$extract["class"] : "btn btn-primary";
            $label = '<i class="la la-save"></i> '.($hide_text == 0 ? $label : "");
        }

        if($name == "delete"){
            $extract["class"] = isset($extract["class"]) ? "btn btn-danger ".$extract["class"] : "btn btn-danger";
            $label = '<i class="la la-trash"></i> '.($hide_text == 0 ? $label : "");
        }

        if($name == "import"){
            $extract["class"] = isset($extract["class"]) ? "btn btn-success ".$extract["class"] : "btn btn-success";
            $label = '<i class="la la-file-excel-o"></i> '.($hide_text == 0 ? $label : "");
        }

        if($name == "export"){
            $extract["class"] = isset($extract["class"]) ? "btn btn-warning ".$extract["class"] : "btn btn-warning";
            $label = '<i class="la la-file-word-o"></i> '.($hide_text == 0 ? $label : "");
        }


        if(!isset($extract["class"])){
            $extract["class"] = 'btn btn-primary';
        }

        return '<a href="'.site_url($link).'" '._stringify_attributes($extract).'>'.$label.'</a>';
    }


    public function help($text, $id=""){
        return $text ? '<small id="'.$id.'" class="form-text text-muted">'.$text.' <i class="la la-question"></i> </small>' : "";
    }

    public function validate($name, $label, $extract=[]){

        if(isset($extract["required"])){
            return '<div class="invalid-feedback">Please complate '.$label.'.</div>';
        }
    }

    public function group_start($on=false){
        if($on) return '<div class="form-group">';
    }

    public function group_end($on=false){
        if($on) return '</div>';
    }
}