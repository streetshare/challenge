<?php

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('operations');
        $this->load->model('persistence');
    }

    public function set_intents($intents) {
        return $this->persistence->set_intents($intents);
    }

    public function set_new_matriz($intent, $tam, $consults) {
        return $this->persistence->set_new_matriz($intent, $tam, $consults);
    }

    public function validate_set_data($intent, $x, $y, $z, $w) {
        return $this->operations->validate_set_data($intent, $x, $y, $z, $w);
    }

    public function get_data($intent, $x1, $y1, $z1, $x2, $y2, $z2) {
        return $this->operations->get_data($intent, $x1, $y1, $z1, $x2, $y2, $z2);
    }

    public function destroy_session() {
        return $this->persistence->destroy_session();
    }

}
