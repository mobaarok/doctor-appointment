@extends('user/layout/master')
@section('content')
@section('css')
<style>

</style>
@endsection
<div>
    <div class="container">

      


        <div class="mt-3">
            <h2 style="display: inline-block;" class="">Hospital in Feni... </h2>
            <a style="float:right;" class="btn btn-info" href="">View all</a>
        </div>
        <!-- hosptal start -->
        <div class="row">
            @foreach($hospitals as $hospital)
            <div class="col-md-4">
                <a class="card-href" href="{{ route('user.singleHospital',  $hospital->id ) }}">
                    <div class="card border-0 shadow-sm my-2" style="width: 23rem;">
                        <div class="card-body">
                            <h4 class="card-title">{{$hospital->hospital_name}}</h4>
                            <p class="text-muted"> <small>Mizan Road, Feni, Chittagong</small> </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            <p> 
                {{$hospitals->links()}}
            </p>
        </div>
        <!-- hospital end -->


   
    
    </div>
</div>



@section('script')


<script type="text/javascript">



</script>
@endsection
@endsection