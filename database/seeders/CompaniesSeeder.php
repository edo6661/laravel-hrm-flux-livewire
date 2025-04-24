<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'Google',
                'email' => 'contact@google.com',
                'website' => 'https://www.google.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Microsoft',
                'email' => 'info@microsoft.com',
                'website' => 'https://www.microsoft.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Apple',
                'email' => 'hello@apple.com',
                'website' => 'https://www.apple.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amazon',
                'email' => 'support@amazon.com',
                'website' => 'https://www.amazon.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Facebook',
                'email' => 'admin@facebook.com',
                'website' => 'https://www.facebook.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Netflix',
                'email' => 'contact@netflix.com',
                'website' => 'https://www.netflix.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tesla',
                'email' => 'info@tesla.com',
                'website' => 'https://www.tesla.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung',
                'email' => 'support@samsung.com',
                'website' => 'https://www.samsung.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adobe',
                'email' => 'hello@adobe.com',
                'website' => 'https://www.adobe.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Intel',
                'email' => 'contact@intel.com',
                'website' => 'https://www.intel.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        foreach (Company::all() as $key => $company) {
            $company->users()->attach(1);
        }
    }
}
