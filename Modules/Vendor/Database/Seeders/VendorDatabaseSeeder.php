<?php

namespace Modules\Vendor\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Vendor\Entities\Vendor;

class VendorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $vendors = [
            'رستوران محمد',
            'رستوران شیلا',
            'رستوران ویلا',
            'کباب سرای ترنج',
            'طباخی کیمیا',
            'طباخی آهو',
            'باگت تهرانپارس',
            'باگت نیاوران',
            'هومی کوک',
            'فست فود اشرف',

        ];

        foreach ($vendors as $key => $name) {
            $vendors[$key] = [
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Vendor::insert($vendors);

    }
}
