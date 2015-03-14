<?php

class ProjectsController extends \BaseController {

            public function __construct()
        {
            $this->beforeFilter('auth');
        }

	public function index()
	{

            if(Auth::user()->hasRole('mainAdmin')){
                $category = Category::get(array('category.id', 'category.name'));
            }
            else if(Auth::user()->hasRole('admin')){
                $category = Category::
                    leftJoin('category_user', 'category_user.category_id', '=', 'category.id')
                    ->where('category_user.user_id', Auth::user()->id)
                    ->where('category.deleted_at', NULL)
                    ->get(array('category.id', 'category.name'));
            }
            else if( Auth::user()->hasRole('moderator') || Auth::user()->hasRole('manager') ){
                $category = Category::get(array('category.id', 'category.name'));
                foreach ($category as $key=>$cat){
                    $category[$key]['projects'] = DB::table('projects')
                            ->leftJoin('project_users', function ($join) {
                            $join->on('projects.id', '=', 'project_users.project_id')
                                    ->where('project_users.user_id', '=', Auth::user()->id);
                            })
                            ->where('project_users.connect', '1')
                            ->where('projects.category_id', $cat->id)
                            ->where('category.deleted_at', NULL)
                            ->where('projects.deleted_at', NULL)
                            ->get(array('projects.name', 'projects.id'));
                    if(count($category[$key]['projects'])==0){
                        unset($category[$key]);
                    }
                }
            }
            else{
                $category = array();
            }
            $groupcat = array();
            if($category){
                foreach ($category as $val){
                    $groupcat[$val->id] = $val->name;
                }
            }
            $stages_all = Stage::get(array('id', 'name'));
            foreach ($stages_all as $val){
                $stages[$val->id] = $val->name;
            }

            $view = array(
                'groupcat' => isset($groupcat)?$groupcat:array(),
                'category' => $category,
                'stages' => $stages,
             );
            return View::make('admin.projects.projects', $view);
	}

        public function show($id)
	{
            $id = (int)($id);

//            $isadmin = ProjectUsers::where('user_id', Auth::user()->id)->first();

            if(Auth::user()->hasRole('mainAdmin')){
                $category = Category::get(array('category.id', 'category.name'));
                $post = true;
            }
            else if(Auth::user()->hasRole('admin')){
                $category = Category::
                    leftJoin('category_user', 'category_user.category_id', '=', 'category.id')
                    ->where('category_user.user_id', Auth::user()->id)
                    ->where('category.deleted_at', NULL)
                    ->get(array('category.id', 'category.name'));
                $category_project = Project::select('category_id')->find($id);
                if(isset($category_project) && Auth::user()->hasCategory($category_project->category_id)){
                    $post = true;
                }

            }
            else if( Auth::user()->hasRole('moderator') || Auth::user()->hasRole('manager') ){
                $category = Category::get(array('category.id', 'category.name'));
                foreach ($category as $key=>$cat){
                    $category[$key]['projects'] = DB::table('projects')
                            ->leftJoin('project_users', function ($join) {
                            $join->on('projects.id', '=', 'project_users.project_id')
                                    ->where('project_users.user_id', '=', Auth::user()->id);
                            })
                            ->where('project_users.connect', '1')
                            ->where('projects.category_id', $cat->id)
                            ->where('projects.deleted_at', NULL)
                            ->get(array('projects.name', 'projects.id'));
                    if(count($category[$key]['projects'])==0){
                        unset($category[$key]);
                    }
                }
                $connect = 0;
                if($connect = ProjectUsers::where('project_id', $id)->where('user_id', Auth::user()->id)->first()){
                    if($connect->hasManagerProgect()){
                        $post = true;
                    }

                }

            }
            else{
                $category = array();
            }
            $groupcat = array();
            if($category){
                foreach ($category as $val){
                    $groupcat[$val->id] = $val->name;
                }
            }
            $stages_all = Stage::get(array('id', 'name'));
            foreach ($stages_all as $val){
                $stages[$val->id] = $val->name;
            }

            if(!isset($post) || !$post){
                return Redirect::to('/admin/project/')
                        ->with('error', 'Ошибка доступа');
            }
            if($post == true){
                $post = Project::find($id);
                // $post = DB::table('projects')->where('projects.id', $id)->leftJoin('project_about', 'projects.id', '=', 'project_about.project_id')->first();
                // var_dump($id, $post, $post['about']);
            }
            if($budget = ProjectBudget::where('project_id', '=', $id)->first()){
                $budget = json_decode($budget->budget, true);
            }
            else{
                $budget = array('2'=>array('0'=>''),'3'=>array('0'=>''),'4'=>array('0'=>''),'5'=>array('0'=>''),'6'=>array('0'=>''));
            }

            $users = DB::table('users')
                    ->leftJoin('project_users', 'users.id', '=', 'project_users.user_id')
                    ->where('project_users.project_id', '=', $id)
                    ->orderBy('project_users.connect', 'desc')
                    ->select('users.id', 'users.name', 'project_users.connect', 'project_users.watch', 'project_users.comment')
                    ->get();

            foreach($post['events'] as $k=>$val){
               $event[$k]['name']=$val->name;
               $event[$k]['part']=$val->part;
               $event[$k]['text']=$val->text;
               $event[$k]['data']=$val->start." - ".$val->end;
            }
            $json = (isset($event)) ? json_encode($event) : null;
            // var_dump($json);

            $view = array(
                'category' => $category,
                'row' => $post,
                'groupcat' => $groupcat,
                'budget' => $budget,
                'stages' => $stages,
                'users' => $users,
                'json' => $json
             );
            return View::make('admin.projects.projects', $view);

	}

