    @if(@$messages) 
        <div class="alert alert-danger">
            @foreach($messages AS $msg) {{ '● '.$msg.'<br/>' }} @endforeach 
        </div>
    @endif 
    @if(@Request::segment(5) == "success") 
        <div class="alert alert-success">İşleminiz Kaydedildi.</div>
    @endif 