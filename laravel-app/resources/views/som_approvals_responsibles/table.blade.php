<div class="table-responsive">
    <table class="table" id="somApprovalsResponsibles-table">
        <thead>
            <tr>
                <th>Lastupdate</th>
        <th>Comment</th>
        <th>Som Form Approvals Id</th>
        <th>Som Status Id</th>
        <th>Document Url</th>
        <th>Doc Url Description</th>
        <th>Order Approval</th>
        <th>Is Final Approval</th>
        <th>Cms Privilege Id Assigned</th>
        <th>Cms Privilege Id Notify</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somApprovalsResponsibles as $somApprovalsResponsible)
            <tr>
                <td>{{ $somApprovalsResponsible->lastupdate }}</td>
            <td>{{ $somApprovalsResponsible->comment }}</td>
            <td>{{ $somApprovalsResponsible->som_form_approvals_id }}</td>
            <td>{{ $somApprovalsResponsible->som_status_id }}</td>
            <td>{{ $somApprovalsResponsible->document_url }}</td>
            <td>{{ $somApprovalsResponsible->doc_url_description }}</td>
            <td>{{ $somApprovalsResponsible->order_approval }}</td>
            <td>{{ $somApprovalsResponsible->is_final_approval }}</td>
            <td>{{ $somApprovalsResponsible->cms_privilege_id_assigned }}</td>
            <td>{{ $somApprovalsResponsible->cms_privilege_id_notify }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somApprovalsResponsibles.destroy', $somApprovalsResponsible->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somApprovalsResponsibles.show', [$somApprovalsResponsible->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somApprovalsResponsibles.edit', [$somApprovalsResponsible->id]) }}" class='btn btn-default btn-xs'>
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
