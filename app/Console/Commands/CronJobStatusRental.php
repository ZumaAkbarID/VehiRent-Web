<?php

namespace App\Console\Commands;

use App\Models\Rental;
use App\Models\VehicleSpec;
use Illuminate\Console\Command;

class CronJobStatusRental extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cronjobstatusrental';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron Job for auto update status rental';

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
        // Rejected
        $rejected = Rental::with('vehicleSpec')->where('end_rent_date', '<', date('Y-m-d H:i:s'))->where('vehicle_picked', null)->where('vehicle_returned', null);
        foreach ($rejected->get() as $reject) {
            Rental::find($reject->id)->update(['status' => 'Rejected', 'reason' => "Customer didn't pick the vehicle"]);
            VehicleSpec::find($reject->vehicleSpec->id)->update(['vehicle_status' => 'Available']);
        }

        // Completed but Didn't restore the vehicle
        $rejected = Rental::with('vehicleSpec')->where('end_rent_date', '<', date('Y-m-d H:i:s'))->where('vehicle_picked', '!=', null)->where('vehicle_returned', null);
        foreach ($rejected->get() as $reject) {
            Rental::find($reject->id)->update(['status' => 'Not Restored', 'reason' => "Customer didn't return vehicle to the commpany"]);
        }
    }
}