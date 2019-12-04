<?php


namespace App\Modules\Record;


use Illuminate\Support\Facades\DB;

trait RecordHandle
{

    public function listRecord($preDrawIssue,$page,$limit){
        $db=DB::table('bet_record');
        if ($preDrawIssue){
            $db->where('preDrawIssue',$preDrawIssue);
        }
        $record=$db->limit($limit)->offset(($page-1)*$limit)->orderBy('created_at')->get();

        foreach ($record as $key=>$value){
            $user=DB::table('bet_user')->where('id',$value->userid)->first();

            $record[$key]->username=$user->username;
        }
        return $record;

    }

    public function getPreDrawIssue(){
        $preDrawIssue=DB::table('results')->select('preDrawIssue')->get()->toArray();
        return $preDrawIssue;
    }

    public function addRecord($user_id,$preDrawIssue,$record){
        $DB=DB::table('bet_record');
        $user=DB::table('bet_user')->where('id',$user_id)->first();
        $int=$user->cur_integral;
        $record=json_decode($record,true);
        foreach ($record['record'] as $key=>$value){
            $data[$value]=[
                'userid'=>$user_id,
                'preDrawIssue'=>$preDrawIssue,
                'rankid'=>$key,
                'price'=>$value,
                'status'=>0,
                'created_at'=>getDatetime(time()),
                'updated_at'=>getDatetime(time())
            ];
        }
        $record_int=array_sum(array_keys($data));
        if ($record_int <= $int){
            $res=$DB->insert($data);
            if ($res){
                var_dump($int);
                var_dump($record_int);
                $int=(float)$int-(float)$record_int;
                dd($int);
                DB::table('bet_user')->where('id',$user_id)->update(['cur_intrgral'=>$int]);
                return $res;
            }
        }else{

            return false;
        }


    }
}
