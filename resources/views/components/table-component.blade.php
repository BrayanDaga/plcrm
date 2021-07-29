<div class="table-responsive">
    <table class="table {{$tableclass}}">
      <thead class="thead-{{$typehead}}">
        {{$theadRows }}
      </thead>
      <tbody>
        {{$tbodyRows }}
      </tbody>
    </table>
    {{ $slot }}
  </div>