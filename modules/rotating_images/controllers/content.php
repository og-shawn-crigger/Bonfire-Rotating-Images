<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

  private $image_path;
  private $image_path_url;
  private $image_width;
  private $image_height;

  //--------------------------------------------------------------------

  public function __construct()
  {
  		parent::__construct();

    $this->auth->restrict('Rotating_Images.Content.View');
    $this->load->model('rotating_images_model', null, true);
    $this->lang->load('rotating_images');

    $this->image_path     = realpath ( APPPATH . '../../assets/uploads/rotating');
    $this->image_path_url = base_url().'assets/uploads/rotating';
    $this->image_height   = 274;
    $this->image_width    = 448;

		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.8.min.js');

  }

  //--------------------------------------------------------------------

  /*
   Method: index()

   Displays a list of form data.
  */
  public function index()
  {
    $data = array();
    $data['records'] = $this->rotating_images_model->find_all();

		Assets::clear_cache();
    Assets::add_js('jquery.dataTables.min.js');
    Assets::add_js('datatable_plugins.min.js');

    Assets::add_module_css('activities', 'datatable.css');

    Assets::add_js($this->load->view('content/js', null, true), 'inline');

    Template::set('data', $data);
    Template::set('toolbar_title', "Manage Rotating-Images");
    Template::render();
  }

	//--------------------------------------------------------------------

  /*
   Method: create()

   Creates a Rotating-Images object.
  */
  public function create()
  {
    $this->auth->restrict('Rotating_Images.Content.Create');

    if ($this->input->post('submit'))
    {
      if ($insert_id = $this->save_rotating_images())
      {
        // Log the activity
        $this->activity_model->log_activity($this->auth->user_id(), lang('rotating_images_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'rotating_images');

        Template::set_message(lang("rotating_images_create_success"), 'success');
        Template::redirect(SITE_AREA .'/content/rotating_images');
      } else {
        Template::set_message(lang('rotating_images_create_failure') . $this->rotating_images_model->error, 'error');
      }
    }

    Template::set('toolbar_title', lang('rotating_images_create_new_button'));
    Template::set('toolbar_title', lang('rotating_images_create') . ' Rotating-Images');
    Template::render();
  }

  //--------------------------------------------------------------------

  /*
   Method: edit()

   Allows editing of Rotating-Images data.
  */
  public function edit()
  {
    $this->auth->restrict('Rotating_Images.Content.Edit');

    $id = (int)$this->uri->segment(5);

    if (empty($id))
    {
      Template::set_message(lang('rotating_images_invalid_id'), 'error');
      redirect(SITE_AREA .'/content/rotating_images');
    }

    if ($this->input->post('submit'))
  		{
      if ($this->save_rotating_images('update', $id))
      {
  				// Log the activity
      		$this->activity_model->log_activity($this->auth->user_id(), lang('rotating_images_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'rotating_images');

      		Template::set_message(lang('rotating_images_edit_success'), 'success');
      	} else {
        Template::set_message(lang('rotating_images_edit_failure') . $this->rotating_images_model->error, 'error');
      }
    }

    Template::set('rotating_images', $this->rotating_images_model->find($id));

    Template::set('toolbar_title', lang('rotating_images_edit_heading'));
    Template::set('toolbar_title', lang('rotating_images_edit') . ' Rotating-Images');
    Template::render();
  }

	//--------------------------------------------------------------------

	/*
		Method: delete()

		Allows deleting of Rotating-Images data.
	*/
	public function delete()
	{
		$this->auth->restrict('Rotating_Images.Content.Delete');

		$id = $this->uri->segment(5);

		if (!empty($id))
		{
      
      $res  = false;
      $file = $id;
      if ( $rimg = $this->rotating_images_model->find($id) )
      {
        $rimg = $rimg->rotating_images_image;
        $file = $rimg;
        $rimg = $this->image_path . '/' . $rimg;
        
        
        if ( file_exists ( $rimg ) ) {
         $res = unlink ( $rimg );
        }            
        
      }
      
      $lang = ( $res === true ) ? lang('rotating_images_act_delete_file') : lang('rotating_images_act_delete_file_failed');
      $this->activity_model->log_activity($this->auth->user_id(), $lang .': ' . $file . ' : ' . $this->input->ip_address(), 'rotating_images');         
      
      if ($this->rotating_images_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('rotating_images_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'rotating_images');

				Template::set_message(lang('rotating_images_delete_success'), 'success');
			} else {
				Template::set_message(lang('rotating_images_delete_failure') . $this->rotating_images_model->error, 'error');
			}
		}

		redirect(SITE_AREA .'/content/rotating_images');
	}

  //--------------------------------------------------------------------
  
  //--------------------------------------------------------------------
  // !PRIVATE METHODS
  //--------------------------------------------------------------------
  
  /*
    Method: save_rotating_images()
  
    Does the actual validation and saving of form data.
  
    Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.
  
    Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
  */
  private function save_rotating_images($type='insert', $id=0)
  {

    $uploaded_file = false;

		$this->form_validation->set_rules('rotating_images_caption','Title','required|trim|xss_clean|alpha_extra|max_length[255]');
//		$this->form_validation->set_rules('rotating_images_image','Image','max_length[200]');
		$this->form_validation->set_rules('rotating_images_weight','Order','required|trim|xss_clean|integer|max_length[3]');
		$this->form_validation->set_rules('rotating_images_active','Active','required|max_length[1]');

    if ( isset ( $_FILES['fileupload'] ) && !empty ( $_FILES['fileupload']['name'] ) )
    {
      $uploaded_file = true;
      $img = $this->do_upload();
  
      $filename = $img;

    }

		if ($this->form_validation->run($this) === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['rotating_images_caption']       = $this->input->post('rotating_images_caption');
		$data['rotating_images_weight']        = $this->input->post('rotating_images_weight');
		$data['rotating_images_active']        = $this->input->post('rotating_images_active');

    if ( $uploaded_file === true )
      $data['rotating_images_image']       = $filename; //$this->input->post('rotating_images_image');

		if ( $type == 'insert' )
		{
			$id = $this->rotating_images_model->insert($data);

			$return = ( is_numeric ( $id ) ) ? $id : FALSE;
		} else if ($type == 'update')	{
			$return = $this->rotating_images_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


  private function do_upload()
  {
    $config['upload_path']   = APPPATH . '../../assets/uploads/';

//                  'max_width'     => '448',
//                  'max_height'    => '274'

    $config = array('upload_path'   => $this->image_path,
                    'allowed_types' => 'gif|jpg|png',
                    'max_size'      => '6000'
                   );

    $field_name = 'fileupload';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload($field_name) )
    {

      //$error = array('error' => $this->upload->display_errors());
      $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
      return false;

    } else {

      $image_data = $this->upload->data();
      $filename   = url_title($image_data['raw_name'], 'underscore', TRUE);
      
      $filename   = $filename . $image_data['file_ext'];
      $config = array(
                      'source_image' => $image_data['full_path'],
                      'new_image' => $this->image_path . '/' . $filename,
                      'maintain_ration' => true,
                      'width' => $this->image_width,
                      'height' => $this->image_height
                     );

      $this->load->library('image_lib', $config);
      $this->image_lib->resize();
      unlink ( $image_data['full_path'] );
      
      return $filename;
    }
  }

  private function handle_upload()
  {
    if ( isset ( $_FILES['image'] ) && !empty ( $_FILES['image']['name'] ) )
    {
      if ($this->upload->do_upload('image'))
      {
        // set a $_POST value for 'image' that we can use later
        $upload_data    = $this->upload->data();
        $_POST['image'] = $upload_data['file_name'];
        return true;
      } else {
        // possibly do some clean up ... then throw an error
        $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
        return false;
      }
    } else {
      // throw an error because nothing was uploaded
      $this->form_validation->set_message('handle_upload', "You must upload an image!");
      return false;
    }
  }


	public function ajax_update_positions()
	{
		// Create an array containing the IDs
		$ids = explode(',', $this->input->post('order'));

		// Counter variable
		$pos = 1;

		foreach($ids as $id)
		{
			// Update the position
			$data['rotating_images_weight'] = $pos;
			$this->navigation_model->update($id, $data);
			++$pos;
		}

	}


}
