<?php
    require 'assets/vendor/autoload.php';
    include 'conn/conn.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Style\Color;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Border;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Merge kolom A1 hingga G1
    $sheet->mergeCells('A1:G1');
    $sheet->setCellValue('A1', 'Laporan Pengelolaan Barang Sembako GoGroceries');
    $sheet->getStyle('A1')->applyFromArray([
        'font' => [
            'bold' => true,
            'size' => 20,
            'name' => 'Calibri Light',
            'color' => ['rgb' => 'FFFFFF']
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '198754'
            ]
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ]
    ]);

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('B')->setWidth(35);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(12);
    $sheet->getColumnDimension('E')->setWidth(12);
    $sheet->getColumnDimension('F')->setWidth(12);
    $sheet->getColumnDimension('G')->setWidth(18);

    $sheet->setCellValue('A3', 'ID Barang');
    $sheet->setCellValue('B3', 'Nama Barang');
    $sheet->setCellValue('C3', 'Jenis Barang');
    $sheet->setCellValue('D3', 'Stok Masuk');
    $sheet->setCellValue('E3', 'Stok Keluar');
    $sheet->setCellValue('F3', 'Stok Akhir');
    $sheet->setCellValue('G3', 'Lokasi Barang');

    $sheet->getStyle('A3:G3')->applyFromArray([
        'font' => [
            'bold' => true,
            'size' => 12,
            'name' => 'Calibri'
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'bdd7ee'
            ]
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ]
    ]);

    $query_table = mysqli_query($mysqli, "SELECT 
                                            barang.id_barang, 
                                            barang.nama_barang, 
                                            jenis_barang.jenis, 
                                            COALESCE(masuk.total_masuk, 0) AS total_barang_masuk, 
                                            COALESCE(keluar.total_keluar, 0) AS total_barang_keluar, 
                                            barang.stok, 
                                            lokasi_penyimpanan.nama_lokasi 
                                        FROM 
                                            barang
                                        LEFT JOIN 
                                            (SELECT id_barang, SUM(jumlah_barang) AS total_masuk 
                                            FROM barang_masuk 
                                            GROUP BY id_barang) masuk ON barang.id_barang = masuk.id_barang
                                        LEFT JOIN 
                                            (SELECT id_barang, SUM(jumlah_barang) AS total_keluar 
                                            FROM barang_keluar 
                                            GROUP BY id_barang) keluar ON barang.id_barang = keluar.id_barang
                                        LEFT JOIN 
                                            jenis_barang ON barang.id_jenisbarang = jenis_barang.id_jenisbarang 
                                        LEFT JOIN 
                                            lokasi_penyimpanan ON barang.id_lokasi = lokasi_penyimpanan.id_lokasi;");

    if (!$query_table) {
        die('Query Error: ' . mysqli_error($mysqli));
    }

    $styleArray = [
        'font' => [
            'size' => 12,
            'name' => 'Calibri'
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_LEFT,
            'vertical' => Alignment::VERTICAL_TOP
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ]
    ];

    $row = 4;
    while ($result = mysqli_fetch_assoc($query_table)) {
        $sheet->setCellValue('A' . $row, $result['id_barang']);
        $sheet->setCellValue('B' . $row, $result['nama_barang']);
        $sheet->setCellValue('C' . $row, $result['jenis']);
        $sheet->setCellValue('D' . $row, $result['total_barang_masuk']);
        $sheet->setCellValue('E' . $row, $result['total_barang_keluar']);
        $sheet->setCellValue('F' . $row, $result['stok']);
        $sheet->setCellValue('G' . $row, $result['nama_lokasi']);

        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray($styleArray);

        $row++;
    }

    setlocale(LC_TIME, 'id_ID.UTF-8');
    $bulan = strftime('%B', strtotime(date('Y-m-01')));
    $tahun = date('Y');

    $filename = "Laporan Pengelolaan Barang Sembako GoGroceries - $bulan $tahun.xlsx";

    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;