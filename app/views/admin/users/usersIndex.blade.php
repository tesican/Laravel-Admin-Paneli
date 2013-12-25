@extends('admin.template.default')

@section('content')

<a href="{{ URL::to(DASHBOARD."/users/form") }}" class="btn btn-success mbottom20">
    <span class="glyphicon glyphicon-plus-sign"></span>
    Yeni Kullanıcı
</a>

<table  class="table table-hover table-responsive table-bordered">
    <tfoot>
        <tr>
            <th colspan="4" class="ts-pager form-horizontal">
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
            <th style="width: 33%">Kullanıcı Ad / Soyad</th>
            <th style="width: 38%">Kullanıcı Adı</th>
            <th class="filter-false remove sorter-false">İşlemler</th>
            <th style="width: 5%" class="filter-false remove sorter-false" ></th>
        </tr>
    </thead>
    <tbody>@foreach($records as $r)

        <tr id="tb_tr_{{$r->id}}">
            <td>{{ HTML::link(URL::to(DASHBOARD."/users/form/".$r->id),$r->fullname) }}</td>
            <td>{{ $r->username }}</td>
            <td>
                <a class="btn btn-primary btn-xs" href="{{ URL::to(DASHBOARD."/users/form/".$r->id) }}">
                    <i class='glyphicon glyphicon-pencil'></i> Düzenle
                </a>
                |
                <a href="javascript:void(0)"  data-rowid="tb_tr_" data-url="{{ URL::to(DASHBOARD."/users/destroy/".$r->id) }}" data-title="{{ $r->fullname }}" data-id="{{ $r->id }}" class="btn btn-xs btn-primary deleteBt">
                    <i class='glyphicon glyphicon-remove'></i> Sil
                </a>
            </td>
            <td>
                @if($r->status == 1)
                {{ HTML::image("img/status-active.png","",array("title" => "Kullanıcı Aktif")) }}
                @elseif($r->status == 2)
                {{ HTML::image("img/status-away.png","",array("title" => "Kullanıcı Beklemede")) }}
                @else
                {{ HTML::image("img/status-busy.png","",array("title" => "Kullanıcı Pasif")) }}
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><b>UYARI</b> : Silme işlemi Yapıyorsunuz.</h4>
            </div>
            <div class="modal-body">
                <span></span> İsimli Kullanıcıyı Silmek İstediğinize Eminmisiniz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">KAPAT</button>
                <button type="button" class="btn btn-success deletePage">SİL</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop