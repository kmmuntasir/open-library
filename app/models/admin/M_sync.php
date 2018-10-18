<?php

class M_sync extends Ci_model {

    public function server_info() {
        return $this->db->get('server')->row();
    }

    public function access_code() {
        return $this->db->get('settings')->row()->server_access_code;
    }

    public function feed_queries($sync_limit) {
        return $this->db->where('log_is_synced', 0)->limit($sync_limit)->order_by('log_datetime')->get('log')->result();
    }

    public function add_log($log) {
        $this->db->trans_start();
        $this->db->insert('log', $log);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_log_as_synced($entry_ids) {
        $this->db->trans_start();
        foreach($entry_ids as $entry_id) {
            $this->db->where('log_entry_id', $entry_id)->update('log', array('log_is_synced'=>1));
        }
        $this->db->trans_complete();
    }

    public function lock_server($server_id) {
        $server = array('server_sync_status' => 1);
        $this->db->trans_start();
        $this->db->where('server_id', $server_id)->update('server', $server);
        $this->db->trans_complete();
        return $this->db->trans_status()?1:0;
    }

    public function unlock_server($server_id) {
        $server = array('server_sync_status' => 0);
        $this->db->trans_start();
        $this->db->where('server_id', $server_id)->update('server', $server);
        $this->db->trans_complete();
        return $this->db->trans_status()?1:0;
    }

    public function update_server_connection_time($server_id) {
        $server = array('server_last_connection' => date('Y-m-d H:i:s'), 'server_status' => 1);
        $this->db->trans_start();
        $this->db->where('server_id', $server_id)->update('server', $server);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function run_query($query) {
        $this->db->trans_start();
        $this->db->query($query);
        $this->db->trans_complete();
        return $this->db->trans_status() ? 1:0;
    }

    public function is_already_synced($log_entry_id) {
    	$existing_log = $this->db->where('log_entry_id', $log_entry_id)->where('log_is_synced', 1)->get('log')->row();
    	return $existing_log ? true : false;
    }

    public function count_synced_logs() {
        return $this->db->select('count(log_id) as count')->where('log_is_synced', 1)->get('log')->row()->count;
    }

    public function clean_old_logs($limit) {
        $this->db->trans_start();

        $this->db->where('log_is_synced', 1);
        $this->db->limit($limit);
        $this->db->order_by('log_id', 'asc');
        $this->db->delete('log');

        $this->db->trans_complete();

        return $this->db->trans_status() ? 1:0;
    }

    public function feed_sms($limit=1) {
        return $this->db->limit($limit)->get('sms')->result();
    }

    public function delete_sms($sms_id) {
        $this->db->trans_start();
        $this->db->where('sms_id', $sms_id)->delete('sms');
        $this->db->trans_complete();

        return $this->db->trans_status() ? 1:0;
    }
    
}
?>