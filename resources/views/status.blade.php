

@php
if ($status == 'Completed') {
    $class = 'green';
} elseif ($status == 'Pending') {
    $class = 'yellow';
} else {
    $class = 'red';
}
@endphp


<p class="badge" style="background:{{ $class }}; margin-bottom: 0rem; color:black;" >{!! $status !!}</p>

<style>
    .green {
        color: #11d668 !important;
    }

    .red {
        color: red !important;
    }

    .yellow {
        color: #f5f500 !important;
    }

</style>
