<?php

class M_sync extends Ci_model {

    public function server_info() {
        return $this->db->get('server')->row();
    }

    public function access_code() {
        return $this->db->get('settings')->row()->server_access_code;
    }
    
}
?>