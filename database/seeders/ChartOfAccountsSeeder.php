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
            ['code' => '1-1101', 'name' => 'Kas Tunai',                              'category' => 'ASSET', 'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1102', 'name' => 'Bank',                                   'category' => 'ASSET', 'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1103', 'name' => 'Kas di Bank (Penampungan)',              'category' => 'ASSET', 'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1201', 'name' => 'Piutang Usaha',                          'category' => 'ASSET', 'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-1301', 'name' => 'Persediaan',                             'category' => 'ASSET', 'sub_category' => 'CURRENT_ASSET',                'normal_balance' => 'DEBIT'],
            ['code' => '1-2101', 'name' => 'Peralatan Kantor',                       'category' => 'ASSET', 'sub_category' => 'NON_CURRENT_ASSET',            'normal_balance' => 'DEBIT'],
            ['code' => '1-2102', 'name' => 'Akumulasi Penyusutan Peralatan',         'category' => 'ASSET', 'sub_category' => 'NON_CURRENT_ASSET',            'normal_balance' => 'CREDIT'],

            // 2. LIABILITAS
            ['code' => '2-1101', 'name' => 'Utang Usaha',                            'category' => 'LIABILITY', 'sub_category' => 'CURRENT_LIABILITY',          'normal_balance' => 'CREDIT'],
            ['code' => '2-1102', 'name' => 'Utang Penyaluran',                       'category' => 'LIABILITY', 'sub_category' => 'CURRENT_LIABILITY',          'normal_balance' => 'CREDIT'],
            ['code' => '2-1103', 'name' => 'Utang Operasional',                      'category' => 'LIABILITY', 'sub_category' => 'CURRENT_LIABILITY',          'normal_balance' => 'CREDIT'],

            // 3. MODAL / ASET BERSIH
            ['code' => '3-1100', 'name' => 'Modal Awal',                             'category' => 'NET_ASSET', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'CREDIT'],
            ['code' => '3-2100', 'name' => 'Dana Zakat',                             'category' => 'NET_ASSET', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '3-2200', 'name' => 'Dana Infak / Sedekah',                   'category' => 'NET_ASSET', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '3-2300', 'name' => 'Dana Sosial Lainnya',                    'category' => 'NET_ASSET', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],

            // 4. PENDAPATAN
            ['code' => '4-1100', 'name' => 'Pendapatan Jasa / Amil',                 'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'CREDIT'],
            ['code' => '4-1200', 'name' => 'Pendapatan Infak',                       'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'CREDIT'],
            ['code' => '4-1300', 'name' => 'Pendapatan Lain-lain',                   'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'CREDIT'],
            ['code' => '4-2100', 'name' => 'Penerimaan Zakat Maal',                  'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '4-2200', 'name' => 'Penerimaan Zakat Fitrah',                'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '4-2300', 'name' => 'Penerimaan Infak Terikat',               'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],
            ['code' => '4-2400', 'name' => 'Penerimaan DSKL',                        'category' => 'REVENUE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'CREDIT'],

            // 5. BEBAN
            ['code' => '5-1100', 'name' => 'Beban Penyaluran - Fakir Miskin',        'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'DEBIT'],
            ['code' => '5-1200', 'name' => 'Beban Penyaluran - Pendidikan',          'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'DEBIT'],
            ['code' => '5-1300', 'name' => 'Beban Penyaluran - Kesehatan',           'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'DEBIT'],
            ['code' => '5-1400', 'name' => 'Beban Penyaluran - Lainnya',             'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'DEBIT'],
            ['code' => '5-1500', 'name' => 'Beban Program Infak',                    'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_RESTRICTED',           'normal_balance' => 'DEBIT'],
            ['code' => '5-2100', 'name' => 'Beban Gaji & Honor',                     'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'DEBIT'],
            ['code' => '5-2200', 'name' => 'Beban Operasional Kantor',               'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'DEBIT'],
            ['code' => '5-2300', 'name' => 'Beban Sosialisasi & Edukasi',            'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'DEBIT'],
            ['code' => '5-2400', 'name' => 'Beban Penyusutan',                       'category' => 'EXPENSE', 'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS', 'normal_balance' => 'DEBIT'],
        ];

        foreach ($accounts as $acc) {
            Account::updateOrCreate(['code' => $acc['code']], $acc);
        }
    }
}