        public function postDescription($id='')
        {

            $all = Input::all();
            // var_dump($all); die();
            if(!$all['slug']) {$all['slug'] = BaseController::ru2Lat($all['name']);}
            $rules = array(
                'name' => 'required|min:2|max:255',
                'title' => 'required|min:3|max:255',
                //'slug'  => 'required|min:4|max:255|alpha_dash',
                'slug'  => 'required|min:4|max:255|alpha_dash|unique:posts,slug',
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/project/'.$id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($id)   {
                  $post = Project::find($id);
            }
            else {
                $post = new Project();
            }

            $post->name = $all['name'];
            $post->title = $all['title'];
            $post->slug = $all['slug'];
            $post->category_id = $all['category'];
            $post->description = $all['description'];
            $post->keywords = $all['keywords'];
            $post->save();

            $postAbout = ProjectAbout::where('project_id',$id)->first();
            if(!$postAbout){
                $postAbout = new ProjectAbout();
                $postAbout->project_id = $id;
            }
            $postAbout->text = $all['text'];
            $postAbout->shortText = $all['shortText'];
            $postAbout->mart = $all['market'];
            $postAbout->stage_id = $all['stage_id'];
            $postAbout->stageComment = $all['stageComment'];
            $postAbout->needInvest = $all['needInvest'];
            $postAbout->irr = $all['irr'];
            $postAbout->pi = $all['pi'];
            $postAbout->npv = $all['npv'];
            if(isset($all['keyFactors'])&&$all['keyFactors']){
                $postAbout->keyFactors = json_encode($all['keyFactors']);
            }

            if(isset($all['image'])){
                $full_name = Input::file('image')->getClientOriginalName();
                $filename=$full_name;
                $path = 'upload/logo/';
                Input::file('image')->move($path, $filename);
                $postAbout->logo = $path.$filename;
            }

            $postAbout->save();

            return Redirect::to('/admin/project/'.$id)
                    ->with('success', 'Изменения сохранены');
        }

        public function postEvent($project_id, $event_id='')
        {
            $all = Input::all();
            $all['slug'] = BaseController::ru2Lat($all['name']);
            $rules = array(
                'name' => 'required|min:2|max:255',
                'start'=>'required',
                'end'=>'required',
                'part'=>'required'
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/project/'.$project_id.'#event')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($event_id)   {
                  $post = ProjectEvent::find($event_id);
            }
            else {
                $post = new ProjectEvent();
            }

            $post->project_id = $project_id;
            $post->name = $all['name'];
            $post->slug = $all['slug'];
            $post->text = $all['text'];
            $post->start = $all['start'];
            $post->end = $all['end'];
            $post->part = $all['part'];
            $post->save();

            return Redirect::to('/admin/project/'.$project_id.'#event')
                    ->with('success', 'Изменения сохранены');
        }

