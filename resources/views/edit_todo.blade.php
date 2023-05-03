
<!-- Formulaire permettant d'éditer une todo -->
<div class="text-center mt-5">
    <h2>Edit Todo</h2>
</div>


<!-- Cet include permet d'inclure le fichier index.blade.php du dossier index dans ce fichier -->
@include('index.index')


<form  method="POST" action="{{route('todos.update',['todo'=>$todo->id])}}">

    @csrf

    {{ method_field('PUT') }}

    <div class="row justify-content-center mt-5">

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{$todo->title}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_completed" id="" class="form-control">
                    <option value="1" @if($todo->is_completed==1) selected @endif>Complete</option>
                    <option value="0" @if($todo->is_completed==0) selected @endif>Not Complete</option>
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Éditer</button>
            </div>
    </div>

</form>