<?php


namespace App\Modules\Results;


use App\Modules\Results\Model\Results;
use Illuminate\Support\Facades\DB;

trait ResultsHandle
{
    public function addResults(){
        $url='https://api.api861861.com/pks/getLotteryPksInfo.do?issue=&lotCode=10057';
        $results=file_get_contents($url);
        if ($results){
            $results=json_decode($results,true);
            $results=$results['result']['data'];
            $db=DB::table('results');
            $check=$db->where('preDrawIssue',$results['preDrawIssue'])->first();
            if(!$check){
                $data=[
                    'preDrawTime'=>$results['preDrawTime'],
                    'preDrawIssue'=>$results['preDrawIssue'],
                    'preDrawCode'=>$results['preDrawCode'],
                    'firstNum'=>$results['firstNum'],
                    'secondNum'=>$results['secondNum'],
                    'thirdNum'=>$results['thirdNum'],
                    'fourthNum'=>$results['fourthNum'],
                    'fifthNum'=>$results['fifthNum'],
                    'sixthNum'=>$results['sixthNum'],
                    'seventhNum'=>$results['seventhNum'],
                    'eighthNum'=>$results['eighthNum'],
                    'ninthNum'=>$results['ninthNum'],
                    'tenthNum'=>$results['tenthNum'],
                    'sumFS'=>$results['sumFS'],
                    'sumBigSamll'=>$results['sumBigSamll'],
                    'sumSingleDouble'=>$results['sumSingleDouble'],
                    'firstDT'=>$results['firstDT'],
                    'secondDT'=>$results['secondDT'],
                    'thirdDT'=>$results['thirdDT'],
                    'fourthDT'=>$results['fourthDT'],
                    'fifthDT'=>$results['fifthDT'],
                    'groupCode'=>$results['groupCode'],
                    'drawTime'=>$results['drawTime'],
                    'drawIssue'=>$results['drawIssue'],
                    'created_at'=>getDatetime(time()),
                ];
                //dd($data);
                $res=DB::table('results')->insert($data);
                return $res;
            }else{
                return false;
            }
        }
    }

    public function listResults($page,$limit){
        $data=DB::table('results')->limit($limit)->offset(($page-1)*$limit)->orderBy('preDrawTime')->get()->toArray();
        return $data;
    }
    public function getResults(){
        $data=DB::table('results')->orderBy('preDrawTime','desc')->first();
        return $data;
    }

    public function countResults($issue){
        $record=DB::table('bet_record')->where('preDrawIssue',$issue)->where('status',0)->get();
        //查询下单的排名
        foreach ($record as $key=>$value){
            $rank=$this->countRanking($value->rankid);
        }
        //计算排名是否中奖
        //计算积分情况

    }

    public function countRanking($rankid){
            $rank=DB::table('ranking')->where('id',$rankid)->first();
    }

}
