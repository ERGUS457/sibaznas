<?php

use App\Http\Controllers\Accounting\JournalController;
use App\Http\Controllers\Accounting\ReportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Upz\BaznasRemittanceController;
use App\Http\Controllers\Upz\MustahiqController;
use App\Http\Controllers\Upz\MuzakkiController;
use App\Http\Controllers\Upz\ZisCollectionController;
use App\Http\Controllers\Upz\ZisDistributionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Integrated UPZ BAZNAS & DE ISAK 35 Format A System
|--------------------------------------------------------------------------
*/

// Public Landing Page (Modul Penggunaan & Statistik Live)
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('logout', [AuthController::class, 'logout']);

// Main Dashboard Panel
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// UPZ Module 1: ZIS & DSKL Collections (Penerimaan & BSZ)
Route::resource('collections', ZisCollectionController::class)->only(['index', 'create', 'store', 'show']);
Route::get('collections/{collection}/print-bsz', [ZisCollectionController::class, 'printBsz'])->name('collections.print-bsz');

// UPZ Module 1: ZIS Distributions (Penyaluran Mustahiq 8 Asnaf)
Route::resource('distributions', ZisDistributionController::class)->only(['index', 'create', 'store']);

// UPZ Module 1: BAZNAS Remittances (Penyetoran ke Rekening BAZNAS)
Route::resource('remittances', BaznasRemittanceController::class)->only(['index', 'create', 'store']);

// UPZ Module 1: Master Data (Muzakki & Mustahiq)
Route::resource('muzakkis', MuzakkiController::class)->only(['index', 'create', 'store']);
Route::resource('mustahiqs', MustahiqController::class)->only(['index', 'create', 'store']);

// Module 2: Accounting & General Ledger
Route::get('journals', [JournalController::class, 'index'])->name('journals.index');
Route::get('journals/ledger', [JournalController::class, 'ledger'])->name('journals.ledger');
Route::get('journals/trial-balance', [JournalController::class, 'trialBalance'])->name('journals.trial-balance');

// Module 2: Financial Reports (DE ISAK 35 Format A & Perbaznas No. 2/2016)
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('financial-position', [ReportController::class, 'financialPosition'])->name('financial-position');
    Route::get('comprehensive-income', [ReportController::class, 'comprehensiveIncome'])->name('comprehensive-income');
    Route::get('net-assets', [ReportController::class, 'netAssets'])->name('net-assets');
    Route::get('cash-flow', [ReportController::class, 'cashFlow'])->name('cash-flow');
    Route::get('perbaznas-compliance', [ReportController::class, 'perbaznasCompliance'])->name('perbaznas-compliance');
    Route::get('perbaznas/lampiran-1', [ReportController::class, 'perbaznasLampiran1'])->name('perbaznas.lampiran1');
    Route::get('perbaznas/lampiran-2', [ReportController::class, 'perbaznasLampiran2'])->name('perbaznas.lampiran2');
    Route::get('perbaznas/lampiran-3', [ReportController::class, 'perbaznasLampiran3'])->name('perbaznas.lampiran3');
    Route::get('perbaznas/lampiran-5', [ReportController::class, 'perbaznasLampiran5'])->name('perbaznas.lampiran5');
    Route::get('perbaznas/lampiran-7', [ReportController::class, 'perbaznasLampiran7'])->name('perbaznas.lampiran7');
});
