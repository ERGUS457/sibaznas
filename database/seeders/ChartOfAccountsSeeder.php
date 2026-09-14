<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            // 1. ASET
            ['code' => '1-1101', 'name' => 'Kas Tunai',                           'category' => 'ASSET',   'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1102', 'name' => 'Rekening Bank',                        'category' => 'ASSET',   'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1103', 'name' => 'Kas di Bank',                         'category' => 'ASSET',   'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1201', 'name' => 'Piutang Usaha',                       'category' => 'ASSET',   'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1301', 'name' => 'Persediaan Barang',                   'category' => 'ASSET',   'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1401', 'name' => 'Perlengkapan Kantor',                 'category' => 'ASSET',   'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-2101', 'name' => 'Peralatan & Inventaris',              'category' => 'ASSET',   'sub_category' => 'NON_CURRENT_ASSET',            'normal_balance' => 'DEBIT'],
            ['code' => '1-2102', 'name' => 'Akumulasi Penyusutan Peralatan',      'category' => 'ASSET',   'sub_category' => 'NON_CURRENT_ASSET',            'normal_balance' => 'CREDIT'],

            // 2. KEWAJIBAN
            ['code' => '2-1101', 'name' => 'Utang Usaha',                         'category' => 'LIABILITY','sub_category' => 'CURRENT_LIABILITY',           'normal_balance' => 'CREDIT'],
            ['code' => '2-1102', 'name' => 'Utang Gaji & Honor',                  'category' => 'LIABILITY','sub_category' => 'CURRENT_LIABILITY',           'normal_balance' => 'CREDIT'],
            ['code' => '2-1103', 'name' => 'Beban yang Masih Harus Dibayar',      'category' => 'LIABILITY','sub_category' => 'CURRENT_LIABILITY',           'normal_balance' => 'CREDIT'],
            ['code' => '2-2101', 'name' => 'Utang Jangka Panjang',                'category' => 'LIABILITY','sub_category' => 'NON_CURRENT_LIABILITY',       'normal_balance' => 'CREDIT'],

            // 3. MODAL / EKUITAS
            ['code' => '3-1100', 'name' => 'Modal Awal',                          'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '3-2100', 'name' => 'Laba Ditahan',                        'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'CREDIT'],
            ['code' => '3-2200', 'name' => 'Cadangan Umum',                       'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'CREDIT'],
            ['code' => '3-2300', 'name' => 'Dana Cadangan Khusus',                'category' => 'NET_ASSET','sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'CREDIT'],

            // 4. PENDAPATAN
            ['code' => '4-1100', 'name' => 'Pendapatan Usaha / Jasa',             'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '4-1200', 'name' => 'Pendapatan Sumbangan',                'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '4-1300', 'name' => 'Pendapatan Bunga & Investasi',        'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '4-1400', 'name' => 'Pendapatan Lain-lain',                'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'CREDIT'],
            ['code' => '4-2100', 'name' => 'Pendapatan Penjualan',                'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'CREDIT'],
            ['code' => '4-2200', 'name' => 'Pendapatan Hibah',                    'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'CREDIT'],
            ['code' => '4-2300', 'name' => 'Pendapatan Donasi Terikat',           'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'CREDIT'],
            ['code' => '4-2400', 'name' => 'Pendapatan Non-Operasional',          'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'CREDIT'],

            // 5. BEBAN
            ['code' => '5-1100', 'name' => 'Beban Pokok Penjualan',               'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'DEBIT'],
            ['code' => '5-1200', 'name' => 'Beban Program & Kegiatan',            'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'DEBIT'],
            ['code' => '5-1300', 'name' => 'Beban Operasional Program',           'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'DEBIT'],
            ['code' => '5-1400', 'name' => 'Beban Umum Lainnya',                  'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'DEBIT'],
            ['code' => '5-1500', 'name' => 'Beban Proyek Khusus',                 'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',          'normal_balance' => 'DEBIT'],
            ['code' => '5-2100', 'name' => 'Beban Gaji & Honorarium',             'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2200', 'name' => 'Beban Operasional Kantor',            'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2300', 'name' => 'Beban Pemasaran & Promosi',           'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2400', 'name' => 'Beban Penyusutan',                    'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
            ['code' => '5-2500', 'name' => 'Beban Administrasi & Umum',           'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS','normal_balance' => 'DEBIT'],
        ];

        foreach ($accounts as $acc) {
            Account::updateOrCreate(['code' => $acc['code']], $acc);
        }

        // Hapus akun lama yang tidak dipakai lagi (jika ada transaksi 0)
        $keepCodes = collect($accounts)->pluck('code')->toArray();
        Account::whereNotIn('code', $keepCodes)->whereDoesntHave('journalItems')->delete();
    }
}
