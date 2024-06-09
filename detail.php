<?php
// Memanggil atau membutuhkan file function.php
include "conn/conn.php";
// Jika Data Mahasiswa diklik maka
if (isset($_POST['dataPegawai'])) {
    $output = '';

    // mengambil data pegawai dari id 
    $sql = "SELECT * FROM pegawai WHERE id_pegawai = '" . $_POST['dataPegawai'] . "'";
    $hasil = mysqli_query($mysqli, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($hasil as $result) {
        $output .= '
                        <tr>
                            <th width="40%">ID Pegawai</th>
                            <td width="60%">' . $result['id_pegawai'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Nama Pegawai</th>
                            <td width="60%">' . $result['nama_pegawai'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Alamat</th>
                            <td width="60%">' . $result['alamat'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">No Telepon</th>
                            <td width="60%">' . $result['no_telepon'] . '</td>
                        </tr>
                        ';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
