<?php

namespace App\Console\Commands;

use App\Models\Onu;
use Illuminate\Console\Command;
use Log;
class CatvState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:catv-state {olt} {onu_index} {mac}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set CATV State then become online';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        $onu=Onu::where('mac','LIKE',strtoupper($this->argument('mac')))->first();
        if($onu){
            Log::debug("ONU ".$onu->mac);
        }else 
        {
            Log::debug("ONU ".$this->argument('mac')." Not found in database");
        }
    }
}
