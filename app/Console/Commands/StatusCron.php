<?php

namespace App\Console\Commands;

use App\Models\Booked;
use App\Models\VehicleSpec;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StatusCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Update Status';

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
     * @return int
     */
    public function handle()
    {
        $now = date('Y-m-d');

        // Booking Status
        $bookList = Booked::where('status_book', '!=', 'Booked')->get();
        $i = 0;
        foreach ($bookList as $book) {
            if ($now == $book->start_rent_date) {
                $i += 1;
                Booked::find($book->id)->update(['status_book', 'Expired']);
                VehicleSpec::find($book->id_vehicle)->update(['status', 'Not Available']);
            }
        }

        Log::info("Cron is working fine! $i item changed");
        return 0;
    }
}