        public function postNews($project_id, $news_id='')
        {
            $all = Input::all();
            $all['slug'] = BaseController::ru2Lat($all['name']);
            $rules = array(
                'name' => 'required|min:2|max:255',
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/project/'.$project_id.'#news')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($news_id)   {
                  $post = ProjectNews::find($news_id);
            }
            else {
                $post = new ProjectNews();
            }

            $post->project_id = $project_id;
            $post->name = $all['name'];
            $post->slug = $all['slug'];
            $post->text = $all['text'];
            $post->save();

            return Redirect::to('/admin/project/'.$project_id.'#news')
                    ->with('success', 'Изменения сохранены');
        }

//        public function getProgectEventXML($project_id)
//        {
//            $events = ProjectEvent::where('project_id', '=', $project_id)->get();
//
//            $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
//            $root = $dom->createElement("data"); // Создаём корневой элемент
//            $dom->appendChild($root);
//
//            foreach ($events as $element){
//
//                $event = $dom->createElement("event");
//
//                $start = $dom->createAttribute('start');
//                $start->appendChild($dom->createTextNode($element->start));
//                $event->appendChild($start);
//
//                $end = $dom->createAttribute('end');
//                $end->appendChild($dom->createTextNode($element->end));
//                $event->appendChild($end);
//
//                $isDuration = $dom->createAttribute('isDuration');
//                $isDuration->appendChild($dom->createTextNode('true'));
//                //$event->appendChild($isDuration);
//
//                $title = $dom->createAttribute('title');
//                $title->appendChild($dom->createTextNode($element->name));
//                $event->appendChild($title);
//
//                $txt = $dom->createTextNode($element->text);
//                $event->appendChild($txt);
//
//                $root->appendChild($event);
//            }
//
//            $xml = $dom->saveXML();
//
//            $response = Response::make($xml, 200);
//            $response->header('Content-Type', 'text/xml');
//            return $response;
//
//        }

        public function postBudget($project_id)
        {
            $all = Input::all();
            $rules = array(
                'budget'=>'required',
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/project/'.$project_id.'#budget')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }

            if(!$post = ProjectBudget::find($project_id)){
                $post = new ProjectBudget;
            }
            $post->budget = json_encode ( $all['budget']);
            $post->project_id = $project_id;
            $post->save();

            return Redirect::to('/admin/project/'.$project_id.'#budget')
                    ->with('success', 'Изменения сохранены');
        }

        public function postComment(){
            $all = Input::all();
            $id_com = $all['com_id'];
            $id_project = $all['project_id'];

            $comment = ProjectComment::where('id','=',$id_com)->where('project_id', '=', $id_project)->first();
            $comment->status = $all['status'];
            $comment->save();

        }

        public function postDelete(){

            $all = Input::all();
            $type = $all['type'];

            switch ($type) {
                case "comment":
                    $comment = ProjectComment::where('id','=',$all['com_id'])->where('project_id', '=', $all['project_id'])->first();
                    $comment->delete();
                    break;
            }

        }

        public function getUser($project_id, $user_id)
	{
            $category = Category::get();
            $user = DB::table('users')
                    ->where('users.id', '=', $user_id)
                    ->leftJoin('project_users', 'users.id', '=', 'project_users.user_id')
                    ->where('project_users.project_id', '=', $project_id)
                    ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                    ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                    ->select('users.name','users.status', 'project_users.*', 'roles.name as role' )
                    ->first();

            $view = array(
                'category' => $category,
                'user' => $user,
             );
            return View::make('admin.projects.project_user', $view);
	}

        public function postUser($project_id, $user_id){

            $all = Input::all();
            $post = ProjectUsers::where('project_id', '=', $project_id)->where('user_id', '=', $user_id)->first();
            $post->connect = $all['connect'];
            $post->comment = $all['text'];
            $post->is_admin = (int)$all['is_admin'];
            $post->save();
            return Redirect::to('/admin/project/'.$project_id.'#participant')
                    ->with('success', 'Изменения сохранены');
        }

        public function getInviteMessage($project_id)
        {
            $users = User::get(array('id', 'name', 'email' ));
            $project = Project::where('id', $project_id)->first(array('name', 'slug', 'id'));
            $view = array(
                'users'=>$users,
                'project'=>$project,
            );
            return View::make('admin.projects.invite_message', $view);
        }

        public function postSendInvite($project_id)
        {
            $all = Input::all();
            $rules = array(
                'email' => array('required', 'email'),
                'message' => array('required'),
            );
            $validation = Validator::make($all, $rules);
            if ($validation->fails()) {
                return Redirect::to('/admin/project/'.$project_id.'#participant')->withErrors($validation)->withError('Ошибка')->withInput();
            }
            $addressee_id=User::where('email', '=', $all['email'])->pluck('id');

            $msg = array(
                'addressee_id' => $addressee_id,
                'sender_id' => Auth::user()->id,
                'message' => $all['message'],
                'addressee_status' => 1,
                'sender_status' => 1,
            );

            $message = new Message();
            $message->fill($msg);
            $message->save();

            if(isset($all['double_email'])){
                Mail::send('emails.message',
                    array('messages' => $all['message'] ),
                    function ($message) use ($all)  {
                        $message->to($all['email'])->subject('Приглашаем ознакомиться с новым проектом.');
                    }
                );
            }

            return Redirect::to('/admin/project/'.$project_id.'#participant')->withSuccess('Приглашение отправлено');

        }

}
