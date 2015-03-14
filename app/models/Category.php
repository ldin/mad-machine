<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends \Eloquent {
    use SoftDeletingTrait;
        protected $table = 'category';
	protected $fillable = [];
        protected $dates = ['deleted_at'];
        protected $softDelete = true;
        
        public function projects()
        {
          return $this->hasMany('Project');
        }
}