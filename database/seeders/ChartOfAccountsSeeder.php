<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            // 1. ASET (ASSETS)
            // 1.1 Aset Lancar
            [
                'code' => '1-1101',
                'name' => 'Kas Tunai UPZ (Dana Amil/Operasional)',
                'category' => 'ASSET',
                'sub_category' => 'CURRENT_ASSET',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '1-1102',
                'name' => 'Bank Operasional UPZ (Dana Amil)',
                'category' => 'ASSET',
                'sub_category' => 'CURRENT_ASSET',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '1-1103',
                'name' => 'Bank Penampungan ZIS (Dana Terikat ZIS)',
                'category' => 'ASSET',
                'sub_category' => 'CURRENT_ASSET',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '1-1201',
                'name' => 'Piutang Penyaluran / Uang Muka Program',
                'category' => 'ASSET',
                'sub_category' => 'CURRENT_ASSET',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '1-1301',
                'name' => 'Persediaan Beras Zakat Fitrah',
                'category' => 'ASSET',
                'sub_category' => 'CURRENT_ASSET',
                'normal_balance' => 'DEBIT',
            ],
            // 1.2 Aset Tidak Lancar
            [
                'code' => '1-2101',
                'name' => 'Peralatan dan Komputer Kantor UPZ',
                'category' => 'ASSET',
                'sub_category' => 'NON_CURRENT_ASSET',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '1-2102',
                'name' => 'Akumulasi Penyusutan Peralatan Kantor',
                'category' => 'ASSET',
                'sub_category' => 'NON_CURRENT_ASSET',
                'normal_balance' => 'CREDIT',
            ],

            // 2. LIABILITAS (LIABILITIES)
            // 2.1 Liabilitas Jangka Pendek
            [
                'code' => '2-1101',
                'name' => 'Utang Penyetoran ke BAZNAS Pembina',
                'category' => 'LIABILITY',
                'sub_category' => 'CURRENT_LIABILITY',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '2-1102',
                'name' => 'Utang Penyaluran Zakat (Mustahiq)',
                'category' => 'LIABILITY',
                'sub_category' => 'CURRENT_LIABILITY',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '2-1103',
                'name' => 'Beban Akrual / Utang Operasional Amil',
                'category' => 'LIABILITY',
                'sub_category' => 'CURRENT_LIABILITY',
                'normal_balance' => 'CREDIT',
            ],

            // 3. ASET BERSIH (NET ASSETS - DE ISAK 35 FORMAT A)
            [
                'code' => '3-1100',
                'name' => 'Aset Bersih Tanpa Pembatasan - Dana Amil & Operasional',
                'category' => 'NET_ASSET',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '3-2100',
                'name' => 'Aset Bersih Dengan Pembatasan - Dana Zakat',
                'category' => 'NET_ASSET',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '3-2200',
                'name' => 'Aset Bersih Dengan Pembatasan - Dana Infak/Sedekah Terikat',
                'category' => 'NET_ASSET',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '3-2300',
                'name' => 'Aset Bersih Dengan Pembatasan - Dana DSKL',
                'category' => 'NET_ASSET',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'CREDIT',
            ],

            // 4. PENDAPATAN / PENGHASILAN (INCOME)
            // 4.1 Pendapatan Tanpa Pembatasan (Dana Amil)
            [
                'code' => '4-1100',
                'name' => 'Pendapatan Alokasi Hak Amil Zakat',
                'category' => 'REVENUE',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '4-1200',
                'name' => 'Pendapatan Alokasi Hak Amil Infak/Sedekah',
                'category' => 'REVENUE',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '4-1300',
                'name' => 'Pendapatan Jasa Bagi Hasil & Lainnya Amil',
                'category' => 'REVENUE',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'CREDIT',
            ],
            // 4.2 Pendapatan Dengan Pembatasan (Penerimaan ZIS)
            [
                'code' => '4-2100',
                'name' => 'Penerimaan Zakat Maal (Penghasilan, Perdagangan, Emas)',
                'category' => 'REVENUE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '4-2200',
                'name' => 'Penerimaan Zakat Fitrah',
                'category' => 'REVENUE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '4-2300',
                'name' => 'Penerimaan Infak / Sedekah Terikat',
                'category' => 'REVENUE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'CREDIT',
            ],
            [
                'code' => '4-2400',
                'name' => 'Penerimaan DSKL (Dana Sosial Keagamaan Lainnya)',
                'category' => 'REVENUE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'CREDIT',
            ],

            // 5. BEBAN / PENGELUARAN (EXPENSES BY FUNCTION - ISAK 35)
            // 5.1 Beban Program / Penyaluran
            [
                'code' => '5-1100',
                'name' => 'Penyaluran Zakat - Asnaf Fakir & Miskin',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '5-1200',
                'name' => 'Penyaluran Zakat - Asnaf Fisabilillah & Pendidikan',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '5-1300',
                'name' => 'Penyaluran Zakat - Asnaf Gharimin & Kesehatan',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '5-1400',
                'name' => 'Penyaluran Zakat - Asnaf Lainnya (Mualaf, Ibnu Sabil)',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '5-1500',
                'name' => 'Penyaluran Program Infak & Sedekah Terikat',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_RESTRICTED',
                'normal_balance' => 'DEBIT',
            ],
            // 5.2 Beban Manajemen & Umum (Operasional Amil)
            [
                'code' => '5-2100',
                'name' => 'Beban Honorarium & Insentif Amil UPZ',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '5-2200',
                'name' => 'Beban Operasional Kantor, ATK & Transportasi UPZ',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '5-2300',
                'name' => 'Beban Sosialisasi, Edukasi & Dakwah Zakat',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'DEBIT',
            ],
            [
                'code' => '5-2400',
                'name' => 'Beban Penyusutan Peralatan Kantor',
                'category' => 'EXPENSE',
                'sub_category' => 'NET_ASSET_UNRESTRICTED_SURPLUS',
                'normal_balance' => 'DEBIT',
            ],
        ];

        foreach ($accounts as $acc) {
            Account::updateOrCreate(['code' => $acc['code']], $acc);
        }
    }
}
