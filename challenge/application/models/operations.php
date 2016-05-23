<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Operations extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('persistence');
    }

    public function get_data($intent, $x1, $y1, $z1, $x2, $y2, $z2) {
        $array = $this->persistence->get_data_by_intent($intent);
        $tam = $array['tam'];
        $total = 0;
        if ($x1 == 0 || $y1 == 0 || $z1 == 0 || $x2 == 0 || $y2 == 0 || $z2 == 0) {
            $resp = -1;
            $data = 'Error: las coordenadas no pueden contener cero';
            return json_encode(array('resp' => $resp, 'data' => $data));
        } else if ($x1 <= $tam && $x1 <= $tam && $z1 <= $tam && $x2 <= $tam && $y2 <= $tam & $z2 <= $tam) {
            for ($x = $x1; $x <= $x2; $x++) {
                for ($y = $y1; $y <= $y2; $y++) {
                    for ($z = $z1; $z <= $z2; $z++) {
                        $total += $array['matriz'][$x][$y][$z];
                    }
                }
            }
            $resp = 1;
            $data = 'CONSULTAR (' . $x1 . ', ' . $y1 . ', ' . $z1 . ')(' . $x2 . ', ' . $y2 . ', ' . $z2 . ') = ' . $total;
            return json_encode(array('resp' => $resp, 'data' => $data));
        } else {
            $resp = -2;
            $data = 'Error: las coordenadas no existen';
            return json_encode(array('resp' => $resp, 'data' => $data));
        }
    }

    public function validate_set_data($intent, $x, $y, $z, $w) {
        $data = $this->persistence->get_data_by_intent($intent);
        $tam = $data['tam'];
        if ($x >= 1 && $y >= 1 && $z >= 1 && $x <= $tam && $y <= $tam && $z <= $tam) {
            $this->persistence->set_data($intent, $x, $y, $z, $w);
            $resp = 1;
            $data = 'ACTUALIZAR (' . $x . ', ' . $y . ', ' . $z . ') = ' . $w;
        } else if ($x == 0 || $y == 0 || $z == 0) {
            $resp = -2;
            $data = 'Ninguna de las coordenadas puede ser cero';
        } else {
            $resp = -1;
            $data = 'Las coordenadas deben ser menores al tamaño de la matriz';
        }
        return json_encode(array('resp' => $resp, 'data' => $data));
    }

}
