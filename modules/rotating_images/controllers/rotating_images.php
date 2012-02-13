<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class rotating_images extends Front_Controller {

  private $image_path;
  private $image_path_url;
  private $image_width;
  private $image_height;
	private $image_resize;
	
  //--------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();

    $this->load->model('rotating_images_model', null, true);
    $this->lang->load('rotating_images');
		
    $settings = $this->settings_model->find_all_by('module', 'rotating_images');
		
    $this->image_path     = realpath ( APPPATH . '../../' . $settings['ri.directory'] );
    $this->image_path_url = base_url(). $settings['ri.directory'];
    $this->image_height   = (int) $settings['ri.height'];
    $this->image_width    = (int) $settings['ri.width'];

    $data['height'] = $this->image_height;

    Assets::add_module_js('rotating_images','jquery.innerfade.js');
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

      if ( is_file ( $path . '/'. $record['image'] ) )
      {
        $image = $url . $record['image'];
        $title = ' title ="' . $record['caption'] . '" ';
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
