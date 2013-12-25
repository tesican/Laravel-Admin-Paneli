@extends("admin.template.default") 
@section('content') 
@include('admin.template.formMessage') 
{{ Form::open(array("url" => URL::to(DASHBOARD."/settings/save"), "method" => "POST", "id" => "settingsForm")) }} 
<div class="form-group">
    {{ Form::label("İletişim Mail Adresi") }} 
    {{ Form::text("mail",@$record->mail,array("class" => "form-control")) }} 
</div>
<div class="form-group">
    {{ Form::label("Analytics Kodu") }} 
    {{ Form::textarea("analytics",@$record->analytics,array("class" => "form-control","rows" => 5)) }} 
</div>
<div class="form-group">
    {{ Form::label("Adres Bilgileri") }} 
    {{ Form::textarea("address",@$record->address,array("class" => "form-control ckeditor")) }} 
</div>
<button type="submit" class="btn btn-primary saveBt">Kaydet</button>
{{ Form::close() }} 
@stop