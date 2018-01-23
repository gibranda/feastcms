<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_details_model extends CI_Model {

	/**
	 * Get details for all account
	 *
	 * @access public
	 * @return object details for all accounts
	 */
	function get()
	{
		return $this->db->get('feast_account_details')->result();
	}

	/**
	 * Get account details by account_id
	 *
	 * @access public
	 * @param string $account_id
	 * @return object account details object
	 */
	function get_by_account_id($account_id)
	{
		return $this->db->get_where('feast_account_details', array('account_id' => $account_id))->row();
	}

	// --------------------------------------------------------------------

	/**
	 * Update account details
	 *
	 * @access public
	 * @param int   $account_id
	 * @param array $attributes
	 * @return void
	 */
	function update($account_id, $attributes = array())
	{
		if (isset($attributes['fullname'])) if (strlen($attributes['fullname']) > 160) $attributes['fullname'] = substr($attributes['fullname'], 0, 160);
		if (isset($attributes['firstname'])) if (strlen($attributes['firstname']) > 80) $attributes['firstname'] = substr($attributes['firstname'], 0, 80);
		if (isset($attributes['lastname'])) if (strlen($attributes['lastname']) > 80) $attributes['lastname'] = substr($attributes['lastname'], 0, 80);
		if (isset($attributes['dateofbirth']))
		{
			$this->load->helper('date');
			$attributes['dateofbirth'] = mdate('%Y-%m-%d', strtotime($attributes['dateofbirth']));
		}
		if (isset($attributes['gender']))
		{
			switch (strtolower($attributes['gender']))
			{
				case 'f':
				case 'female':
					$attributes['gender'] = 'f';
					break;
				case 'm':
				case 'male':
					$attributes['gender'] = 'm';
					break;
			}
		}
		if (isset($attributes['postalcode'])) if (strlen($attributes['postalcode']) > 40) $attributes['postalcode'] = substr($attributes['postalcode'], 0, 40);
		// Check that it's a recognized country (see http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)
		if (isset($attributes['country']))
		{
			$this->load->model('account/ref_country_model');
			$country = $this->ref_country_model->get($attributes['country']);
			$country ? $attributes['country'] = $country->country : NULL;
		}
		// At this point, if country is still not determined, use ip address to determine country
		if ( ! isset($attributes['country']))
		{
				$attributes['country'] = $country;
		}

		// Update
		if ($this->get_by_account_id($account_id))
		{
			$this->db->where('account_id', $account_id);
			$this->db->update('feast_account_details', $attributes);
		}
		// Insert
		else
		{
			$attributes['account_id'] = $account_id;
			$this->db->insert('feast_account_details', $attributes);
		}
	}

}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */