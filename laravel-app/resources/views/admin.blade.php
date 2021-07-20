@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            var id = 46;
            loadPProjectInfo(id, false)
        });
        function loadPProjectInfo(id, onBack){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/get_project?id=' + id);
            xhr.onload = function (){
                if(xhr.status == 200){
                    var output = JSON.parse(xhr.responseText);
                    console.log(output);
                    if(output.api_status == 'OK'){
                        loadedProject = true;
                        currentProjectInfo = output.data;
                    } else if (output.api_status == 'KO') {
                        alert(output.api_message);
                    }
                }
            };
            xhr.send();
            xhr.onerror = function(){
                alert('Request faild. Returned status of ' + xhr.status)
            }
        }
    </script>
@endsection
