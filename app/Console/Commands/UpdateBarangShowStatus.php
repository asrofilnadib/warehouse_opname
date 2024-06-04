<?php

namespace App\Console\Commands;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateBarangShowStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-barang-show-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that shows status of barang based on expired date';

    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        Barang::where('expired_at', '<', $now)->update(['show' => 0]);
        Barang::where('expired_at', '>=', $now)->update(['show' => 1]);

        $this->info('Item show status update successfully');
    }
}
