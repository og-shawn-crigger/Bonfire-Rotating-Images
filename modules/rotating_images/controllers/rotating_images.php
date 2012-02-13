<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class rotating_images extends Front_Controller {

  private $image_path;
  private $image_path_url;
  private $image_width;
  private $image_height;

  //--------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();

    $this->load->model('rotating_images_model', null, true);
    $this->lang->load('rotating_images');
    $this->image_path     = realpath ( APPPATH . '../../assets/uploads/rotating');
    $this->image_path_url = base_url().'assets/uploads/rotating/';
    $this->image_height   = 274;
    $this->image_width    = 448;

    $data['height'] = $this->image_height';

//    Assets::add_module_js('rotating_images','jquery.innerfade.js');
//    Assets::add_js(base_url() .'assets/js/jquery.innerfade.min.js','external');
    Assets::add_js( $this->load->view('rotating_images/js', $data, true) , 'inline');

  }

  public function __remap()
  {
    die('No direct access');
  }
  //--------------------------------------------------------------------

  /*
   Method: index()

   Displays a list of form data.
  */
  public function index()
  {

    $records = $this->rotating_images_model->find_all();

    $path    = $this->image_path;
    $url     = $this->image_path_url;

    $attr    = ' width="' . $this->image_width . '" height="' . $this->image_height . '" ';

    $list    = '';

    foreach ( $records as $record )
    {
      $record = (array) $record;

      if ( is_file ( $path . '/'. $record['rotating_images_image'] ) )
      {
        $image = $url . $record['rotating_images_image'];
        $title = ' title ="' . js_addslashes ( $record['rotating_images_caption'] ) . '" ';
        $list .= '    <li>' . PHP_EOL;
        $list .= '      <img src="' . $image . '" ' . $attr . $title . ' />' . PHP_EOL;
        $list .= '    </li>' . PHP_EOL;
      }
    }

    $data    = array();
    $data['list'] = $list;

    return $this->load->view('rotating_images/index', $data, true);
  }

	//--------------------------------------------------------------------

}
