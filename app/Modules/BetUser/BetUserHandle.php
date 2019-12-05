<?php


namespace App\Modules\BetUser;


use Illuminate\Support\Facades\DB;

trait BetUserHandle
{
    public function getlist($page,$limit){
        $list=DB::table('bet_user')->limit($limit)->offset(($page-1)*$limit)->get();
        return $list;
    }

    public function addBetUser($account,$username,$password,$status){
        $data=[
            'account'=>$account,
            'username'=>$username,
            'password'=>bcrypt($password),
            'status'=>$status
        ];
        $res=DB::table('bet_user')->insert($data);
        return $res;
    }

    public function getBetUser($id){
        $res=DB::table('bet_user')->where('id',$id)->select('id','username','status')->first();
        return $res;
    }
    public function editBetUser($data){
        $res=DB::table('bet_user')->where('id',$data['id'])->update($data);
        return $res;
    }
    public function resetPassword($id,$password){
        $password=bcrypt($password);
        $res=DB::table('bet_user')->where('id',$id)->update(['password'=>$password]);
        return $res;
    }
    public function setIntegral($id,$integral){
        $DB=DB::table('bet_user');
        $cur_int=$DB->where('id',$id)->select('cur_integral')->first();
        $curIntegral=$cur_int->cur_integral+$integral;
        $res=$DB->where('id',$id)->update(['cur_integral'=>$curIntegral]);
        if ($res){
            $status=1;
            $this->recordDetails($id,$status,$integral);
            return $res;
        }else{
            return false;
        }

    }
    public function recordDetails($id,$status=1,$integral){
        if ($status == 1){
            $value='+'.$integral;
        }elseif($status == 0){
            $value='-'.$integral;
        }
        $res=DB::table('int_details')->insert([
            'user_id'=>$id,
            'value'=>$value,
            'created_at'=>date('Y-m-d H:i:s',time()),
            'mode'=>1
        ]);
        return $res;
    }

    public function intDetails($userid,$page,$limit){
        $details=DB::table('int_details');
        if ($userid){
            $details->where('user_id',$userid);
        }
        $data=$details->limit($limit)->offset(($page-1)*$limit)->orderBy('created_at')->get();
        return $data;
    }


}
