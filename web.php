<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PermohonanMangroveController;
use App\Http\Controllers\PermohonanKarangController;
use App\Http\Controllers\FishshelterController;
use App\Http\Controllers\RehabilitasiKarangController;
use App\Http\Controllers\RehabilitasiMangroveController;
use App\Http\Controllers\FishFarmingLocationController;
use App\Http\Controllers\CoralReefClosureController;
use App\Http\Controllers\SeagrassEcosystemController;
use App\Http\Controllers\AbundanceReefFishController;
use App\Http\Controllers\MangroveEcosystemController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\SmartController;

use App\Http\Controllers\SailorAuthController;
use App\Http\Controllers\SailorDashboardController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\RegulationController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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

Route::get('/', [HomeController::class, "home"])->name('/');
Route::get('/tanyajawab', [HomeController::class, "tanyajawab"])->name('/tanyajawab');
Route::post('tanyajawab_store', [HomeController::class, "tanyajawab_store"])->name('tanyajawab_store');
Route::get('/kegiatan', [HomeController::class, "kegiatan"])->name('/kegiatan');
Route::get('/gallery', [HomeController::class, "gallery"])->name('/gallery');
Route::get('/report', [HomeController::class, "report"])->name('/report');
Route::get('/permohonan_mangrove', [HomeController::class, "permohonan_mangrove"])->name('/permohonan_mangrove');
Route::get('/permohonan_karang', [HomeController::class, "permohonan_karang"])->name('/permohonan_karang');
Route::get('/tracking', [HomeController::class, "tracking"])->name('/tracking');
Route::get('/ekosistem', [HomeController::class, "ekosistem"])->name('/ekosistem');
Route::get('/perikanan', [HomeController::class, "perikanan"])->name('/perikanan');
Route::get('/rehabilitasi', [HomeController::class, "rehabilitasi"])->name('/rehabilitasi');

Route::get('/webgis', [HomeController::class, "webgis"])->name('/webgis');
Route::get('/land/{id}', [HomeController::class, "land"])->name('/land');
Route::get('/test_chart', [HomeController::class, "test_chart"])->name('/test_chart');


Route::get('/carigaleri', [HomeController::class, "carigaleri"])->name('/carigaleri');
Route::get('/fullmap', [HomeController::class, "fullmap"])->name('/fullmap');
Route::get('/news', [HomeController::class, "news"])->name('/news');
Route::get('/wisata', [HomeController::class, "wisata"])->name('/wisata');
Route::get('/wisata_bahari', [HomeController::class, "wisata_bahari"])->name('/wisata_bahari');
Route::get('/wisata_bahari_deskripsi', [HomeController::class, "wisata_bahari_deskripsi"])->name('/wisata_bahari_deskripsi');
Route::get('/kontak', [HomeController::class, "kontak"])->name('/kontak');
Route::get('/sejarah', [HomeController::class, "sejarah"])->name('/sejarah');
Route::get('/dasar-dan-aturan', [HomeController::class, "dasardanaturan"])->name('/dasar-dan-aturan');
Route::get('/daftar-anggota', [HomeController::class, "daftaranggota"])->name('/daftar-anggota');
Route::get('/carianggota', [HomeController::class, "carianggota"])->name('/carianggota');
Route::get('/teknis', [HomeController::class, "teknis"])->name('/teknis');
Route::get('detail/{id}', [ HomeController::class, "detail" ])->name('detail');
Route::get('detail', [ HomeController::class, "detail" ])->name('detail');

Route::post('/kawasan_boleh', [HomeController::class, "kawasan_boleh"])->name('kawasan_boleh');
Route::post('/report_store', [HomeController::class, "report_store"])->name('report_store');
Route::post('/permohonan_mangrove_store', [HomeController::class, "permohonan_mangrove_store"])->name('permohonan_mangrove_store');
Route::post('/permohonan_karang_store', [HomeController::class, "permohonan_karang_store"])->name('permohonan_karang_store');
Route::post('/diagram_tutupan_terumbu_karang', [HomeController::class, "diagram_tutupan_terumbu_karang"])->name('diagram_tutupan_terumbu_karang');
Route::post('/diagram_ekosistem_padang_lamun', [HomeController::class, "diagram_ekosistem_padang_lamun"])->name('diagram_ekosistem_padang_lamun');
Route::post('/diagram_kelimpahan_ikan_terumbu', [HomeController::class, "diagram_kelimpahan_ikan_terumbu"])->name('diagram_kelimpahan_ikan_terumbu');
Route::post('/diagram_ekosistem_mangrove', [HomeController::class, "diagram_ekosistem_mangrove"])->name('diagram_ekosistem_mangrove');
Route::post('/tracking_report', [HomeController::class, "tracking_report"])->name('tracking_report');


