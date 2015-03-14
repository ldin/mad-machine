<?php

class UsersController extends \BaseController {
    
    
    
        public function getAccount(){            
            $news = Post::where('parent', '=', '7')->get();
            $projects = Project::limit(10)->get();
            
            $view = array(
                'news' => $news,
                'projects' => $projects,
             );
            return View::make('user.account', $view);
            
        }

        public function postAccountEdit(){
            $all = Input::all();
                $rules = array(
                    'name' => array('required', 'min:5'),
                    'email' => array('required', 'email', 'unique:users,email,'.$all['user_id']),
                );
                $validator = Validator::make($all, $rules);

                if ( $validator -> fails() ) {           
                    return Redirect::to('user/account')
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error', 'Ошибка');
                }
                $user = User::find($all['user_id']);
                $user->email =  $all['email']; 
                $user->name =  $all['name'];
                $user->phone =  $all['phone'];
                $user->save();
            return Redirect::to('user/account')->with('success', 'Изменения сохранены');
        }
        
        public function postAccountPassword($type){
            $all = Input::all();
                $rules = array(
//                        'oldpass' => array('required'),
                    'pass' => array('required', 'confirmed'),
                );
                $validator = Validator::make($all, $rules);
                $user = User::find($all['user_id']);
                if ( $validator -> fails() ) {           
                    return Redirect::to('user/account')
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error', 'Ошибка');
                }
                //var_dump(Hash::make($all['oldpass']), $user->password); die();
                $user->password = Hash::make($all['pass']);
                $user->save();
            return Redirect::to('user/account')->with('success', 'Пароль изменен');
        }
        
        public function getMessages(){
            $messages = Message::get();
            $id = Auth::user()->id;

            $query = 'SELECT m.addressee_id, m.sender_id, m.message, m.isread, us.name as sender_name, ua.name as addressee_name from messages m  
                        LEFT JOIN users us ON m.sender_id = us.id
                        LEFT JOIN users ua ON m.addressee_id = ua.id
                        WHERE m.id IN
                              (
                              SELECT MAX(id) FROM messages
                              WHERE '.$id.' IN(sender_id, addressee_id)
                              GROUP by CASE WHEN sender_id>addressee_id THEN addressee_id ELSE sender_id END, 
                                       CASE WHEN sender_id>addressee_id THEN sender_id ELSE addressee_id END
                              )
                        ORDER BY m.created_at DESC ';
            $messages = DB::select($query);

            $view = array(
                'messages' => $messages,
             );
            return View::make('user.msg.messages', $view);
        }
        
        public function getUserMsg($interlocutor_id){
            $user_id = Auth::user()->id;
            $messages = Message::where(function ($query) use ($interlocutor_id, $user_id) {
                                $query->where('addressee_id', $interlocutor_id)
                                      ->where('sender_id', $user_id);
                            })
                            ->orWhere(function ($query) use ($interlocutor_id, $user_id) {
                                $query->where('addressee_id', $user_id)
                                      ->where('sender_id', $interlocutor_id);
                            })
                            ->orderBy('created_at', 'desc')       
                            ->paginate(20);
            $interlocutor = array(
                'id' => $interlocutor_id,
                'name' => User::where('id', $interlocutor_id)->pluck('name')
                    
            );
            
            Message::where('addressee_id', $user_id)->where('sender_id', $interlocutor_id)->update(array('isread' => 1));
            
            $view = array(
                'messages' => $messages,
                'addressee' => $interlocutor,
             );
            return View::make('user.msg.user-msg', $view);
        }
        
        public function getSendMsg(){
            $users = User::get(array('id', 'name', 'email' ));
            $view = array(
                'users'=>$users,
            );
            return View::make('user.msg.send-msg', $view);
        }
        
        public function postSendMsg($addressee_id=''){
            $all = Input::all();
            if(!$addressee_id){ 
                
                $rules = array(
                    'email' => array('required', 'email'),
                    'message' => array('required'),
                );
                $validation = Validator::make($all, $rules);
                if ($validation->fails()) {
                    return Redirect::to('user/send-msg')->withErrors($validation)->withError('Ошибка')->withInput();
                }
                $addressee_id=User::where('email', '=', $all['email'])->pluck('id');
                $redirect = 'user/messages';
            }
            else{
               $rules = array(
                    'message' => array('required'),
                );
                $validation = Validator::make($all, $rules);
                if ( $validation -> fails() ) {           
                    return Redirect::to('user/user-msg/'.$addressee_id);
                } 
                $redirect = 'user/user-msg/'.$addressee_id;
            }
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
            
            return Redirect::to($redirect)->withSuccess('Сообщение отправлено');
        }
}