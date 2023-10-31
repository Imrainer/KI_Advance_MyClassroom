<x-layout title="Edit Mata-Pelajaran | My Classroom">
   
    <div class="container col-md-5">
      @foreach ( $mapel as $item)
      <form action="http://localhost/laravel_MyClassroom/public/mapel/edit-store/{{$mapel->id}}" method="POST" enctype="multipart/form-data" class="card p-3 mt-3">
        @csrf @method('put')
        @endforeach
        <h3> Form Edit Mata-Pelajaran </h3>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama</label>
          <input type="text" class="form-control"  value="{{$mapel->name}}" name="name" id="exampleInputEmail1">
        </div>
      
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Foto</label>
        <input type="file" class="form-control" name="photo_thumbnail" id="exampleInputEmail1">
      </div>
        <div class="d-flex justify-content-center ">
        <button type="submit" class="btn btn-outline-primary">Submit</button></div>
      </form>
</div>
</x-layout>