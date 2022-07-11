<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //validasi jika user belum login
        $this->data['CI'] = &get_instance();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_login');
        if ($this->session->userdata('masuk_sistem_rekam') != TRUE) {
            $url = base_url('login');
            redirect($url);
        }
    }
    function laporananggota()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["login"] = $this->M_login->GET_ALL();
        $this->data['title_web'] = 'Laporan Cetak Anggota';
        $pdf = $this->load->view('laporan/laporananggota', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporanbuku()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["book"] = $this->M_login->GET_BOOK();
        $this->data['title_web'] = 'Laporan Cetak Buku';
        $pdf = $this->load->view('laporan/laporanbuku', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporanebook()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["ebook"] = $this->M_login->GET_EBOOK();
        $this->data['title_web'] = 'Laporan Cetak Ebook';
        $pdf = $this->load->view('laporan/laporanebook', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporanpeminjaman()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["pinjam"] = $this->M_login->GET_PEMINJAMAN();
        $this->data['title_web'] = 'Laporan Cetak Peminjaman';
        $pdf = $this->load->view('laporan/laporanpeminjaman', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporanpengembalian()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["kembali"] = $this->M_login->GET_PENGEMBALIAN();
        $this->data['title_web'] = 'Laporan Cetak Pengembalian';
        $pdf = $this->load->view('laporan/laporanpengembalian', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporandenda()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["denda"] = $this->M_login->GET_DENDA();
        $this->data['title_web'] = 'Laporan Cetak Denda';
        $pdf = $this->load->view('laporan/laporandenda', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporanrusak()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["rusak"] = $this->M_login->GET_RUSAK();
        $this->data['title_web'] = 'Laporan Cetak Buku Rusak';
        $pdf = $this->load->view('laporan/laporanrusak', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporanpesan()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["pesan"] = $this->M_login->GET_PESAN();
        $this->data['title_web'] = 'Laporan Cetak Mailbox Pesan';
        $pdf = $this->load->view('laporan/laporanpesan', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporantop10()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["top10"] = $this->M_login->GET_TOP10();
        $this->data['title_web'] = 'Laporan Top 10 Anggota';
        $pdf = $this->load->view('laporan/laporantop10', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    function laporantopbuku10()
    {
        $mpdf = new \Mpdf\mpdf();
        $this->data["topbuku10"] = $this->M_login->GET_TOPBUKU10();
        $this->data['title_web'] = 'Laporan Top 10 Buku';
        $pdf = $this->load->view('laporan/laporantopbuku10', $this->data, TRUE);
        $mpdf->WriteHTML($pdf);
        $mpdf->Output();
    }
    //view
    function laporananggota_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Anggota';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporananggota_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporanbuku_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Buku';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporanbuku_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporandenda_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Denda';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporandenda_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporanebook_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Ebook';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporanebook_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporanpeminjaman_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Peminjaman';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporanpeminjaman_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporanpengembalian_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Pengembalian';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporanpengembalian_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporanpesan_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Mailbox';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporanpesan_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporanrusak_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Rusak';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporanrusak_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporantop10_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Top 10';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporantop10_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    function laporantopbuku10_view()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Laporan Top 10';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('laporan/laporantopbuku10_view', $this->data);
        $this->load->view('footer_view', $this->data);
    }
}
