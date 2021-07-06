<div class="table-responsive">
    <table class="table" id="somNews-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>News Description</th>
                <th>Date From</th>
                <th>Date Until</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somNews as $somNews)
            <tr>
                <td>{{ $somNews->title }}</td>
            <td>{{ $somNews->news_description }}</td>
            <td>{{ $somNews->date_from }}</td>
            <td>{{ $somNews->date_until }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somNews.destroy', $somNews->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {{-- <a href="{{ route('somNews.show', [$somNews->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('somNews.edit', [$somNews->id]) }}" class='btn btn-default btn-xs'>
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
