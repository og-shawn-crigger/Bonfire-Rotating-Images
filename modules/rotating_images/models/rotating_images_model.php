<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rotating_images_model extends BF_Model {

  protected $table		      = "rotating_images";
  protected $key			       = "id";
  protected $soft_deletes	= false;
  protected $date_format	 = "datetime";
  protected $set_created	 = false;
  protected $set_modified = false;

  /*
  private $image_path;
  private $image_path_url;
  private $image_width;
  private $image_height;

  //--------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();

    $this->image_path     = realpath ( APPPATH . '../../assets/uploads/rotating');
    $this->image_path_url = base_url().'assets/uploads/rotating/';
    $this->image_height   = 274;
    $this->image_width    = 448;

  }
  */
  

}
