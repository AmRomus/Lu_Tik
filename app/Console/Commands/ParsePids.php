<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\HtmlNode;
class ParsePids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-pids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dom = new Dom();
        $channels_table= new Dom();
        $channels_rows = new Dom();
        $dom->loadFromUrl('https://www.lyngsat.com/packages/NTV-Plus.html');
        $tables = $dom->getElementsByTag("table");
       
        $tbls=1;
        foreach($tables as $item){
           
            $this->info("Table: ".$tbls);
            $tbls++;
            $it=$item->find(".td-copyright");
            if($it->getParent()->getParent()!=null){
                $channels_table->loadStr($it->getParent()->getParent()->outerHtml);
                $rows= $channels_table->getElementsByTag("tr");
                $r=1;
                foreach($rows as $row){
                    $channels_rows->loadStr($row);
                    $items=$channels_rows->getElementsByTag("td");
                    if(count($items)==11){
                        if($r==1){
                            $this->info("Header");
                            $r++;
                        }else {
                            foreach($items as $col){
                                $this->info($col);
                                $this->info($col->innerText."\n");
                            }

                        }
                    }
                    $this->info(count($items));
                 //   dd($channels_rows);
                }
                


            }

            //dd($it->getParent()->getParent()->outerHtml);
          

                // $new_htmnl=$dom->loadStr($item->innerHtml);
                // $inner_tables=$new_htmnl->find("table");
                // $this->info(count($inner_tables));
                // foreach($item as $item_rows){
                //     $item_rows->find("td");
                //     $this->info($item_rows->innerHtml);
                //     $this->info("----------------------------");
                // }
            
            break;
        }
    }
}
