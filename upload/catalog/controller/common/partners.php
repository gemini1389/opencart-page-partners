<?php
class ControllerCommonPartners extends Controller {
    public function index() {
        $this->load->model('common/partners');
        $this->load->model('tool/image');

        $this->document->setTitle($this->language->get('text_partners'));

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_partners'),
            'href'      => $this->url->link('common/partners'),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['heading_title'] = $this->language->get('text_partners');

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $this->data['partners'] = array();

        $partners_info = $this->model_common_partners->getPartners();

        foreach ($partners_info as $partner_info) {
            if ($partner_info['image']) {
                $image = $this->model_tool_image->resize($partner_info['image'], 200, 275);
            } else {
                $image = $this->model_tool_image->resize('no_image.jpg', 200, 275);
            }

            $this->data['partners'][] = array(
                'partner_id'    => $partner_info['partner_id'],
                'image'         => $image,
                'name'          => $partner_info['name'],
                'description'   => strip_tags(html_entity_decode($partner_info['description'], ENT_QUOTES, 'UTF-8'))
            );
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/partners.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/common/partners.tpl';
        } else {
            $this->template = 'default/template/common/partners.tpl';
        }

        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );

        $this->response->setOutput($this->render());
    }
}
?>