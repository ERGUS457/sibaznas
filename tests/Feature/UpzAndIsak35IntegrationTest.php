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
    protected function authenticateAdmin(): \App\Models\User
    {
        $admin = \App\Models\User::where('role', 'superadmin')->first();
        $this->actingAs($admin);
        return $admin;
    }

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
        $this->authenticateAdmin();
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
        $this->authenticateAdmin();
        $distResponse = $this->get(route('distributions.index'));
        $distResponse->assertStatus(200);
        $distResponse->assertSee('Penyaluran ZIS (Mustahiq 8 Asnaf)');

        $remitResponse = $this->get(route('remittances.index'));
        $remitResponse->assertStatus(200);
        $remitResponse->assertSee('Setoran Hasil Pengumpulan ke BAZNAS');
    }

    public function test_accounting_journals_and_ledger(): void
    {
        $this->authenticateAdmin();
        $journalResponse = $this->get(route('journals.index'));
        $journalResponse->assertStatus(200);
        $journalResponse->assertSee('Jurnal Umum (General Journal)');

        $trialBalanceResponse = $this->get(route('journals.trial-balance'));
        $trialBalanceResponse->assertStatus(200);
        $trialBalanceResponse->assertSee('Neraca Saldo (Trial Balance)');
    }

    public function test_de_isak35_financial_reports(): void
    {
        $this->authenticateAdmin();
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
        $this->authenticateAdmin();
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
        $this->authenticateAdmin();
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

    public function test_user_registration_and_admin_approval_workflow(): void
    {
        // 1. Visit Register Step 1
        $step1Get = $this->get(route('register.step1'));
        $step1Get->assertStatus(200);
        $step1Get->assertSee('Buat Akun Baru');

        // 2. Submit Step 1 (User Account Data)
        $suffix = time();
        $step1Post = $this->post(route('register.step1.submit'), [
            'name' => 'Ahmad Pengurus Baru',
            'username' => 'ahmad_upz_' . $suffix,
            'email' => 'ahmad_' . $suffix . '@masjid.or.id',
            'phone' => '081234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $step1Post->assertRedirect(route('register.step2'));

        // 3. Visit Register Step 2
        $step2Get = $this->get(route('register.step2'));
        $step2Get->assertStatus(200);
        $step2Get->assertSee('Data Organisasi / UPZ');

        // 4. Submit Step 2 (UPZ Organization Data)
        $uniqueCode = 'UPZ-REG-' . $suffix;
        $step2Post = $this->post(route('register.step2.submit'), [
            'upz_name' => 'UPZ Masjid Jami Al-Hidayah',
            'upz_code' => $uniqueCode,
            'institution_type' => 'Masjid',
            'parent_baznas_level' => 'BAZNAS Kab/Kota',
            'parent_baznas_name' => 'BAZNAS Kota Surabaya',
            'sk_number' => 'SK/2026/MJA/001',
            'address' => 'Jl. Masjid No. 45',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'chairman_name' => 'H. Ahmad Syamsuddin',
            'bank_name' => 'Bank Syariah Indonesia',
            'bank_account_number' => '7123456789',
            'bank_account_name' => 'UPZ MASJID AL-HIDAYAH',
            'amil_share_percentage' => 12.50,
        ]);
        $step2Post->assertRedirect(route('pending-approval'));

        // 5. Verify User and UPZ were created in database with pending status
        $user = \App\Models\User::where('username', 'ahmad_upz_' . $suffix)->first();
        $this->assertNotNull($user);
        $this->assertEquals('pending', $user->status);
        $this->assertTrue($user->isPending());

        $upz = \App\Models\Upz\UpzProfile::where('code', $uniqueCode)->first();
        $this->assertNotNull($upz);
        $this->assertEquals('UPZ Masjid Jami Al-Hidayah', $upz->name);
        $this->assertEquals($upz->id, $user->upz_profile_id);

        // 6. Test Admin User Approval Workflow
        $admin = \App\Models\User::where('role', 'superadmin')->first();
        $this->actingAs($admin);

        $adminIndex = $this->get(route('admin.users.index'));
        $adminIndex->assertStatus(200);
        $adminIndex->assertSee('Manajemen Pengguna');
        $adminIndex->assertSee('Ahmad Pengurus Baru');

        // 7. Approve the pending user
        $approveResp = $this->post(route('admin.users.approve', $user->id));
        $approveResp->assertStatus(302);

        $user->refresh();
        $this->assertEquals('active', $user->status);
        $this->assertTrue($user->isActive());

        // Clean up test records
        $user->delete();
        $upz->delete();
    }

    public function test_admin_user_edit_and_forgot_password_request_workflow(): void
    {
        $admin = $this->authenticateAdmin();
        $suffix = time() . '_' . rand(100, 999);

        // 1. Submit Forgot Password Request from Login page
        $forgotResponse = $this->post(route('password.request.send'), [
            'name' => 'Pengurus UPZ Pengujian',
            'username_or_email' => 'pengurus_' . $suffix,
            'phone' => '08987654321',
            'message' => 'Tolong bantu reset password akun kami karena lupa kata sandi.',
        ]);
        $forgotResponse->assertRedirect();
        $forgotResponse->assertSessionHas('success');

        $req = \App\Models\PasswordResetRequest::where('username_or_email', 'pengurus_' . $suffix)->first();
        $this->assertNotNull($req);
        $this->assertEquals('pending', $req->status);
        $this->assertTrue($req->isPending());

        // 2. Admin views index and sees the request
        $indexResp = $this->get(route('admin.users.index'));
        $indexResp->assertStatus(200);
        $indexResp->assertSee('Pengurus UPZ Pengujian');
        $indexResp->assertSee('Permohonan Bantuan Lupa Password');

        // 3. Create a temporary user to test edit & password reset
        $targetUser = \App\Models\User::create([
            'name' => 'Target Edit User ' . $suffix,
            'username' => 'target_' . $suffix,
            'email' => 'target_' . $suffix . '@example.com',
            'password' => bcrypt('oldpassword123'),
            'role' => 'pengurus_upz',
            'status' => 'active',
        ]);

        // 4. Admin visits edit page
        $editResp = $this->get(route('admin.users.edit', $targetUser));
        $editResp->assertStatus(200);
        $editResp->assertSee('Edit Data Pengguna');
        $editResp->assertSee($targetUser->name);

        // 5. Admin updates target user with new name and new password
        $updateResp = $this->put(route('admin.users.update', $targetUser), [
            'name' => 'Target User Updated',
            'username' => 'target_' . $suffix,
            'email' => 'target_' . $suffix . '@example.com',
            'phone' => '08111222333',
            'role' => 'akuntan',
            'status' => 'active',
            'password' => 'newsecretpassword123',
            'password_confirmation' => 'newsecretpassword123',
        ]);
        $updateResp->assertRedirect(route('admin.users.index'));
        $updateResp->assertSessionHas('success');

        $targetUser->refresh();
        $this->assertEquals('Target User Updated', $targetUser->name);
        $this->assertEquals('akuntan', $targetUser->role);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('newsecretpassword123', $targetUser->password));

        // 6. Admin resolves the password reset request
        $this->from(route('admin.users.index'));
        $resolveResp = $this->post(route('admin.password-requests.resolve', $req), [
            'admin_notes' => 'Password telah direset ke default oleh Superadmin.',
        ]);
        $resolveResp->assertRedirect(route('admin.users.index'));
        $resolveResp->assertSessionHas('success');

        $req->refresh();
        $this->assertEquals('resolved', $req->status);
        $this->assertTrue($req->isResolved());
        $this->assertNotNull($req->resolved_at);

        // Clean up
        $targetUser->delete();
        $req->delete();
    }
}
