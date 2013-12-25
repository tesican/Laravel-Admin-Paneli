@extends("admin.template.default") 
@section("content") 
<div class="jumbotron">
    <h1>Laravel Kod Örneği</h1>
    <p class="lead">
        Bu kod örneğini Laravel kullanmak istediğiniz projelerinizde hazırlayacağınız admin panellerine örnek olarak hazırlanmıştır. 
        Ayrıca Template sistemi, oturum yönetimi, Routes yönetimi vs. işlemler hakkında da bilgi sahibi olabilirsiniz.
        Çok aşırı gelişmiş işlemler basitlik açısından kullanılmamıştır. Soru ve görüşlerininizi {{ HTML::link("http://www.webteders.com/iletisim", "İletişim", array("target" => "_blank")) }} adresinden paylaşabilirsiniz.
    </p>
</div>
@stop