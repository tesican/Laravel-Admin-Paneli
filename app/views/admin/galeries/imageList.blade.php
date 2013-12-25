@extends("admin.template.default") 
@section('content') 
<a href="{{ URL::to(DASHBOARD."/galeries/form") }}" class="btn btn-success mbottom20">
    <span class="glyphicon glyphicon-plus-sign"></span>
    Yeni Galeri Kategorisi
</a>
<a href="{{ URL::to(DASHBOARD."/galeries/imageform") }}" class="btn btn-primary mbottom20">
    <span class="glyphicon glyphicon-plus-sign"></span>
    Yeni Resim Ekle
</a>
<table class="table table-hover table-responsive table-bordered">
    <tfoot>
        <tr>
            <th colspan="3" class="ts-pager form-horizontal">
                <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                <select class="pagesize input-mini" title="Select page size">
                    <option selected="selected" value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
                <select class="pagenum input-mini" title="Select page number"></select>
            </th>
        </tr>
    </tfoot>
    <thead>
        <tr>
            <th style="width: 38%">Kategori Adı</th>
            <th style="width: 38%">Kategori Link Adı</th>
            <th class="filter-false remove sorter-false">İşlemler</th>
        </tr>
    </thead>
    <tbody>@foreach($records as $r) 
        <tr id="tb_tr_{{$r->id}}">
            <td>{{ HTML::link(URL::to(DASHBOARD."/galeries/form/".$r->id),$r->name) }}</td>
            <td>{{ $r->slug }}</td>
            <td>
                <a class="btn btn-primary btn-xs" href="{{ URL::to(DASHBOARD."/galeries/form/".$r->id) }}">
                   <i class='glyphicon glyphicon-pencil'></i> Düzenle
                </a> |
                <a href="javascript:void(0)" data-rowid="tb_tr_" data-url="{{ URL::to(DASHBOARD."/galeries/destroy/".$r->id) }}" data-title="{{ $r->name }}" data-id="{{ $r->id }}" class="btn btn-xs btn-primary deleteBt">
                    <i class='glyphicon glyphicon-remove'></i> Sil
                </a>
            </td>
        </tr>
        @endforeach 
    </tbody>
</table>

  {{ HTML::style('js/wookmark/wookmark.css') }} 
  {{ HTML::script('js/wookmark/jquery.imagesloaded.js') }} 
  {{ HTML::script('js/wookmark/jquery.wookmark.js') }} 
  <div style="position: relative;">
<ol id="filters">
    @foreach($records as $r)
    <li data-filter="{{ $r->slug }}">{{ $r->name }}</li>
    @endforeach
</ol>
<br/>

<div id="galeryMain" role="galeryMain">
    <ul id="tiles">
        @foreach($images as $im)
        <li data-filter-class='["{{ $im->galerySlug }}"]' id="image_{{ $im->id }}">
            {{ HTML::image("upload/".$im->image,"",array("width" => 160)) }}
            <div class="tit">{{ $im->name }}</div>
            <div class="btList">
                <a class="glyphicon glyphicon-zoom-in colorBox" href="{{ URL::to("upload/".$im->image) }}"></a>
                <a class="glyphicon glyphicon-trash deleteBt" data-rowid="image_" data-url="{{ URL::to(DASHBOARD."/galeries/imdestroy/".$im->id) }}" data-title="{{ $im->name }}" data-id="{{ $im->id }}"></a>
            </div>
        </li>
        @endforeach
    </ul>
</div>
</div>
  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    (function ($){
      $('#tiles').imagesLoaded(function() {
        // Prepare layout options.
        var options = {
          autoResize: true, container: $('#galeryMain'),offset: 2,
          itemWidth: 170,fillEmptySpace: true
        };
        var handler = $('#tiles li'),
            filters = $('#filters li');
        handler.wookmark(options);
        var onClickFilter = function(event) {
          var item = $(event.currentTarget),
              activeFilters = [];
          if (!item.hasClass('active')) {
            filters.removeClass('active');
          }
          item.toggleClass('active');
          if (item.hasClass('active')) {
            activeFilters.push(item.data('filter'));
          }
          handler.wookmarkInstance.filter(activeFilters);
        }
        filters.click(onClickFilter);
      });
    })(jQuery);
  </script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><b>UYARI</b> : Silme işlemi Yapıyorsunuz.</h4>
            </div>
            <div class="modal-body">
                <span></span> İsimli İçeriği Silmek İstediğinize Eminmisiniz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">KAPAT</button>
                <button type="button" class="btn btn-success deletePage">SİL</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop