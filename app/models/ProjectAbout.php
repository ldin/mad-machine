<?php

class ProjectAbout extends Eloquent {

        protected $table = 'project_about';
        //protected $fillable = [];

        public function post()
          {
            return $this->belongsTo('Project');
          }

}
