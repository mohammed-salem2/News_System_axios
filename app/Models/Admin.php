<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory , HasRoles , SoftDeletes;

    public function user(){
        return $this->morphOne(User::class , 'actor' , 'actor_type' , 'actor_id' , 'id');
    }

    public function getImagesAttribute(){
        return $this->user->image ?? ' ';
    }

    // public function getFullNameAttribute(){
    //     return $this->user->first_name ?? ' ' . " " . $this->user->last_name ?? ' ';
    // }
}
