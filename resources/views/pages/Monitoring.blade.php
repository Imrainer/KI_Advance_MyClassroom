<x-layout title="Monitoring | My Classroom">
<style>
.yellow{
    background-color:  yellow;
    color: blueviolet;
    font-weight: bold;
}

</style>
<div class="d-flex">
<x-Sidebar photo="{{$admin->photo}}" name="{{$admin->name}}"></x-Sidebar>


<div class=" container mt-5 ">

<div class="ms-5 d-flex ">


        <div class="card border-primary mb-3 mt-3 col-md-8" style="max-width: 32rem;">
        <div class="card-header  yellow  bg-gradient">Diagram</div>
        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
        </div> 
        
        <div class="card border-primary mb-3 ms-5 mt-3 col-md-4 " style="max-height: 12rem;">
        <div class="card-header  yellow  bg-gradient">User</div>
        <div class="card-body">
            <h1 class="card-title text-center">{{$userCount}}</h1>
        </div>
        </div>

</div>


<div class="d-flex ms-5 mt-3">
<div class="card border-primary mb-3 shadow col-md-5" style="max-width: 18rem;">
    <div class="card-header text-center yellow bg-gradient  ">Mata Pelajaran</div>
    <div class="card-body">
        <h1 class="card-title text-center">{{$mapelCount}}</h1>
    </div>
    </div>

    <div class="card border-primary mb-3 shadow col-md-5 ms-5" style="max-width: 18rem;">
        <div class="card-header text-center yellow bg-gradient  ">Assignment</div>
        <div class="card-body">
            <h1 class="card-title text-center">{{$assignmentCount}}</h1>
        </div>
        </div>
    </div>

</div>
</div>
</x-layout>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var data = {
        labels: ['Juni', 'Juli', 'Agustus',], 
        datasets: [{
            label: 'User Count',
            data: [10, 0, 0],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
        }]
    };

    var myChart = new Chart(ctx, {
        type: 'bar', 
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var data_session = {
        labels: ['Juni', 'Juli', 'Agustus',], 
        datasets: [{
            label: 'User Count',
            data: [10, 20, 30],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
        }]
    };

    var myChart_session = new Chart(ctx, {
        type: 'pie', 
        data: data_session,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>