<?php

namespace Admin;

use BaseController,
    View,
    Request,
    Validator,
    URL,
    Input,
    Response,
    Str,
    Redirect,
    Pages;

class PagesController extends BaseController
{

    public $activePage = "pages";
    
    public $rules = array(
        'title' => 'required',
        'body' => 'required'
    );
    public $messages = array(
        'title.required' => 'Sayfa Başlığını Girmelisiniz.',
        'body.required' => 'Sayfa İçeriği Girmelisiniz.',
        'slug.unique' => 'Slug Adresi Zaten Bulunuyor.'
    );

    public function __construct()
    {
        $this->beforeFilter('csrf', array('only' => 'postSave'));
    }

    public function getIndex()
    {
        $viewData = array(
            "activePage" => $this->activePage,
            "records" => Pages::orderBy("id", "desc")->get()
        );
        return View::make('admin.pages.pageList', $viewData);
    }

    public function getForm()
    {
        $id = Request::segment(4);
        if ($id) {
            $record = Pages::where("id", "=", $id)->first();
        } 
        
        $viewData = array(
            "activePage" => $this->activePage,
            "record" => @$record
        );
        return View::make('admin.pages.pageForm', $viewData);
    }

    public function postSave()
    {
        $id = Request::segment(4);
        $postData = Input::except('_token', '_method');
        $this->rules += array('slug' => 'unique:pages,slug,'.$id);
        $postData['slug'] = $postData['slug']?:Str::slug($postData['title']);
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

            return View::make('admin.pages.pageForm', $viewData);
        } else {
            // İd dolu ise güncelleme yap, boş ise yeni kayıt ekle
            if ($id) {
                $postData["created_at"] = date("Y-m-d H:i:s");
                $status = Pages::where("id", "=", $id)->update($postData);
            } else {
                $id = Pages::insertGetId($postData);
            }
            return Redirect::to(DASHBOARD . "/pages/form/" . $id . "/success");
        }
    }

    public function postDestroy($id = "")
    {
        $status = Pages::where("id", "=", $id)->delete();
        if ($status) {
            return Response::json(array('status' => '1', 'text' => 'Sayfa Silindi'));
        } else {
            return Response::json(array('status' => '2', 'text' => 'İşlem Sırasında Hata Oluştu'));
        }
    }

}
