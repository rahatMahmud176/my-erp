<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
            $this->call(PermissionSeeder::class);
            $this->call(RoleSeeder::class);
            $this->call(UserSeeder::class); 
            $this->call(BranchSeeder::class);
            $this->call(CategorySeeder::class);
            $this->call(SubCategorySeeder::class);
            $this->call(BrandSeeder::class);
            $this->call(ColorSeeder::class);
            $this->call(SizeSeeder::class);
            $this->call(CountryVariantSeeder::class);
            $this->call(UnitSeeder::class);
            $this->call(SubUnitSeeder::class);
            $this->call(ItemSeeder::class);
            $this->call(SupplierSeeder::class); 
            $this->call(ChallanSeeder::class);
            $this->call(StockSeeder::class);
            $this->call(AccountSeeder::class);
            $this->call(SettingSeeder::class);
            $this->call(CustomerSeeder::class);
            $this->call(InvoiceSeeder::class);

            

    }
}
