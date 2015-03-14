<?php

class ProjectComment extends Eloquent {
	
        protected $table = 'project_comments';
        //protected $fillable = [];
        
        public function post()
          {
            return $this->belongsTo('Project');
          }
        public function user()
        {
          return $this->belongsTo('User');
        }
        
}