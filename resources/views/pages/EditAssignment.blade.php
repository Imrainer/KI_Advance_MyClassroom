<x-layout title="Edit Mata-Pelajaran | My Classroom">
   
    <div class="container col-md-5">
      @foreach ( $assignment as $item)
      <form action="http://localhost/laravel_MyClassroom/public/assignment/edit-store/{{$assignment->id}}" method="POST" enctype="multipart/form-data" class="card p-3 mt-3">
        @csrf @method('put')
        @endforeach
        <h3> Form Edit Mata-Pelajaran </h3>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Title</label>
          <input type="text" class="form-control"  value="{{$assignment->title}}" name="title" id="exampleInputEmail1">
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Description</label>
          <input type="text" class="form-control" value="{{$assignment->description}}" name="description">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Due</label>
            <input type="date" class="form-control" value="{{$assignment->due_date}}" name="due_date">
          </div>

          <div class="dropdown">
            <label for="mapel-select">Mata Pelajaran:</label>
            <select class="form-control" id="mapel-select" name="mata_pelajaran_id">
                <option value="">Select a mapel</option>
                @foreach ($mapel as $mapel)
                    <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="d-flex justify-content-center ">
        <button type="submit" class="btn btn-outline-primary mt-3">Submit</button></div>
      </form>
</div>
</x-layout>