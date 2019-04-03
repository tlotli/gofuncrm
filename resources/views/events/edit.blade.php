@extends('layouts.app')

@section('custom-styles')
    <!-- Bootstrap Datetimepicker CSS -->
    <link href="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{asset('assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('main-section')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-10">
                            Edit Event
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{route('events.update' , ['id' => $event->id])}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Event Name</label>
                                            <input type="text" class="form-control" name="title" id="title" value="{{$event->title}}">
                                            @if ($errors->has('title'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Location </label>
                                            <input type="text" class="form-control map-input" name="location" id="address-input" value="{{$event->location}}">
                                            @if ($errors->has('location'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                                            <input type="hidden" name="address_latitude" id="address-latitude" value="{{$event->address_latitude}}" />
                                            <input type="hidden" name="address_longitude" id="address-longitude" value="{{$event->address_longitude}}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Start Date</label>
                                            <div class='input-group date datetimepicker1' >
                                                <input type='text' value="{{date('m-d-Y H:i:s',strtotime($event->start_date))}}" name="start_date" class="form-control" />
                                                <span class="input-group-addon">
												    <span class="fa fa-calendar"></span>
												</span>
                                                @if ($errors->has('start_date'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">End Date</label>
                                            <div class='input-group date datetimepicker1' >
                                                <input type='text' name="end_date" value="{{date('m-d-Y H:i:s',strtotime($event->end_date))}}" class="form-control" />
                                                <span class="input-group-addon">
												    <span class="fa fa-calendar"></span>
												</span>
                                                @if ($errors->has('end_date'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('end_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Notes</label>
                                            <textarea name="notes" id="notes" class="form-control" rows="10">{{$event->notes}}</textarea>
                                            @if ($errors->has('notes'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('notes') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-pencil-square"></span> Update Event</button>
                                            <a href="{{route('events.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')

    <script type="text/javascript" src="{{asset('assets/vendors/bower_components/moment/min/moment-with-locales.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>--}}
    <script src="{{asset('js/mapInput.js')}}"></script>

    <script>
        $("#demo").click(function(){
            var tour = new Tour({
                steps: [
                    {
                        element: "#name",
                        title: "Permission Name",
                        content: "Use the field to enter the name of the permission"
                    },
                    {
                        element: "#permission_id",
                        title: "Permission Type",
                        content: "Select permission type from the field list"
                    },
                    {
                        element: "#create_button",
                        title: "Create Permission",
                        content: "Use the button to create a new permission"
                    },
                    {
                        element: "#back",
                        title: "Back Button",
                        content: "Use the button to return to the previous page"
                    },
                ]});
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.restart();
            storage:false;
        });
    </script>


    <script>
        $(function () {
            $('.datetimepicker1').datetimepicker({
                useCurrent: false,
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
            });
        });

    </script>



@endsection