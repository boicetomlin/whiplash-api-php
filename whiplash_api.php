<?php
class WhiplashApi
{
    // property declaration
		public $base_url = 'http://localhost:3000/api/';
		public $connection;

    // Constructor
    public function WhiplashApi($api_key, $api_version='') {
			$ch = curl_init();
    	// Set headers
			$headers = array('Content-type: application/json', "X-API-KEY: $api_key");

			if ($api_version != '') {
				array_push($headers, "X-API-VERSION: $api_version");
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$this->connection = $ch;
    }

		// Basic REST functions
		public function get($path, $params=array()) {
			$json_url = $this->base_url . $path; 
			$ch = $this->connection;
			curl_setopt($ch, CURLOPT_URL, $json_url);
			$result =  curl_exec($ch); // Getting jSON result string
			$out = json_decode($result); // Decode the result
			return $out;
		}
		
		public function post($path, $params=array()) {
			$json_url = $this->base_url . $path; 
			$ch = $this->connection;
			curl_setopt($ch, CURLOPT_URL, $json_url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
			$result =  curl_exec($ch); // Getting jSON result string
			$out = json_decode($result); // Decode the result
			return $out;
		}
		
		public function put($path, $params=array()) {
			$json_url = $this->base_url . $path; 
			$ch = $this->connection;
			curl_setopt($ch, CURLOPT_URL, $json_url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
			$result =  curl_exec($ch); // Getting jSON result string
			$out = json_decode($result); // Decode the result
			return $out;
		}
		
		public function delete($path, $params=array()) {
			$json_url = $this->base_url . $path; 
			$ch = $this->connection;
			curl_setopt($ch, CURLOPT_URL, $json_url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
			$result =  curl_exec($ch); // Getting jSON result string
			$out = json_decode($result); // Decode the result
			return $out;
		}
		
		/** Item functions **/
		public function get_items($params=array()) {
			return $this->get('items', $params);
		}
		
		public function get_item($id) {
			return $this->get('items/'.$id);
		}
		
		// This requires a valid ID
		public function create_item($params=array()) {
			$p = array();
			if (!$params['item']) {
				$p['item'] = $params;
			} else {
				$p = $params;
			}
			return $this->post('items', $p);
		}
		
		// This requires a valid ID
		public function update_item($id, $params=array()) {
			$p = array();
			if (!$params['item']) {
				$p['item'] = $params;
			} else {
				$p = $params;
			}
			return $this->put('items/'.$id, $p);
		}
		
		// This requires a valid ID
		public function delete_item($id) {
			return $this->put('items/'.$id);
		}
		
		
		/** Order functions **/
		public function get_orders($params=array()) {
			return $this->get('orders', $params);
		}
		
		public function get_order($id) {
			return $this->get('orders/'.$id);
		}
		
		// This requires a valid ID
		public function create_order($params=array()) {
			$p = array();
			if (!$params['order']) {
				$p['order'] = $params;
			} else {
				$p = $params;
			}
			return $this->post('orders', $p);
		}
		
		// This requires a valid ID
		public function update_order($id, $params=array()) {
			$p = array();
			if (!$params['order']) {
				$p['order'] = $params;
			} else {
				$p = $params;
			}
			return $this->put('orders/'.$id, $p);
		}
		
		// This requires a valid ID
		public function delete_order($id) {
			return $this->put('orders/'.$id);
		}
		
		
		/** OrderItem functions **/		
		public function get_order_item($id) {
			return $this->get('order_items/'.$id);
		}
		
		// This requires a valid ID
		public function create_order_item($params=array()) {
			$p = array();
			if (!$params['order_item']) {
				$p['order_item'] = $params;
			} else {
				$p = $params;
			}
			return $this->post('order_items', $p);
		}
		
		// This requires a valid ID
		public function update_order_item($id, $params=array()) {
			$p = array();
			if (!$params['order_item']) {
				$p['order_item'] = $params;
			} else {
				$p = $params;
			}
			return $this->put('order_items/'.$id, $p);
		}
		
		// This requires a valid ID
		public function delete_order_item($id) {
			return $this->put('order_items/'.$id);
		}
}
?>