@extends("admin.template.default") 
@section("content") 
    @include("admin.template.formMessage") 
    {{ Form::open(array("url" => URL::to(DASHBOARD."/users/save/".@$record->id), "method" => "POST", "id" => "UserForm")) }} 
    <div class="form-group">
        {{ Form::label("Kullanıcı Ad / Soyad") }} 
        {{ Form::text("fullname",@$record->fullname,array("class" => "form-control")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Kullanıcı Adı") }} 
        {{ Form::text("username",@$record->username,array("class" => "form-control")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Kullanıcı Email Adresi") }} 
        {{ Form::text("email",@$record->email,array("class" => "form-control")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Kullanıcı Durumu") }} 
        {{ Form::select("status",array("1" => "Aktif","0" => "Pasif","2" => "Beklemede"),@$record->status,array("class" => "form-control")) }} 
    </div>
    @if(@$record->id) 
    <div class="form-group passChange">
        <a class="btn btn-default" onclick="showObj('.passChange','.passChangeForm')">Şifreyide değiştir</a>
    </div>
    @endif 
    <div class='passChangeForm {{ @$record->id?"none":'' }}'>
        <div class="form-group">
            {{ Form::label("Şifre") }} 
            {{ Form::password("password",array("class" => "form-control")) }} 
        </div>
        <div class="form-group">
            {{ Form::label("Şifre Tekrarı") }} 
            {{ Form::password("password_confirmation",array("class" => "form-control")) }} 
        </div>        
    </div>
    <button type="submit" class="btn btn-primary saveBt">Kaydet</button>
    {{ Form::close() }} 
@stop