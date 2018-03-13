<?php

class M_sync extends Ci_model {

    public function server_info() {
        return $this->db->get('server')->row();
    }

    public function feed_queries($sync_limit) {
        return $this->db->where('log_is_synced', 0)->limit($sync_limit)->order_by('log_datetime')->get('log')->result();
    }

    public function add_log($logs) {
        $this->db->trans_start();
        $this->db->insert_batch('log', $logs);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_log_as_synced($entry_ids) {
        $log = array('log_is_synced'=>1);
        $this->db->trans_start();
        foreach($entry_ids as $entry_id) {
            $this->db->where('log_entry_id', $entry_id)->update('log', $log);
        }
        $this->db->trans_complete();
    }

    public function lock_server($server_id) {
        $server = array('server_sync_status' => 1);
        $this->db->trans_start();
        $this->db->where('server_id', $server_id)->update('server', $server);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function unlock_server($server_id) {
        $server = array('server_sync_status' => 0);
        $this->db->trans_start();
        $this->db->where('server_id', $server_id)->update('server', $server);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_server_connection_time($server_id) {
        $server = array('server_last_connection' => date('Y-m-d H:i:s'), 'server_status' => 1);
        $this->db->trans_start();
        $this->db->where('server_id', $server_id)->update('server', $server);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function access_code() {
        return $this->db->get('settings')->row()->server_access_code;
    }
}
?>