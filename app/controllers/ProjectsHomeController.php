<?php

class ProjectsHomeController extends \BaseController {

        public function __construct()
        {
            $this->beforeFilter('auth', array('except' => array('getIndex', 'getSearch')));
        }


	public function getIndex()
	{
            $category = Category::get(array('id', 'name'));
            // if(Auth::check()){
            //     $projects =  DB::table('projects')
            //             ->leftJoin('project_users', function ($join) {
            //                 $join->on('projects.id', '=', 'project_users.project_id')
            //                       ->where('project_users.user_id', '=', Auth::user()->id);
            //             })


            //             ->where('projects.deleted_at', NULL)
            //             ->select('projects.name',  'projects.slug',  'projects.id', 'project_users.connect', 'project_users.watch')
            //             ->paginate(10);
            // }else{
            //     $projects =  DB::table('projects')
            //         ->where('projects.deleted_at', NULL)
            //         // ->select('projects.name', 'projects.shortText', 'projects.slug', 'projects.logo', 'projects.id', 'project_users.connect', 'project_users.watch')
            //         ->select('projects.name', 'projects.slug', 'projects.id')
            //         ->paginate(10);
            // }
            $projects = Project::paginate(10);

            $groupcat[''] = '';    //массив категорий для поиска
            foreach ($category as $val){
                $groupcat[$val->id] = $val->name;
            }
            $stages_all = Stage::get(array('id', 'name'));
            foreach ($stages_all as $val){
                $stages[$val->id] = $val->name;
            }
            // var_dump($projects[0]['stage']);
            $view = array(
                'projects' => $projects,
                'groupcat' => $groupcat,
                'stages' => $stages,
             );
            return View::make('home.projects.projects', $view);
	}

	public function getProject($slug)
	{
            $slug = BaseController::validateSlug($slug);
            $project = Project::where('slug', '=', $slug)->first();
            $projectUser = ProjectUsers::where('project_id', '=', $project->id)->where('user_id', '=', Auth::user()->id)->first();
            $project->connect = ($projectUser ? $projectUser->connect : 0);
            $project->watch = ($projectUser ? $projectUser->watch : 0);
            $lastdate =  date('Y-m-d');

            $stages_all = Stage::get(array('id', 'name'));
            foreach ($stages_all as $val){
                $stages[$val->id] = $val->name;
            }

            foreach($project['events'] as $val){
                if($lastdate > $val->start){
                    $lastdate = $val->start;
                }
            }

            if($budget = ProjectBudget::where('project_id', '=', $project->id)->first()){
                $budget = json_decode($budget->budget, true);
            }
            else{
                $budget = array();
            }
            $json = null;
            if(count($project['events'])>0){
                foreach($project['events'] as $k=>$val){
                   $event[$k]['name']=$val->name;
                   $event[$k]['part']=$val->part;
                   $event[$k]['text']=$val->text;
                   $event[$k]['data']=$val->start." - ".$val->end;
                }
                $json = json_encode($event);
            }


            $view = array(
                'project' => $project,
                'lastdate' => $lastdate,
                'budget' => $budget,
                'json' => $json,
                'stages' => $stages,
             );
            return View::make('home.projects.project', $view);
	}

        public function postAddComment($project_id){
            $all = Input::all();
            $comment = new ProjectComment;
            $comment->project_id = $project_id;
            $comment->user_id = $all['user_id'];
            $comment->text = $all['comment'];
            $comment->status = '1';
            $comment->save();
        }

        public function postCommentDelete(){
            $all = Input::all();
            $comment = ProjectComment::find($all['com_id']);
            if($comment->user_id==$all['user_id']){
                $comment->delete();
            }
        }

        public function postWatch(){
            $all = Input::all();
            $post = ProjectUsers::where('project_id', '=', $all['project_id'])->where('user_id', '=', $all['user_id'])->first();
            if(!$post){
                $post = new ProjectUsers;
                $post->project_id=$all['project_id'];
                $post->user_id=$all['user_id'];
            }
            $post->watch = $all['watch'];
            $post->save();

        }

