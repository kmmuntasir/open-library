<?php

class M_settings extends Ci_model {

    // Basic Functions

    public function all_settings() {
        $settings = $this->db->get('settings')->row();
        $settings->server_url = $this->db->get('server')->row()->server_url;
        $settings->remote_access_code = $this->db->get('server')->row()->server_access_code;
        return $settings;
    }

    public function update_settings($settings, $server) {
        $this->db->trans_start();
        //$this->db->where('id', 1);
        $this->db->update('settings', $settings);
        $this->db->update('server', $server);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_issue_settings($settings) {
        $this->db->trans_start();
        //$this->db->where('id', 1);
        $this->db->update('settings', $settings);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_info($settings) {
        $this->db->trans_start();
        //$this->db->where('id', 1);
        $this->db->update('settings', $settings);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
?>