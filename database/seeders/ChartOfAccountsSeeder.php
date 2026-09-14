<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            // 1. ASET LANCAR
            ['code' => '1-1101', 'name' => 'Kas',                            'category' => 'ASSET',    'sub_category' => 'CURRENT_ASSET',                 'normal_balance' => 'DEBIT'],
            ['code' => '1-1102', 'name' => 'Bank',                                 'category' => 'ASSET',    'sub_category' => 'CURRENT_ASSET',                 'normal_balance' => 'DEBIT'],
            ['code' => '1-1103', 'name' => 'Kas Kecil',                            'category' => 'ASSET',    'sub_category' => 'CURRENT_ASSET',                 'normal_balance' => 'DEBIT'],
            ['code' => '1-1201', 'name' => 'Piutang Usaha',                        'category' => 'ASSET',    'sub_category' => 'CURRENT_ASSET',                 'normal_balance' => 'DEBIT'],
            ['code' => '1-1301', 'name' => 'Persediaan Barang',                    'category' => 'ASSET',    'sub_category' => 'CURRENT_ASSET',                 'normal_balance' => 'DEBIT'],
            ['code' => '1-1401', 'name' => 'Perlengkapan Kantor',                  'category' => 'ASSET',    'sub_category' => 'CURRENT_ASSET',                 'normal_balance' => 'DEBIT'],
            ['code' => '1-1501', 'name' => 'Sewa Dibayar di Muka',                 'category' => 'ASSET',    'sub_category' => 'CURRENT_ASSET',                 'normal_balance' => 'DEBIT'],
            // 1. ASET TIDAK LANCAR
            ['code' => '1-2101', 'name' => 'Peralatan & Inventaris',               'category' => 'ASSET',    'sub_category' => 'NON_CURRENT_ASSET',             'normal_balance' => 'DEBIT'],
            ['code' => '1-2102', 'name' => 'Akumulasi Penyusutan Peralatan',       'category' => 'ASSET',    'sub_category' => 'NON_CURRENT_ASSET',             'normal_balance' => 'CREDIT'],

            // 2. KEWAJIBAN
            ['code' => '2-1101', 'name' => 'Utang Usaha',                          'category' => 'LIABILITY','sub_category' => 'CURRENT_LIABILITY',            'normal_balance' => 'CREDIT'],
            ['code' => '2-1102', 'name' => 'Utang Gaji & Honor',                   'category' => 'LIABILITY','sub_category' => 'CURRENT_LIABILITY',            'normal_balance' => 'CREDIT'],
            ['code' => '2-1103', 'name' => 'Utang Pajak',                          'category' => 'LIABILITY','sub_category' => 'CURRENT_LIABILITY',            'normal_balance' => 'CREDIT'],
            ['code' => '2-1104', 'name' => 'Pendapatan Diterima di Muka',          'category' => 'LIABILITY','sub_category' => 'CURRENT_LIABILITY',            'normal_balance' => 'CREDIT'],
            ['code' => '2-2101', 'name' => 'Utang Bank Jangka Panjang',            'category' => 'LIABILITY','sub_category' => 'NON_CURRENT_LIABILITY',        'normal_balance' => 'CREDIT'],

            // 3. MODAL / EKUITAS
            ['code' => '3-1100', 'name' => 'Modal Awal',                           'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '3-1200', 'name' => 'Modal Tambahan',                       'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '3-2100', 'name' => 'Laba Ditahan',                         'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '3-2200', 'name' => 'Cadangan Umum',                        'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],

            // 4. PENDAPATAN — Amil = tanpa pembatasan, ZIS Mustahiq = dengan pembatasan (PSAK 109)
            ['code' => '4-1100', 'name' => 'Pendapatan Usaha (Hak Amil)',          'category' => 'REVENUE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '4-1200', 'name' => 'Pendapatan Jasa',                      'category' => 'REVENUE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '4-1300', 'name' => 'Pendapatan Sumbangan & Hibah',         'category' => 'REVENUE',  'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '4-1400', 'name' => 'Pendapatan Bunga & Investasi',         'category' => 'REVENUE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '4-1500', 'name' => 'Pendapatan Lain-lain',                 'category' => 'REVENUE',  'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '4-2100', 'name' => 'Pendapatan Sumbangan & Hibah (Zakat Maal)',   'category' => 'REVENUE','sub_category' => 'NET_ASSET_RESTRICTED','normal_balance' => 'CREDIT'],
            ['code' => '4-2200', 'name' => 'Pendapatan Sumbangan & Hibah (Zakat Fitrah)', 'category' => 'REVENUE','sub_category' => 'NET_ASSET_RESTRICTED','normal_balance' => 'CREDIT'],
            ['code' => '4-2300', 'name' => 'Pendapatan Sumbangan & Hibah (Infak Terikat)', 'category' => 'REVENUE','sub_category' => 'NET_ASSET_RESTRICTED','normal_balance' => 'CREDIT'],
            ['code' => '4-2400', 'name' => 'Pendapatan Lain-lain (DSKL/Fidyah)',    'category' => 'REVENUE',  'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],

            // 5. BEBAN — program = dengan pembatasan, operasional amil = tanpa pembatasan
            ['code' => '5-1100', 'name' => 'Penyaluran - Fakir & Miskin',          'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'DEBIT'],
            ['code' => '5-1200', 'name' => 'Beban Gaji & Honorarium',              'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-1300', 'name' => 'Beban Administrasi & Umum',            'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-1400', 'name' => 'Beban Lain-lain',                      'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-1500', 'name' => 'Program Infak Terikat',                'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'DEBIT'],
            ['code' => '5-2100', 'name' => 'Beban Gaji & Honorarium',              'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2200', 'name' => 'Beban Sewa',                           'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2300', 'name' => 'Beban Perlengkapan & ATK',             'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2400', 'name' => 'Beban Penyusutan',                     'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2500', 'name' => 'Beban Transportasi & Perjalanan Dinas','category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2600', 'name' => 'Beban Pemasaran & Promosi',            'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2700', 'name' => 'Beban Penyusutan',                     'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2800', 'name' => 'Beban Administrasi & Umum',            'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2900', 'name' => 'Beban Lain-lain',                      'category' => 'EXPENSE',  'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
        ];

        foreach ($accounts as $acc) {
            Account::updateOrCreate(['code' => $acc['code']], $acc);
        }

        // Hapus akun lama yang bukan akun umum (jika belum ada transaksi)
        $keep = collect($accounts)->pluck('code')->toArray();
        Account::whereNotIn('code', $keep)->whereDoesntHave('journalItems')->delete();
    }
}
