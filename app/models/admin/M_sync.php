<?php

class M_sync extends Ci_model {

    public function server_info() {
        return $this->db->get('server')->row();
    }
    
}
?>