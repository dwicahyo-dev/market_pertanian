<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Agriculture;

class inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire:minute';

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
        Agriculture::create([
            'commodity_id' => 1,
            'agriculture_name' => 'Test1',
        ]);

        $this->info('Word of the Day sent to All Users');
    }
}
