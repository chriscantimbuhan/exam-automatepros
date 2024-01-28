
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
    </thead>
    <tbody>
        @if (count($data->items()) > 0)
            @foreach($data as $item)
                <tr>
                    <th scope="row">{{ $item->getKey() }}</th>
                    <td>{{ $item->name }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan='2' class="text-center">No data available in table</td>
            </tr>
        @endif
    </tbody>
</table>

@if (count($data->items()) > 0)
    <div>
        <p>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} 
            {{ $data->total() > 1 ? 'results' : 'result' }}</p>
    </div>

    <div class="d-flex justify-content-center align-items-center">
        <nav>
            <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{  $data->previousPageUrl() }}">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href={{ $data->nextPageUrl() }}>Next</a>
            </li>
            </ul>
        </nav>
    </div>
@endif
