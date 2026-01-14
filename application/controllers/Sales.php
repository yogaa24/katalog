<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Sales extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Katalog");
        $this->load->library('form_validation');
    }

    function index()
    {
        if ($this->session->userdata('status') != "login") {
            redirect('login');
        }

        $data['tot_gbr'] = $this->M_Katalog->get_total()->result();

        $this->load->view("partial/sales/header");
        $this->load->view("content/sales/katalog/dashboard", $data);
        $this->load->view("partial/sales/footer");
    }

    function getBarang()
    {
        $list = $this->M_Katalog->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->kode_barang;
            $row[] = $field->produk_fokus;
            $row[] = $field->nama_barang;
            $row[] = $field->nama_suplier;
            $row[] = $field->kelompok;
            $row[] = $field->bahan_aktif;
            $imagePath = "images/produk/" . $field->gbr_produk;
            if (!file_exists($imagePath))
                $imagePath = "images/Karisma.png";
            $row[] = '<img src="' . $imagePath . '" style="width:100px; height:100px">';
            $row[] =
                '<a href="' . base_url('') . 'pricelist?id=' . $field->kode_barang . '" class="btn btn-primary btn-sm ">
            <i class="fa fa-solid fa-eye"></i></a>' . ' ' . '';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Katalog->count_all(),
            "recordsFiltered" => $this->M_Katalog->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
