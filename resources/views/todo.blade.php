
<!-- Formulaire permettant d'ajouter une todo -->

<!-- <h2 class="text-center mt-2">Add Todo</h2> -->

<!-- Cet include permet d'inclure le fichier index.blade.php du dossier index dans ce fichier -->
@include('index.index')


<div class="text-center">
    
</div>







<!-- Lister toutes les todos existants dans la base de données -->


<div class="text-center">

    <div class="row d-flex align-items-center">
        <div class="col-7">
            <h2>All Todos</h2>
        </div>
        <div class="col-3">
            <button id="addTodoButton" type="button" class="btn btn-primary mb-3">Ajouter</button>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>



                @php
                    $start = ($todos->currentPage() - 1) * $todos->perPage() + 1;
                    $end = min($start + $todos->perPage() - 1, $todos->total());
                @endphp

                @php $counter = $start; @endphp

                @foreach($todos as $todo)
                    <tr>
                        <th>{{$counter}}</th>
                        <td>{{$todo->title}}</td>
                        <td>{{$todo->created_at}}</td>
                        <td>
                            @if($todo->is_completed)
                                <div class="badge bg-success">Completed</div>
                            @else
                                <div class="badge bg-warning">Not Completed</div>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('todos.edit',['todo'=>$todo->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('todos.destory',['todo'=>$todo->id])}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                    
                    @php $counter++; @endphp

                @endforeach
                </tbody>
                
            </table>



            <div class="row d-flex">
                <div class="col-7 d-flex justify-content-start">
                    {{ $todos->links() }}
                </div>
                <div class="col-auto d-flex align-items-center justify-content-end">
                    <p>Showing {{ $start }} to {{ $end }} of {{ $totalTodos }} todos</p>
                </div>
            </div>
        </div>
    </div>
    <!-- @section('css')
        <style>
            .card-footer {
                justify-content: center;
                align-items: center;
                padding: 0.4em;
            }
        </style>
    @endsection -->
    
</div>



<div id="addTodoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center align-items-center">Add Todo</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <form class="row g-3 justify-content-center" method="POST" action="{{route('todos.store')}}">
                    @csrf
                    <div class="form-group col-8">
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#addTodoButton').click(function(){
        $('#addTodoModal').modal('show');
    });
});
</script>
