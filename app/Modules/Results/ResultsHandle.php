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
                if ($res){
                    $this->countResults($data['preDrawIssue']);
                }
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
        $count=0;
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
        $bs=$this->xsbs($placing);
        $str='';
        //$a=$this->placMode(17,354,338);

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
                            $mode=$this->sumMode($other,$rank[0]->rank2_id);
                            break;
                        case 10:
                            $mode=$this->lmpMode($dx[0],$bs[0],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$other['firstDT'],$Did,$Tid);
                            break;
                        case 11:
                            $mode=$this->lmpMode($dx[1],$bs[1],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$other['secondDT'],$Did,$Tid);
                            break;
                        case 12:
                            $mode=$this->lmpMode($dx[2],$bs[2],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$other['thirdDT'],$Did,$Tid);
                            break;
                        case 13:
                            $mode=$this->lmpMode($dx[3],$bs[3],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$other['fourthDT'],$Did,$Tid);
                            break;
                        case 14:
                            $mode=$this->lmpMode($dx[4],$bs[4],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$other['fifthDT'],$Did,$Tid);
                            break;
                        case 15:
                            $mode=$this->lmpMode($dx[5],$bs[5],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$str,$Did,$Tid);
                            break;
                        case 16:
                            $mode=$this->lmpMode($dx[6],$bs[6],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$str,$Did,$Tid);
                            break;
                        case 17:
                            $mode=$this->lmpMode($dx[7],$bs[7],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$str,$Did,$Tid);
                            break;
                        case 18:
                            $mode=$this->lmpMode($dx[8],$bs[8],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$str,$Did,$Tid);
                            break;
                        case 19:
                            $mode=$this->lmpMode($dx[9],$bs[9],$rank[0]->rank2_id,$singleid,$double,$bigid,$samllid,$str,$Did,$Tid);
                            break;
                        default:
                            $mode=2;
                    }
                }
                if ($rank[0]->rank4_id == 24 ){
                    switch ($rank[0]->rank3_id){
                        case 128:
                            $mode=$this->placMode($placing['firstNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 129:
                            $mode=$this->placMode($placing['secondNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 130:
                            $mode=$this->placMode($placing['thirdNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 131:
                            $mode=$this->placMode($placing['fourthNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 132:
                            $mode=$this->placMode($placing['fifthNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 133:
                            $mode=$this->placMode($placing['sixthNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 134:
                            $mode=$this->placMode($placing['seventhNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 135:
                            $mode=$this->placMode($placing['eighthNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 136:
                            $mode=$this->placMode($placing['ninthNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 137:
                            $mode=$this->placMode($placing['tenthNum'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                        case 338:
                            $mode=$this->placMode($other['sumFS'],$rank[0]->rank2_id,$rank[0]->rank3_id);
                            break;
                    }
                }
                $user=DB::table('bet_user')->where('id',$value->userid)->first();
                if (isset($mode) && $mode == 1){
                    $odds=number_format($rank[0]->rank1_rank_name,3);
                    $price=$value->price;
                    $int=$odds * $price;
                    $update=DB::table('ranking')->where("id",$value->id)->update(['status'=>1]);
                    if ($update){
                        $cur_integral=$user->cur_integral + $int;
                        DB::table('bet_user')->where('id',$value->userid)->update(['cur_integral'=>$cur_integral]);
                        DB::table('int_details')->insert([
                            'user_id'=>$value->userid,
                            'value'=>"+".$int,
                            'mode'=>0,
                            'created_at'=>getDatetime(time())
                        ]);
                    }
                }elseif(isset($mode) && $mode == 2){
                    $update=DB::table('bet_user')->where('id',$value->id)->update(["status"=>2]);
                    if ($update){
                        DB::table('int_details')->insert([
                            'user_id'=>$value->userid,
                            'value'=>"-".$value->price,
                            'mode'=>0,
                            'created_at'=>getDatetime(time())
                        ]);
                    }

                }
                $count=$count+1;
            }
            return $count;
        }
    }
    public function xsdx($result){
        foreach ($result as $key=>$value){
            /* if (in_array($value,$single,true)){
                 $dx[]=1;
             }elseif(in_array($value,$double,true)){
                 $dx[]=2;
             }*/
            if ($value%2 === 1){
                $dx[]=1;
            }elseif($value%2 === 0){
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
    public function placMode($plac,$rank_id,$rank_pid){
        $placid=DB::table('ranking')->where('pid',$rank_pid)->where('rank_name','like',$plac."%")->first();
        if ($placid->id == $rank_id){
            return $mode=1;
        }else{
            return $mode=2;
        }
    }
    public function sumMode($other,$rank_id){
        $sumid=DB::table('ranking')->where('pid',1)->select('id')->get()->toArray();
        foreach ($sumid as $key=>$value){
            $arrid[]=$value->id;
        }
        if (in_array($rank_id,$arrid)){
            switch ($rank_id){
                case 2:
                    if ($other['sumBigSamll'] == 0){
                        $mode=1;
                    }else{
                        $mode=2;
                    }
                    break;
                case 3:
                    if ($other['sumBigSamll'] == 1){
                        $mode=1;
                    }else{
                        $mode=2;
                    }
                    break;
                case 4:
                    if ($other['sumSingleDouble'] == 0){
                        $mode=1;
                    }else{
                        $mode=2;
                    }
                    break;
                case 8:
                    if ($other['sumSingleDouble'] == 1){
                        $mode=1;
                    }else{
                        $mode=2;
                    }
                    break;
                default:$mode=2;
            }
            return $mode;
        }else{
            return $mode=2;
        }
    }
    public function lmpMode($dx,$rank_id,$singleid,$double,$bigid,$samllid,$other="",$Did,$Tid){
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
            case in_array($rank_id,$bigid):
                if ($dx == '大'){
                    $mode=1;
                }else{
                    $mode=2;
                }
                break;
            case in_array($rank_id,$samllid):
                if ($dx == '小'){
                    $mode=1;
                }else{
                    $mode=2;
                }
                break;
            case in_array($rank_id,$Did) && !empty($other):
                if ($other == 0){
                    $mode=1;
                }else{
                    $mode=2;
                }
                break;
            case in_array($rank_id,$Tid) && !empty($other):
                if ($other == 1){
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
