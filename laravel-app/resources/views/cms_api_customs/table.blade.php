<div class="table-responsive">
    <table class="table" id="cmsApiCustoms-table">
        <thead>
            <tr>
                <th>Permalink</th>
        <th>Tabel</th>
        <th>Aksi</th>
        <th>Kolom</th>
        <th>Orderby</th>
        <th>Sub Query 1</th>
        <th>Sql Where</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Parameter</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Method Type</th>
        <th>Parameters</th>
        <th>Responses</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsApiCustoms as $cmsApiCustom)
            <tr>
                <td>{{ $cmsApiCustom->permalink }}</td>
            <td>{{ $cmsApiCustom->tabel }}</td>
            <td>{{ $cmsApiCustom->aksi }}</td>
            <td>{{ $cmsApiCustom->kolom }}</td>
            <td>{{ $cmsApiCustom->orderby }}</td>
            <td>{{ $cmsApiCustom->sub_query_1 }}</td>
            <td>{{ $cmsApiCustom->sql_where }}</td>
            <td>{{ $cmsApiCustom->nama }}</td>
            <td>{{ $cmsApiCustom->keterangan }}</td>
            <td>{{ $cmsApiCustom->parameter }}</td>
            <td>{{ $cmsApiCustom->created_at }}</td>
            <td>{{ $cmsApiCustom->updated_at }}</td>
            <td>{{ $cmsApiCustom->method_type }}</td>
            <td>{{ $cmsApiCustom->parameters }}</td>
            <td>{{ $cmsApiCustom->responses }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsApiCustoms.destroy', $cmsApiCustom->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsApiCustoms.show', [$cmsApiCustom->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsApiCustoms.edit', [$cmsApiCustom->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
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
