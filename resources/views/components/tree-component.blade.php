<div class="col-lg-12 col-md-12 col-12">
    <div id="tree" />
</div>

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/orgChart/orgchart.js')) }}"></script>
@endsection
@section('page-script')
    <script>
        let users = @json($users); // convierto a Json la variable users de mi componente
        
        const tree = users;
        var chart = new OrgChart(document.getElementById("tree"), {
            mouseScrool: OrgChart.action.none,
            template: "ula",
            nodeBinding: {
                field_0: "name"
            },
            nodes: tree
        });
    </script>
@endsection
