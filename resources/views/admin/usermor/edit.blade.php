@extends('admin.layouts.template')
@section('admin.content')






				<section role="main" class="content-body">

					<header class="page-header">
						<h2>{{$header}}</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.html">
										<i class="fa fa-home"></i>
									</a>
								</li>

								<li><span>{{$header}}</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right" ><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


					<!-- start: page -->




							<div class="row">
							<div class="col-md-4 col-lg-3">

							</div>







              <div class="col-md-8 col-lg-8">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">

									<li class="active">
										<a href="#edit" data-toggle="tab">แก้ไขข้อมูล</a>
									</li>
								</ul>
								<div class="tab-content">

									<div id="edit" class="tab-pane active">

										<form class="form-horizontal" action="{{$url}}" method="post" enctype="multipart/form-data">
                      {{ method_field($method) }}
											{{ csrf_field() }}

											<h4 class="mb-xlg">{{$header}}</h4>
                      @if (count($errors) > 0)
                      <br>
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
											<fieldset>

												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">Name</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="name_user" value="{{ $objs->name_user }}" id="profileFirstName">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileLastName">Surname</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="ser_name" value="{{ $objs->ser_name }}" id="profileLastName">
													</div>
												</div>



												<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Position</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="position_user" value="{{ $objs->position_user }}" id="profileCompany" >
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Company</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="company_user" value="{{ $objs->company_user }}" id="profileCompany" >
													</div>
												</div>


                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Email</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="email_user" value="{{ $objs->email_user }}" id="profileCompany" >
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Mobile Phone No.</label>
													<div class="col-md-8">
														<input type="number" class="form-control" name="phone_user" value="{{ $objs->phone_user }}" id="profileCompany" >
													</div>
												</div>

                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileAddress">Type of Participants</label>
													<div class="col-md-8">
														<select class="form-control" name="group_user">
                            <option value="">--Please select--</option>
                            @foreach($group as $groups)
                            <option value="{{$groups->id}}" @if( $objs->group_user == $groups->id)
                                                                  selected='selected'
                                                                  @endif >{{$groups->group_name}}</option>
                            @endforeach
                            </select>
													</div>
												</div>





											</fieldset>





											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">Submit</button>
														<button type="reset" class="btn btn-default">Reset</button>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>











						</div>

</section>
@stop

@section('scripts')

@if ($message = Session::get('success_user_edit'))
<script type="text/javascript">
var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
var notice = new PNotify({
      title: 'ยินดีด้วยค่ะ',
      text: 'ทำการแก้ไข เสร็จเรียบร้อยแล้ว ',
      type: 'success',
      addclass: 'stack-bar-top',
      stack: stack_bar_top,
      width: "100%"
    });
</script>
@endif

@stop('scripts')
