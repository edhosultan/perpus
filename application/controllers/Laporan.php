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
}