        public function postConnect(){
            $all = Input::all();
            $post = ProjectUsers::where('project_id', '=', $all['project_id'])->where('user_id', '=', $all['user_id'])->first();
            if(!$post){
                $post = new ProjectUsers;
                $post->project_id=$all['project_id'];
                $post->user_id=$all['user_id'];
            }
            $post->connect = $all['connect'];
            $post->save();

        }

  public function getSearch(){
        $all = Input::all();
        $auth = Auth::check();
        // var_dump($all); die();

        $request =  DB::table('projects');
        //var_dump($auth); die();
        $request->leftJoin('project_about', 'projects.id', '=', 'project_about.project_id');

        if($auth){
            $request->leftJoin('project_users', function ($join) {
              $join->on('projects.id', '=', 'project_users.project_id')
                    ->where('project_users.user_id', '=', Auth::user()->id);
            });
        }
        $request->where(function($query) use($all, $auth){

            if($all['to']&&$all['from']){
                $query->whereBetween('project_about.needInvest', array($all['from'], $all['to']));
            }
            elseif($all['to']){
                $query->where('project_about.needInvest', '<', $all['to']);
            }
            elseif($all['from']){
                $query->where('project_about.needInvest', '>', $all['from']);
            }

            if(isset($all['stage'])){
                $k=0;
                foreach ($all['stage'] as $stage) {
                    if($k==0){
                        $query->where('project_about.stage_id',$stage); $k++;
                    }else{
                        $query->orWhere('project_about.stage_id',$stage);
                    }
                }
            }



        })

        // $request->where(function($query) use($all, $auth){
        //         if($all['connect'] && $auth){
        //             if($all['connect']==1){
        //                 $query->where('connect', '=', 1);
        //             }elseif ($all['connect']==2) {
        //                 $query->where('watch', '=', 1);
        //             }
        //         }
        //         if($all['category']){
        //             $query->where('category_id', '=', $all['category']);
        //         }
        //         if($all['keyword']){
        //             $keywords = $all['keyword'];
        //             $keywords = trim($keywords);
        //             $keywords = mysql_real_escape_string($keywords);
        //             $keywords = htmlspecialchars($keywords);
        //             if (!empty($keywords)){
        //                 $query->where('text', 'like', '%'.$keywords.'%')
        //                     ->orWhere('name', 'like', '%'.$keywords.'%')
        //                     ->orWhere('shortText', 'like', '%'.$keywords.'%');
        //             }

        //         }
        //     })
            ->where('projects.deleted_at', NULL);
            if($auth){
                $request->select('projects.*','project_about.*', 'project_users.connect', 'project_users.watch');
            }
            else{
                $request->select('projects.*','project_about.*');
            }



        $projects = $request->paginate(10);

        foreach ($projects as $key=>$value) {
            $projects[$key]->about['mart']=$value->mart;
            $projects[$key]->about['logo']=$value->logo;
            $projects[$key]->about['shortText']=$value->shortText;
            $projects[$key]->about['irr']=$value->irr;
            $projects[$key]->about['pi']=$value->pi;
            $projects[$key]->about['npv']=$value->npv;
            $projects[$key]->about['needInvest']=$value->needInvest;
            $projects[$key]->about['keyFactors']=$value->keyFactors;
            $projects[$key]->about['stage_id']=$value->stage_id;
            $projects[$key]->about['stageComment']=$value->stageComment;
        }

 // var_dump($projects[0]);die();

        $category = Category::get();

        $groupcat[''] = '';
        foreach ($category as $val){
            $groupcat[$val->id] = $val->name;
        }
        $stages_all = Stage::get(array('id', 'name'));
        foreach ($stages_all as $val){
            $stages[$val->id] = $val->name;
        }

        unset($all['page']);

        $view = array(
            'projects' => $projects,
            'groupcat' => $groupcat,
            'stages' => $stages,
            'old' => $all,
         );
        return View::make('home.projects.projects', $view);
    }


}
