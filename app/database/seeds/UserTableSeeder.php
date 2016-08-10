<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserTableSeeder extends Seeder {
    
    
    
    public function run() {
    

        
         \DB::beginTransaction();
        
        try{
            
       
        
        \DB::table('users')->truncate();
        
        for ($i = 0; $i < 5; $i++) {
            
            $user = User::create([
                        'name' => str_random(5),
                        'surname' => str_random(5),
                        'username' => 'user'.$i,
                        'password' => hash('sha512','root')
                    ]);
        
         };
            
       
    }catch (Exception $ads) 
    {
        DB::rollback();
    }

}
}
