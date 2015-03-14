<?php

class ProjectNews extends Eloquent {
	
        protected $table = 'project_news';
        //protected $fillable = [];
        
        public function post()
          {
            return $this->belongsTo('Project');
          }
        
}