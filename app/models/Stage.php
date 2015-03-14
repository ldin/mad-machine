<?php
class Stage extends Eloquent
{
    protected $table = 'stage';

    public function projects()
    {
        return $this->belongsToMany('Project');
    }

    // public function hasProject($key) {
    //     foreach($this->projects as $project){
    //         if ($project->stage === $key) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
}
