<?php

namespace Admin;

use View,User,Redirect,
    Auth,Input,Request,has,
    BaseController;

class AuthController extends BaseController
{

    public function index()
    {
        return View::make('admin.auth.login');
    }

    public function doLogin()
    {
        // Kullanıcı Hatırlama var mı ?
        if (Input::get('remember')) $remember = true; else $remember = false;
        
        // Kullanıcı Girişleri
        $username = Input::get('username');
        $password = Input::get('password');
        
        // username Değişkeni içerisinde mail değeri varsa email kolununda arama yapması için
        $user = filter_var($username, FILTER_VALIDATE_EMAIL)?"email":"username";
        
        // Kullanıcı Kontrolü Yapar
        if (Auth::attempt(array($user => $username, 'password' => $password, 'status' => 1), $remember)) {
            
            $update = array("updated_ip" => Request::getClientIp(),"updated_at" => date("Y-m-d H:i:s"));
            // Güncelleme
            User::where('id', '=', Auth::user()->id)
                    ->update($update);
            
            return Redirect::route('admin.home');
        } else {
            return Redirect::route('admin.login');
        }
    }
    
    public function logout ()
    {
        Auth::logout();
        return Redirect::route('admin.login');
    }

}
