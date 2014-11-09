<?php
class ControllerPaymentPaytabs extends Controller {
	private $error = array(); 

	public function index() {
		$this->language->load('payment/paytabs');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('paytabs', $this->request->post);				

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->request->data['heading_title'] = $this->language->get('heading_title');

		$this->request->data['text_enabled'] = $this->language->get('text_enabled');
		$this->request->data['text_disabled'] = $this->language->get('text_disabled');
		$this->request->data['text_all_zones'] = $this->language->get('text_all_zones');

		$this->request->data['entry_merchant'] = $this->language->get('entry_merchant');
		$this->request->data['entry_security'] = $this->language->get('entry_security');
		$this->request->data['entry_callback'] = $this->language->get('entry_callback');
		$this->request->data['entry_total'] = $this->language->get('entry_total');	
		$this->request->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->request->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->request->data['entry_status'] = $this->language->get('entry_status');
		$this->request->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->request->data['button_save'] = $this->language->get('button_save');
		$this->request->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->request->data['error_warning'] = $this->error['warning'];
		} else {
			$this->request->data['error_warning'] = '';
		}

		if (isset($this->error['merchant'])) {
			$this->request->data['error_merchant'] = $this->error['merchant'];
		} else {
			$this->request->data['error_merchant'] = '';
		}

		if (isset($this->error['security'])) {
			$this->request->data['error_security'] = $this->error['security'];
		} else {
			$this->request->data['error_security'] = '';
		}

		$this->request->data['breadcrumbs'] = array();

		$this->request->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->request->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->request->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/paytabs', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->request->data['action'] = $this->url->link('payment/paytabs', 'token=' . $this->session->data['token'], 'SSL');

		$this->request->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['paytabs_merchant'])) {
			$this->data['paytabs_merchant'] = $this->request->post['paytabs_merchant'];
		} else {
			$this->request->data['paytabs_merchant'] = $this->config->get('paytabs_merchant');
		}

		if (isset($this->request->post['paytabs_security'])) {
			$this->request->data['paytabs_security'] = $this->request->post['paytabs_security'];
		} else {
			$this->request->data['paytabs_security'] = $this->config->get('paytabs_security');
		}

		$this->request->data['callback'] = HTTP_CATALOG . 'index.php?route=payment/paytabs/callback';

		if (isset($this->request->post['paytabs_total'])) {
			$this->request->data['paytabs_total'] = $this->request->post['paytabs_total'];
		} else {
			$this->request->data['paytabs_total'] = $this->config->get('paytabs_total'); 
		} 

		if (isset($this->request->post['paytabs_order_status_id'])) {
			$this->request->data['paytabs_order_status_id'] = $this->request->post['paytabs_order_status_id'];
		} else {
			$this->request->data['paytabs_order_status_id'] = $this->config->get('paytabs_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');

		$this->request->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['paytabs_geo_zone_id'])) {
			$this->request->data['paytabs_geo_zone_id'] = $this->request->post['paytabs_geo_zone_id'];
		} else {
			$this->request->data['paytabs_geo_zone_id'] = $this->config->get('paytabs_geo_zone_id'); 
		} 

		$this->load->model('localisation/geo_zone');

		$this->request->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['paytabs_status'])) {
			$this->request->data['paytabs_status'] = $this->request->post['paytabs_status'];
		} else {
			$this->request->data['paytabs_status'] = $this->config->get('paytabs_status');
		}

		if (isset($this->request->post['paytabs_sort_order'])) {
			$this->request->data['paytabs_sort_order'] = $this->request->post['paytabs_sort_order'];
		} else {
			$this->request->data['paytabs_sort_order'] = $this->config->get('paytabs_sort_order');
		}

		$this->template = 'payment/paytabs.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render('payment/paytabs'));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/paytabs')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['paytabs_merchant']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		if (!$this->request->post['paytabs_security']) {
			$this->error['security'] = $this->language->get('error_security');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>