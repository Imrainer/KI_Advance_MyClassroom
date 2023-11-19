<x-layout title="Login | Schoolio">

<style>


.icon{
  color: rgb(63, 197, 146);
}

.title{
  color:  rgb(183, 0, 255);
}

.button {
  background-color:   rgb(255, 251, 0);
  color:rgb(183, 0, 255);
  width: 150px;
}

.button:hover{
  background-color: rgb(255, 255, 255);
  outline:10px  rgb(255, 251, 0);
  color:   rgb(183, 0, 255);
}

</style>
@if (session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif

@foreach($errors->all() as $msg)
  <div class="alert alert-danger">{{$msg}}</div>
  @endforeach

<div class="container mt-5 col-md-5 shadow-lg bg-white">
      <div class=" col-md-12">
    <form action="http://localhost/laravel_MyClassroom/public/login" class="p-3" method="POST">
        @csrf
         <h1 class="title fw-bold ">Schoolio</h1>
            
      
         <h5 class="fst-roboto mt-3"> Sign in </h5>
        <div class="mb-3 mt-3 col-md-11 form-floating">
          <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Masukkan Email" >
          <label for="floatingInput">Email address</label>
          </div>
       
          <div class="mb-3 mt-3 col-md-11 form-floating">
            <input type="password" class="form-control" name='password' id="floatingInput" placeholder="Masukkan Password" fdprocessedid="cj01lg">
            <label for="floatingInput">Password</label>
            </div>
       
        <div class="d-flex justify-content-center ">
        <button type="submit" class="button btn fw-bold">Login</button></div>
      </form>
</div>
</div>
</x-layout>