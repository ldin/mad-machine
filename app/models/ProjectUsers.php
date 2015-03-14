<?php

class ProjectUsers extends \Eloquent {
        protected $table = 'project_users';
	protected $fillable = [];
        
        public function hasManagerProgect() {
            if ($this->connect == 1 && ($this->is_admin == (2 || 3)) ) {
                return true;
            }
            return false;
        }        
        
}