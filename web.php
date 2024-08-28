<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware'=>['auth']], function(){
    Route::get('/user', function(){
        return view('/user');
    });
    route::get('/utama', 'App\Http\Controllers\UtamaController@index');
    route::get('/downloadmanual','App\Http\Controllers\UtamaController@getdownload');
    Route::get('/ganti-password','App\Http\Controllers\Auth\ForgotPasswordController@edit');
    Route::put('/simpan-ganti-password', array('as'=>'update','uses'=>'App\Http\Controllers\Auth\ForgotPasswordController@update'));

    Route::get('/cariobat','App\Http\Controllers\BeliObatController@cariobat');
    Route::get('/carikodeobat','App\Http\Controllers\BeliObatController@carikodeobat');
    Route::get('/caripasien','App\Http\Controllers\BeriHargaResepController@caripasien');

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu1']], function(){

        Route::get('pembelian',array('as'=>'index','uses'=>'App\Http\Controllers\BeliObatController@index'));
        Route::get('/pesan', 'App\Http\Controllers\BeliObatController@create');
        Route::post('pembelian/insert','App\Http\Controllers\ListBeliObatController@insert')->name('beliobat.insert');
        Route::post('/input',array('as'=>'store','uses'=>'App\Http\Controllers\BeliObatController@store'));
        Route::get('/lihat-cetak-pesanan','App\Http\Controllers\BeliObatController@lihatcetakpesan');
        Route::get('/cetak-pesanan/{no_invoice}','App\Http\Controllers\BeliObatController@cetakpesanan');
        Route::put('/batal-terima-pembelian/{no_invoice}',array('as'=>'batalterima','uses'=>'App\Http\Controllers\BeliObatController@batalterima'));
        Route::put('/batal-pesanan/{no_invoice}',array('as'=>'batalpesan','uses'=>'App\Http\Controllers\BeliObatController@batalpesan'));

        Route::get('/jual_bebas',array('as'=>'index','uses'=>'App\Http\Controllers\PenjualanBebasController@create'));
        Route::get('/list_jual_bebas',array('as'=>'index','uses'=>'App\Http\Controllers\PenjualanBebasController@index'));
        Route::post('/simpan',array('as'=>'store','uses'=>'App\Http\Controllers\PenjualanBebasController@store'));
        Route::get('/edit/jualbebas/{no_faktur}','App\Http\Controllers\PenjualanBebasController@edit');
        Route::put('/koreksi/jualbebas/{no_faktur}',array('as'=>'update','uses'=>'App\Http\Controllers\PenjualanBebasController@update'));
        Route::get('/findbebas','App\Http\Controllers\PenjualanBebasController@findbebas');
        Route::get('/koreksi-penjualan','App\Http\Controllers\PenjualanBebasController@koreksipenjualan');
        Route::post('/koreksi-penjualan/cari',array('as'=>'carikoreksi','uses'=>'App\Http\Controllers\PenjualanBebasController@carikoreksi'));
        Route::put('/retur-obat-bebas/{no_faktur}',array('as'=>'returjualbebas','uses'=>'App\Http\Controllers\PenjualanBebasController@returjualbebas'));
        Route::get('beri_resep', 'App\Http\Controllers\BeriHargaResepController@create');
        Route::get('/list_blm_disetujui','App\Http\Controllers\BeriHargaResepController@index');
        Route::get('/search-resep','App\Http\Controllers\BeriHargaResepController@searchresep');
        Route::post('/tambahresep',array('as'=>'store','uses'=>'App\Http\Controllers\BeriHargaResepController@store'));
        Route::get('/edit/resep/{no_faktur}','App\Http\Controllers\BeriHargaResepController@edit');
        Route::put('/ubah/resep/{no_faktur}',array('as'=>'update','uses'=>'App\Http\Controllers\BeriHargaResepController@update'));
        Route::put('/hapus-obat/jual-resep/{id}','App\Http\Controllers\BeriHargaResepController@destroyrow');
        Route::get('/batal-beli-resep','App\Http\Controllers\BeriHargaResepController@listbatalbeli');
        Route::put('/batal-beli-resep/simpan/{no_faktur}',array('as'=>'batalkanbeli','uses'=>'App\Http\Controllers\BeriHargaResepController@batalkanbeli'));
        Route::get('/buat_resep','App\Http\Controllers\BuatResepController@index');
        Route::put('/racik/resep/{no_faktur}',array('as'=>'update','uses'=>'App\Http\Controllers\BuatResepController@update'));
        Route::get('/lihat-racikan/{no_faktur}',array('as'=>'lihatracikan','uses'=>'App\Http\Controllers\BuatResepController@lihatracikan'));
        Route::get('/findresep','App\Http\Controllers\BeriHargaResepController@findresep');
        Route::get('/findCustomer','App\Http\Controllers\BeriHargaResepController@findCustomer');
        Route::get('/findPasien','App\Http\Controllers\BeriHargaResepController@findPasien');
        Route::get('/koefcust','App\Http\Controllers\BeriHargaResepController@koefcust');
        Route::get('/lihat-no-faktur','App\Http\Controllers\BeriHargaResepController@lihatnofaktur');
        Route::get('/obat-expired-date','App\Http\Controllers\BeriHargaResepController@expireddate');
        Route::get('/search-kartu-stock','App\Http\Controllers\BeriHargaResepController@searchkartustock');
        Route::get('/lihat-kartu-stock','App\Http\Controllers\BeriHargaResepController@listkartustock');
        Route::post('/kartu-stock/detail',array('as'=>'cetakkartustock','uses'=>'App\Http\Controllers\BeriHargaResepController@cetakkartustock'));
        Route::get('/riwayat-pasien-resep',array('as'=>'listcaririwayatpasien','uses'=>'App\Http\Controllers\BeriHargaResepController@listcaririwayatpasien'));
        Route::get('/riwayat-pasien/detail/{no_faktur}',array('as'=>'detailriwayatpasien','uses'=>'App\Http\Controllers\BeriHargaResepController@detailriwayatpasien'));
        Route::get('/kartu-stock',array('as'=>'kartustock','uses'=>'App\Http\Controllers\BeriHargaResepController@kartustock'));
        Route::get('/getTglResep','App\Http\Controllers\BeriHargaResepController@getTglResep');
        Route::get('/resep-exist','App\Http\Controllers\BeriHargaResepController@resepexist');
        Route::get('/data-pasien','App\Http\Controllers\DataPasienController@getData');
        Route::get('/data_pasien', 'App\Http\Controllers\DataPasienController@index');
        Route::get('/edit/data_pasien/{no_faktur}','App\Http\Controllers\DataPasienController@edit');
        Route::put('/data-pasien/input/{no_faktur}',array('as'=>'store','uses'=>'App\Http\Controllers\DataPasienController@store'));
        Route::put('/ubah/data_pasien/{no_faktur}',array('as'=>'update','uses'=>'App\Http\Controllers\DataPasienController@update'));
        Route::get('/searchdokter','App\Http\Controllers\DataPasienController@searchdokter');
        Route::get('/penyerahan_resep', 'App\Http\Controllers\InvoiceController@index');
        Route::get('/pilih/resep/{no_faktur}','App\Http\Controllers\InvoiceController@edit');
        Route::get('/cetak/resep/{no_faktur}','App\Http\Controllers\InvoiceController@downloadPDF');
        Route::get('/cetak-jual-bebas',array('as'=>'cetakjualbebas','uses'=>'App\Http\Controllers\PenjualanBebasController@cetakjualbebas'));
        Route::get('/cetak-jual-bebas-faktur/{no_faktur}',array('as'=>'cetakjualbebasfaktur','uses'=>'App\Http\Controllers\PenjualanBebasController@cetakjualbebasfaktur'));
        Route::get('/findcust','App\Http\Controllers\PenjualanBebasController@findcust');
        Route::get('/search-jualbebas','App\Http\Controllers\PenjualanBebasController@searchjualbebas');
        Route::get('/koreksi-resep/{no_faktur}',array('as'=>'koreksiresep','uses'=>'App\Http\Controllers\BuatResepController@koreksiresep'));
        Route::put('/koreksi-resep/simpan/{no_faktur}',array('as'=>'simpankoreksi','uses'=>'App\Http\Controllers\BuatResepController@simpankoreksi'));
        Route::get('/koreksi-cetak-resep/{no_faktur}',array('as'=>'koreksicetakresep','uses'=>'App\Http\Controllers\BuatResepController@koreksicetakresep'));
        Route::put('/batal-beli-resep/batal/{id}',array('as'=>'simpanbatalbeli','uses'=>'App\Http\Controllers\BuatResepController@simpanbatalbeli'));
        Route::put('/batal-buat-resep/batal/{id}',array('as'=>'simpanbatal','uses'=>'App\Http\Controllers\BuatResepController@simpanbatal'));
        Route::put('/updatestock',array('as'=>'updatestok','uses'=>'App\Http\Controllers\BeriHargaResepController@updatestok'));

        Route::get('/obat', 'App\Http\Controllers\ObatController@index');
        Route::get('/obat_tambah','App\Http\Controllers\ObatController@create');
        Route::post('/obat/simpan',array('as'=>'store','uses'=>'App\Http\Controllers\ObatController@store'));
        Route::get('/obat/edit/{id}',array('as'=>'edit','uses'=>'App\Http\Controllers\ObatController@edit'));
        Route::put('/obat/update/{id}','App\Http\Controllers\ObatController@update');
        Route::delete('/obat/hapus/{id}','App\Http\Controllers\ObatController@destroy');
        Route::get('/search-obat','App\Http\Controllers\ObatController@searchobat');
        // Route::resource('/apotik', 'App\Http\Controllers\ApotikController');
        Route::get('/apotik','App\Http\Controllers\ApotikController@index');
        Route::get('/apotik_tambah','App\Http\Controllers\ApotikController@create');
        Route::post('/apotik/simpan','App\Http\Controllers\ApotikController@store');
        Route::get('/apotik/edit/{id}','App\Http\Controllers\ApotikController@edit');
        Route::put('/apotik/update/{id}',array('as'=>'update','uses'=>'App\Http\Controllers\ApotikController@update'));
        Route::delete('/apotik/hapus/{id}','App\Http\Controllers\ApotikController@destroy');
        Route::get('/biaya-dokter','BiayaDokterController@index');
        Route::get('/biaya-dokter/tambah','BiayaDokterController@create');
        Route::post('/biaya-dokter/simpan',array('as'=>'store','uses'=>'BiayaDokterController@store'));
        Route::get('/biaya-dokter/edit/{id}','BiayaDokterController@edit');
        Route::put('/biaya-dokter/update/{id}',array('as'=>'update','uses'=>'BiayaDokterController@update'));
        Route::resource('/jenis_obat','App\Http\Controllers\JenisObatController');
        Route::get('/jenis_obat_tambah','App\Http\Controllers\JenisObatController@create');
        Route::get('/jenisobat_edit/{jenis_obat}','App\Http\Controllers\JenisObatController@edit');
        Route::resource('/kelompok_obat', 'KelObatController');
        Route::get('/golongan-obat/tambah','GolonganObatController@create');
        Route::get('/golongan-obat',array('as'=>'index','uses'=>'GolonganObatController@index'));
        Route::post('/golongan-obat/simpan',array('as'=>'store','uses'=>'GolonganObatController@store'));
        Route::put('/golongan-obat/update/{kode_gol}',array('as'=>'update','uses'=>'GolonganObatController@update'));
        Route::get('/golongan-obat/ubah/{kode_gol}','GolonganObatController@edit');
        Route::delete('/golongan-obat/hapus/{kode_gol}',array('as'=>'delete','uses'=>'GolonganObatController@destroy'));
        Route::get('/kelobat_tambah','KelObatController@create');
        Route::resource('/pabrik', 'App\Http\Controllers\PabrikController');
        Route::get('/pabrik_tambah','App\Http\Controllers\PabrikController@create');
        Route::get('/search-pabrik','App\Http\Controllers\PabrikController@searchpabrik');
        Route::put('/pabrik/update/{kode_pabrik}',array('as'=>'update','uses'=>'App\Http\Controllers\PabrikController@update'));
        Route::get('/pabrik/edit/{kode_pabrik}','App\Http\Controllers\PabrikController@edit');
        Route::resource('/supplier', 'App\Http\Controllers\SupplierController');
        Route::get('/supplier_tambah','App\Http\Controllers\SupplierController@create');
        Route::get('/search-supplier','App\Http\Controllers\SupplierController@searchsupplier');
        Route::get('/kode-satuan-obat','App\Http\Controllers\SatuanObatController@index');
        Route::get('/kode-satuan-obat/tambah','App\Http\Controllers\SatuanObatController@create');
        Route::post('/kode-satuan-obat/simpan',array('as'=>'store','uses'=>'App\Http\Controllers\SatuanObatController@store'));
        Route::get('/kode-satuan-obat/edit/{kode_satuan}','App\Http\Controllers\SatuanObatController@edit');
        Route::put('/kode-satuan-obat/update/{kode_satuan}',array('as'=>'update','uses'=>'App\Http\Controllers\SatuanObatController@update'));
        Route::delete('/kode-satuan-obat/hapus/{kode_satuan}','App\Http\Controllers\SatuanObatController@destroy');
        Route::get('/search-satuan','App\Http\Controllers\SatuanObatController@searchsatuan');
        Route::get('/biaya-jasa-dan-tindakan','App\Http\Controllers\BiayaJasaTindakanController@index');
        Route::get('/biaya-jasa-dan-tindakan/tambah','App\Http\Controllers\BiayaJasaTindakanController@create');
        Route::get('/Apotik-cari','App\Http\Controllers\BiayaJasaTindakanController@getApotik');
        Route::post('/biaya-jasa-dan-tindakan/simpan','App\Http\Controllers\BiayaJasaTindakanController@store');
        Route::get('/biaya-jasa-dan-tindakan/edit/{kode_tindakan}','App\Http\Controllers\BiayaJasaTindakanController@edit');
        Route::put('/biaya-jasa-dan-tindakan/update/{kode_tindakan}',array('as'=>'update','uses'=>'App\Http\Controllers\BiayaJasaTindakanController@update'));
        Route::delete('/biaya-jasa-dan-tindakan/hapus/{kode_tindakan}','App\Http\Controllers\BiayaJasaTindakanController@destroy');

        // Route::get('/monitoring-stock-apotik','App\Http\Controllers\MonitoringController@stockapotik');
        // Route::post('/monitoring-stock-apotik/cetak',array('as'=>'cetakstockapotik','uses'=>'App\Http\Controllers\MonitoringController@cetakstockapotik'));
        
        
    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu2']], function(){

        Route::get('/terima/{no_invoice}/pembelian', 'App\Http\Controllers\BeliObatController@edit');
        Route::put('/update_terima/{no_invoice}',array('as'=>'update','uses'=>'App\Http\Controllers\BeliObatController@update'));
        // Route::delete('/hapus/pesan/{no_invoice}','App\Http\Controllers\BeliObatController@destroy');
        Route::get('/terima-pesanan','App\Http\Controllers\BeliObatController@show');
        Route::get('/koreksi/{no_invoice}/pembelian','App\Http\Controllers\BeliObatController@koreksi');
        Route::put('/update/pembelian/{no_invoice}',array('as'=>'ubah','uses'=>'App\Http\Controllers\BeliObatController@ubah'));
        // Route::delete('/hapus/pembelian/{no_invoice}','App\Http\Controllers\BeliObatController@hapus');
        Route::get('/pesan-telah-diterima', array('as'=>'pesananditerima','uses'=>'App\Http\Controllers\BeliObatController@pesananditerima'));
        Route::post('/lihat-pesanan','App\Http\Controllers\BeliObatController@lihatterima');
        Route::get('/search-term','App\Http\Controllers\BeliObatController@searchterm');
        Route::get('/koreksi-terima-obat','App\Http\Controllers\BeliObatController@koreksiterima');
        Route::get('/lihat-koreksi-terima/{no_invoice}','App\Http\Controllers\BeliObatController@tampilkoreksiterima');
        Route::put('/koreksi-terima-obat/simpan/{no_invoice}',array('as'=>'lihatkoreksiterima','uses'=>'App\Http\Controllers\BeliObatController@lihatkoreksiterima'));
        Route::get('/pindah','App\Http\Controllers\PindahApotikController@index');
        Route::get('/pindah_apotik',array('as'=>'index','uses'=>'App\Http\Controllers\PindahApotikController@create'));
        Route::post('/pindah_tambah',array('as'=>'store','uses'=>'App\Http\Controllers\PindahApotikController@store'));
        Route::get('/pindah/{id_pindah}/edit','App\Http\Controllers\PindahApotikController@edit');
        // Route::delete('/hapus/{id_pindah}','App\Http\Controllers\PindahApotikController@destroy');
        Route::put('/update_pindah/{id_pindah}',array('as'=>'update','uses'=>'App\Http\Controllers\PindahApotikController@update'));
        Route::put('/batal-kirim/{id_pindah}',array('as'=>'batalkirim','uses'=>'App\Http\Controllers\PindahApotikController@batalkirim'));
        Route::get('/obat-telah-diterima','App\Http\Controllers\PindahApotikController@listbatalterima');
        Route::get('/obat-telah-diterima/lihat/{id_pindah}','App\Http\Controllers\PindahApotikController@lihatterima');
        Route::put('/obat-telah-diterima/batal/{id_pindah}',array('as'=>'batalterima','uses'=>'App\Http\Controllers\PindahApotikController@batalterima'));
        Route::get('/list_terima_kiriman',array('as'=>'index','uses'=>'App\Http\Controllers\TerimaKirimanController@index'));
        Route::get('/terima/{id_pindah}/pindah','App\Http\Controllers\TerimaKirimanController@edit');
        Route::put('/terima-kiriman/{id_pindah}',array('as'=>'update','uses'=>'App\Http\Controllers\TerimaKirimanController@update'));
        // Route::delete('/hapus/terima_kiriman/{id_pindah}','App\Http\Controllers\TerimaKirimanController@destroy');
        Route::get('/list-terima',array('as'=>'index','uses'=>'App\Http\Controllers\TerimaKirimanController@listlihat'));
        Route::get('/lihat-terima-pindah/{id_pindah}',array('as'=>'lihat','uses'=>'App\Http\Controllers\TerimaKirimanController@lihat'));
        Route::get('/daftar-pengiriman/{id_pindah}',array('as'=>'cetakkirim','uses'=>'App\Http\Controllers\TerimaKirimanController@cetakkirim'));
        Route::get('/surat-pengiriman','App\Http\Controllers\PindahApotikController@lihatcetakpengiriman');
        Route::get('/surat-pengiriman/cetak/{id_pindah}',array('as'=>'cetakpengiriman','uses'=>'App\Http\Controllers\PindahApotikController@cetakpengiriman'));

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu3']], function(){

        Route::get('/riwayat-pasien','App\Http\Controllers\KlinikController@riwayat');
        Route::get('/daftar-pasien-baru','App\Http\Controllers\KlinikController@index');
        Route::post('/pasien-didaftarkan',array('as'=>'store','uses'=>'App\Http\Controllers\KlinikController@store'));
        Route::get('/lihat-daftar-pasien',array('as'=>'lihatdaftar','uses'=>'App\Http\Controllers\KlinikController@lihatdaftar'));
        Route::get('/pilih-dokter/{no_kartu_pasien}','App\Http\Controllers\KlinikController@kedokter');
        Route::post('/daftar-ke-dokter/{no_kartu_pasien}',array('as'=>'daftarkedokter','uses'=>'App\Http\Controllers\KlinikController@daftarkedokter'));
        Route::get('/searchkartupasien','App\Http\Controllers\KlinikController@searchkartupasien');
        Route::get('/findCust','App\Http\Controllers\KlinikController@findCust');
        Route::get('/findPas','App\Http\Controllers\KlinikController@findPas');
        Route::get('/daftar-pasien-umum','App\Http\Controllers\KlinikController@daftarumum');
        Route::post('/simpan-daftar-umum',array('as'=>'simpandaftarumum','uses'=>'App\Http\Controllers\KlinikController@simpandaftarumum'));
        Route::get('/caridatapegawai','App\Http\Controllers\KlinikController@caridatapegawai');
        Route::get('/Bayar-Dokter','App\Http\Controllers\KlinikController@menutagihandokter');
        Route::get('/cetak-kwitansi-dokter/{no_resep}',array('as'=>'cetakkwitansidokter','uses'=>'App\Http\Controllers\KlinikController@cetakkwitansidokter'));
        Route::get('/daftar-tindakan-medis/{no_kartu_pasien}','App\Http\Controllers\KlinikController@lihattindakanmedis');
        Route::post('/daftar-tindakan-medis/simpan/{no_kartu_pasien}',array('as'=>'daftartindakanmedis','uses'=>'App\Http\Controllers\KlinikController@daftartindakanmedis'));
        Route::get('/lihat-daftar-tindakan','App\Http\Controllers\KlinikController@lihatpasientindakan');
        Route::get('/input-tindakan-medis/{id_riwayat_tindakan}','App\Http\Controllers\KlinikController@tindakanmedis');
        Route::put('/input-tindakan-medis/simpan/{id_riwayat_tindakan}',array('as'=>'simpantindakanmedis','uses'=>'App\Http\Controllers\KlinikController@simpantindakanmedis'));
        Route::get('/kwitansi-tindakan-medis','App\Http\Controllers\KlinikController@kwitansitindakanmedis');
        Route::get('/kwitansi-tindakan-medis/cetak/{id_riwayat_tindakan}','App\Http\Controllers\KlinikController@cetaktindakanmedis'); Route::get('/daftar-tindakan-medis/{no_kartu_pasien}','App\Http\Controllers\KlinikController@lihattindakanmedis');
        Route::post('/daftar-tindakan-medis/simpan/{no_kartu_pasien}',array('as'=>'daftartindakanmedis','uses'=>'App\Http\Controllers\KlinikController@daftartindakanmedis'));
        Route::get('/lihat-daftar-tindakan','App\Http\Controllers\KlinikController@lihatpasientindakan');
        Route::get('/input-tindakan-medis/{id_riwayat_tindakan}','App\Http\Controllers\KlinikController@tindakanmedis');
        Route::put('/input-tindakan-medis/simpan/{id_riwayat_tindakan}',array('as'=>'simpantindakanmedis','uses'=>'App\Http\Controllers\KlinikController@simpantindakanmedis'));
        Route::get('/kwitansi-tindakan-medis','App\Http\Controllers\KlinikController@kwitansitindakanmedis');
        Route::get('/kwitansi-tindakan-medis/cetak/{id_riwayat_tindakan}','App\Http\Controllers\KlinikController@cetaktindakanmedis');
        Route::put('/hapus-riwayat-tindakan/{id_riwayat_tindakan}','App\Http\Controllers\KlinikController@hapusriwayattindakan');
        Route::get('/lihatcustomer','App\Http\Controllers\KlinikController@lihatcustomer');
        Route::get('/koreksi-data-pasien/{no_kartu_pasien}','App\Http\Controllers\KlinikController@koreksipasien');
        Route::put('/koreksi-data-pasien/simpan/{no_karttu_pasien}',array('as'=>'simpankoreksipasien','uses'=>'App\Http\Controllers\KlinikController@simpankoreksipasien'));
        
        Route::get('/tindakan-dokter-gigi/tambah','App\Http\Controllers\KlinikController@tambahtindakandrg');
        Route::post('/tindakan-dokter-gigi/simpan',array('as'=>'simpantindakandrg','uses'=>'App\Http\Controllers\KlinikController@simpantindakandrg'));
        Route::get('/tindakan-dokter-gigi/koreksi/{id}','App\Http\Controllers\KlinikController@koreksitindakandrg');
        Route::put('/tindakan-dokter-gigi/update/{id}',array('as'=>'updatetindakandrg','uses'=>'App\Http\Controllers\KlinikController@updatetindakandrg'));
        Route::delete('/tindakan-dokter-gigi/hapus/{id}','App\Http\Controllers\KlinikController@hapustindakandrg');
        Route::get('/pasien-rujukan','App\Http\Controllers\KlinikController@pasienrujukan');
        Route::get('/list-cetak-rapid','App\Http\Controllers\KlinikController@listrapid');
        Route::get('/kwitansi-tindakan-dokter-gigi','App\Http\Controllers\KlinikController@lamandoktergigi');
        Route::get('/kwitansi-tindakan-dokter-gigi/cetak/{id_riwayat_drg}','App\Http\Controllers\KlinikController@cetakkwitansidrg');
        Route::get('/dokter-spesialis','App\Http\Controllers\DokterSpesialisController@index');
        Route::get('/dokter-spesialis/tambah','App\Http\Controllers\DokterSpesialisController@create');
        Route::post('/dokter-spesialis/tambah/simpan','App\Http\Controllers\DokterSpesialisController@store');
        Route::get('/dokter-spesialis/edit/{id}','App\Http\Controllers\DokterSpesialisController@edit');
        Route::put('/dokter-spesialis/edit/update/{id}',array('as'=>'update','uses'=>'App\Http\Controllers\DokterSpesialisController@update'));

        Route::get('/findtindakanjasa','App\Http\Controllers\KlinikController@findtindakanjasa');

        Route::get('/surat-keterangan-sehat','App\Http\Controllers\KlinikController@suratketsehat');
        Route::put('/surat-keterangan-sehat/cetak/{no_resep}',array('as'=>'cetaksuketsehat','uses'=>'App\Http\Controllers\KlinikController@cetaksuketsehat'));
        Route::get('/surat-keterangan-istirahat','App\Http\Controllers\KlinikController@suratketistirahat');
        Route::put('/surat-keterangan-istirahat/cetak/{no_resep}',array('as'=>'cetaksuketistirahat','uses'=>'App\Http\Controllers\KlinikController@cetaksuketistirahat'));
        Route::get('/cetak-surat-keterangan-rujukan/{no_resep}','App\Http\Controllers\KlinikController@cetaksuketrujukan');

        Route::get('/riwayat-tindakan/{no_kartu_pasien}',array('as'=>'carihasiltindakan','uses'=>'App\Http\Controllers\KlinikController@carihasiltindakan'));
    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu4']], function(){

        Route::get('/data-pasien-dokter/{id}','App\Http\Controllers\PasienDokterController@index');
        Route::get('/pemeriksaan-pasien','App\Http\Controllers\PasienDokterController@create');
        Route::put('/simpan-pemeriksaan-pasien/{no_kartu_pasien}',array('as'=>'store','uses'=>'App\Http\Controllers\PasienDokterController@store'));
        Route::put('/pemeriksaan-pasien/batal/{no_kartu_pasien}', array('as'=>'batalpasien','uses'=>'App\Http\Controllers\PasienDokterController@batalpasien'));
        Route::get('/findresepdok','BeriHargaResepController@findresepdok');
        Route::get('/cetak-resep-pasien','App\Http\Controllers\PasienDokterController@cetakreseppasien');
        Route::get('/periksa-pasien-drg/{id}','App\Http\Controllers\PasienDokterController@periksadrg');
        Route::get('/periksa-pasien-drg','App\Http\Controllers\PasienDokterController@listperiksadrg');
        Route::get('/findbiayatindakandrg','App\Http\Controllers\PasienDokterController@findtindakandrg');
        Route::put('/periksa-pasien-drg/simpan/{no_kartu_pasien}',array('as','simpanpasiendrg','uses'=>'App\Http\Controllers\PasienDokterController@simpanpasiendrg'));
        Route::get('/cetak-resep-pasien-drg','App\Http\Controllers\PasienDokterController@cetakreseppasiendrg');
        Route::get('/laporan-pemeriksaan-oleh-dokter','DokterController@lappemeriksaandokter');
        Route::post('/laporan-pemeriksaan-oleh-dokter/cetak',array('as'=>'cetakpemeriksaandokter','uses'=>'DokterController@cetakpemeriksaandokter'));
        Route::get('/riwayat-pasien-dokter-gigi','App\Http\Controllers\PasienDokterController@lihatriwayatdrg');
        Route::get('/riwayat-pasien-dokter-gigi/cetak/{no_kartu_pasien}',array('as'=>'cetakriwayatdrg','uses'=>'App\Http\Controllers\PasienDokterController@cetakriwayatdrg'));
        Route::get('/search-pasien-drg','App\Http\Controllers\PasienDokterController@searchpasiendrg');
        Route::get('/daftar-riwayat-pasien','App\Http\Controllers\PasienDokterController@riwayatpasienumum');
        Route::post('/daftar-riwayat-pasien/cetak',array('as'=>'cetakriwayatpasienumum','uses'=>'App\Http\Controllers\PasienDokterController@cetakriwayatpasienumum'));
        Route::get('/periksa-tambahan','App\Http\Controllers\PasienDokterController@tambahinputpasien');
        Route::get('/periksa-pasien/add/{no_kartu_pasien}',array('as'=>'showtambahinputan','uses'=>'App\Http\Controllers\PasienDokterController@showtambahinputan'));
        Route::put('/periksa-pasien/add/simpan/{no_kartu_pasien}',array('as'=>'savetambahperiksa','uses'=>'App\Http\Controllers\PasienDokterController@savetambahperiksa'));

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu5']], function(){

        Route::get('/daftar-penagihan','App\Http\Controllers\PenagihanController@lihat');
        Route::post('/cetak', 'App\Http\Controllers\PenagihanController@cetaktagihan');
        Route::post('/simpan-tagihan','App\Http\Controllers\PenagihanController@simpan');
        Route::get('/pembayaran-tagihan','App\Http\Controllers\PenagihanController@verifikasi');
        Route::get('/search-faktur','App\Http\Controllers\PenagihanController@searchfaktur');
        Route::get('/search-kwitansi','App\Http\Controllers\PenagihanController@searchkwitansi');
        Route::put('/gagal-bayar/{no_faktur}',array('as'=>'gagalbayar','uses'=>'App\Http\Controllers\PenagihanController@gagalbayar'));
        Route::get('/kwitansi','App\Http\Controllers\PenagihanController@kwitansi');
        Route::post('/cetak-kwitansi','App\Http\Controllers\PenagihanController@cetakkwitansi');
        Route::get('/laporan-daftar-penagihan','App\Http\Controllers\PenagihanController@daftarlaporan');
        Route::get('/laporan-daftar-penagihan/cetak/{no_kwitansi}',array('as'=>'cetakdaftarlaporan','uses'=>'App\Http\Controllers\PenagihanController@cetakdaftarlaporan'));
        Route::get('/lihat-penagihan','App\Http\Controllers\PenagihanController@lihatpenagihan');
        Route::post('/laman-lihat-penagihan','App\Http\Controllers\PenagihanController@lamanlihatpenagihan');
        Route::get('/monitoring-penagihan','App\Http\Controllers\PenagihanController@monitoringpenagihan');
        Route::get('/cari-customer','App\Http\Controllers\PenagihanController@caricust');
        Route::get('/penagihan-dokter','App\Http\Controllers\PenagihanController@tagihdokter');
        Route::post('/penagihan-dokter/cetak','App\Http\Controllers\PenagihanController@cetaktagihdokter');
        Route::get('/kwitansi-penagihan-dokter','App\Http\Controllers\PenagihanController@kwitansitagihdokter');
        Route::post('/kwitansi-penagihan-dokter/cetak','App\Http\Controllers\PenagihanController@cetakkwitansitagihdokter');
        Route::get('/penagihan-rujukan-resep','App\Http\Controllers\PenagihanController@tagihrujukan');
        Route::post('/penagihan-rujukan-resep/cetak','App\Http\Controllers\PenagihanController@cetaktagihrujukan');
        Route::get('/kwitansi-penagihan-rujukan-resep','App\Http\Controllers\PenagihanController@kwitansirujukanresep');
        Route::post('/kwitansi-penagihan-rujukan-resep/cetak','App\Http\Controllers\PenagihanController@cetakkwitansirujukanresep');
        Route::get('/lihat-penagihan-tindakan-gigi','App\Http\Controllers\PenagihanController@lihatpendrg');
        Route::post('/laman/lihat-penagihan-tindakan-gigi','App\Http\Controllers\PenagihanController@lamanlihatpendrg');
        Route::get('/buat-penagihan-tindakan-drg','App\Http\Controllers\PenagihanController@buatpendrg');
        Route::post('/cetak/buat-penagihan-tindakan-drg','App\Http\Controllers\PenagihanController@cetakpendrg');
        Route::get('/daftar-penagihan-tindakan-drg','App\Http\Controllers\PenagihanController@daftarlistpendrg');
        Route::get('/laporan/daftar-penagihan-tindakan-drg/{no_kwitansi}',array('as'=>'cetakdaftarlistpendrg','uses'=>'App\Http\Controllers\PenagihanController@cetakdaftarlistpendrg'));
        Route::get('/kwitansi-penagihan-drg','App\Http\Controllers\PenagihanController@kwitansipendrg');
        Route::post('/cetak/kwitansi-penagihan-drg','App\Http\Controllers\PenagihanController@cetakkwitansipendrg');
        Route::get('/lihat-daftar-rujukan','App\Http\Controllers\PenagihanController@lihatpenagihanrujukan');
        Route::post('/lihat-daftar-rujukan/cetak',array('as'=>'cetaklihatpenagihanrujukan','uses'=>'App\Http\Controllers\PenagihanController@cetaklihatpenagihanrujukan'));
        Route::get('/monitoring-koreksi-resep','BeriHargaResepController@listmonpenjualan');
        Route::get('/monitoring-koreksi-resep/koreksi/{no_faktur}',array('as'=>'koreksimonpenjualan','uses'=>'BeriHargaResepController@koreksimonpenjualan'));
        Route::put('/monitoring-koreksi-reseo/simpan/{no_faktur}',array('as'=>'simpankoreksimonpenjualan','uses'=>'BeriHargaResepController@simpankoreksimonpenjualan'));

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu6']], function(){

        Route::get('/lap-stock-obat','LaporanController@index');
        Route::get('/cetak-stock-obat','LaporanController@cetakstockobat');
        Route::get('/export-stock-obat','LaporanController@export');
        Route::get('/export-loc-stock-obat','LaporanController@exportloc');
        Route::get('/cetak-stock-all','LaporanController@cetakall');
        Route::get('/search-apotik','LaporanController@searchapotik');
        Route::get('/obat-exp_date','LaporanController@expdateobat');
        Route::post('/obat-exp_date/cetak',array('as'=>'cetakexpdateobat','uses'=>'LaporanController@cetakexpdateobat'));
        
    });
    
    Route::group(['middleware'=>['App\Http\Middleware\checkmenu7']], function(){
        
        Route::get('/obat-harus-dibeli','LaporanController@obatharusdibeli');
       

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu8']], function(){

        Route::get('/laporan-psikotropika','LaporanController@psi');
        Route::post('/laporan-psikotropika/cetak','LaporanController@cetakpsi');

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu9']], function(){

        Route::resource('/lokasi', 'LokasiController');
        Route::post('/lokasi/simpan',array('as'=>'store','uses'=>'LokasiController@store'));
        Route::get('/lokasi_tambah','LokasiController@create');
        Route::resource('/gudang', 'GudangController');
        Route::get('/gudang_tambah','GudangController@create');
        Route::get('/search-digudang','GudangController@searchdigudang');
        Route::get('/input-harga','GudangController@entryharga');
        Route::get('/findobatharga','GudangController@findobatharga');
        Route::get('/cariapotik','GudangController@cariapotik');
        Route::post('/simpan-harga',array('as'=>'simpanharga','uses'=>'GudangController@simpanharga'));
        Route::get('/harga-obat','LaporanController@hargaobat');
        Route::get('search-harga','LaporanController@searchharga');
        Route::get('/laporan-preku-narkotika','LaporanController@psinar');
        Route::post('/laporan-preku-narkotika/cetak','LaporanController@cetakprenar');
        Route::get('/rekap-laporan-narkotika','LaporanController@rekaplapnarpsioot');
        Route::post('/rekap-laporan-narkotika/cetak',array('as'=>'cetaklapnarpsioot','uses'=>'LaporanController@cetaklapnarpsioot'));
        Route::get('/laporan-obat-covid','LaporanController@obatcovid');
        Route::post('/laporan-obat-covid/cetak','LaporanController@cetakobatcovid');
        Route::get('/rekap-laporan-covid','LaporanController@rekaplapcovid');
        Route::post('/rekap-laporan-covid/cetak',array('as'=>'cetaklapcovid','uses'=>'LaporanController@cetaklapcovid'));

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu10']], function(){

        Route::resource('/customer', 'CustomerController');
        Route::get('/customer_tambah','CustomerController@create');
        Route::get('/search-customer','CustomerController@searchcustomer');
        Route::resource('/karyawan', 'KaryawanController');
        Route::get('/karyawan_tambah','KaryawanController@create');
        Route::get('/karyawan-koreksi-cust/{id}','KaryawanController@lihatkoreksicust');
        Route::get('/search-karyawan','KaryawanController@searchkaryawan');
        Route::put('/update-cust-karyawan/{id}','KaryawanController@koreksicustomer');
        Route::resource('/rumah_sakit', 'RSController');
        Route::get('/rs_tambah','RSController@create');
        // Route::get('/dokter', 'DokterController@index');
        Route::get('dokter_rs', 'DokterController@getRS');
        Route::post('dokter/save', 'DokterController@store');
        Route::get('/dokter_tambah','DokterController@create');
        Route::resource('/dokter','DokterController');

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu11']], function(){
    
        Route::get('/register-aja','Auth\RegisterController@index');
        Route::post('/insert',array('as'=>'create','uses'=>'Auth\RegisterController@create'));
        Route::get('/info-user',array('as'=>'edit','uses'=>'Auth\RegisterController@edit'));
        Route::get('/edit-user/{id}',array('as'=>'ubah','uses'=>'Auth\RegisterController@ubah'));
        Route::put('/update-user/{id}',array('as'=>'update','uses'=>'Auth\RegisterController@update'));
        Route::delete('/delete-user/{id}','Auth\RegisterController@destroy');
        Route::get('/search-user','Auth\RegisterController@searchuser');
        Route::get('/reset-password-user/{id}',array('as'=>'show','uses'=>'Auth\RegisterController@show'));
        Route::put('/simpan-reset-password/{id}', array('as'=>'simpanpassword','uses'=>'Auth\RegisterController@simpanpassword'));
        Route::get('/getApotik','Auth\RegisterController@getApotik');
        Route::get('/login-track','App\Http\Controllers\MonitoringController@lastlogin');
    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu12']], function(){

        Route::get('/monitoring-pemeriksaan-pasien','App\Http\Controllers\MonitoringController@monperiksapasien');
        Route::post('/monitoring-pemeriksaan-pasien/cetak',array('as'=>'cetakperiksapasien','uses'=>'App\Http\Controllers\MonitoringController@cetakperiksapasien'));
        // Route::get('/monitoring-penjualan-per-item','App\Http\Controllers\MonitoringController@penjualanperitem');
        // Route::post('/monitoring-penjualan-per-item/cetak',array('as'=>'cetakpenjualanperitem','uses'=>'App\Http\Controllers\MonitoringController@cetakpenjualanperitem'));
        Route::get('/monitoring-racikan-dan-tidak-diracik','App\Http\Controllers\MonitoringController@raciktidakracik');
        Route::post('/monitoring-racikan-dan-tidak-diracik/cetak',array('as'=>'cetakraciktidakracik','uses'=>'App\Http\Controllers\MonitoringController@cetakraciktidakracik'));
        Route::get('/monitoring-pendapatan-per-unit','App\Http\Controllers\MonitoringController@pendapatanperunit');
        Route::post('/monitoring-pendapatan-per-unit/cetak',array('as'=>'cetakpendapatanperunit','uses'=>'App\Http\Controllers\MonitoringController@cetakpendapatanperunit'));
        Route::get('/monitoring-pemeriksaan-per-unit','App\Http\Controllers\MonitoringController@pemeriksaanunit');
        Route::post('/monitoring-pemeriksaan-per-unit/cetak',array('as'=>'cetakpemeriksaanunit','uses'=>'App\Http\Controllers\MonitoringController@cetakpemeriksaanunit'));
        Route::get('/monitoring-tindakan-per-apotik','App\Http\Controllers\MonitoringController@tindakanapotik');
        Route::post('/monitoring-tindakan-per-apotik/cetak',array('as'=>'cetaktindakanapotik','uses'=>'App\Http\Controllers\MonitoringController@cetaktindakanapotik'));
        // Route::get('/monitoring-stock-apotik','App\Http\Controllers\MonitoringController@stockapotik');
        // Route::post('/monitoring-stock-apotik/cetak',array('as'=>'cetakstockapotik','uses'=>'App\Http\Controllers\MonitoringController@cetakstockapotik'));
        Route::get('/monitoring-beda-harga_jual-beli','App\Http\Controllers\MonitoringController@bedajualbeli');
        Route::post('/monitoring-beda-harga_jual-beli/cetak',array('as','cetakbedajualbeli','uses'=>'App\Http\Controllers\MonitoringController@cetakbedajualbeli'));
        Route::get('/monitoring-pembelian-per-supplier','App\Http\Controllers\MonitoringController@monsupplier');
        Route::post('/monitoring-pembelian-per-supplier/cetak',array('as','cetakmonsupplier','uses'=>'App\Http\Controllers\MonitoringController@cetakmonsupplier'));
        Route::get('/monitoring-pasien-per-hari','App\Http\Controllers\MonitoringController@monpasienperhari');
        Route::post('/monitoring-pasien-per-hari/cetak',array('as'=>'cetakpasienperhari','uses'=>'App\Http\Controllers\MonitoringController@cetakpasienperhari'));
        Route::get('/monitoring-pasien-biaya-terbesar','App\Http\Controllers\MonitoringController@monrupiahterbesar');
        Route::post('/monitorin-pasien-biaya-terbesar/cetak',array('as'=>'cetakpasienrupiahterbanyak','uses'=>'App\Http\Controllers\MonitoringController@cetakpasienrupiahterbanyak'));
        Route::get('/monitoring-kunjungan-terbanyak','App\Http\Controllers\MonitoringController@monkunjunganterbanyak');
        Route::post('/monitoring-kunjungan-terbanyak/cetak',array('as'=>'cetakkunjunganterbanyak','uses'=>'App\Http\Controllers\MonitoringController@cetakkunjunganterbanyak'));
        Route::get('/monitoring-resep-apotik','App\Http\Controllers\MonitoringController@monresepperbulan');
        Route::post('/monitoring-resep-apotik/cetak',array('as'=>'cetakresepperbulan','uses'=>'App\Http\Controllers\MonitoringController@cetakresepperbulan'));
        Route::get('/monitoring-dokter-gigi','App\Http\Controllers\MonitoringController@mondoktergigi');
        Route::post('/monitoring-dokter-gigi/cetak',array('as'=>'cetakmondoktergigi','uses'=>'App\Http\Controllers\MonitoringController@cetakmondoktergigi'));
        Route::get('/monitoring-pembelian-obat','App\Http\Controllers\MonitoringController@monpembelian');
        Route::post('/monitoring-pembelian-obat/cetak',array('as'=>'cetakpembelian','uses'=>'App\Http\Controllers\MonitoringController@cetakpembelian'));
        Route::get('/monitoring-alur-stock','App\Http\Controllers\MonitoringController@monalurstock');
        Route::post('/monitoring-alur-stock/cetak',array('as'=>'cetakalurstock','uses'=>'App\Http\Controllers\MonitoringController@cetakalurstock'));
        Route::get('/monitoring-riwayat-rujukan-pasien','App\Http\Controllers\MonitoringController@monriwayatpasien');
        Route::post('/monitoring-riwayat-rujukan-pasien/cetak',array('as'=>'cetakriwayatpasien','uses'=>'App\Http\Controllers\MonitoringController@cetakriwayatpasien'));
        Route::get('/monitoring-riwayat-dokter-gigi','App\Http\Controllers\MonitoringController@monriwayatdoktergigi');
        Route::post('/monitoring-riwayat-dokter-gigi/cetak',array('as'=>'cetakriwayatdoktergigi','uses'=>'App\Http\Controllers\MonitoringController@cetakriwayatdoktergigi'));
        Route::get('/monitoring-pendapatan-unit-apotik','App\Http\Controllers\MonitoringController@pendapatanunitapotik');
        Route::post('/monitoring-pendapatan-unit-apotik/cetak',array('as'=>'printpendapatanunitapotik','uses'=>'App\Http\Controllers\MonitoringController@printpendapatanunitapotik'));
        Route::get('/monitoring-pendapatan-apotik','App\Http\Controllers\MonitoringController@monpendapatanapotik');
        Route::post('/monitoring-pendapatan-apotik/cetak',array('as'=>'cetakpendapatanapotik','uses'=>'App\Http\Controllers\MonitoringController@cetakpendapatanapotik'));
        Route::get('/monitoring-kelompok-dokter-gigi','App\Http\Controllers\MonitoringController@mondrgpisah');
        Route::post('/monitoring-kelompok-dokter-gigi/cetak',array('as'=>'cetakdrgpisah','uses'=>'App\Http\Controllers\MonitoringController@cetakdrgpisah'));

    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu13']], function(){
    
        Route::get('/pembayaran-jatuh-tempo','App\Http\Controllers\PembayaranController@index');
        Route::get('/pembayaran-jatuh-tempo/pilih/{kode_supplier}',array('as'=>'pilihjatuhtempo','uses'=>'App\Http\Controllers\PembayaranController@pilihjatuhtempo'));
        Route::put('/pembayaran-jatuh-tempo/cetak/{kode_supplier}',array('as'=>'create','uses'=>'App\Http\Controllers\PembayaranController@create'));
        Route::put('/pembayaran-jatuh-tempo/selesai/{kode_supplier}',array('as'=>'jatuhtemposelesai','uses'=>'App\Http\Controllers\PembayaranController@jatuhtemposelesai'));
        Route::get('/pembayaran-obat-kredit/kembali/cetak','App\Http\Controllers\PembayaranController@pembayarankreditbayarkembali');
        Route::get('/simpan/kembali/flag/{no_invoice}',array('as'=>'kembaliflag','uses'=>'App\Http\Controllers\PembayaranController@kembaliflag'));
        Route::get('/schedule-pembayaran','App\Http\Controllers\PembayaranController@bayarschedule');
        Route::get('/kas-harian/tambah','App\Http\Controllers\PembayaranController@tambahkasharian');
        Route::get('/kas-harian','App\Http\Controllers\PembayaranController@listkasharian');
        Route::post('/kas-harian/simpan',array('as'=>'simpankasharian','uses'=>'App\Http\Controllers\PembayaranController@simpankasharian'));
        Route::get('/kas-harian/cetak/{id}',array('as'=>'cetakkasharian','uses'=>'App\Http\Controllers\PembayaranController@cetakkasharian'));
        Route::post('/kas-harian/bulan',array('as'=>'caribulankasharian','uses'=>'App\Http\Controllers\PembayaranController@caribulankasharian'));
        Route::get('/saldo-awal','App\Http\Controllers\PembayaranController@saldo_awal');
        Route::post('/saldo-awal/simpan','App\Http\Controllers\PembayaranController@simpansaldoawal');
        Route::get('/pembayaran-obat-tunai','App\Http\Controllers\PembayaranController@listobattunai');
        Route::get('/kas-harian/koreksi/{id}','App\Http\Controllers\PembayaranController@koreksikasharian');
        Route::put('/kas-harian/update/{id}',array('as'=>'updatekoreksikasharian','uses'=>'App\Http\Controllers\PembayaranController@updatekoreksikasharian'));
        Route::get('/kas-harian-apotik/tambah','App\Http\Controllers\PembayaranController@tambahkasharianapotik');
        Route::get('/kas-harian-apotik','App\Http\Controllers\PembayaranController@listkasharianapotik');
        Route::post('/kas-harian-apotik/simpan',array('as'=>'simpankasharianapotik','uses'=>'App\Http\Controllers\PembayaranController@simpankasharianapotik'));
        Route::get('/kas-harian-apotik/cetak/{id}',array('as'=>'cetakkasharianapotik','uses'=>'App\Http\Controllers\PembayaranController@cetakkasharianapotik'));
        Route::delete('/kas-harian/hapus/{id}','App\Http\Controllers\PembayaranController@hapuskasharianutama');
        Route::delete('/kas-harian-apotik/hapus/{id}','App\Http\Controllers\PembayaranController@hapuskasharianApotik');
        Route::post('/kas-harian-apotik/bulan',array('as'=>'caribulankasapotik','uses'=>'App\Http\Controllers\PembayaranController@caribulankasapotik'));
        Route::get('/saldo-awal-apotik','App\Http\Controllers\PembayaranController@saldo_awalapotik');
        Route::post('/saldo-awal-apotik/simpan','App\Http\Controllers\PembayaranController@simpansaldoawalapotik');
        Route::get('/kas-harian-apotik/koreksi/{id}','App\Http\Controllers\PembayaranController@koreksikasharianapotik');
        Route::put('/kas-harian-apotik/update/{id}',array('as'=>'updatekoreksikasharianapotik','uses'=>'App\Http\Controllers\PembayaranController@updatekoreksikasharianapotik'));
        Route::get('/rekapan-kas-utama','App\Http\Controllers\PembayaranController@rekapankasutama');
        Route::post('/rekapan-kas-utama/cetak',array('as'=>'cetakrekapankasutama','uses'=>'App\Http\Controllers\PembayaranController@cetakrekapankasutama'));
        Route::get('/rekapan-kas-apotik','App\Http\Controllers\PembayaranController@rekapankasapotik');
        Route::post('/rekapan-kas-apotik/cetak',array('as'=>'cetakrekapankasapotik','uses'=>'App\Http\Controllers\PembayaranController@cetakrekapankasapotik'));
        Route::get('/saldo-awal-utama/simpan','App\Http\Controllers\PembayaranController@simpansaldoawalupdate');
        Route::post('/saldo-akhir/simpan',array('as'=>'saldoakhirsimpan','uses'=>'App\Http\Controllers\PembayaranController@saldoakhirsimpan'));
        Route::get('/accounts-list','KodeAkunController@index');
        Route::get('/accounts-list/tambah','KodeAkunController@create');
        Route::post('/accounts-list/simpan',array('as'=>'store','uses'=>'KodeAkunController@store'));
        Route::get('/accounts-list/edit/{id}','KodeAkunController@edit');
        Route::put('/accounts-list/update/{id}',array('as'=>'update','uses'=>'KodeAkunController@update'));
        Route::delete('/accounts-list/delete/{id}','KodeAkunController@destroy');
        Route::get('/monitoring-pembelian-telah-dibayar','App\Http\Controllers\PembayaranController@monpembeliandibayar');
        Route::post('/monitoring-pembelian-telah-dibayar/cetak',array('as'=>'cetakmonpembeliandibayar','uses'=>'App\Http\Controllers\PembayaranController@cetakmonpembeliandibayar'));

        Route::get('/laporan-kas-apotik','App\Http\Controllers\PembayaranController@laporankasapotik');
        Route::post('/laporan-kas-apotik/cetak',array('as'=>'cetaklaporankasapotik','uses'=>'App\Http\Controllers\PembayaranController@cetaklaporankasapotik'));

        Route::get('/Buku-Bank','App\Http\Controllers\BukuBankController@index');
        Route::get('/Buku-Bank/tambah','App\Http\Controllers\BukuBankController@create');
        Route::post('/Buku-Bank/simpan',array('as'=>'store','uses'=>'App\Http\Controllers\BukuBankController@store'));
        Route::get('/Buku-Bank/edit/{id}','App\Http\Controllers\BukuBankController@edit');
        Route::put('/Buku-Bank/update/{id}',array('as'=>'update','uses'=>'App\Http\Controllers\BukuBankController@update'));
        Route::delete('/Buku-Bank/hapus/{id}','App\Http\Controllers\BukuBankController@destroy');
        Route::post('/Buku-Bank/bulan', array('as'=>'show','uses'=>'App\Http\Controllers\BukuBankController@show'));
        Route::get('/Buku-Bank/cetak/{id}','App\Http\Controllers\BukuBankController@cetakbukubank');
        Route::get('/Rekapan-Buku-Bank','App\Http\Controllers\BukuBankController@rekapanbukubank');
        Route::post('/Rekapan-Buku-Bank/cetak',array('as'=>'cetakrekapanbukubank','uses'=>'App\Http\Controllers\BukuBankController@cetakrekapanbukubank'));
        Route::get('/saldo-buku-bank','App\Http\Controllers\BukuBankController@inputsaldobukubank');
        Route::post('/saldo-buku-bank/simpan',array('as'=>'simpansaldobukubank','uses'=>'App\Http\Controllers\BukuBankController@simpansaldobukubank'));
        
        Route::get('/Jurnal-Akuntansi','App\Http\Controllers\JurnalAkunController@index');
        Route::get('/Jurnal-Akuntansi/tambah','App\Http\Controllers\JurnalAkunController@create');
        Route::get('/search-data-jurnal','App\Http\Controllers\JurnalAkunController@searchdatabeli');
        Route::get('/search-supplier-jurnal','App\Http\Controllers\JurnalAkunController@searchsupplier');
        Route::post('/Jurnal-Akuntansi/simpan',array('as'=>'store','uses'=>'App\Http\Controllers\JurnalAkunController@store'));
        Route::post('/Jurnal-Akuntansi/bulan',array('as'=>'searchmonthjurnal','uses'=>'App\Http\Controllers\JurnalAkunController@searchmonthjurnal'));
        Route::get('/Jurnal-Akuntansi/edit/{id}','App\Http\Controllers\JurnalAkunController@edit');
        Route::put('/Jurnal-Akuntansi/update/{id}',array('as'=>'update','uses'=>'App\Http\Controllers\JurnalAkunController@update'));
        Route::get('/Rekap-Jurnal-Akuntansi','App\Http\Controllers\JurnalAkunController@listrekapjurnal');
        Route::post('/Rekap-Jurnal-Akuntansi/cetak',array('as'=>'cetakrekapjurnal','uses'=>'App\Http\Controllers\JurnalAkunController@cetakrekapjurnal'));
        Route::get('/Import-Jurnal-Akuntansi','App\Http\Controllers\JurnalAkunController@listimportjurnal');
        Route::post('/Import-Jurnal-Akuntansi/cetak',array('as'=>'importjurnal','uses'=>'App\Http\Controllers\JurnalAkunController@importjurnal'));
        Route::put('/Jurnal-Akuntansi/Batal/{id}',array('as'=>'destroy','uses'=>'JurnalAkunController@destroy'));

        Route::get('/penagihan-makassar','App\Http\Controllers\PembayaranController@pendapatanmks');
        Route::get('/penagihan-makassar/selesai/{no_kwitansi}', array('as'=>'sudahbayarmks','uses'=>'App\Http\Controllers\PembayaranController@sudahbayarmks'));
        
    });

    Route::group(['middleware'=>['App\Http\Middleware\checkmenu14']],function(){
        Route::get('/list-piutang','App\Http\Controllers\PiutangController@index');
        Route::post('/piutang/no_resi','App\Http\Controllers\PiutangController@create');
        Route::post('/piutang/no-resi/tambah-data','App\Http\Controllers\PiutangController@store');
        Route::post('/piutang/bayar','App\Http\Controllers\PiutangController@inputpiutang');
        Route::post('/piutang/bayar/simpan','App\Http\Controllers\PiutangController@simpanpiutang');
        Route::get('/lihat-rekapan-drg','App\Http\Controllers\RekapanDrgController@index');
        Route::post('lihat-rekap-drg/cetak','App\Http\Controllers\RekapanDrgController@show');
        Route::get('/monitoring-laporan-piutang','App\Http\Controllers\PiutangController@monpiutang');
        Route::post('/monitoring-laporan-piutang/cetak',array('as'=>'cetakpiutang','uses'=>'App\Http\Controllers\PiutangController@cetakpiutang'));
    });

    
        Route::get('export', 'App\Http\Controllers\TestController@export')->name('export');
        Route::get('importExportView', 'App\Http\Controllers\TestController@importExportView');
        Route::post('import', 'App\Http\Controllers\TestController@import')->name('import');


        Route::get('/daftar-trans-pembelian','App\Http\Controllers\LaporanJualBeliController@index');
        Route::post('/daftar-trans-pembelian/cetak',array('as'=>'create','uses'=>'App\Http\Controllers\LaporanJualBeliController@create'));
        Route::get('/daftar-trans-jual-bebas','App\Http\Controllers\LaporanJualBeliController@show');
        Route::post('/daftar-trans-jual-bebas/cetak',array('as'=>'edit','uses'=>'App\Http\Controllers\LaporanJualBeliController@edit'));
        Route::get('/daftar-trans-jual-resep','App\Http\Controllers\LaporanJualBeliController@jualresep');
        Route::post('/daftar-trans-jual-resep/cetak',array('as'=>'cetakjualresep','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetakjualresep'));
        Route::get('/daftar-retur-jual-bebas','App\Http\Controllers\LaporanJualBeliController@returbebas');
        Route::post('/daftar-retur-jual-bebas/cetak',array('as'=>'cetakreturbebas','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetakreturbebas'));
        Route::get('/daftar-laporan-pasien','App\Http\Controllers\LaporanJualBeliController@daftarpasien');
        Route::post('/daftar-laporan-pasien/cetak',array('as'=>'cetakdaftarpasien','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetakdaftarpasien'));
        Route::get('/laporan-pasien-untuk-dokter','App\Http\Controllers\LaporanJualBeliController@laporanbiayauntukdokter');
        Route::post('/laporan-pasien-untuk-dokter/cetak',array('as'=>'cetaklaporanbiayauntukdokter','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetaklaporanbiayauntukdokter'));
        Route::get('/daftar-tindakan-medis-tunai','App\Http\Controllers\LaporanJualBeliController@daftartindakanmedistunai');
        Route::post('/daftar-tindakan-medis-tunai/cetak',array('as'=>'cetaktindakanmedistunai','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetaktindakanmedistunai'));
        Route::get('/daftar-tindakan-medis-kredit','App\Http\Controllers\LaporanJualBeliController@daftartindakanmediskredit');
        Route::post('/daftar-tindakan-medis-kredit/cetak',array('as'=>'cetaktindakanmediskredit','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetaktindakanmediskredit'));
        Route::get('/daftar-pembelian-dibatalkan','App\Http\Controllers\LaporanJualBeliController@daftarbatalresep');
        Route::post('/daftar-pembelian-dibatalkan/cetak',array('as'=>'laporanbatalbeli','uses'=>'App\Http\Controllers\LaporanJualBeliController@laporanbatalbeli'));
        Route::get('/daftar-pengiriman-obat','App\Http\Controllers\LaporanJualBeliController@laporanpindahapotik');
        Route::post('/daftar-pengiriman-obat/cetak',array('as'=>'cetakpindahapotik','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetakpindahapotik'));
        Route::get('/daftar-batal-pesan-terima-obat','App\Http\Controllers\LaporanJualBeliController@daftarbtalpesanterima');
        Route::post('/daftar-batal-pesan-terima-obat/cetak',array('as'=>'cetakbatalpesanterima','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetakbatalpesanterima'));
        Route::get('/daftar-batal-kirim-obat','App\Http\Controllers\LaporanJualBeliController@daftarbatalpindah');
        Route::post('/daftar-batal-kirim-obat/cetak',array('as'=>'cetakbatalpindah','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetakbatalpindah'));
        Route::get('/daftar-layanan-farmasi','App\Http\Controllers\LaporanJualBeliController@layananfarmasi');
        Route::post('/daftar-layanan-farmasi/cetak',array('as'=>'cetaklayananfarmasi','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetaklayananfarmasi'));
        Route::get('/monitoring-beda-harga_jual-beli','App\Http\Controllers\MonitoringController@bedajualbeli');
        Route::post('/monitoring-beda-harga_jual-beli/cetak',array('as','cetakbedajualbeli','uses'=>'App\Http\Controllers\MonitoringController@cetakbedajualbeli'));
        Route::get('/monitoring-koreksi-gudang','App\Http\Controllers\MonitoringController@monkoreksigudang');
        Route::post('/monitoring-koreksi-gudang/cetak',array('as'=>'cetakkoreksigudang','uses'=>'App\Http\Controllers\MonitoringController@cetakkoreksigudang'));
        Route::get('/monitoring-transaksi-obat','App\Http\Controllers\MonitoringController@montransaksiobat');
        Route::post('/monitoring-transaksi-obat/cetak',array('as'=>'cetaktransaksiobat','uses'=>'App\Http\Controllers\MonitoringController@cetaktransaksiobat'));
        Route::get('/daftar-pembelian-telah-dibayar','App\Http\Controllers\LaporanJualBeliController@daftarpembeliandibayar');
        Route::post('/daftar-pembelian-telah-dibayar/cetak',array('as'=>'cetakpembeliandibayar','uses'=>'App\Http\Controllers\LaporanJualBeliController@cetakpembeliandibayar'));


        Route::get('/findkoefapo','Auth\RegisterController@findkoefapo');

        Route::get('/keterangan-piutang','App\Http\Controllers\KeteranganPiutangController@index');
        Route::get('/keterangan-piutang/tambah','App\Http\Controllers\KeteranganPiutangController@create');
        Route::post('/keterangan-piutang/tambah/simpan',array('as'=>'store','uses'=>'App\Http\Controllers\KeteranganPiutangController@store'));
        Route::get('/keterangan-piutang/koreksi/{id}','App\Http\Controllers\KeteranganPiutangController@edit');
        Route::put('/keterangan-piutang/koreksi/update/{id}',array('as'=>'update','uses'=>'App\Http\Controllers\KeteranganPiutangController@update'));
        Route::delete('/keterangan-piutang/hapus/{id}','App\Http\Controllers\KeteranganPiutangController@destroy');

        Route::get('/monitoring-stock-apotik','App\Http\Controllers\MonitoringController@stockapotik');
        Route::post('/monitoring-stock-apotik/cetak',array('as'=>'cetakstockapotik','uses'=>'App\Http\Controllers\MonitoringController@cetakstockapotik'));
        Route::get('/monitoring-penjualan-per-item','App\Http\Controllers\MonitoringController@penjualanperitem');
        Route::post('/monitoring-penjualan-per-item/cetak',array('as'=>'cetakpenjualanperitem','uses'=>'App\Http\Controllers\MonitoringController@cetakpenjualanperitem'));

        Route::get('/change-jth_tempo','App\Http\Controllers\PembayaranController@changejthtempo');

        Route::get('/list-cetak-rapid/cetak/{id_riwayat_tindakan}','App\Http\Controllers\KlinikController@cetaklaprapit');

        Route::get('/tindakan-dokter-gigi','App\Http\Controllers\KlinikController@list_tindakandrg');

        Route::get('qr-code-g/{id_riwayat_tindakan}', 'App\Http\Controllers\KlinikController@cetakqrcode');
   
});

Route::get('testpage', function(){
    return view('test');;
});


Route::get('invoice2', function(){
    return view('invoice2');
});
Route::get('uang',function(){
    echo ucwords(terbilang(12512930));
});

Route::get('/test', 'App\Http\Controllers\TestController@index'); // localhost:8000/
Route::post('/uploadFile', 'App\Http\Controllers\TestController@uploadFile');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
