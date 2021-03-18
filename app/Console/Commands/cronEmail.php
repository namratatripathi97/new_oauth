<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use App\User;
use DB;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        
        // 
         

        // $words = [
        //     'aberration' => 'a state or condition markedly different from the norm',
        //     'convivial' => 'occupied with or fond of the pleasures of good company',
        //     'diaphanous' => 'so thin as to transmit light',
        //     'elegy' => 'a mournful poem; a lament for the dead',
        //     'ostensible' => 'appearing as such but not necessarily so'
        // ];
         
        // // Finding a random word
        // $key = array_rand($words);
        // $value = $words[$key];
         
        // $users = User::all();
        // foreach ($users as $user) {
        //     Mail::raw("{$key} -> {$value}", function ($mail) use ($user) {
        //         $mail->from('namratatripathi36@gmail.com');
        //         $mail->to($user->email)
        //         ->subject('Word of the Day');
        //     });
        // }
         

         //insert data in database 

          // DB::table('tasks')->insert(['task'=>'it will run every minutes','type'=>'everyMinute','frequency'=>'everyMinute']);


/// update data in data base
        // DB::table('tasks')
        //     ->where('id', 1)
        //     ->update(['type' => str_random(10)]);


// insert dyanamiclly 

         $holddata=array('task'=>'every minutes','type'=>'everyMonth','frequency'=>'everyMonth');
         DB::table('tasks')->insert($holddata);
         echo "Created \n";

        $this->info('Insert data successfully');
    }
}
