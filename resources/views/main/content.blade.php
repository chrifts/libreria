@extends('layouts.app')

@section('content')
    @component('main.keywordfinder')
        
    @endcomponent
    <div class="row mt-3" >    
        <div class="col-md-3 col-lg-2">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <p>Filters</p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="theCard my-1 border rounded">
                        <div class="imageX pull-left rounded-left m-0"></div>
                        <div class="content pull-left">
                            <h4>
                                Title Goes Here
                            </h4>
                            <p style="font-weight: 100; width: 100%">
                                Lorem ipsum amet
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="theCard my-1 border rounded">
                        <div class="imageX pull-left rounded-left m-0"></div>
                        <div class="content pull-left">
                            <h4>
                                Title Goes Here
                            </h4>
                            <p style="font-weight: 100; width: 100%">
                                Lorem ipsum amet
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection