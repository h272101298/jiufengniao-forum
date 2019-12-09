<?php

namespace App\Console\Commands;

use App\Modules\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Modules\Results\ResultsHandle;
use Illuminate\Support\Facades\Log;

class Results extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:make';

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
        $url = 'https://api.api861861.com/pks/getLotteryPksInfo.do?issue=&lotCode=10057';
        $results = file_get_contents($url);
        $time=date('Y-m-d H:i:s',time());
        Log::info($time."执行成功");
        if ($results) {
            $results = json_decode($results, true);
            $results = $results['result']['data'];
            $db = DB::table('results');
            $check = $db->where('preDrawIssue', $results['preDrawIssue'])->first();
            if (!$check) {
                $data = [
                    'preDrawTime' => $results['preDrawTime'],
                    'preDrawIssue' => $results['preDrawIssue'],
                    'preDrawCode' => $results['preDrawCode'],
                    'firstNum' => $results['firstNum'],
                    'secondNum' => $results['secondNum'],
                    'thirdNum' => $results['thirdNum'],
                    'fourthNum' => $results['fourthNum'],
                    'fifthNum' => $results['fifthNum'],
                    'sixthNum' => $results['sixthNum'],
                    'seventhNum' => $results['seventhNum'],
                    'eighthNum' => $results['eighthNum'],
                    'ninthNum' => $results['ninthNum'],
                    'tenthNum' => $results['tenthNum'],
                    'sumFS' => $results['sumFS'],
                    'sumBigSamll' => $results['sumBigSamll'],
                    'sumSingleDouble' => $results['sumSingleDouble'],
                    'firstDT' => $results['firstDT'],
                    'secondDT' => $results['secondDT'],
                    'thirdDT' => $results['thirdDT'],
                    'fourthDT' => $results['fourthDT'],
                    'fifthDT' => $results['fifthDT'],
                    'groupCode' => $results['groupCode'],
                    'drawTime' => $results['drawTime'],
                    'drawIssue' => $results['drawIssue'],
                    'created_at' => getDatetime(time()),
                ];
                //dd($data);
                $inster=DB::table('results')->insert($data);
                if ($inster){
                    $user=new User();
                    $user->countResults($data["preDrawIssue"]);
                }

            }
        }
    }
}
