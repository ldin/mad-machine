<?php

class ProjectEvent extends \Eloquent {
        protected $table = 'project_events';
	//protected $fillable = [];
        
        public function post()
          {
            return $this->belongsTo('Project');
          }
}