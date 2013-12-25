@extends("admin.template.default") 
@section("content") 
    @include('admin.template.formMessage') 
    {{ Form::open(array("url" => URL::to(DASHBOARD."/galeries/save/".@$record->id), "method" => "POST", "id" => "GaleryForm")) }} 
    <div class="form-group">
        {{ Form::label("Galeri Adı") }} 
        {{ Form::text("name",@$record->name,array("class" => "form-control")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Galeri Url Adı") }} 
        {{ Form::text("slug",@$record->slug,array("class" => "form-control")) }} 
    </div>
    <button type="submit" class="btn btn-primary saveBt">Kaydet</button>
    {{ Form::close() }} 
@stop