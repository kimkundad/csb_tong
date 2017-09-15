@extends('admin.layouts.template')
@section('admin.stylesheet')


@stop('admin.stylesheet')
@section('admin.content')






        <section role="main" class="content-body">

          <header class="page-header">
            <h2>{{$datahead}}</h2>

            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="dashboard.html">
                    <i class="fa fa-home"></i>
                  </a>
                </li>

                <li><span>{{$datahead}}</span></li>
              </ol>

              <a class="sidebar-right-toggle" data-open="sidebar-right" ><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>


          <!-- start: page -->



<div class="row">
              <div class="row">
              <div class="col-xs-12">

            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#"  class="panel-action panel-action-toggle" data-panel-toggle></a>

                </div>

                <h2 class="panel-title">{{$datahead}}</h2>
              </header>
              <div class="panel-body">


                <div class="form-group">
														<label class="col-sm-4 control-label">Startup </label>

														<div class="col-sm-8">
                              @if($attendee)
                          @foreach($attendee as $u)

															<div class="checkbox-custom checkbox-default">
																<input type="checkbox"  id="checkboxExample1">

                                     <label for="checkboxExample1"><a style="float:left; margin: 3px; "  target="_blank"
                                          download="{{$u->qrcode}}_{{$u->name_user}}_{{$u->ser_name}}_{{$u->phone_user}}.jpg" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($u->Qid)) !!}"
                                          role="button">  {{$u->name_user}} {{$u->ser_name}}</a></label>
															</div>
                              @endforeach
                     @endif

														</div>
													</div>
              </div>
            </section>

              </div>
            </div>
        </div>
</section>
@stop



@section('scripts')
<script src="//code.jquery.com/jquery-1.12.4.js"></script>



@if ($message = Session::get('success'))
<script type="text/javascript">
var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
var notice = new PNotify({
      title: 'ยินดีด้วยค่ะ',
      text: '{{$message}}',
      type: 'success',
      addclass: 'stack-bar-top',
      stack: stack_bar_top,
      width: "100%"
    });
</script>
@endif


@stop('scripts')
