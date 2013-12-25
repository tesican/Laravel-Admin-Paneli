<?php

namespace Admin;

use BaseController,
    View,
    Request,
    Validator,
    URL,
    Input,
    Response,
    Str,Hash,
    Redirect,
    User;

class UsersController extends BaseController
{
    public $activePage = "users";
    
    public $rules = array(
        'username' => 'required',
        'fullname' => 'required',
        'email' => 'email',
        'password'  =>'confirmed|between:6,12'
    );
    public $messages = array(
        'username.required' => 'Kullanıcı Adını Girmelisiniz.',
        'fullname.required' => 'Kullanıcı Ad / Soyad Alanını Girmelisiniz.',
        'email.email' => 'Email Adresi Geçersiz.',
        'password.confirmed' => "Şifreyi İkilemesi Hatalı.",
        'password.between' => "Şifreniz En Az 6, En Fazla 12 Karakterli Olmalıdır.",
        'password.required' => 'Kullanıcı Şifresi Girmediniz.'
    );

    public function __construct()
    {
        $this->beforeFilter('csrf', array('only' => 'postSave'));
    }

    public function getIndex()
    {
        $viewData = array(
            "activePage" => $this->activePage,
            "records" => User::orderBy("id", "desc")->get()
        );
        return View::make('admin.users.usersIndex', $viewData);
    }

    public function getForm()
    {
        $id = Request::segment(4);
        if ($id) {
            $record = User::where("id", "=", $id)->first();
        }
        
        $viewData = array(
            "activePage" => $this->activePage,
            "record" => @$record
        );
        return View::make('admin.users.userForm', $viewData);
    }

    public function postSave()
    {
        $id = Request::segment(4);
        $postData = Input::except('_token', '_method');
        
        if(empty($id)){
            $this->rules['password'] = 'required|confirmed|between:6,12';
        }
        
        // Zorunlu Bilgilerin kontrolü
        $validator = Validator::make($postData, $this->rules, $this->messages);
        // Eksik Bilgi Var mı?
        if ($validator->fails()) {
            // Convert Post Data
            $record = (object) array();
            foreach ($postData as $k => $v) {
                $record->$k = $v;
            }
            
            $viewData = array(
                "activePage" => $this->activePage,
                "record" => $record,
                'messages' => $validator->messages()->all(),
                'failed' => $validator->failed()
            );

            return View::make('admin.users.userForm', $viewData);
        } else {
            unset($postData['password_confirmation']);
            if($postData["password"]){
                $postData["password"] = Hash::make($postData["password"]);
            }else{
                unset($postData["password"]);
            }
            
            // İd dolu ise güncelleme yap, boş ise yeni kayıt ekle
            if ($id) {
                $postData["created_at"] = date("Y-m-d H:i:s");
                $status = User::where("id", "=", $id)->update($postData);
            } else {
                $id = User::insertGetId($postData);
            }
            return Redirect::to(DASHBOARD . "/users/form/" . $id . "/success");
        }
    }

    public function postDestroy($id = "")
    {
        $userCount = User::count();
        if ($userCount < 2) {
            return Response::json(array('status' => '2', 'text' => 'Tek kullanıcı var. Bu kullanıcı Silinemez.'));
        }
        $status = User::where("id", "=", $id)->delete();
        if ($status) {
            return Response::json(array('status' => '1', 'text' => 'Kullanıcı Silindi'));
        } else {
            return Response::json(array('status' => '2', 'text' => 'İşlem Sırasında Hata Oluştu'));
        }
    }

}
