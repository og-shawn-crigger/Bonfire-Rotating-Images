<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_rotating_images_settings extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;
    $this->db->query("INSERT INTO {$prefix}settings (`name`, `module`, `value`) VALUES ('ri.directory', 'rotating_images', ''),
                     ('ri.height', 'rotating_images', ''), ('ri.width', 'rotating_images', ''), ('ri.resize', 'rotating_images', '');");
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;
    $this->db->query("DELETE FROM {$prefix}settings WHERE module='rotating_images';");
	}
	
	//--------------------------------------------------------------------
	
}
