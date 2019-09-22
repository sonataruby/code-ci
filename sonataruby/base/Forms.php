<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;

class Forms{
	protected $theme = 'bootstrap4';

    /**
     * Form Builder Theme By Class and other informations
     */
    public $template = false;
    protected $theme_templates = [
        
        'bootstrap4' => [
            // input and textarea and dropdown and multiselect
            'group_class' =>  'form-group',
            'label_class' =>  'col-md-3 col-sm-12 col-form-label',
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
        $this->CI = &get_instance();
        
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

        $group = isset($extract["group"]) ? $extract["group"] : false;

        $help = isset($extract["help"]) ? $extract["help"] : false;

        $append_before = isset($append[0]) ? $append[0] : false;
        $append_after = isset($append[1]) ? $append[1] : false;
        
        if(isset($extract["type"]) && $extract["type"] == "password"){
            $input = form_password($name, $value, $extract);
        }else{
            $input = form_input($name, $value, $extract);
        }
        $input = $append_before || $append_after ? '<div class="input-group">'.$append_before.$input.$append_after.'</div>' : $input;

        $layout = isset($extract["layout"]) ? $extract["layout"] : false;
        return  $this->group_start($group).
                $this->renderTemplate($this->label($label, $extract["id"], $extract),$input, $layout).
                $this->validate($name, $label,$extract).
                $this->help($help, $extract["id"]).
                $this->group_end($group);
    }

    public function datetime(array $params=[], $extract=[], $append=[]){ 
        //$extract["data-provide"] = "datepicker";
        //$extract["data-date-autoclose"] = "true";

        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : "";
        $value = isset($params["value"]) ? $params["value"] : "";

        
        $extract = array_merge($extract,["class" => "form-control"]);

        $group = isset($extract["group"]) ? $extract["group"] : false;

        $help = isset($extract["help"]) ? $extract["help"] : false;

        $input = "";
        if(is_array($name)){
            $ii = 0;
            foreach ($name as $keyName => $valueName) {
               $extract["id"] = "DatePicker".random_string('alnum', 16);
               $input .= form_input($keyName, $valueName, $extract);
               if($ii == 0){
                $input .= '<div class="input-group-prepend"><span class="input-group-text">To</span></div>';
               }
               $ii++;
            }
            $input = '<div class="input-group input-daterange" data-date-startDate="'.date("d/m/Y h:i").'" data-date-todayHighlight="true" data-provide="datepicker" data-date-autoclose="true">'.$input.'</div>';
            
        }else{
            $extract["id"] = "DatePicker".random_string('alnum', 16);
            $input = form_input($name, $value, $extract);
            $input = '<div class="input-group date" data-provide="datepicker" data-date-autoclose="true">'.$input.'<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-alt"></i></span></div></div>';
        }
        

        $layout = isset($extract["layout"]) ? $extract["layout"] : false;
        return  $this->group_start($group).
                $this->renderTemplate($this->label($label, $extract["id"], $extract),$input, $layout).
                $this->validate($name, $label,$extract).
                $this->help($help, $extract["id"]).
                $this->group_end($group);

        
        
    }

    public function upload(array $params=[], $extract=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $value = isset($params["value"]) ? $params["value"] : "";

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputText".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control"]);

        $group = isset($extract["group"]) ? $extract["group"] : false;
        $size = isset($extract["size"]) ? $extract["size"] : "480x250";
        $raito = isset($extract["raito"]) ? $extract["raito"] : false;
        if($raito){
            $size = image_raito($raito);
        }
        $help = isset($extract["help"]) ? $extract["help"] : false;
        $previewID = random_string('alnum', 16);

        $preview = (@$extract["preview"] ? 'upload-image-preview="'.@$extract["preview"].'"' : 'upload-image-preview="#Preview'.$previewID.'"');
        $layout = isset($extract["layout"]) ? $extract["layout"] : false;
        return  $this->group_start($group).
                $this->renderTemplate($this->label($label, $extract["id"], $extract),
                '
                <div class="media">
                    <div id="Preview'.$previewID.'" class="img-thumbnail mr-3" style="width:120px;"><img src="'.site_url(($value ? $value : "libs/image/nophoto.jpg")).'" alt="..." style="max-width:100%;"></div>
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
                ', $layout).
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
        $group = isset($extract["group"]) ? $extract["group"] : false;
        $help = isset($extract["help"]) ? $extract["help"] : false;
        $layout = isset($extract["layout"]) ? $extract["layout"] : false;

        return  $this->group_start($group).
                $this->renderTemplate($this->label($label, $extract["id"], $extract),form_dropdown($name, $item, $select, $extract), $layout).
                $this->help($help, $extract["id"]).
                $this->group_end($group);
    }


