<? php
    use Illuminate\Database\Seeder;
    class WebshopSeeder extends Seeder {
        public function run() {
            
            $cms_webshop = array(
                array (
                    'id' => 17,
                    'item_id'=>'100601243',
                    'level'=>'65',
                    'name'=>'Custodian's Grimoire',
                    'type'=>'Spellbook',
                    'category_id'=>'5',
                    'amount'=>'1',
                    'price'=>'80',
                    'enchant'=>'0',
                    'temperance'=>'0'
                )
                
            );
            
            DB::table('cms_webshop')->insert($cms_webshop);
            
        }
    }