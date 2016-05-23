<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Persistence extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function set_intents($intents) {
        $value = array('value' => $intents);
        $this->session->set_userdata('intents', $value);
        $value = $this->session->userdata('intents');
        return $value['value'];
    }

    public function set_new_matriz($intent, $tam, $consults) {
        $intents_array = $this->session->userdata('intents');
        $intents_array[$intent]['consults'] = $consults;
        $intents_array[$intent]['count_consult'] = 0;
        $intents_array[$intent]['tam'] = $tam;
        for ($x = 1; $x <= $tam; $x++)
            for ($y = 1; $y <= $tam; $y++)
                for ($z = 1; $z <= $tam; $z++)
                    $cube[$x][$y][$z] = 0;
        $intents_array[$intent]['matriz'] = $cube;
        $this->session->set_userdata('intents', $intents_array);
        return 1;
    }
    
    public function set_data($intent, $x, $y, $z, $w){
        $intents_array = $this->session->userdata('intents');
        $matriz = $intents_array[$intent]['matriz'];
        $matriz[$x][$y][$z] = $w;
        $intents_array[$intent]['matriz'] = $matriz;
        $this->session->set_userdata('intents', $intents_array);
        return 1;
    }
    
    public function get_data_by_intent($intent){
        $data = $this->session->userdata('intents');
        return $data[$intent];
    }
    
    public function destroy_session(){
        $this->session->sess_destroy();
        return 1;
    }

}
