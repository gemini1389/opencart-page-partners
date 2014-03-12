<?php
class ModelCommonPartners extends Model {
    public function getPartners() {
        $sql = "
            SELECT p.*, pd.name, pd.description
            FROM " . DB_PREFIX . "partners p
            LEFT JOIN " . DB_PREFIX . "partners_descriptions pd ON (p.partner_id = pd.partner_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "')
            WHERE p.status = '1'
            ORDER BY p.sort_order, pd.name
        ";
        $query = $this->db->query($sql);

        return $query->rows;
    }
}
?>