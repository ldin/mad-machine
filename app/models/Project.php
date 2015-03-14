<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Project extends \Eloquent {
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function category()
    {
       return $this->belongsTo('Category');
    }

    public function news()
    {
        return $this->hasMany('ProjectNews');
    }

    public function events()
    {
        return $this->hasMany('ProjectEvent');
    }

    public function comments()
    {
        return $this->hasMany('ProjectComment');
    }

    public function about()
    {
        return $this->hasOne('ProjectAbout');
    }

    public function stage()
    {
        return $this->hasOne('Stage');
    }

//    public function users()
//      {
//        return $this->hasMany('ProjectUsers');
//      }


}
