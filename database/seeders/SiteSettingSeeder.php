<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::create([
            'company_name'=>'Company Name',
            'site_name'=>'Site Name',
            'email'=>'defaultemail@gmail.com',
            'location'=>'default location',
            'contact_number'=>'9876543210',
            'introduction_text'=>'null'
        ]);
    }
}
