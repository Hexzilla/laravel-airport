<div class="table-responsive">
    <table class="table" id="somFormElements-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Document</th>
        <th>Doc Url Description</th>
        <th>Template</th>
        <th>Template Url Description</th>
        <th>Lastupdate</th>
        <th>Comment</th>
        <th>Som Forms Id</th>
        <th>Order Elements</th>
        <th>Is Mandatory</th>
        <th>Is Sub Element</th>
        <th>Tooltip</th>
        <th>Cms Privileges Role Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somFormElements as $somFormElements)
            <tr>
                <td>{{ $somFormElements->name }}</td>
            <td>{{ $somFormElements->document }}</td>
            <td>{{ $somFormElements->doc_url_description }}</td>
            <td>{{ $somFormElements->template }}</td>
            <td>{{ $somFormElements->template_url_description }}</td>
            <td>{{ $somFormElements->lastupdate }}</td>
            <td>{{ $somFormElements->comment }}</td>
            <td>{{ $somFormElements->som_forms_id }}</td>
            <td>{{ $somFormElements->order_elements }}</td>
            <td>{{ $somFormElements->is_mandatory }}</td>
            <td>{{ $somFormElements->is_sub_element }}</td>
            <td>{{ $somFormElements->tooltip }}</td>
            <td>{{ $somFormElements->cms_privileges_role_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somFormElements.destroy', $somFormElements->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somFormElements.show', [$somFormElements->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somFormElements.edit', [$somFormElements->id]) }}" class='btn btn-default btn-xs'>
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
