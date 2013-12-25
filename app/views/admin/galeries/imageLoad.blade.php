@extends("admin.template.default") 
@section("content") 
    @include('admin.template.formMessage') 
    {{ Form::open(array("url" => URL::to(DASHBOARD."/galeries/imagesave/"), "method" => "POST", "id" => "GaleryForm","enctype"=>"multipart/form-data")) }}
    <div class="form-group">
        {{ Form::label("Resim Başlığı") }} 
        {{ Form::text("name",'',array("class" => "form-control")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Resim Kategorisi") }} 
        {{ Form::select("galery_id",@$galeries,'',array("class" => "form-control","required")) }} 
    </div>
    <div class="form-group">
        {{ Form::label("Resim") }} 
        {{ Form::file("image",array("class" => "form-control","required")) }} 
    </div>
    <button type="submit" class="btn btn-primary saveBt">Kaydet</button>
    {{ Form::close() }} 
@stop