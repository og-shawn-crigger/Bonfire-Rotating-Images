<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Rotating_Images.Settings.View');
		$this->load->model('rotating_images_model', null, true);
		$this->lang->load('rotating_images');
		
    $settings = $this->settings_model->find_all_by('module', 'rotating_images');

    $ri_dir    = $settings['ri.directory'];
    $ri_width  = $settings['ri.width'];
    $ri_height = $settings['ri.height'];
    $ri_resize = $settings['ri.resize'];

    Template::set('ri_directory',$ri_dir);
    Template::set('ri_width',$ri_width);
    Template::set('ri_height',$ri_height);
    Template::set('ri_resize',$ri_resize);
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Template::set('toolbar_title', 'Rotating-Images');
		Template::render();
	}
	
	//--------------------------------------------------------------------

  /*
    Method: edit()

    Displays form data and writes settings to database.
  */
  public function edit()
  {
    $this->auth->restrict('Rotating_Images.Settings.Edit');
    
    if ($this->input->post('submit'))
    {
      if ($this->save_settings())
      {
        Template::set_message(lang('settings_edit_success'), 'success');
        Template::redirect('admin/settings/rotating_images');
      } else {
        Template::set_message('Error', 'error');
      }
    }

    Template::set('toolbar_title', 'Rotating Images');
    Template::set_view('settings/index');
    Template::render();
  }
	
  //--------------------------------------------------------------------

  //--------------------------------------------------------------------
  // !PRIVATE METHODS
  //--------------------------------------------------------------------

  /*
    Method: save_settings()

    Runs form validation on data and writes settings to database.
  */
  private function save_settings()
  {

    $this->form_validation->set_rules('ri_directory','Upload Directory','required|trim|xss_clean|max_length[100]');
    $this->form_validation->set_rules('ri_width','Image Width','required|trim|xss_clean|max_length[5]');
    $this->form_validation->set_rules('ri_height','Image Height','required|trim|xss_clean|max_length[5]');
    $this->form_validation->set_rules('ri_resize','Image Resize','trim|xss_clean|max_length[1]');

/*
    if ( $this->input->post('ga_enabled') != 0 )
    {
      $this->form_validation->set_rules('ga_profile','Profile id','trim|xss_clean|max_length[100]');
      $this->form_validation->set_rules('ga_code','Code','required|trim|xss_clean|max_length[15]');
    }
*/

    if ($this->form_validation->run() === false)
    {
      return false;
    }

    $data = array(
                  array('name' => 'ri.directory', 'value' => $this->input->post('ri_directory') ),
                  array('name' => 'ri.width', 'value' => $this->input->post('ri_width') ),
                  array('name' => 'ri.height', 'value' => $this->input->post('ri_height') ),
                  array('name' => 'ri.resize', 'value' => $this->input->post('ri_resize') ),
                 );

    //destroy the saved update message in case they changed update preferences.
    if ($this->cache->get('update_message'))
    {
      $this->cache->delete('update_message');
    }

    // Log the activity
    $this->activity_model->log_activity($this->auth->user_id(), lang('bf_act_settings_saved').': ' . $this->input->ip_address(), 'rotating_images');

    // save the settings to the DB
    $updated = $this->settings_model->update_batch($data, 'name');

    return $updated;
  }

  //--------------------------------------------------------------------

}