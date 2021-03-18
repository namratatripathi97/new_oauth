<?php

use Illuminate\Database\Seeder;
use App\Task;

class CreateTask extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tasks = [
            [
                'task' => 'It will run every minute',
                'type' => 'everyMinute',
                'frequency' => 'everyMinute'
            ],
            [
                'task' => 'It will run every five minute',
                'type' => 'everyFiveMinutes',
                'frequency' => 'everyFiveMinutes'
            ],
            [
                'task' => 'It will run daily',
                'type' => 'daily',
                'frequency' => 'daily'
            ],
            [
                'task' => 'It will run every month',
                'type' => 'monthly',
                'frequency' => 'monthly'
            ]
        ];
        foreach ($tasks as $key => $task) {
            Task::create($task);
        }
    }
}
