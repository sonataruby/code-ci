<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Migrations extends Enterprise {
	private $_migration_path;
	protected $_migration_file_table = '';
	protected $_migration_file_name = '';
	protected $_migration_table = 'migrations';
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		// Load the libraries
		$this->config->load("migration");
		$this->load->library('migration');
		$this->_migration_path = $this->config->item('migration_path');
		
		
	}
	public function index(){
		$result= $this->db->list_tables();

		$this->view("migrations", ["data" => $result]);
	}

	public function renderall(){
		$result= $this->db->list_tables();
		foreach ($result as $key => $value) {
			$this->render($value, true);
		}
		$this->go("tools/migrations/");
	}
	public function render($table, $return=false){
		$this->_migration_file_table = $table;
		$file_name = $this->_format_file_name($this->_get_migration_version()."_".$table);
		$data = $this->_get_file_content($table);
		
		write_file($this->_migration_path . "/{$file_name}.php", $data);
		if(!$return) $this->go("tools/migrations/");
	}


	protected function _get_file_content($table_name = '')
	{
		$file_content = '<?php ';
        $file_content .= 'defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');' . "\n\n";
        $file_content .= "class Migration_{$table_name} extends CI_Migration" . "\n";
        $file_content .= '{' . "\n";
        $file_content .= "\n\t" .'private $tables="'.$table_name.'";' . "\n";
        $file_content .= $this->get_function_up_content($table_name);
        $file_content .= $this->get_function_down_content($table_name);
        $file_content .= "\n" . '}' . "\n";
        // replace tab into 4 space
        $file_content = str_replace("\t", '    ', $file_content);
        return $file_content;
		
	}


	public function get_function_up_content($table_name)
    {
        $str = "\n\t" . '/**' . "\n";
        $str .= "\t" . ' * up (create table)' . "\n";
        $str .= "\t" . ' *' . "\n";
        $str .= "\t" . ' * @return void' . "\n";
        $str .= "\t" . ' */' . "\n";
        $str .= "\t" . 'public function up()' . "\n";
        $str .= "\t" . '{' . "\n";
        $query = $this->db->query("SHOW FULL FIELDS FROM {$this->db->dbprefix($table_name)} FROM {$this->db->database}");
        // 如果没有结果，直接返回
        if ($query->result() === NULL)
        {
            return FALSE;
        }
        $columns = $query->result_array();//获取列数据
        $add_key_str = '';
        $add_field_str = "\t\t" . '$this->dbforge->add_field(array(' . "\n";
        foreach ($columns as $column)
        {
            // field name
            $add_field_str .= "\t\t\t'{$column['Field']}' => array(" . "\n";
            preg_match('/^(\w+)\(([\d]+(?:,[\d]+)*)\)/', $column['Type'], $match);
            if($match === [])
            {
                preg_match('/^(\w+)/', $column['Type'], $match);
            }
            $add_field_str .= "\t\t\t\t'type' => '" . strtoupper($match[1]) . "'," . "\n";
            if(isset($match[2]))
            {
                switch (strtoupper($match[1]))
                {
                    //type enum need extra handle
                    case 'ENUM':
                        $enum_constraint_str = str_replace(',', ', ', $match[2]);
                        $add_field_str .= "\t\t\t\t'constraint' => [" . $enum_constraint_str . "],\n";
                        break;
                    default:
                        $add_field_str .= "\t\t\t\t'constraint' => '" . strtoupper($match[2]) . "'," . "\n";
                        break;
                }
            }
            $add_field_str .= (strstr($column['Type'], 'unsigned')) ? "\t\t\t\t'unsigned' => TRUE," . "\n" : '';
            $add_field_str .= ((string) $column['Default'] !== '') ? "\t\t\t\t'default' => '" . $column['Default'] . "'," . "\n" : '';
            $add_field_str .= ((string) $column['Comment'] !== '') ? "\t\t\t\t'comment' => '" . str_replace("'", "\\'", $column['Comment']) . "',\n" : '';
            $add_field_str .= ($column['Null'] !== 'NO') ? "\t\t\t\t'null' => TRUE," . "\n" : '';
            $add_field_str .= "\t\t\t)," . "\n";
            if ($column['Key'] == 'PRI')
            {
                $add_key_str .= "\t\t" . '$this->dbforge->add_key("' . $column['Field'] . '", TRUE);' . "\n";
            }
        }
        $add_field_str .= "\t\t));" . "\n";
        $str .= "\n\t\t" . '// Add Fields.' . "\n";
        $str .= $add_field_str;
        $str .= ($add_key_str !== '') ? "\n\t\t" . '// Add Primary Key.' . "\n" . $add_key_str : '';
        // create db
        $query = $this->db->query(' SHOW TABLE STATUS WHERE Name = \'' . $table_name . '\'');
        $engines = $query->row_array();
        $attributes_str = "\n\t\t" . '$attributes = array(' . "\n";;
        $attributes_str .= ((string) $engines['Engine'] !== '') ? "\t\t\t'ENGINE' => '" . $engines['Engine'] . "'," . "\n" : '';
        $attributes_str .= ((string) $engines['Comment'] !== '') ? "\t\t\t'COMMENT' => '\\'" . str_replace("'", "\\'", $engines['Comment']) . "'\\'',\n" : '';
        $attributes_str .= "\t\t" . ');' . "\n";
        $str .= "\n\t\t" . '// Table attributes.' . "\n";
        $str .= $attributes_str;
        $str .= "\n\t\t" . '// Create Table ' . $table_name . "\n";
        $str .= "\t\t" . '$this->dbforge->create_table($this->tables, TRUE, $attributes);' . "\n";
        $str .= "\n\t" . '}' . "\n";
        return $str;
    }
    /**
     * Base on table name create migration down function
     *
     * @param string $table_name table name
     *
     * @return string
     */
    public function get_function_down_content($table_name)
    {
        $function_content = "\n\t" . '/**' . "\n";
        $function_content .= "\t" . ' * down (drop table)' . "\n";
        $function_content .= "\t" . ' *' . "\n";
        $function_content .= "\t" . ' * @return void' . "\n";
        $function_content .= "\t" . ' */' . "\n";
        $function_content .= "\t" . 'public function down()' . "\n";
        $function_content .= "\t" . '{' . "\n";
        $function_content .= "\t\t" . '// Drop table ' . $table_name . "\n";
        $function_content .= "\t\t" . '$this->dbforge->drop_table($this->tables, TRUE);' . "\n";
        $function_content .= "\t" . '}' . "\n";
        return $function_content;
    }

	protected function _format_file_name($file_name = '')
	{
		return str_replace(' ', '_', $file_name);
	}



	protected function _get_migration_version()
	{
		// By default we'll use the timestamps
		// for version control
		$migration_version = date("YmdHis");
		// If the migration type has been set to 
		// sequential, we'll set the migration 
		// version to sequential
		if ($this->config->item('migration_type') === 'sequential')
		{
			$migration_version = (int) ( (int) $this->_get_version() + 1);
			$migration_version = str_pad($migration_version, 3, "0", STR_PAD_LEFT);
		}
		return $migration_version;
	}

	protected function _get_version($select = 'version')
	{
		$row = $this->db->select($select)->get($this->_migration_table)->row();
		return $row ? $row->$select : '0';
	}
}