<?php
class Role extends Eloquent
{
    public function users()
    {
        return $this->belongsToMany('User');
    }
        
    public function hasUser($key) {
        foreach($this->users as $user){
            if ($user->name === $key) {
                return true;
            }
        }
        return false;
    }
}