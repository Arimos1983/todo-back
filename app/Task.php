<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'priority', 'done', 'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public static function taskValidationRules($request){
       return $request->validate([
        'title' => 'required|max:255',
        'description' => 'required|max:1000',
        'priority' => 'required'
        ]);
    }

    
}
