<?php
class RailAPI {
	
	public function __construct($token) {
		$this->key = $token;
	}

	public function create($pname = "", $name = "") {
		$this->opt = array(
			"host_key" => $this->key,
			"name" => $name,
			"pubname" => $pname
		);
		return $this->_get($this->opt, "/api/v2/railgun/init");
	}

	public function delete($rtkn) {
		$this->opt = array(
			"host_key" => $this->key,
			"rtkn" => $rtkn
		);
		return $this->_get($this->opt, "/api/v2/railgun/delete");
	}

	public function set($domain, $rtkn) {
		$this->opt = array(
			"host_key" => $this->key,
			"z" => $domain,
			"rtkn" => $rtkn,
			"mode" => "1"
		);
		return $this->_get($this->opt, "/api/v2/railgun/conn_set");
	}

	public function listAll() {
		$this->opt = array(
			"host_key" => $this->key
		);
		return $this->_get($this->opt, "/api/v2/railgun/host_get_all");
	}

	public function findRailgun($id) {
		$res = $this->listAll();
		if($res->result != "success") {
			return null;
		}
		foreach($res->response->railguns->objs as $key => $value) {
			if($value->railgun_id == $id) {
				return $value;
			}
		}
		return null;
	}

	function isActive($id) {
		$res = $this->findRailgun($id);
		if($res == null) {
			return false;
		}
		switch($res->railgun_status) {
			case "V":
				return true;
				break;
			case "INI":
				return false;
				break;
			default:
				return false;
		}
	}

	private function _get($data, $uri) {
		$this->opts = http_build_query($data);
		return json_decode(file_get_contents("https://cloudflare.com$uri?$this->opts"));
	}
}
