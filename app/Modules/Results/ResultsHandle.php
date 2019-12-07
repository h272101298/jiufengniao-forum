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
        $result=$this->getResults();
        $placing=[
            'firstNum'=>$result->firstNum,
            'secondNum'=>$result->secondNum,
            'thirdNum'=>$result->thirdNum,
            'fourthNum'=>$result->fourthNum,
            'fifthNum'=>$result->fifthNum,
            'sixthNum'=>$result->sixthNum,
            'seventhNum'=>$result->seventhNum,
            'eighthNum'=>$result->eighthNum,
            'ninthNum'=>$result->ninthNum,
            'tenthNum'=>$result->tenthNum,

        ];
        $other=[
            'sumFS'=>$result->sumFS,
            'sumBigSamll'=>$result->sumBigSamll,
            'sumSingleDouble'=>$result->sumSingleDouble,
            'firstDT'=>$result->firstDT,
            'secondDT'=>$result->secondDT,
            'thirdDT'=>$result->thirdDT,
            'fourthDT'=>$result->fourthDT,
            'fifthDT'=>$result->fifthDT,
        ];

        $dx=$this->xsdx($placing);
        if ($result->preDrawIssue == $issue){

            $record=DB::table('bet_record')->where('preDrawIssue',$issue)->where('status',0)->get();
            //查询下单的排名
            foreach ($record as $key=>$value){
                $rank=$this->countRanking($value->rankid);
                if ($rank[0]->rank4_id == 23 ){
                    $singleid=$this->getRankid('单');
                    $double=$this->getRankid('双');
                    $bigid=$this->getRankid('大');
                    $samllid=$this->getRankid('小');
                    $Did=$this->getRankid('龙');
                    $Tid=$this->getRankid('虎');
                    switch ($rank[0]->rank3_id){
                        case 1:
                            break;
                        case 10:
                            $mode=$this->dxMode($dx[0],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 11:
                            $mode=$this->dxMode($dx[1],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 12:
                            $mode=$this->dxMode($dx[2],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 13:
                            $mode=$this->dxMode($dx[3],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 14:
                            $mode=$this->dxMode($dx[4],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 15:
                            $mode=$this->dxMode($dx[5],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 16:
                            $mode=$this->dxMode($dx[6],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 17:
                            $mode=$this->dxMode($dx[7],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 18:
                            $mode=$this->dxMode($dx[8],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        case 19:
                            $mode=$this->dxMode($dx[9],$rank[0]->rank2_id,$singleid,$double);
                            break;
                        default:
                            $mode=2;
                    }
                }
                if ($rank[0]['rank4_id'] == 24 ){

                }
                if ($rank[0]['rank4_id'] == 25 ){

                }
                if ($rank[0]['rank4_id'] == 26 ){

                }

            }
            //计算排名是否中奖
            //计算积分情况
        }
    }
    public function xsdx($result){
        $single=[1,3,5,7,9];
        $double=[2,4,6,8,10];
        foreach ($result as $key=>$value){
            if (in_array($value,$single,true)){
                $dx[]=1;
            }elseif(in_array($value,$double,true)){
                $dx[]=2;
            }
        };
        return $dx;
    }
    public function xsbs($result){
        $big=[6,7,8,9,10];
        $samll=[1,2,3,4,5];
        foreach ($result as $key=>$value){
            if (in_array($value,$big)){
                $dx[]='大';
            }elseif(in_array($value,$samll)){
                $dx[]='小';
            }
        };
        return $dx;
    }
    public function dxMode($dx,$rank_id,$singleid,$double){
        switch ($rank_id){
            case in_array($rank_id,$singleid):
                if ($dx == 1){
                    $mode=1;
                }else{
                    $mode=2;
                }
                break;
            case in_array($rank_id,$double):
                if ($dx == 2){
                    $mode=1;
                }else{
                    $mode=2;
                }
                break;
            default:
                $mode=2;
        }
        return $mode;
    }
    public function getRankid($key){
        $id=DB::table('ranking')->where('rank_name',$key)->select('id')->get()->toArray();
        foreach ($id as $key=>$value){
            $arr[]=$value->id;
        }
        return $arr;
    }
    public function countRanking($rankid){
        $rank=DB::select("SELECT rank1.id as rank1_id,rank1.rank_name as rank1_rank_name,rank1.pid as rank1_pid,rank1.`level` as rank1_level,rank2.id as rank2_id,rank2.rank_name as rank2_rank_name,rank2.pid as rank2_pid,rank2.`level` as rank2_level,rank3.id as rank3_id,rank3.rank_name as rank3_rank_name ,rank3.pid as rank3_pid,rank3.`level`as rank3_level,rank4.id as rank4_id,rank4.rank_name as rank4_rank_name,rank4.pid as rank4_pid,rank4.`level` as rank4_level
FROM ranking AS rank1,ranking AS rank2,ranking AS rank3,ranking AS rank4 WHERE rank1.id = ".$rankid." AND rank1.pid = rank2.id AND rank2.pid = rank3.id AND rank3.pid = rank4.id;
");

        return $rank;
    }

}
