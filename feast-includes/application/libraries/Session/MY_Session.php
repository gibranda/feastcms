<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Session Class
 *
 * Extends CI_Session with the following functionalities:
 *
 * 1) Ability to create a session that expire when the browser closes
 * 2) Prevent session loss when parallel requests are made using AJAX
 * 3) Maintain all flashdata making them available to next request
 */
class MY_Session extends CI_Session {

    function __construct() {
        parent::__construct();
    }	


	// ------------------------------------------------------------------------

	/**
	 * Cookie Monster eats up the session cookie just before browser closes if he's awake!
	 *
	 * Okay, fine! It works by creating a cookie that tells CI_Session
	 * to create session cookies that expire when the browser closes
	 *
	 * @access    public
	 * @return    void
	 */
	function cookie_monster($asleep)
	{
		$asleep ? setcookie($this->sess_cookie_name.'_cm', 'true', 0, $this->cookie_path, $this->cookie_domain, 0) : setcookie($this->sess_cookie_name.'_cm', 'false', 0, $this->cookie_path, $this->cookie_domain, 0);

		$_COOKIE[$this->sess_cookie_name.'_cm'] = $asleep ? 'true' : 'false';

		$this->sess_time_to_update = - 1;
		$this->sess_update();
	}

	// ------------------------------------------------------------------------

	/**
	 * Write the session cookie
	 *
	 * @access    public
	 * @return    void
	 */
	function _set_cookie($cookie_data = NULL)
	{
		if (is_null($cookie_data))
		{
			$cookie_data = $this->userdata;
		}

		// Serialize the userdata for the cookie
		$cookie_data = $this->_serialize($cookie_data);

		if ($this->sess_encrypt_cookie == TRUE)
		{
			$cookie_data = $this->CI->encrypt->encode($cookie_data);
		}
		else
		{
			// if encryption is not used, we provide an md5 hash to prevent userside tampering
			$cookie_data .= hash_hmac('sha1', $cookie_data, $this->encryption_key);
		}

		// Set the cookie
		setcookie($this->sess_cookie_name, $cookie_data, // if cookie monster exist and is awake, generate a session cookie that expires on browser close
			isset($_COOKIE[$this->sess_cookie_name.'_cm']) && $_COOKIE[$this->sess_cookie_name.'_cm'] == 'false' ? 0 : $this->sess_expiration + time(), $this->cookie_path, $this->cookie_domain, 0);
	}

	// ------------------------------------------------------------------------

	/**
	 * Update an existing session
	 *
	 * @access    public
	 * @return    void
	 */
	/**
	 * Update an existing session
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_update()
	{
		// We only update the session every five minutes by default
		if (($this->userdata['last_activity'] + $this->sess_time_to_update) >= $this->now)
		{
			return;
		}

		// Save the old session id so we know which record to
		// update in the database if we need it
		$old_sessid = $this->userdata['session_id'];
		$new_sessid = '';
		while (strlen($new_sessid) < 32)
		{
			$new_sessid .= mt_rand(0, mt_getrandmax());
		}

		// To make the session ID even more secure we'll combine it with the user's IP
		$new_sessid .= $this->CI->input->ip_address();

		// Turn it into a hash
		$new_sessid = md5(uniqid($new_sessid, TRUE));

		// Update the session data in the session data array
		$this->userdata['session_id'] = $new_sessid;
		$this->userdata['last_activity'] = $this->now;

		// _set_cookie() will handle this for us if we aren't using database sessions
		// by pushing all userdata to the cookie.
		$cookie_data = NULL;

		// Update the session ID and last_activity field in the DB if needed
		if ($this->sess_use_database === TRUE)
		{
			// set cookie explicitly to only have our session data
			$cookie_data = array();
			foreach (array('session_id','ip_address','user_agent','last_activity') as $val)
			{
				$cookie_data[$val] = $this->userdata[$val];
			}

			$this->CI->db->query($this->CI->db->update_string($this->sess_table_name, array('last_activity' => $this->now, 'session_id' => $new_sessid), array('session_id' => $old_sessid)));
		}

		// Write the cookie
		$this->_set_cookie($cookie_data);
	}

	// ------------------------------------------------------------------------

	/**
	 * Keeps existing flashdata available to next request.
	 *
	 * @access    public
	 * @param    string
	 * @return    void
	 */
	function keep_flashdata($key = '')
	{
		// Mark individual flashdata as 'new' to preserve it from _flashdata_sweep()
		if ($key)
		{
			parent::keep_flashdata($key);
		}
		// Mark all 'old' flashdata as 'new' (keep data from being deleted during next request)
		else
		{
			$userdata = $this->all_userdata();
			foreach ($userdata as $name => $value)
			{
				$parts = explode(':old:', $name);
				if (is_array($parts) && count($parts) === 2)
				{
					$new_name = $this->flashdata_key.':new:'.$parts[1];
					$this->set_userdata($new_name, $value);
					$this->unset_userdata($name);
				}
			}
		}
	}

	// ------------------------------------------------------------------------

}


/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */
