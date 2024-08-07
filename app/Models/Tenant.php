<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory;
    use SoftDeletes;
    //protected $dates = ['deleted_at'];
    protected $dates = ['duedate'];
    protected $table = 'tenant';
    protected $fillable = [
        'id ',
       'tenant_name',
       'property_id',
       'address',
       'contact_number',
       'tenant_no',
       'carpark',
       'rate',
       'period',
       'duedate',
       'contracts',
       'id1',
       'id2',
       'status',
       'created_at',
       'deleted_at',
       'updated_at',
      
   ];
   public function property(){
    return $this->belongsTo('App\Models\Property','property_id');
}
public function paymenttenants()
    {
        return $this->hasMany(PaymentTenant::class, 'tenant_id');
    }
    public static function IDGenerator($model,$trow,$length = 4, $prefix){
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.$zeros.$last_number;
    }
}
