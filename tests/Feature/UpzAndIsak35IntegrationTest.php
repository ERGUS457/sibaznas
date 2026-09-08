<?php

namespace Tests\Feature;

use App\Models\Accounting\Account;
use App\Models\Upz\Muzakki;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Services\Accounting\Isak35ReportService;
use App\Services\Upz\ZisCollectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class UpzAndIsak35IntegrationTest extends TestCase
{
    public function test_dashboard_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SIM-UPZ BAZNAS');
        $response->assertSee('DE ISAK 35 FORMAT A');
        $response->assertSee('Total Pengumpulan ZIS');
    }

    public function test_collections_index_and_bsz_display(): void
    {
        $response = $this->get(route('collections.index'));
        $response->assertStatus(200);
        $response->assertSee('Penerimaan ZIS & DSKL');

        $collection = ZisCollection::first();
        if ($collection) {
            $showResponse = $this->get(route('collections.show', $collection->id));
            $showResponse->assertStatus(200);
            $showResponse->assertSee($collection->bsz_number);

            $printResponse = $this->get(route('collections.print-bsz', $collection->id));
            $printResponse->assertStatus(200);
            $printResponse->assertSee('BUKTI SETOR ZAKAT (BSZ)');
        }
    }

    public function test_distributions_and_remittances_pages(): void
    {
        $distResponse = $this->get(route('distributions.index'));
        $distResponse->assertStatus(200);
        $distResponse->assertSee('Penyaluran ZIS (Mustahiq 8 Asnaf)');

        $remitResponse = $this->get(route('remittances.index'));
        $remitResponse->assertStatus(200);
        $remitResponse->assertSee('Setoran Hasil Pengumpulan ke BAZNAS');
    }

    public function test_accounting_journals_and_ledger(): void
    {
        $journalResponse = $this->get(route('journals.index'));
        $journalResponse->assertStatus(200);
        $journalResponse->assertSee('Jurnal Umum (General Journal)');

        $trialBalanceResponse = $this->get(route('journals.trial-balance'));
        $trialBalanceResponse->assertStatus(200);
        $trialBalanceResponse->assertSee('Neraca Saldo (Trial Balance)');
    }

    public function test_de_isak35_financial_reports(): void
    {
        // 1. Posisi Keuangan (Neraca)
        $fpResponse = $this->get(route('reports.financial-position'));
        $fpResponse->assertStatus(200);
        $fpResponse->assertSee('LAPORAN POSISI KEUANGAN');
        $fpResponse->assertSee('Tanpa Pembatasan dari Pemberi Sumber Daya');
        $fpResponse->assertSee('Dengan Pembatasan dari Pemberi Sumber Daya');

        // 2. Penghasilan Komprehensif
        $ciResponse = $this->get(route('reports.comprehensive-income'));
        $ciResponse->assertStatus(200);
        $ciResponse->assertSee('LAPORAN PENGHASILAN KOMPREHENSIF');

        // 3. Perubahan Aset Bersih
        $naResponse = $this->get(route('reports.net-assets'));
        $naResponse->assertStatus(200);
        $naResponse->assertSee('LAPORAN PERUBAHAN ASET BERSIH');

        // 4. Arus Kas
        $cfResponse = $this->get(route('reports.cash-flow'));
        $cfResponse->assertStatus(200);
        $cfResponse->assertSee('LAPORAN ARUS KAS');

        // 5. Kepatuhan Perbaznas No. 2/2016
        $compResponse = $this->get(route('reports.perbaznas-compliance'));
        $compResponse->assertStatus(200);
        $compResponse->assertSee('LAPORAN PERTANGGUNGJAWABAN DAN TATA KERJA UPZ');
    }

    public function test_isak35_statement_of_financial_position_is_balanced(): void
    {
        $service = app(Isak35ReportService::class);
        $statement = $service->getStatementOfFinancialPosition();

        $this->assertTrue($statement['is_balanced'], 'Laporan Posisi Keuangan harus seimbang (Total Aset = Total Liabilitas + Aset Bersih)');
        $this->assertEquals(
            round($statement['total_assets'], 2),
            round($statement['total_liabilities_and_net_assets'], 2)
        );
    }

    public function test_perbaznas_amil_share_cannot_exceed_maximum_limit(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Hak amil untuk dana zakat tidak boleh melebihi 12.50%');

        $upz = UpzProfile::first();
        $muzakki = Muzakki::first();
        $service = app(ZisCollectionService::class);

        // Attempt to record collection with 15% amil (exceeds 12.5% max)
        $service->recordCollection([
            'upz_profile_id' => $upz->id,
            'muzakki_id' => $muzakki->id,
            'fund_type' => 'zakat_maal',
            'amount' => 1000000,
            'amil_percentage' => 15.00,
        ]);
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('SIM-UPZ BAZNAS');
        $response->assertSee('Kredensial Login Default');
        $response->assertSee('admin');
        $response->assertSee('admin123');
    }

    public function test_admin_can_login_with_provided_credentials(): void
    {
        $response = $this->post(route('login.submit'), [
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('portal'));
        $this->assertAuthenticated();
    }

    public function test_portal_and_modular_dashboards_render_successfully(): void
    {
        // 1. Portal Workspace Selector
        $portalResponse = $this->get(route('portal'));
        $portalResponse->assertStatus(200);
        $portalResponse->assertSee('Pilih Ruang Kerja Aplikasi');
        $portalResponse->assertSee('Akuntansi Keuangan Organisasi (DE ISAK 35)');
        $portalResponse->assertSee('Pengelolaan &amp; Pelaporan Zakat (BAZNAS RI)', false);

        // 2. ISAK 35 Organizational Accounting Dashboard
        $isakResponse = $this->get(route('dashboard.isak35'));
        $isakResponse->assertStatus(200);
        $isakResponse->assertSee('Pembukuan &amp; Laporan Keuangan DE ISAK 35', false);
        $isakResponse->assertSee('Total Aset');

        // 3. BAZNAS Zakat Operations Dashboard
        $baznasResponse = $this->get(route('dashboard.baznas'));
        $baznasResponse->assertStatus(200);
        $baznasResponse->assertSee('Pengelolaan &amp; Pelaporan Zakat UPZ', false);
        $baznasResponse->assertSee('Total ZIS Dihimpun');
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        $response = $this->post(route('login.submit'), [
            'username' => 'admin',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    public function test_perbaznas_official_lampiran_reports_render_successfully(): void
    {
        // Lampiran I: Rencana Penerimaan
        $r1 = $this->get(route('reports.perbaznas.lampiran1'));
        $r1->assertStatus(200);
        $r1->assertSee('LAMPIRAN I');
        $r1->assertSee('RENCANA PENERIMAAN');

        // Lampiran II: Asnaf
        $r2 = $this->get(route('reports.perbaznas.lampiran2'));
        $r2->assertStatus(200);
        $r2->assertSee('LAMPIRAN II');
        $r2->assertSee('RENCANA PENDISTRIBUSIAN DAN PENDAYAGUNAAN BERDASARKAN ASNAF');

        // Lampiran III: Program
        $r3 = $this->get(route('reports.perbaznas.lampiran3'));
        $r3->assertStatus(200);
        $r3->assertSee('LAMPIRAN III');
        $r3->assertSee('RENCANA PENDISTRIBUSIAN DAN PENDAYAGUNAAN BERDASARKAN PROGRAM');

        // Lampiran V: Dana Operasional
        $r5 = $this->get(route('reports.perbaznas.lampiran5'));
        $r5->assertStatus(200);
        $r5->assertSee('LAMPIRAN V');
        $r5->assertSee('RENCANA PENERIMAAN DAN PENGGUNAAN DANA OPERASIONAL');

        // Lampiran VII: Penyaluran Dana
        $r7 = $this->get(route('reports.perbaznas.lampiran7'));
        $r7->assertStatus(200);
        $r7->assertSee('LAMPIRAN VII');
        $r7->assertSee('LAPORAN PENDISTRIBUSIAN DAN PENDAYAGUNAAN DANA');

        // Bukti Setor Zakat (BSZ) Print Sheet
        $col = ZisCollection::first();
        if ($col) {
            $rBsz = $this->get(route('collections.print-bsz', $col->id));
            $rBsz->assertStatus(200);
            $rBsz->assertSee('BUKTI SETOR ZAKAT (BSZ)');
        }
    }

    public function test_multi_organization_registration_and_switching(): void
    {
        // 1. Check organizations index page
        $indexResp = $this->get(route('organizations.index'));
        $indexResp->assertStatus(200);
        $indexResp->assertSee('Entitas Organisasi');

        // 2. Check create page
        $createResp = $this->get(route('organizations.create'));
        $createResp->assertStatus(200);
        $createResp->assertSee('Pendaftaran Organisasi');

        // 3. Register a new organization
        $uniqueCode = 'UPZ-TEST-' . time();
        $storeResp = $this->post(route('organizations.store'), [
            'name' => 'Yayasan Generasi Gemilang',
            'code' => $uniqueCode,
            'institution_type' => 'yayasan',
            'parent_baznas_level' => 'kab_kota',
            'parent_baznas_name' => 'BAZNAS Kota Surabaya',
            'sk_number' => 'SK/2026/YGG/001',
            'chairman_name' => 'Dr. H. Ahmad Santoso',
            'bank_name' => 'Bank Syariah Indonesia',
            'bank_account_number' => '7890123456',
            'bank_account_name' => 'YAYASAN GENERASI GEMILANG',
            'amil_share_percentage' => 12.50,
        ]);

        $storeResp->assertRedirect(route('portal'));

        // Verify organization created
        $newOrg = UpzProfile::where('code', $uniqueCode)->first();
        $this->assertNotNull($newOrg);
        $this->assertEquals('Yayasan Generasi Gemilang', $newOrg->name);

        // Verify session active org switched
        $this->assertEquals($newOrg->id, session('active_upz_id'));

        // Verify it starts completely clean (0 transactions)
        $orgContext = app(\App\Services\OrganizationContextService::class);
        $stats = $orgContext->getStatistics($newOrg->id);
        $this->assertEquals(0, $stats['total_zis_collected']);
        $this->assertEquals(0, $stats['total_distributed']);
        $this->assertEquals(0, $stats['journal_entries_count']);
        $this->assertEquals(0, $stats['muzakki_count']);
        $this->assertEquals(0, $stats['mustahiq_count']);

        // 4. Test switching back to demo organization (ID 1)
        $switchResp = $this->from(route('portal'))->post(route('organizations.switch', 1));
        $switchResp->assertStatus(302);
        $this->assertEquals(1, session('active_upz_id'));

        // Clean up test organization
        $newOrg->delete();
    }
}
