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
    Settings;

class SettingsController extends DashboardController
{

    public $activePage = "settings";
    public $rules = array(
        'mail' => 'required|email'
    );
    public $messages = array(
        'mail.required' => 'Mail Formunun Gideceği Email Adresini Girmelisiniz.',
        'mail.email' => 'Email Adresi Geçersiz.'
    );

    public function getIndex()
    {
        $viewData = array(
            "activePage" => $this->activePage,
            "record" => Settings::first()
        );
        return View::make('admin.settings.settings', $viewData);
    }

    public function postSave()
    {
        $postData = Input::except("_token");
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

            return View::make('admin.settings.settings', $viewData);
        } else {
            Settings::where("id", "=", 1)->update($postData);
            return Redirect::to(DASHBOARD . "/settings/index/1/success");
        }
    }

}
