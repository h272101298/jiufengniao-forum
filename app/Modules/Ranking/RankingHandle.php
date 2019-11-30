<?php


namespace App\Modules\Ranking;


use App\Modules\Ranking\Model\Ranking;
use Illuminate\Support\Facades\DB;

trait RankingHandle
{
    /*public function getParent(){
        $parent=Ranking::where('pid',0)->get();
        return $parent;
    }*/

    public function getTree($data,$fieldId,$fieldPid,$pid=0){
        $arr=[];
        foreach ($data as $key=>$value){
            if ($value[$fieldPid] == $pid){
                $arr[$key]=$value;
                $arr[$key]['child']=self::getTree($data,$fieldId,$fieldPid,$value[$fieldId]);
            }
        }
        return $arr;
    }

    public function addRanking($level,$rankname,$pid){
        $data=[
            'level'=>$level,
            'rank_name'=>$rankname,
            'pid'=>$pid
        ];
        $res=DB::table('ranking')->insert($data);
        return $res;
    }

    public function editRanking($data){
        $res=DB::table('ranking')->where('id',$data['id'])->update($data);
        return $res;
    }

    public function getRanking($id){
        $data=DB::table('ranking')->where('id',$id)->first();
        return $data;
    }



}
