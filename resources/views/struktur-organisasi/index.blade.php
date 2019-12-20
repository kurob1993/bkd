@extends('core-ui.layouts.app') 
    @push('style')
        <style>
            .chartStyle {
                background-color: #86A8E7;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                border-radius: 5px; /* 5px rounded corners */
            }

            .selectChartStyle {
                background-color: #e8d4b4;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                border-radius: 5px; /* 5px rounded corners */
            }
        </style>
    @endpush 
    @push('script')
        <script src="{{ asset('js/gChart.js') }}"></script>
        <script>
            $(document).ready(function() {
                google.charts.load('current', {packages:["orgchart"]});
                google.charts.setOnLoadCallback(drawChart);
            });

            function drawChart() {
                // For each orgchart box, provide the name, manager, and tooltip to show.
                var daraRows = '';
                $getData = $.get("{{ route('struktur-organisasi.show','all') }}", function(data, status){
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
            @endpush
            <div id="chart_div" style="overflow-x: scroll;"></div>
        @endCardDefault()

    </div>
</div>
@endsection