<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReliabilityController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        // Load view
        $this->load->view('reliability_view');
    }

    public function calculate_cronbach_alpha() {
        // Get scores from POST request
        $scores = $this->input->post('scores');
        
        if (!empty($scores)) {
            $alpha = $this->cronbach_alpha($scores);
            echo "Alpha Cronbach: " . $alpha;
        } else {
            echo "No scores provided.";
        }
    }

    private function cronbach_alpha($scores) {
        $n = count($scores);
        $k = count($scores[0]);
        
        $item_variances = array();
        $total_variance = 0;
        $total_sum = 0;
        
        for ($i = 0; $i < $n; $i++) {
            $total_sum += array_sum($scores[$i]);
        }
        
        $grand_mean = $total_sum / ($n * $k);
        
        for ($j = 0; $j < $k; $j++) {
            $item_mean = 0;
            for ($i = 0; $i < $n; $i++) {
                $item_mean += $scores[$i][$j];
            }
            $item_mean /= $n;
            
            $variance_sum = 0;
            for ($i = 0; $i < $n; $i++) {
                $variance_sum += pow($scores[$i][$j] - $item_mean, 2);
            }
            $item_variances[$j] = $variance_sum / ($n - 1);
        }
        
        $total_variance_sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $total_variance_sum += pow(array_sum($scores[$i]) - $grand_mean * $k, 2);
        }
        $total_variance = $total_variance_sum / ($n - 1);
        
        $item_variance_sum = array_sum($item_variances);
        
        $cronbach_alpha = ($k / ($k - 1)) * (1 - ($item_variance_sum / $total_variance));
        
        return $cronbach_alpha;
    }
}