Route::get('/generate-captcha', function () {
  $captcha = Str::random(6); // Generate teks captcha
  session(['captcha' => $captcha]);

  $image = imagecreate(150, 50);
  $background_color = imagecolorallocate($image, 255, 255, 255);
  $text_color = imagecolorallocate($image, 0, 0, 0);

  imagestring($image, 5, 10, 10, $captcha, $text_color);
  header("Content-type: image/png");
  imagepng($image);
  imagedestroy($image);
});

Route::group([ "middleware" => ['auth:sanctum', 'verified', 'role:admin'] ], function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');
    Route::get('/dashboard', [ DashboardController::class, "index" ])->name('dashboard');

    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/galleries', [ GalleryController::class, "index" ])->name('galleries');
    Route::get('/galleries/data', [ GalleryController::class, "galleries_json" ])->name('galleries.json');
    Route::post('/galleries/store', [ GalleryController::class, "store" ])->name('store.galleries.json');
    Route::delete('/galleries/delete/{id}', [ GalleryController::class, "destroy" ])->name('delete.galleries.json');
    Route::get('/galleries/edit/{id}/edit', [ GalleryController::class, "edit" ])->name('edit.galleries.json');
    Route::patch('/galleries/update/{id}', [GalleryController::class, 'update'])->name('update.galleries.json');



    Route::get('/reports', [ ReportController::class, "index" ])->name('reports');
    Route::get('/reports/exports', [ ReportController::class, "exports" ])->name('reports.exports');
    Route::get('/reports/detail/{id}', [ ReportController::class, "show" ])->name('reports.show');
    Route::get('/reports/data', [ ReportController::class, "reports_json" ])->name('reports.json');
    Route::post('/reports/update_status', [ ReportController::class, "update_status" ])->name('reports.update_status');
    Route::post('/reports/store', [ ReportController::class, "store" ])->name('store.reports.json');
    Route::delete('/reports/delete/{id}', [ ReportController::class, "destroy" ])->name('delete.reports.json');
    Route::get('/reports/edit/{id}/edit', [ ReportController::class, "edit" ])->name('edit.reports.json');
    Route::patch('/reports/update/{id}', [ ReportController::class, 'update' ])->name('update.reports.json');

    Route::get('/permohonan_mangroves', [ PermohonanMangroveController::class, "index" ])->name('permohonan_mangroves');
    Route::get('/permohonan_mangroves/exports', [ PermohonanMangroveController::class, "exports" ])->name('permohonan_mangroves.exports');
    Route::get('/permohonan_mangroves/detail/{id}', [ PermohonanMangroveController::class, "show" ])->name('permohonan_mangroves.show');
    Route::get('/permohonan_mangroves/data', [ PermohonanMangroveController::class, "permohonan_mangroves_json" ])->name('permohonan_mangroves.json');
    Route::post('/permohonan_mangroves/update_status', [ PermohonanMangroveController::class, "update_status" ])->name('permohonan_mangroves.update_status');
    Route::post('/permohonan_mangroves/store', [ PermohonanMangroveController::class, "store" ])->name('store.permohonan_mangroves.json');
    Route::delete('/permohonan_mangroves/delete/{id}', [ PermohonanMangroveController::class, "destroy" ])->name('delete.permohonan_mangroves.json');
    Route::get('/permohonan_mangroves/edit/{id}/edit', [ PermohonanMangroveController::class, "edit" ])->name('edit.permohonan_mangroves.json');
    Route::patch('/permohonan_mangroves/update/{id}', [ PermohonanMangroveController::class, 'update' ])->name('update.permohonan_mangroves.json');
     
    Route::get('/permohonan_karangs', [ PermohonanKarangController::class, "index" ])->name('permohonan_karangs');
    Route::get('/permohonan_karangs/exports', [ PermohonanKarangController::class, "exports" ])->name('permohonan_karangs.exports');
    Route::get('/permohonan_karangs/detail/{id}', [ PermohonanKarangController::class, "show" ])->name('permohonan_karangs.show');
    Route::get('/permohonan_karangs/data', [ PermohonanKarangController::class, "permohonan_karangs_json" ])->name('permohonan_karangs.json');
    Route::post('/permohonan_karangs/update_status', [ PermohonanKarangController::class, "update_status" ])->name('permohonan_karangs.update_status');
    Route::post('/permohonan_karangs/store', [ PermohonanKarangController::class, "store" ])->name('store.permohonan_karangs.json');
    Route::delete('/permohonan_karangs/delete/{id}', [ PermohonanKarangController::class, "destroy" ])->name('delete.permohonan_karangs.json');
    Route::get('/permohonan_karangs/edit/{id}/edit', [ PermohonanKarangController::class, "edit" ])->name('edit.permohonan_karangs.json');
    Route::patch('/permohonan_karangs/update/{id}', [ PermohonanKarangController::class, 'update' ])->name('update.permohonan_karangs.json');

    Route::get('/fishshelters', [ FishshelterController::class, "index" ])->name('fishshelters');
    Route::get('/fishshelters/exports', [ FishshelterController::class, "exports" ])->name('fishshelters.exports');
    Route::get('/fishshelters/data', [ FishshelterController::class, "fishshelters_json" ])->name('fishshelters.json');
    Route::post('/fishshelters/store', [ FishshelterController::class, "store" ])->name('store.fishshelters.json');
    Route::delete('/fishshelters/delete/{id}', [ FishshelterController::class, "destroy" ])->name('delete.fishshelters.json');
    Route::get('/fishshelters/edit/{id}/edit', [ FishshelterController::class, "edit" ])->name('edit.fishshelters.json');
    Route::patch('/fishshelters/update/{id}', [ FishshelterController::class, 'update' ])->name('update.fishshelters.json');

    Route::get('/rehabilitasi_karangs', [ RehabilitasiKarangController::class, "index" ])->name('rehabilitasi_karangs');
    Route::get('/rehabilitasi_karangs/detail/{id}', [ RehabilitasiKarangController::class, "show" ])->name('rehabilitasi_karangs.show');
    Route::get('/rehabilitasi_karangs/exports', [ RehabilitasiKarangController::class, "exports" ])->name('rehabilitasi_karangs.exports');
    Route::get('/rehabilitasi_karangs/data', [ RehabilitasiKarangController::class, "rehabilitasi_karangs_json" ])->name('rehabilitasi_karangs.json');
    Route::post('/rehabilitasi_karangs/store', [ RehabilitasiKarangController::class, "store" ])->name('store.rehabilitasi_karangs.json');
    Route::delete('/rehabilitasi_karangs/delete/{id}', [ RehabilitasiKarangController::class, "destroy" ])->name('delete.rehabilitasi_karangs.json');
    Route::get('/rehabilitasi_karangs/edit/{id}/edit', [ RehabilitasiKarangController::class, "edit" ])->name('edit.rehabilitasi_karangs.json');
    Route::get('/rehabilitasi_karangs/rehabilitasi_karang_updates/{id}/edit', [ RehabilitasiKarangController::class, "rehabilitasi_karang_update" ])->name('edit.rehabilitasi_karang_updates.json');
    Route::patch('/rehabilitasi_karangs/update/{id}', [ RehabilitasiKarangController::class, 'update' ])->name('update.rehabilitasi_karangs.json');
    Route::post('/rehabilitasi_karangs/add_perkembangan', [ RehabilitasiKarangController::class, "add_perkembangan" ])->name('rehabilitasi_karangs.add_perkembangan');
    Route::post('/rehabilitasi_karangs/edit_perkembangan', [ RehabilitasiKarangController::class, "edit_perkembangan" ])->name('rehabilitasi_karangs.edit_perkembangan');
    Route::post('/rehabilitasi_karangs/delete_perkembangan', [ RehabilitasiKarangController::class, "delete_perkembangan" ])->name('rehabilitasi_karangs.delete_perkembangan');


    Route::get('/rehabilitasi_mangroves', [ RehabilitasiMangroveController::class, "index" ])->name('rehabilitasi_mangroves');
    Route::get('/rehabilitasi_mangroves/detail/{id}', [ RehabilitasiMangroveController::class, "show" ])->name('rehabilitasi_mangroves.show');
    Route::get('/rehabilitasi_mangroves/exports', [ RehabilitasiMangroveController::class, "exports" ])->name('rehabilitasi_mangroves.exports');
    Route::get('/rehabilitasi_mangroves/data', [ RehabilitasiMangroveController::class, "rehabilitasi_mangroves_json" ])->name('rehabilitasi_mangroves.json');
    Route::post('/rehabilitasi_mangroves/store', [ RehabilitasiMangroveController::class, "store" ])->name('store.rehabilitasi_mangroves.json');
    Route::delete('/rehabilitasi_mangroves/delete/{id}', [ RehabilitasiMangroveController::class, "destroy" ])->name('delete.rehabilitasi_mangroves.json');
    Route::get('/rehabilitasi_mangroves/edit/{id}/edit', [ RehabilitasiMangroveController::class, "edit" ])->name('edit.rehabilitasi_mangroves.json');
    Route::get('/rehabilitasi_mangroves/rehabilitasi_mangrove_updates/{id}/edit', [ RehabilitasiMangroveController::class, "rehabilitasi_mangrove_update" ])->name('edit.rehabilitasi_mangrove_updates.json');
    Route::patch('/rehabilitasi_mangroves/update/{id}', [ RehabilitasiMangroveController::class, 'update' ])->name('update.rehabilitasi_mangroves.json');
    Route::post('/rehabilitasi_mangroves/add_perkembangan', [ RehabilitasiMangroveController::class, "add_perkembangan" ])->name('rehabilitasi_mangroves.add_perkembangan');
    Route::post('/rehabilitasi_mangroves/edit_perkembangan', [ RehabilitasiMangroveController::class, "edit_perkembangan" ])->name('rehabilitasi_mangroves.edit_perkembangan');
    Route::post('/rehabilitasi_mangroves/delete_perkembangan', [ RehabilitasiMangroveController::class, "delete_perkembangan" ])->name('rehabilitasi_mangroves.delete_perkembangan');



    Route::get('/fish_farming_locations', [ FishFarmingLocationController::class, "index" ])->name('fish_farming_locations');
    Route::get('/fish_farming_locations/exports', [ FishFarmingLocationController::class, "exports" ])->name('fish_farming_locations.exports');

    Route::get('/fish_farming_locations/data', [ FishFarmingLocationController::class, "fish_farming_locations_json" ])->name('fish_farming_locations.json');
    Route::post('/fish_farming_locations/store', [ FishFarmingLocationController::class, "store" ])->name('store.fish_farming_locations.json');
    Route::delete('/fish_farming_locations/delete/{id}', [ FishFarmingLocationController::class, "destroy" ])->name('delete.fish_farming_locations.json');
    Route::get('/fish_farming_locations/edit/{id}/edit', [ FishFarmingLocationController::class, "edit" ])->name('edit.fish_farming_locations.json');
    Route::patch('/fish_farming_locations/update/{id}', [ FishFarmingLocationController::class, 'update' ])->name('update.fish_farming_locations.json');




    Route::get('/lands', [ LandController::class, "index" ])->name('lands');
    Route::get('/lands/exports', [ LandController::class, "exports" ])->name('lands.exports');
    Route::get('/lands/data', [ LandController::class, "lands_json" ])->name('lands.json');
    Route::post('/lands/store', [ LandController::class, "store" ])->name('store.lands.json');
    Route::delete('/lands/delete/{id}', [ LandController::class, "destroy" ])->name('delete.lands.json');
    Route::get('/lands/edit/{id}/edit', [ LandController::class, "edit" ])->name('edit.lands.json');
    Route::patch('/lands/update/{id}', [ LandController::class, 'update' ])->name('update.lands.json');



    Route::get('/coral_reef_closures', [ CoralReefClosureController::class, "index" ])->name('coral_reef_closures');
    Route::get('/coral_reef_closures/exports', [ CoralReefClosureController::class, "exports" ])->name('coral_reef_closures.exports');
    Route::get('/coral_reef_closures/create', [ CoralReefClosureController::class, "create" ])->name('coral_reef_closures.create');
    Route::get('/coral_reef_closures/data', [ CoralReefClosureController::class, "coral_reef_closures_json" ])->name('coral_reef_closures.json');
    Route::post('/coral_reef_closures/store', [ CoralReefClosureController::class, "store" ])->name('store.coral_reef_closures.json');
    Route::delete('/coral_reef_closures/delete/{id}', [ CoralReefClosureController::class, "destroy" ])->name('delete.coral_reef_closures.json');
    Route::get('/coral_reef_closures/edit/{id}/edit', [ CoralReefClosureController::class, "edit" ])->name('edit.coral_reef_closures.json');
    Route::patch('/coral_reef_closures/update/{id}', [ CoralReefClosureController::class, 'update' ])->name('update.coral_reef_closures.json');
      

    Route::get('/seagrass_ecosystems', [ SeagrassEcosystemController::class, "index" ])->name('seagrass_ecosystems');
    Route::get('/seagrass_ecosystems/exports', [ SeagrassEcosystemController::class, "exports" ])->name('seagrass_ecosystems.exports');
    Route::get('/seagrass_ecosystems/data', [ SeagrassEcosystemController::class, "seagrass_ecosystems_json" ])->name('seagrass_ecosystems.json');
    Route::post('/seagrass_ecosystems/store', [ SeagrassEcosystemController::class, "store" ])->name('store.seagrass_ecosystems.json');
    Route::delete('/seagrass_ecosystems/delete/{id}', [ SeagrassEcosystemController::class, "destroy" ])->name('delete.seagrass_ecosystems.json');
    Route::get('/seagrass_ecosystems/edit/{id}/edit', [ SeagrassEcosystemController::class, "edit" ])->name('edit.seagrass_ecosystems.json');
    Route::patch('/seagrass_ecosystems/update/{id}', [ SeagrassEcosystemController::class, 'update' ])->name('update.seagrass_ecosystems.json');

    Route::get('/abundance_reef_fishs', [ AbundanceReefFishController::class, "index" ])->name('abundance_reef_fishs');
    Route::get('/abundance_reef_fishs/exports', [ AbundanceReefFishController::class, "exports" ])->name('abundance_reef_fishs.exports');
    Route::get('/abundance_reef_fishs/data', [ AbundanceReefFishController::class, "abundance_reef_fishs_json" ])->name('abundance_reef_fishs.json');
    Route::post('/abundance_reef_fishs/store', [ AbundanceReefFishController::class, "store" ])->name('store.abundance_reef_fishs.json');
    Route::delete('/abundance_reef_fishs/delete/{id}', [ AbundanceReefFishController::class, "destroy" ])->name('delete.abundance_reef_fishs.json');
    Route::get('/abundance_reef_fishs/edit/{id}/edit', [ AbundanceReefFishController::class, "edit" ])->name('edit.abundance_reef_fishs.json');
    Route::patch('/abundance_reef_fishs/update/{id}', [ AbundanceReefFishController::class, 'update' ])->name('update.abundance_reef_fishs.json');

    Route::get('/mangrove_ecosystems', [ MangroveEcosystemController::class, "index" ])->name('mangrove_ecosystems');
    Route::get('/mangrove_ecosystems/exports', [ MangroveEcosystemController::class, "exports" ])->name('mangrove_ecosystems.exports');
    Route::get('/mangrove_ecosystems/data', [ MangroveEcosystemController::class, "mangrove_ecosystems_json" ])->name('mangrove_ecosystems.json');
    Route::post('/mangrove_ecosystems/store', [ MangroveEcosystemController::class, "store" ])->name('store.mangrove_ecosystems.json');
    Route::delete('/mangrove_ecosystems/delete/{id}', [ MangroveEcosystemController::class, "destroy" ])->name('delete.mangrove_ecosystems.json');
    Route::get('/mangrove_ecosystems/edit/{id}/edit', [ MangroveEcosystemController::class, "edit" ])->name('edit.mangrove_ecosystems.json');
    Route::patch('/mangrove_ecosystems/update/{id}', [ MangroveEcosystemController::class, 'update' ])->name('update.mangrove_ecosystems.json');
      



    //News
      Route::get('/homenews', [ NewsController::class, "index" ])->name('homenews');
      Route::get('/news/data', [ NewsController::class, "news_json" ])->name('news.json');
      Route::post('/news/store', [ NewsController::class, "store" ])->name('store.news.json');
      Route::delete('/news/delete/{id}', [ NewsController::class, "destroy" ])->name('delete.news.json');
      Route::get('/news/edit/{id}/edit', [ NewsController::class, "edit" ])->name('edit.news.json');
      Route::patch('/news/update/{id}', [NewsController::class, 'update'])->name('update.news.json');

    //Visi & Misi
      Route::get('/visimisi', [ VisiMisiController::class, "index" ])->name('visimisi');
      Route::patch('visimisiupdate', [ VisiMisiController::class, "update" ])->name('visimisiupdate');

      //Pertanyaan
      Route::delete('/question/delete/{id}', [ ContactController::class, "destroy" ])->name('delete.news.json');
      //Sudah
      Route::get('/answer', [ ContactController::class, "index_answer" ])->name('answer');
      Route::get('/answer/data', [ ContactController::class, "answer_json" ])->name('answer.json');

      //Detail Sudah Di Jawab
      Route::get('/detail-answer/{id}', [ContactController::class, 'show_answer'])->name('detail-answer');

      //Belum
      Route::get('/un-answer', [ ContactController::class, "index_un_answer" ])->name('un-answer');
      Route::get('/un-answer/data', [ ContactController::class, "un_answer_json" ])->name('un-answer.json');

      //Detail Belum DI Jawab
      Route::get('/detail-un-answer/{id}', [ContactController::class, 'show_un_answer'])->name('detail-un-answer');
      Route::patch('contactupdate/{id}', [ContactController::class, 'update'])->name('contactupdate');

      //Member
      Route::get('/member', [ MemberController::class, "index" ])->name('member');
      Route::get('/member/data', [ MemberController::class, "member_json" ])->name('member.json');
      Route::post('/member/store', [ MemberController::class, "store" ])->name('store.member.json');
      Route::get('/member/edit/{id}/edit', [ MemberController::class, "edit" ])->name('edit.member.json');
      Route::patch('/member/update/{id}', [MemberController::class, 'update'])->name('update.member.json');
      Route::delete('/member/delete/{id}', [ MemberController::class, "destroy" ])->name('delete.member.json');
});

