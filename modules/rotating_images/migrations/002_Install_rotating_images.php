<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_rotating_images extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`rotating_images_caption` VARCHAR(255) NOT NULL");
			$this->dbforge->add_field("`rotating_images_image` VARCHAR(200) NOT NULL");
			$this->dbforge->add_field("`rotating_images_weight` TINYINT(3) NOT NULL");
			$this->dbforge->add_field("`rotating_images_active` TINYINT(1) NOT NULL");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('rotating_images');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('rotating_images');

	}
	
	//--------------------------------------------------------------------
	
}
