<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Dashboard
 * @property Mnotif $mnotif
 */
class Notification extends Mst_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_HOME";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->model("Mnotif", "mnotif");
    }

    public function index()
    {
        $this->data['titlehead'] = "List Notifikasi";
        $this->data['list_data'] = $this->mnotif->get_notif(null, 0, 10, $this->get_userid());

        $this->data['csrf'] = $this->_get_sess_csrf();
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/main/notif.js'
        );
        $this->data['loadfoot'] = $loadfoot;

        $this->_render_page('vnotifikasi', $this->data, false, 'tmpl/vwbacktmpl');
    }

    function notifikasi(){
        $jumlah = 0;
        $html = "";

        $notifs = $this->mnotif->get_notif(null, 0, 4, $this->get_userid());
        if ($notifs != null) {
            $jumlah = $this->mnotif->get_notif_cnt($this->get_userid(), null, false);
            $url_foto = "";
            foreach ($notifs as $row ) {
                $url = site_url("main/notification/go/" . $this->qsecure->encrypt($row->notif_id));
                $tgl = Carbon\Carbon::parse($row->tgl, 'Asia/Jakarta');

                if ($row->is_read == 0) {
                    $css_class_read = "new-notif";
                } else {
                    $css_class_read = "";
                }

                if($row->url_foto != ""){
                    $url_foto = site_url('uploads/personal/photo/').$row->url_foto;
                }else{
                    $url_foto = site_url('uploadfile/profile/avatar4.png');
                }
                
                $html .= "<a href='{$url}' class='{$css_class_read}'>
                            <div class='mail-contnet'>
                                <img alt='user-img' class='img-circle pull-left' src='{$url_foto}' width='36'>
                                    <h5>{$row->notif_subj}</h5>
                                    <h6>{$row->emp_name}</h6>
                                    <span class='time' title='{$tgl->format('d-m-Y H:i:s')}'><i class='fa fa-clock-o' aria-hidden='true'></i> {$tgl->locale('id')->diffForHumans()}</span>
                            </div>
                        </a>";

            }
        } else {
            $html .= "<a><div class='mail-contnet'><span class='mail-desc text-center'>Tidak Ada Notifikasi..</span></div></a>";
        }

        $data = array('html' => $html, 'jumlah' => $jumlah);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    function go($id){
        $notif_id = $this->qsecure->decrypt($id);
        $notif = $this->mnotif->get_notif($notif_id);
        if ($notif !== null) {
            if($this->session->userdata(sess_prefix()."roleid") != 1 ){
                if ($notif->is_read == 0) {
                    $data = array();
                    $data["is_read"] = 1;
                    $data["notif_date_read"] = date('Y-m-d H:i:s');
                    $this->mnotif->update($notif_id, $data);
                }
            }
            redirect($notif->notif_url.$this->qsecure->encrypt($notif->src_uid));
        }
    }
}
