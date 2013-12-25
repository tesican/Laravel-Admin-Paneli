<?php

namespace Admin;

use BaseController,
    View,
    Request,
    Validator,
    URL,
    Input,
    Response,
    Str,Image,
    ImagesList,
    Redirect,
    Galeries;

class GaleriesController extends BaseController
{

    public $activePage = "galeries";
    public $rules = array(
        'name' => 'required'
    );
    public $messages = array(
        'name.required' => 'Kategori Adını Girmelisiniz.',
        'slug.unique' => 'Slug Adresi Zaten Bulunuyor.'
    );

    public function __construct()
    {
        $this->beforeFilter('csrf', array('only' => 'postSave'));
    }

    public function getIndex()
    {
        $records = Galeries::get();

        $images = ImagesList::getImage();

        $viewData = array(
            "images" => $images,
            "records" => $records,
            "activePage" => $this->activePage
        );
        return View::make('admin.galeries.imageList', $viewData);
    }

    public function getForm()
    {
        $id = Request::segment(4);
        if ($id) {
            $record = Galeries::where("id", "=", $id)->first();
        }

        $viewData = array(
            "activePage" => $this->activePage,
            "record" => @$record
        );
        return View::make('admin.galeries.GaleryForm', $viewData);
    }

    public function postSave()
    {
        $id = Request::segment(4);
        $postData = Input::except('_token', '_method');
        $this->rules += array('slug' => 'unique:galeries,slug,' . $id);
        $postData['slug'] = $postData['slug']? : Str::slug($postData['name']);
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

            return View::make('admin.galeries.galeryForm', $viewData);
        } else {
            // İd dolu ise güncelleme yap, boş ise yeni kayıt ekle
            if ($id) {
                $postData["created_at"] = date("Y-m-d H:i:s");
                $status = Galeries::where("id", "=", $id)->update($postData);
            } else {
                $id = Galeries::insertGetId($postData);
            }
            return Redirect::to(DASHBOARD . "/galeries/form/" . $id . "/success");
        }
    }

    public function postDestroy($id = "")
    {
        $status = Galeries::where("id", "=", $id)->delete();
        if ($status) {
            return Response::json(array('status' => '1', 'text' => 'Galeri Silindi'));
        } else {
            return Response::json(array('status' => '2', 'text' => 'İşlem Sırasında Hata Oluştu'));
        }
    }

    public function postImdestroy($id = "")
    {
        $data = ImagesList::where("id", "=", $id)->first();
        $status = ImagesList::where("id", "=", $id)->delete();
        \File::delete('upload/' . $data->image);
        if ($status) {
            return Response::json(array('status' => '1', 'text' => 'Resim Silindi'));
        } else {
            return Response::json(array('status' => '2', 'text' => 'İşlem Sırasında Hata Oluştu'));
        }
    }
    
    public function getImageform(){
        $records = Galeries::get();
        $galeries = array("" => "Seçilmedi");
        foreach($records as $r){
            $galeries[$r->id] = $r->name;
        }
        $viewData = array(
            "galeries" => $galeries,
            "activePage" => $this->activePage
        );
        return View::make('admin.galeries.imageLoad', $viewData);
    }
    
    public function postImagesave(){
        $postData["galery_id"] = Input::get("galery_id");
        // Resim Yükleme
        if (@Input::hasFile('image')) {
            $image = Input::file('image');
            // Dosya Adının başına 4 karakter atarak yeniden isimlendiriyoruz.
            $postData['image'] = Str::slug(str_random(4)."_" .$image->getClientOriginalName(),'.');
            Image::make($image->getRealPath())->resize(500, 300, true,true)->save('upload/' . $postData['image']);
        }
        $postData["created_at"] = date("Y-m-d H:i:s");
        \ImagesList::insertGetId($postData);
        return Redirect::to(DASHBOARD."/galeries");
    }

}