    public function country(array $params=[], $extract=[]){
        $options = [];
        //if(file_exists(CMS_SHAREPATH . "country.json")){
            $data = json_decode(file_get_contents(CMS_SHAREPATH . "country.json"));
            
            foreach ($data as $key => $value) {
                $options[$value->code] = $value->name;
            }
        //}
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
        $group = isset($extract["group"]) ? $extract["group"] : false;
        $help = isset($extract["help"]) ? $extract["help"] : false;
        $js = isset($extract["js"]) ? $extract["js"] : [];
        $layout = isset($extract["layout"]) ? $extract["layout"] : false;

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
                $this->renderTemplate((@$extract["label"] !== false ? $this->label($label, $extract["id"], $extract) : ""),
                $radio, $layout).
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
        $group = isset($extract["group"]) ? $extract["group"] : false;
        $help = isset($extract["help"]) ? $extract["help"] : false;
        $js = isset($extract["js"]) ? $extract["js"] : [];
        $layout = isset($extract["layout"]) ? $extract["layout"] : false;

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
                $this->renderTemplate((@$extract["label"] !== false ? $this->label($label, $extract["id"], $extract) : ""),
                $radio, $layout).
                $this->help($help, $extract["id"]).
                $this->group_end($group);

    }

    public function textarea(array $params=[], $extract=[]){
        $name = isset($params["name"]) ? $params["name"] : "";
        $label = isset($params["label"]) ? $params["label"] : $params["name"];
        $value = isset($params["value"]) ? $params["value"] : "";

        $extract["id"] = isset($extract["id"]) ? $extract["id"] : "InputTextarea".random_string('alnum', 16);
        $extract = array_merge($extract,["class" => "form-control"]);

        $group = isset($extract["group"]) ? $extract["group"] : false;

        $help = isset($extract["help"]) ? $extract["help"] : false;
        $layout = isset($extract["layout"]) ? $extract["layout"] : false;

        return  $this->group_start($group).
                $this->renderTemplate((@$extract["label"] !== false ? $this->label($label, $extract["id"], $extract) : ""),form_textarea($name, $value, $extract), $layout).
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
        $size = (isset($extract["size"]) && $extract["size"] != "" ? $extract["size"] : "990x440");
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


    public function template($set=""){
        $this->template = $set;
        return $this;
    }
    public function renderTemplate($label, $text, $layout=""){
        if($layout == "inline"){
            return $label.'<div class="col-md-9 col-sm-12">'.$text.'</div>';
        }
        return $label. $text;
    }

    public function label($name, $id="", $extract=[], $append=[]){
        if(isset($extract["data-spance"])) $name = $name." <em data-spance-lable>".$extract["data-spance"]."</em>";
        if(isset($extract["required"])) $name = $name ." ". $this->style["requried_text"];

        if(isset($extract["layout"]) && $extract["layout"] == "inline"){
            $append = array_merge($append, ["class" => $this->style["label_class"]]);
        }
        return form_label($name, $id,$append);
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
        if($on) return '<div class="form-group '.$on.'">';
    }

    public function group_end($on=false){
        if($on) return '</div>';
    }


    public function companyinfo(array $params=[], $extract=[], $append=[]){
        $name = $params["name"];
        $value = @$params["value"];
        return '
                
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                      '.$this->text(["name" => $name."[hotline]", "label" => "Hotline","value" => @$value->hotline],["required" => true]).'
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                      '.$this->text(["name" =>  $name."[site_email]", "label" => "Email","value" => @$value->site_email],["required" => true]).'
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                      '.$this->text(["name" => $name."[ctyphone]", "label" => "Tel","value" => @$value->ctyphone],[]).'
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                      '.$this->text(["name" =>  $name."[company_license_number]", "label" => "Company license number","value" => @$value->company_license_number],[]).'
                    </div>
                </div>'.$this->address($params, $extract, $append);
    }




    public function address(array $params=[], $extract=[], $append=[]){
        $name = $params["name"];
        $value = @$params["value"];
        return '
                
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                      '.$this->text(["name" => $name."[firstname]", "label" => "First Name","value" => @$value->firstname],["required" => true]).'
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                      '.$this->text(["name" =>  $name."[lastname]", "label" => "Last Name","value" => @$value->lastname],["required" => true]).'
                    </div>
                </div>
                  <div class="form-group">
                    '.$this->textarea(["name" =>  $name."[address]", "label" => "Address","value" => @$value->address],["rows" => 2,"required" => true]).'
                  </div>
                  <div class="form-group">
                    '.$this->textarea(["name" =>  $name."[address2]", "label" => "Address 2","value" => @$value->address2],["rows" => 2]).'
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4 col-sm-12">
                      '.$this->country(["name" =>  $name."[country]", "label" => "Country","value" => @$value->country],["required" => true]).'
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                      '.$this->text(["name" =>  $name."[region]", "label" => "Region","value" => @$value->region],["required" => true]).'
                    </div>
                    

                    <div class="form-group col-md-3 col-sm-12">
                      '.$this->text(["name" =>  $name."[city]", "label" => "City","value" => @$value->city],[]).'
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-12">
                      '.$this->text(["name" =>  $name."[zipcode]", "label" => "Zipcode","value" => @$value->zipcode]).'
                    </div>
                  </div>
                  ';
    }
    
}