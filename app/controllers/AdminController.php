<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function __construct()
    {
        $this->beforeFilter('auth');

//        $this->beforeFilter(Authority::can('create', 'User'));


    }

    public function getShowAdmin()
	{
		return View::make('admin/index');
	}

    public function getPage($id='')
        {
            $post = '';
            $parent = array();

            $posts = Post::where('type', '=', 'page')->where('parent', '=', '0')->get();
            $posts_child = Post::where('type', '=', 'page')->where('parent', '!=', '0')->get();
            foreach ($posts as $value) {
                $parent[0]='';
                if($value->id!=$id){
                    $parent[$value['id']]= $value['name'];
                }
            }
            if($id){
                $post = Post::find($id);
            }

            $view = array(
                'posts' => $posts,
                'posts_child' => $posts_child,
                'parent' => $parent,
                'row' => $post,
                'type' => 'page'
             );
            return View::make('admin.posts', $view);
        }

    public function postPage($id='')
        {
            $all = Input::all();
            if(!$all['slug']) {$all['slug'] = AdminController::ru2Lat($all['name']);}
            $rules = array(
                'name' => 'required|min:2|max:255',
                'title' => 'required|min:3|max:255',
                'slug'  => 'required|min:4|max:255|alpha_dash',
                //'slug'  => 'required|min:4|max:255|alpha_dash|unique:posts,slug,post_id'.$post_id,
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/page/'.$id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($id)   {
                  $post = Post::find($id);
            }
            else {
                $post = new Post();
                $post->type = 'page';
            }

            $post->name = $all['name'];
            $post->title = $all['title'];
            $post->slug = $all['slug'];
            $post->parent = $all['parent'];
            $post->text = $all['text'];
            $post->watch = isset($all['watch'])?1:0;
            $post->offer_name = $all['offer_name'];
            $post->offer_text = $all['offer_text'];
            $post->description = $all['description'];
            $post->keywords = $all['keywords'];
            $post->save();

            return Redirect::to('/admin/page/'.$id)
                    ->with('success', 'Изменения сохранены');
        }


    public function showSettings()
        {
            $settings = Setting::get();

            $view = array(
                'settings' => $settings,
            );
            return View::make('admin.settings', $view);
        }

    public function postSettings($news_id='')
        {
            $settings = Input::all();

            foreach($settings as $key=>$setting) {
                if($key[0]!='_'){
                    $field_ru = Setting::where('name', '=', $key)->first();
                    $field_ru->value = $setting;
                    $field_ru->save();
                }
            }
            return Redirect::to('/admin/settings');
        }

    public function getUser($id='')
        {
            $users = User::get();
            $user = User::find($id);
            $category = Category::
                    leftJoin('category_user', 'category_user.category_id', '=', 'category.id')
                    ->where('category_user.user_id', $id)
                    ->get(array('category.id', 'category.name'));

            foreach (Role::get() as $roles){
                if($roles->name == 'mainAdmin'){
                    if( Auth::user()->hasRole('mainAdmin') ){
                        $role[$roles->id] = $roles->name;
                    }
                }
                else if(Auth::user() == 'admin'){
                    if( $user->hasRole('mainAdmin' || 'admin') ){
                        $role[$roles->id] = $roles->name;
                    }
                }
                else{
                    $role[$roles->id] = $roles->name;
                }

            }

            $view = array(
                'users' => $users,
                'row' => $user,
                'role' => $role,
                'category' => $category,
             );

            return View::make('admin.users.users', $view);
        }

    public function postUser($id)
        {
            $all = Input::all();

            if(!Authority::can('update', 'User'))
            {
                return Redirect::to('/admin/user/'.$id)
                        ->withInput()
                        ->with('error', 'У вас нет прав редактирования');
            }

            $rules = array(
                'name' => 'required|min:2|max:255',
                'email'  => 'required|email',

            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/user/'.$id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($id)   {
                  $user = User::find($id);
            }
            else {
                $user = new User();
            }

            $user->name = $all['name'];
            $user->email = $all['email'];
            $user->phone = $all['phone'];
            $user->description = $all['description'];
            $user->status = $all['status'];
            $user->save();

            $role = Role::find($all['role']);
            if(!$user->hasRole($role->name)) {
                $user->roles()->detach();
                $user->roles()->attach($role);
                $user->save();
            }

            return Redirect::to('/admin/user/'.$id)
                    ->with('success', 'Изменения сохранены');
        }

    public function getCategory($id='')
        {
            $users = Role::
                    leftJoin('role_user', 'role_user.role_id', '=', 'roles.id')
                    ->leftJoin('users', 'role_user.user_id', '=', 'users.id')
                    ->leftJoin('category_user', function ($join) use ($id) {
                        $join->on('users.id', '=', 'category_user.user_id')
                                ->where(DB::raw('category_user.category_id'), '=', $id);
                    })
                    ->where('roles.name','admin')
                    ->where('users.deleted_at', NULL)
                    ->get(array('users.id', 'users.name', 'category_user.status'));


            $cat = Category::find($id);
            $categories = Category::get();

            $view = array(
                'users' => $users,
                'row' => $cat,
                'categories' => $categories,
             );

            return View::make('admin.category', $view);
        }

    public function postCategory($id='')
        {
            $all=Input::all();
            $rules = array(
                'name' => 'required|min:2|max:255',
                'slug'  => 'required|min:4|max:255',

            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/category/'.$id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($id)   {
                  $category = Category::find($id);
            }
            else {
                $category = new Category();
            }

            $category->name = $all['name'];
            $category->slug = $all['slug'];
            $category->save();

            return Redirect::to('/admin/category/'.$id)
                    ->with('success', 'Изменения сохранены');


        }

    public function postCategoryUser($id='')
        {
            $all=Input::all();

            $user = User::find($all['user_id']);
            $category = Category::find($all['category_id']);

            if($all['status']=='1'){
                $user->categories()->attach($category);
            }
            else if($all['status']=='0'){
                $user->categories()->detach($category);
            }
            else{
                return Redirect::to('/admin/category/'.$id)
                ->with('error', 'Ошибка');
            }


            return;
        }

    public function getDeleteAny($type, $id)
        {
            switch ($type) {
                case 'user':
                    User::find($id)->delete();
                    break;
                case 'page':
                    Post::find($id)->delete();
                    break;
                case 'category':
                    Category::find($id)->delete();
                    break;
                case 'project':
                    Project::find($id)->delete();
                    break;


            }

        return Redirect::to('/admin/'.$type);
        }

        public function getPartner($id='')
        {
            $post = '';

            $posts = Partner::get();
            if($id){
                $post = Partner::find($id);
            }

            $view = array(
                'posts' => $posts,
                'row' => $post,
                'type' => 'partner'
             );

            return View::make('admin.partners', $view);

        }

        public function postPartner($id='')
        {
            $all = Input::all();
            if(!$all['slug']) {$all['slug'] = AdminController::ru2Lat($all['name']);}
            $rules = array(
                'name' => 'required|min:2|max:255',
                'title' => 'required|min:3|max:255',
                'slug'  => 'required|min:4|max:255|alpha_dash',
                //'slug'  => 'required|min:4|max:255|alpha_dash|unique:posts,slug,post_id'.$post_id,
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/partner/'.$id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($id)   {
                  $post = Partner::find($id);
            }
            else {
                $post = new Partner();
                $post->type = 'partner';
            }

            if(isset($all['image'])){
                $full_name = Input::file('image')->getClientOriginalName();
                $filename=$full_name;
                $path = 'upload/partners/';
                Input::file('image')->move($path, $filename);
                $post->logo = $path.$filename;
            }

            $post->name = $all['name'];
            $post->title = $all['title'];
            $post->slug = $all['slug'];
            $post->text = $all['text'];
            $post->description = $all['description'];
            $post->keywords = $all['keywords'];
            $post->save();

            return Redirect::to('/admin/partner/'.$id)
                    ->with('success', 'Изменения сохранены');
        }




}
