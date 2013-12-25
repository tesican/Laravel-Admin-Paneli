@extends("admin.template.default") 
@section("content") 
    @include('admin.template.formMessage') 
    {{ Form::open(array("url" => URL::to(DASHBOARD."/pages/save/".@$record->id), "method" => "POST", "id" => "PageForm")) }} 
    <div class="form-group">
        {{ Form::label("Sayfa Başlığı") }} 
        {{ Form::text("title",@$record->title,array("class" => "form-control")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Sayfa Url Adı") }} 
        {{ Form::text("slug",@$record->slug,array("class" => "form-control")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Sayfa İçerği") }} 
        {{ Form::textarea("body",@$record->body,array("class" => "form-control ckeditor")) }} 
    </div>
    <button type="submit" class="btn btn-primary saveBt">Kaydet</button>
    {{ Form::close() }} 
@stop