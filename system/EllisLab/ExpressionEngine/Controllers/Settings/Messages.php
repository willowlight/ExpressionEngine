<?php

namespace EllisLab\ExpressionEngine\Controllers\Settings;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use CP_Controller;

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2014, EllisLab, Inc.
 * @license		http://ellislab.com/expressionengine/user-guide/license.html
 * @link		http://ellislab.com
 * @since		Version 3.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ExpressionEngine CP Messaging Settings Class
 *
 * @package		ExpressionEngine
 * @subpackage	Control Panel
 * @category	Control Panel
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
class Messages extends Settings {

	/**
	 * General Settings
	 */
	public function index()
	{
		$vars['sections'] = array(
			array(
				array(
					'title' => 'prv_msg_max_chars',
					'desc' => 'prv_msg_max_chars_desc',
					'fields' => array(
						'prv_msg_max_chars' => array('type' => 'text')
					)
				),
				array(
					'title' => 'prv_msg_html_format',
					'desc' => 'prv_msg_html_format_desc',
					'fields' => array(
						'prv_msg_html_format' => array(
							'type' => 'dropdown',
							'choices' => array(
								'safe' => lang('html_safe'),
								'none' => lang('html_none'),
								'all' => lang('html_all')
							)
						)
					)
				),
				array(
					'title' => 'prv_msg_auto_links',
					'desc' => 'prv_msg_auto_links_desc',
					'fields' => array(
						'prv_msg_auto_links' => array('type' => 'yes_no')
					)
				),
			),
			'attachment_settings' => array(
				array(
					'title' => 'prv_msg_upload_path',
					'desc' => 'prv_msg_upload_path_desc',
					'fields' => array(
						'prv_msg_upload_path' => array('type' => 'text')
					)
				),
				array(
					'title' => 'prv_msg_max_attachments',
					'desc' => 'prv_msg_max_attachments_desc',
					'fields' => array(
						'prv_msg_max_attachments' => array('type' => 'text')
					)
				),
				array(
					'title' => 'prv_msg_attach_maxsize',
					'desc' => 'prv_msg_attach_maxsize_desc',
					'fields' => array(
						'prv_msg_attach_maxsize' => array('type' => 'text')
					)
				),
				array(
					'title' => 'prv_msg_attach_total',
					'desc' => 'prv_msg_attach_total_desc',
					'fields' => array(
						'prv_msg_attach_total' => array('type' => 'text')
					)
				),
			)
		);

		ee()->form_validation->set_rules(array(
			array(
				'field' => 'prv_msg_max_chars',
				'label' => 'lang:prv_msg_max_chars',
				'rules' => 'integer'
			),
			array(
				'field' => 'prv_msg_upload_path',
				'label' => 'lang:prv_msg_upload_path',
				'rules' => 'file_exists|writable'
			),
			array(
				'field' => 'prv_msg_max_attachments',
				'label' => 'lang:prv_msg_max_attachments',
				'rules' => 'integer'
			),
			array(
				'field' => 'prv_msg_attach_maxsize',
				'label' => 'lang:prv_msg_attach_maxsize',
				'rules' => 'integer'
			),
			array(
				'field' => 'prv_msg_attach_total',
				'label' => 'lang:prv_msg_attach_total',
				'rules' => 'integer'
			)
		));

		$base_url = cp_url('settings/messages');

		if (AJAX_REQUEST)
		{
			ee()->form_validation->run_ajax();
			exit;
		}
		elseif (ee()->form_validation->run() !== FALSE)
		{
			if ($this->saveSettings($vars['sections']))
			{
				ee()->view->set_message('success', lang('preferences_updated'), lang('preferences_updated_desc'), TRUE);
			}

			ee()->functions->redirect($base_url);
		}
		elseif (ee()->form_validation->errors_exist())
		{
			ee()->view->set_message('issue', lang('settings_save_error'), lang('settings_save_error_desc'));
		}

		ee()->view->ajax_validate = TRUE;
		ee()->view->base_url = $base_url;
		ee()->view->cp_page_title = lang('messaging_settings');
		ee()->view->save_btn_text = 'btn_save_settings';
		ee()->view->save_btn_text_working = 'btn_save_settings_working';

		ee()->cp->render('settings/form', $vars);
	}
}
// END CLASS

/* End of file Messages.php */
/* Location: ./system/expressionengine/controllers/cp/Settings/Messages.php */