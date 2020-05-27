<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'category', 'made_in', 'user_id'
    ];

    public static $rules = [
        'title' => 'required|string|min:3|max:100',
        'description' => 'required|string|min:3|max:10000',
        'label' => 'image|max:2048',
        'category' => 'required|string|min:3|max:100',
        'made_in' => 'required|string|min:3|max:100',
    ];

    public function file()
    {
        return $this->hasOne(File::class);
    }
}