Route::get('/smart-pelaut', [SmartController::class, 'index'])->name('smart.pelaut');
Route::get('/documents/compliance/{filename}', [ComplianceController::class, 'document'])->name('documents.compliance');
Route::get('/documents/regulation/{filename}', [RegulationController::class, 'document'])->name('documents.regulation');
Route::get('/login-smart-pelaut', [SailorAuthController::class, 'index'])->name('sailor.login');
Route::post('/login-smart-pelaut', [SailorAuthController::class, 'doLogin']);

Route::group([ "middleware" => ['auth:sanctum', 'verified', 'role:admin,sailor'], 'prefix' => 'pelaut' ], function() {
  Route::get('/dashboard', [ SailorDashboardController::class, 'index'])->name('sailor.dashboard');
  Route::resource('compliance', ComplianceController::class);
  Route::resource('regulation', RegulationController::class);  
});

Route::group(['prefix' => 'pelaut/home'], function(){
    Route::get('/dashboard', [SailorDashboardController::class, 'homeIndex'])->name('sailor.home.dashboard');
    Route::get('/compliance', [ComplianceController::class, 'homeIndex'])->name('sailor.home.compliance');
    Route::get('/regulation', [RegulationController::class, 'homeIndex'])->name('sailor.home.regulation');
});

