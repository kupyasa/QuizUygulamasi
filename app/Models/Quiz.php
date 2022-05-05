<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','finished_at','status','slug'];
    
    protected $dates = ['finished_at'];

    protected $appends = ['details','my_rank'];

    public function questions(){
        return $this->hasMany(Question::class);
    }
  
    public function topTen(){
        return $this->results()->orderByDesc('point')->take(10);
    }
    
    public function my_result(){
        return $this->hasOne(Result::class)->where([['user_id','=',auth()->user()->id]]);
    }
    public function results(){
        return $this->hasMany(Result::class);
    }
    public function getDetailsAttribute(){
        
        if ($this->results()->count() > 0) {
            return [
                'avarage_point' => round($this->results()->avg('point')),
                'participants'  => $this->results()->count()
            ];
        }
        return null;
    }

    public function getMyRankAttribute(){      
        $rank = 0;
        foreach ($this->results()->orderByDesc('point')->get() as  $result) {
           $rank++;
           if (auth()->user()->id === $result->user_id) {
               return $rank;
           }
        }
    }

    public function getFinishedAtAttribute($date) {
        return $date ? Carbon::parse($date) : null;
    }
}
