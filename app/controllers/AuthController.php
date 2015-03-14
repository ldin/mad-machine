<?php

class AuthController extends BaseController {

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


    public function getLogin()
        {
            return View::make('user.auth.login');
        }

    public function postLogin()
	{
            $creds = array(
                'password' => Input::get('password'),
                'isActive'  => 1,
            );
            $username = Input::get('username');
            if (strpos($username, '@')) {
                $creds['email'] = $username;
            } else {
                $creds['name'] = $username;
            }

            if (Auth::attempt($creds, Input::has('remember'))) {
//                 Log::info("User [{$username}] successfully logged in.");
                return Redirect::intended()->with('success', 'You have been logged in');
            }
            else {
                 Log::info("User [{$username}] failed to login.");
                 $alert = "Неверная комбинация имени (email) и пароля, либо учетная запись еще не активирована.";
                return Redirect::back()->withError($alert);
            }
	}

    public function getLogout()
        {
            Auth::logout();
            return Redirect::to('/')->with('success', 'You have successfully logged out');

        }

    public function getRegister()
        {
            return View::make('user/register/index');
        }

    public function postRegister()
	{
            $validator = Validator::make(
                Input::all(),
                array(
                    'name' => array('required', 'min:5'),
                    'email' => array('required', 'email', 'unique:users'),
                    'password' => array('required', 'confirmed')
                )
            );

            if ($validator->passes()) {
                $user = new User();
                $user->fill(Input::all());
                $id = $user->register();
                return $this->getMessage("Регистрация почти завершена. Вам необходимо подтвердить e-mail, указанный при регистрации, перейдя по ссылке в письме.");
            }
            else {
                return Redirect::to('auth/register')->with(
                    'error',
                    'Please correct the following errors:'
                )
                ->withErrors($validator)
                ->withInput();
            }
            return;
	}

        public function getActivate($userId, $activationCode){
            // Получаем указанного пользователя
            $user = User::find($userId);
            if (!$user) {
                return $this->getMessage("Неверная ссылка на активацию аккаунта.");
            }

            // Пытаемся его активировать с указанным кодом
            if ($user->activate($activationCode)) {
                $role_auth = Role::where('name', '=', 'auth')->first();
                $user->roles()->attach($role_auth);
                // В случае успеха авторизовываем его
                Auth::login($user);
                // И выводим сообщение об успехе
                return $this->getMessage("Аккаунт активирован", "/");
            }

            // В противном случае сообщаем об ошибке
            return $this->getMessage("Неверная ссылка на активацию аккаунта, либо учетная запись уже активирована.");
        }






}
