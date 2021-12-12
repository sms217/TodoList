<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','todo'];
    
    public function user(){
        /* User <-> Post의 relationship
                    1 : N
                User는 hasMany posts
                Post는 belongs to a User
        
         */
        return $this->belongsTo(User::class, "user_id");
    }
}