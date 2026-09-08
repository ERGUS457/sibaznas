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

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
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
}
