<?php
class ModelCommonPartners extends Model {
	public function addPartner($data) {
		$this->db->query("
			INSERT INTO " . DB_PREFIX . "partners
			SET
				sort_order = '" . (int)$data['sort_order'] . "',
				status = '" . (int)$data['status'] . "',
				image = '" . $data['image'] . "'
		");

		$partner_id = $this->db->getLastId();

		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("
				INSERT INTO " . DB_PREFIX . "partners_descriptions
				SET
				    partner_id = '" . (int)$partner_id . "',
					language_id = '" . (int)$language_id . "',
					name = '" . $this->db->escape($value['name']) . "',
					description = '" . $this->db->escape($value['description']) . "'
			");
		}

		return $partner_id;
	}

	public function editPartner($partner_id, $data) {
		$this->db->query("
			UPDATE " . DB_PREFIX . "partners
			SET
				sort_order = '" . (int)$data['sort_order'] . "',
				status = '" . (int)$data['status'] . "',
				image = '" . $data['image'] . "'
				WHERE partner_id = '" . (int)$partner_id . "'
		");

		$this->db->query("DELETE FROM " . DB_PREFIX . "partners_descriptions WHERE partner_id = '" . (int)$partner_id . "'");

		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("
				INSERT INTO " . DB_PREFIX . "partners_descriptions
				SET
				    partner_id = '" . (int)$partner_id . "',
					language_id = '" . (int)$language_id . "',
					name = '" . $this->db->escape($value['name']) . "',
					description = '" . $this->db->escape($value['description']) . "'
			");
		}
	}

	public function deletePartner($partner_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "partners WHERE partner_id = '" . (int)$partner_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "partners_descriptions WHERE partner_id = '" . (int)$partner_id . "'");
	}

	public function getPartner($partner_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "partners WHERE partner_id = '" . (int)$partner_id . "'");

		return $query->row;
	}

	public function getPartners() {
		$partner_data = array();

		$query = $this->db->query("
			SELECT c.*, cd.*
			FROM " . DB_PREFIX . "partners c
			LEFT JOIN " . DB_PREFIX . "partners_descriptions cd ON (c.partner_id = cd.partner_id)
			WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'
			ORDER BY c.sort_order, cd.name ASC
		");

		foreach ($query->rows as $result) {
			$partner_data[] = array(
				'partner_id'  => $result['partner_id'],
				'name'        => $result['name'],
				'status'  	  => $result['status'],
				'sort_order'  => $result['sort_order']
			);
		}

		return $partner_data;
	}

	public function getPartnersDescriptions($partner_id) {
		$partner_data = array();

		$query = $this->db->query("
			SELECT *
			FROM " . DB_PREFIX . "partners_descriptions
			WHERE partner_id = '" . (int)$partner_id . "'
		");

		foreach ($query->rows as $result) {
			$partner_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}

		return $partner_data;
	}
}
?>