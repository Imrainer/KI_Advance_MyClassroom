<x-layout title="Profil | Jelajah Nusantara">
<x-navbar></x-navbar>

<style>
body{
  background-color: rgb(39, 38, 38)
}
.title {
  color:white;

}

.button {
  background-color:   rgb(255, 251, 0);
  color:rgb(183, 0, 255);
  
}

.button:hover{
  background-color: rgb(255, 255, 255);
  outline:10px  rgb(255, 251, 0);
  color:   rgb(183, 0, 255);
}

</style>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


<div class=" justify-content-center container  mt-5 bg-dark col-md-5 ">
    @if (empty($data->photo))   
    <div class="d-flex justify-content-center">
<img src="{{ asset('storage/blank_user.png') }}"  alt="Profile Picture" width="300px" class="me-3 profil rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"></div> 
    @else
    <div class="d-flex justify-content-center">
   <img src="{{ asset('storage/'. $data->photo) }}" alt="Profile Picture" width="300px" class="me-3 profil rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"></div> 
    @endif
<div class="ms-3 ">
    <form action="http://localhost/laravel_MyClassroom/public/profile/edit-store" method="POST">
        @csrf @method('put')
        <div class="mb-3 mt-3">
            <label for="exampleInputEmail1" class="title form-label">Nama</label>
            <input type="text" class="form-control" value="{{$data->name}}" name="name">
          </div>
        <div class="mb-3 mt-3">
          <label for="exampleInputEmail1" class="title form-label">Email </label>
          <input type="email" class="form-control" value="{{$data->email}}"name="email">
        </div>

        <div class="mb-3 mt-3">
            <label for="exampleInputEmail1" class="title form-label">Nomor Telepon</label>
            <input type="number" class="form-control" value="{{$data->phone}}" name="phone">
          </div>
          
        <div class="d-flex justify-content-center">
        <button type="submit" class="button btn fw-bold">Submit</button>
    </div> 

      </form>
   
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Foto Profil</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="http://localhost/laravel_MyClassroom/public/profile/edit-photo" method="POST" enctype="multipart/form-data">
                @csrf @method('put')
            <div class="mb-3 mt-3">
                
                <input type="file" class="form-control" name="photo">
              </div>
            <div class="d-flex justify-content-center mt-5">
             <button type="submit" class="button btn">Confirm</button>
            </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>
</x-layout>