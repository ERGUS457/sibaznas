<?php

namespace Database\Seeders;

use App\Models\Accounting\FiscalPeriod;
use App\Models\Upz\Mustahiq;
use App\Models\Upz\Muzakki;
use App\Models\Upz\UpzProfile;
use App\Models\User;
use App\Services\Upz\BaznasRemittanceService;
use App\Services\Upz\ZisCollectionService;
use App\Services\Upz\ZisDistributionService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpzDemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Fiscal Period 2026
        $fiscalPeriod = FiscalPeriod::firstOrCreate(
            ['year' => 2026],
            [
                'name' => 'Tahun Anggaran 2026',
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_closed' => false,
            ]
        );

        // 2. UPZ Profile
        $upz = UpzProfile::firstOrCreate(
            ['code' => 'UPZ-BZN-0042'],
            [
                'name' => 'UPZ BAZNAS PT Sinergi Amanah Bangsa',
                'sk_number' => 'Kep. 042/BAZNAS-RI/SK-UPZ/III/2024',
                'sk_date' => '2024-03-15',
                'sk_valid_until' => '2029-03-15',
                'institution_type' => 'Perusahaan Swasta Nasional',
                'parent_baznas_level' => 'BAZNAS RI',
                'parent_baznas_name' => 'Badan Amil Zakat Nasional (Pusat)',
                'address' => 'Jl. Jenderal Sudirman Kav. 52-53, SCBD',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'phone' => '021-52901234',
                'email' => 'upz@sinergiamanah.co.id',
                'chairman_name' => 'Drs. H. Bambang Soedibyo, M.M.',
                'secretary_name' => 'Rian Hidayat, S.E.',
                'treasurer_name' => 'Nurul Fadilah, S.Ak.',
                'bank_name' => 'Bank Syariah Indonesia (BSI)',
                'bank_account_number' => '7112233445',
                'bank_account_name' => 'UPZ BAZNAS PT SINERGI AMANAH',
                'amil_share_percentage' => 12.50,
                'is_active' => true,
            ]
        );

        // 3. User Accounts
        $admin = User::firstOrCreate(
            ['email' => 'admin@upz-sinergi.id'],
            [
                'name' => 'H. Bambang Soedibyo (Ketua UPZ)',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'phone' => '081234567890',
                'upz_profile_id' => $upz->id,
            ]
        );

        $pengurus = User::firstOrCreate(
            ['email' => 'pengurus@upz-sinergi.id'],
            [
                'name' => 'Rian Hidayat (Petugas Penerima ZIS)',
                'password' => Hash::make('password'),
                'role' => 'pengurus_upz',
                'phone' => '081298765432',
                'upz_profile_id' => $upz->id,
            ]
        );

        $akuntan = User::firstOrCreate(
            ['email' => 'akuntan@upz-sinergi.id'],
            [
                'name' => 'Nurul Fadilah, S.Ak. (Akuntan)',
                'password' => Hash::make('password'),
                'role' => 'akuntan',
                'phone' => '081388776655',
                'upz_profile_id' => $upz->id,
            ]
        );

        // 4. Muzakkis
        $muzakki1 = Muzakki::firstOrCreate(
            ['nik_or_npwp' => '3171012304850001'],
            [
                'upz_profile_id' => $upz->id,
                'type' => 'individu',
                'npwz' => '31.71.042.0001',
                'name' => 'Ir. H. Ahmad Fauzi, M.T.',
                'email' => 'ahmad.fauzi@sinergiamanah.co.id',
                'phone' => '08111222333',
                'address' => 'Jl. Tebet Barat Dalam No. 12',
                'city' => 'Jakarta Selatan',
                'workplace_or_agency' => 'Direktorat Operasi PT Sinergi',
                'payroll_id' => 'EMP-001',
                'is_active' => true,
            ]
        );

        $muzakki2 = Muzakki::firstOrCreate(
            ['nik_or_npwp' => '3171025508900002'],
            [
                'upz_profile_id' => $upz->id,
                'type' => 'individu',
                'npwz' => '31.71.042.0002',
                'name' => 'Dra. Hj. Siti Rahmawati',
                'email' => 'siti.rahma@sinergiamanah.co.id',
                'phone' => '08112333444',
                'address' => 'Jl. Pejaten Barat Raya No. 45',
                'city' => 'Jakarta Selatan',
                'workplace_or_agency' => 'Divisi Human Capital',
                'payroll_id' => 'EMP-014',
                'is_active' => true,
            ]
        );

        $muzakki3 = Muzakki::firstOrCreate(
            ['nik_or_npwp' => '01.234.567.8-012.000'],
            [
                'upz_profile_id' => $upz->id,
                'type' => 'badan',
                'npwz' => '31.71.042.9001',
                'name' => 'PT Sinergi Amanah Bangsa (Zakat Korporasi)',
                'email' => 'finance@sinergiamanah.co.id',
                'phone' => '021-52901200',
                'address' => 'Gedung Sinergi Tower Lt. 18, SCBD',
                'city' => 'Jakarta Selatan',
                'workplace_or_agency' => 'Kantor Pusat',
                'is_active' => true,
            ]
        );

        // 5. Mustahiqs (8 Asnaf)
        $mustahiq1 = Mustahiq::firstOrCreate(
            ['nik' => '3201011503700005'],
            [
                'upz_profile_id' => $upz->id,
                'name' => 'Pak Slamet Riyadi',
                'asnaf_category' => 'fakir',
                'gender' => 'L',
                'phone' => '085711223344',
                'address' => 'Kampung Melayu Kecil RT 04/01',
                'city' => 'Jakarta Timur',
                'family_dependents_count' => 5,
                'monthly_income' => 750000,
                'eligibility_notes' => 'Lansia buruh serabutan tanpa penghasilan tetap, menanggung istri dan cucu yatim.',
                'survey_date' => '2026-01-10',
                'surveyor_name' => 'Rian Hidayat',
                'is_active' => true,
            ]
        );

        $mustahiq2 = Mustahiq::firstOrCreate(
            ['nik' => '3201026006850008'],
            [
                'upz_profile_id' => $upz->id,
                'name' => 'Ibu Aminah Maryam',
                'asnaf_category' => 'miskin',
                'gender' => 'P',
                'phone' => '085822334455',
                'address' => 'Gg. Kancil No. 18, Menteng Atas',
                'city' => 'Jakarta Selatan',
                'family_dependents_count' => 3,
                'monthly_income' => 1200000,
                'eligibility_notes' => 'Ibu tunggal (janda), berjualan gorengan, butuh bantuan biaya SPP sekolah anak.',
                'survey_date' => '2026-01-15',
                'surveyor_name' => 'Rian Hidayat',
                'is_active' => true,
            ]
        );

        $mustahiq3 = Mustahiq::firstOrCreate(
            ['nik' => '3201031010800003'],
            [
                'upz_profile_id' => $upz->id,
                'name' => 'Ustadz Dahlan Mansyur',
                'asnaf_category' => 'fisabilillah',
                'gender' => 'L',
                'phone' => '081399887766',
                'address' => 'Pesantren & TPA Al-Ikhlas, Cibinong',
                'city' => 'Bogor',
                'family_dependents_count' => 4,
                'monthly_income' => 1500000,
                'eligibility_notes' => 'Pengajar Al-Quran gratis bagi anak-anak dhuafa dan dakwah pelosok.',
                'survey_date' => '2026-01-18',
                'surveyor_name' => 'Rian Hidayat',
                'is_active' => true,
            ]
        );

        // 6. Record Collections via ZisCollectionService
        $collectionService = app(ZisCollectionService::class);
        $distributionService = app(ZisDistributionService::class);
        $remittanceService = app(BaznasRemittanceService::class);

        // Check if collections already exist
        if ($upz->collections()->count() === 0) {
            // Transaction 1: Zakat Maal Penghasilan
            $collectionService->recordCollection([
                'upz_profile_id' => $upz->id,
                'muzakki_id' => $muzakki1->id,
                'transaction_date' => '2026-02-05',
                'fund_type' => 'zakat_maal',
                'fund_subtype' => 'Zakat Penghasilan / Profesi',
                'payment_method' => 'payroll',
                'amount' => 5000000,
                'amil_percentage' => 12.50,
                'description' => 'Potong zakat payroll bulan Januari 2026 (Ahmad Fauzi)',
                'reference_number' => 'PAY-202601-001',
            ], $pengurus);

            // Transaction 2: Zakat Maal Penghasilan
            $collectionService->recordCollection([
                'upz_profile_id' => $upz->id,
                'muzakki_id' => $muzakki2->id,
                'transaction_date' => '2026-02-05',
                'fund_type' => 'zakat_maal',
                'fund_subtype' => 'Zakat Penghasilan / Profesi',
                'payment_method' => 'payroll',
                'amount' => 3500000,
                'amil_percentage' => 12.50,
                'description' => 'Potong zakat payroll bulan Januari 2026 (Siti Rahmawati)',
                'reference_number' => 'PAY-202601-014',
            ], $pengurus);

            // Transaction 3: Zakat Perniagaan Korporasi
            $collectionService->recordCollection([
                'upz_profile_id' => $upz->id,
                'muzakki_id' => $muzakki3->id,
                'transaction_date' => '2026-02-15',
                'fund_type' => 'zakat_maal',
                'fund_subtype' => 'Zakat Perniagaan / Perusahaan',
                'payment_method' => 'transfer_bank',
                'amount' => 25000000,
                'amil_percentage' => 12.50,
                'description' => 'Zakat perniagaan triwulan IV PT Sinergi Amanah Bangsa',
                'reference_number' => 'TRF-BSI-990812',
            ], $pengurus);

            // Transaction 4: Infak Terikat Beasiswa
            $collectionService->recordCollection([
                'upz_profile_id' => $upz->id,
                'muzakki_id' => $muzakki1->id,
                'transaction_date' => '2026-02-20',
                'fund_type' => 'infak_terikat',
                'fund_subtype' => 'Infak Program Pendidikan Yatim & Dhuafa',
                'payment_method' => 'transfer_bank',
                'amount' => 10000000,
                'amil_percentage' => 10.00,
                'description' => 'Infak terikat beasiswa anak asuh dhuafa',
                'reference_number' => 'TRF-BSI-991204',
            ], $pengurus);

            // Transaction 5: Zakat Fitrah
            $collectionService->recordCollection([
                'upz_profile_id' => $upz->id,
                'muzakki_id' => $muzakki2->id,
                'transaction_date' => '2026-03-01',
                'fund_type' => 'zakat_fitrah',
                'fund_subtype' => 'Zakat Fitrah Uang (5 Jiwa)',
                'payment_method' => 'kas_tunai',
                'amount' => 250000,
                'amil_percentage' => 12.50,
                'description' => 'Zakat fitrah Ramadhan 1447 H untuk 5 jiwa @ Rp 50.000',
            ], $pengurus);
        }

        // 7. Record Distributions via ZisDistributionService
        if ($upz->distributions()->count() === 0) {
            // Distribution 1: Bantuan Sembako & Santunan Asnaf Fakir
            $distributionService->recordDistribution([
                'upz_profile_id' => $upz->id,
                'mustahiq_id' => $mustahiq1->id,
                'distribution_date' => '2026-02-25',
                'fund_type' => 'zakat_maal',
                'asnaf_category' => 'fakir',
                'program_name' => 'BAZNAS Peduli - Santunan Biaya Hidup & Sembako',
                'distribution_type' => 'konsumtif',
                'amount' => 2500000,
                'description' => 'Bantuan pemenuhan pangan pokok dan modal sembako keluarga Pak Slamet',
                'recipient_identity_name' => 'Pak Slamet Riyadi',
            ], $admin);

            // Distribution 2: Beasiswa Pendidikan Asnaf Miskin
            $distributionService->recordDistribution([
                'upz_profile_id' => $upz->id,
                'mustahiq_id' => $mustahiq2->id,
                'distribution_date' => '2026-02-26',
                'fund_type' => 'zakat_maal',
                'asnaf_category' => 'miskin',
                'program_name' => 'BAZNAS Cerdas - Bantuan SPP & Perlengkapan Sekolah',
                'distribution_type' => 'konsumtif',
                'amount' => 3000000,
                'description' => 'Pelunasan SPP dan seragam 2 anak sekolah Ibu Aminah',
                'recipient_identity_name' => 'Ibu Aminah Maryam',
            ], $admin);

            // Distribution 3: Dukungan Dakwah Asnaf Fisabilillah
            $distributionService->recordDistribution([
                'upz_profile_id' => $upz->id,
                'mustahiq_id' => $mustahiq3->id,
                'distribution_date' => '2026-02-28',
                'fund_type' => 'zakat_maal',
                'asnaf_category' => 'fisabilillah',
                'program_name' => 'BAZNAS Dakwah - Kafalah Da\'i Pelosok & Sarana TPA',
                'distribution_type' => 'produktif',
                'amount' => 4000000,
                'description' => 'Kafalah da\'i dan pengadaan Al-Quran & iqro santri TPA Al-Ikhlas',
                'recipient_identity_name' => 'Ustadz Dahlan Mansyur',
            ], $admin);
        }

        // 8. Record Remittance to BAZNAS via BaznasRemittanceService
        if ($upz->remittances()->count() === 0) {
            $remittanceService->recordRemittance([
                'upz_profile_id' => $upz->id,
                'remittance_date' => '2026-03-02',
                'period_month' => 2,
                'period_year' => 2026,
                'total_collected' => 43500000,
                'amil_retained' => 5406250,
                'amount_remitted' => 20000000,
                'target_baznas_bank' => 'Bank Syariah Indonesia (BSI) BAZNAS RI',
                'target_baznas_account_number' => '7001122334',
                'status' => 'verified_by_baznas',
                'notes' => 'Penyetoran termin I hasil pengumpulan ZIS bulan Februari 2026 ke rekening BAZNAS RI.',
            ], $admin);
        }
    }
}
