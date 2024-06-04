<?php

namespace App\Jobs;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateExpiredBarang implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $expiredBarang = Barang::where('expired_at', '<', Carbon::now())
          ->where('show', 1)
          ->get();

        foreach ($expiredBarang as $barang) {
          $barang->show = 0;
          $barang->save();
        }
    }
}
