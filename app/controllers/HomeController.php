<?php

class HomeController extends BaseController {

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

    public function getShowIndex($slug='main')
    {
        $slug = BaseController::validateSlug($slug);
        $pages_all = Post::where('type', '=', 'page')->where('parent', '=', '0')->where('watch', 1)->get();
        //var_dump('<pre>', $pages);
        // $news = Post::where('parent', '=', '7')->get(array('name', 'slug', 'created_at'));
        $projects = Project::limit(10)->get(array('name', 'slug'));
        $post = Post::where('slug', '=', $slug)->first();

         $view = array(
            'pages_all' => $pages_all,
            'projects' => $projects,
            'post' => $post,
         );
        
        if(isset($post->parent)){
            if($post->parent==0){
                $parent = $post->id;
            } else{
                $parent = $post->parent;
            }

            $categories = Post::where('parent', $parent)->where('watch', '1')->get(array('id', 'slug', 'name'));
            $parent = Post::where('id', $parent)->first(array('id', 'slug', 'name', 'offer_name', 'offer_text'));
            $view['categories'] = $categories;
            $view['parent'] = $parent;

         }



        return View::make( ($slug=='main')?'home.main':'home.page', $view);
    }

    public function postFormRequest()
    {
            $all = Input::all();

            $rules = array(
                'name' => 'required|min:2|max:255',
                'text' => 'required|min:3',
            );

            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/#block_form')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('errorRequest', 'Ошибка');
            }

            // $post = new Request();
            // $post->name = $all['name'];
            // $post->phone = $all['phone'];
            // $post->email = $all['email'];
            // $post->text = $all['text'];

            $mail = Setting::where('name', 'email')->first();
             //var_dump($mail->value); die();

            $messages = '<b>Пользователь: </b>'.$all['name'].'<br>';
            $messages .= '<b>Вопрос: </b>'.$all['text'].'<br>';
            $messages .= '<b>Контактные данные: </b>'.'<br>';
            $messages .= '<i>Телефон: </i>'.$all['phone'].'<br>';
            $messages .= '<i>Емайл: </i>'.$all['email'].'<br>';

                Mail::send('emails.message',
                    array('messages' => $messages ),
                    function ($message) use ($mail)  {
                        $message->to($mail->value)->subject('Обращение посетителя');
                    }
                );

            return Redirect::to('/#block_form')
                    ->with('successRequest', 'Сообщение отправлено');
    }
}
