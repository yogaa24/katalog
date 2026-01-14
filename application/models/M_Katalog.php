<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */

class M_Katalog extends CI_Model
{

    var $table = 'tb_barangv2'; //nama tabel dari database
    var $column_order =
    array('id_barang', 'kode_barang', 'nama_barang', 'nama_suplier', 'produk_fokus', 'kelompok', 'bahan_aktif', 'gbr_produk', 'gbr_promo1', 'gbr_promo2', 'gbr_promo3');
    var $column_search = array('produk_fokus', 'nama_barang', 'nama_suplier', 'bahan_aktif', 'kelompok');
    var $order = array('produk_fokus' => 'desc'); // default order 


    public function getAll()
    {
        $this->db->from('tb_barangv2');
        $this->db->group_by('kode_barang');
        $this->db->order_by("produk_fokus desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total()
    {
        return $this->db->query("SELECT 
        COUNT(a.id_barang)AS t_barang,
        SUM(CASE WHEN a.gbr_produk = '-' THEN 1 ELSE 0 END) AS t_non_gbr,
        SUM(CASE WHEN a.gbr_produk != '-' THEN 1 ELSE 0 END) AS t_upl_gbr
        FROM tb_barangv2 a
        ");
    }

    public function adddata($data)
    {
        return $this->db->insert('tb_barangv2', $data);
    }

    function editdataKat($data, $id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        return $this->db->update('tb_barangv2', $data);
    }

    function barangdel($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        return $this->db->delete("tb_barangv2");
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);
        $this->db->group_by('nama_barang');

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
