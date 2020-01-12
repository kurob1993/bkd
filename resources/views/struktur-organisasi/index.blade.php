@extends('core-ui.layouts.app') 
    @push('style')
        <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2-bootstrap4.min.css') }}">
        <style>
            .chartStyle {
                background-color: #52de97;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                border-radius: 5px; /* 5px rounded corners */
            }

            .selectChartStyle {
                background-color: #ffba5a;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                border-radius: 5px; /* 5px rounded corners */
            }

            .node-style {
                color:#ffffff; 
                font-style:italic; 
                font-weight: bold;
                font-size: 1.05em; 
                width: 200px
            }
        </style>
    @endpush 
    @push('script')
        <script src="{{ asset('vendors/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('js/gChart.js') }}"></script>
        <script>
            $(document).ready(function() {
                google.charts.load('current', {packages:["orgchart"]});
                // google.charts.setOnLoadCallback(drawChart);
                drawChart(1);
                $('.opd').select2();
                $('#card-button').css('width','30%');
            });

            function drawChart(id) { 
                               
                // For each orgchart box, provide the name, manager, and tooltip to show.
                var daraRows = '';
                $getData = $.get("{{ route('struktur-organisasi.show','') }}/"+id, function(data, status){
                   daraRows = data;
                });
                $getData.done(function(){                    
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Name');
                    data.addColumn('string', 'Manager');
                    data.addColumn('string', 'ToolTip');

                    data.addRows(daraRows);
                    // Create the chart.
                    var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
                    // Draw the chart, setting the allowHtml option to true for the tooltips.
                    chart.draw(data, 
                        {
                            'allowHtml':true,
                            'allowCollapse':true,
                            'nodeClass' : 'chartStyle',
                            'selectedNodeClass' : 'selectChartStyle'
                        }
                    );
                });

            }
        </script>
    @endpush

@include('core-ui.layouts._layout')
@section('content')

<div class="row justify-content-center">
    <div class="col m-3">

        @CardDefault(['title' => 'Struktur Organisasi'])
            @push('card-button')
            <div class="col-xs-10">
                <select class="form-control-sm opd" onchange="drawChart(this.value)">
                    <option> -- Pilih Data OPD -- </option>
                    @foreach ($mopd as $item)
                    <option value="{{$item->id}}"> {{$item->text}} </option>
                    @endforeach
                </select>
            </div>            
            @endpush
            <div id="chart_div" style="overflow-x: scroll; zoom: 80%;"></div>
        @endCardDefault()

    </div>
</div>
@endsection