<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */

class M_Katalog extends CI_Model
{

    var $table = 'tb_barangv2'; //nama tabel dari database
    var $column_order = array(
        'id_barang','kode_barang','nama_barang','nama_suplier',
        'produk_fokus','kelompok','bahan_aktif','gbr_produk',
        'gbr_promo1','gbr_promo2','gbr_promo3','isactive'
    );
    var $column_search = array('produk_fokus','nama_barang','nama_suplier','bahan_aktif','kelompok','isactive');
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

    public function get_datatables()
    {
        $this->datatables_query();
        if (isset($_POST['start']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function datatables_query()
    {
        $this->db->from('tb_barangv2');
        $columns = array(
            'kode_barang','produk_fokus','nama_barang','nama_suplier',
            'kelompok','bahan_aktif','gbr_produk','shopee','tokopedia','kiushop','isactive'
        );

        // Search global
        if (!empty($_POST['search']['value'])) {
            $this->db->group_start();
            foreach ($columns as $col) {
                $this->db->or_like($col, $_POST['search']['value']);
            }
            $this->db->group_end();
        }

        // Filter produk fokus
        if (!empty($_POST['filter_fokus'])) {
            if ($_POST['filter_fokus'] == 'fokus') {
                $this->db->where('(produk_fokus IS NOT NULL AND produk_fokus != "" AND produk_fokus != "-")', null, false);
            } elseif ($_POST['filter_fokus'] == 'non_fokus') {
                $this->db->where('(produk_fokus IS NULL OR produk_fokus = "" OR produk_fokus = "-")', null, false);
            }
        }

        // Filter online shop ← tambahan baru
        if (!empty($_POST['filter_online'])) {
            if ($_POST['filter_online'] == 'shopee') {
                $this->db->where('shopee', 1);
            } elseif ($_POST['filter_online'] == 'tokopedia') {
                $this->db->where('tokopedia', 1);
            } elseif ($_POST['filter_online'] == 'kiushop') {
                $this->db->where('kiushop', 1);
            } elseif ($_POST['filter_online'] == 'kosong') {
                $this->db->where('shopee', 0);
                $this->db->where('tokopedia', 0);
                $this->db->where('kiushop', 0);
            }
        }

        // Filter status aktif
        if (isset($_POST['filter_aktif']) && $_POST['filter_aktif'] !== '') {
            $this->db->where('isactive', $_POST['filter_aktif']);
        }

        // Order
        if (isset($_POST['order'])) {
            $this->db->order_by($columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
        } else {
            $this->db->order_by('id_barang', 'DESC');
        }
    }

    public function count_all()
    {
        $this->db->from('tb_barangv2');
        return $this->db->count_all_results();
    }

    public function count_filtered()
    {
        $this->datatables_query();
        return $this->db->count_all_results();
    }

    // Statistik untuk info cards
    public function getStatistik($isactive = null)
    {
        $stat = array();

        if ($isactive !== null) $this->db->where('isactive', $isactive);
        $stat['total'] = $this->db->count_all_results('tb_barangv2');

        if ($isactive !== null) $this->db->where('isactive', $isactive);
        $this->db->where('shopee', 1);
        $stat['shopee'] = $this->db->count_all_results('tb_barangv2');

        if ($isactive !== null) $this->db->where('isactive', $isactive);
        $this->db->where('tokopedia', 1);
        $stat['tokopedia'] = $this->db->count_all_results('tb_barangv2');

        if ($isactive !== null) $this->db->where('isactive', $isactive);
        $this->db->where('kiushop', 1);
        $stat['kiushop'] = $this->db->count_all_results('tb_barangv2');

        // Khusus halaman admin (tidak pakai filter isactive)
        if ($isactive === null) {
            $this->db->where('isactive', 'F');
            $stat['aktif'] = $this->db->count_all_results('tb_barangv2');

            $this->db->where('isactive', 'T');
            $stat['nonaktif'] = $this->db->count_all_results('tb_barangv2');
        }

        return $stat;
    }
    
    public function updateOnlineShop($data, $id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        return $this->db->update('tb_barangv2', $data);
    }

    public function toggleAktif($id_barang, $status)
    {
        $this->db->where('id_barang', $id_barang);
        return $this->db->update('tb_barangv2', array('isactive' => $status));
    }
}
