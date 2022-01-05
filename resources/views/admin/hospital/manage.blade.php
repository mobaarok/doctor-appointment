@extends('admin/admin_layout/master') @section('content')

<div class="page-title mb-3">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Hospitals</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Hospitals
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Hospital List</h4>
                    <a
                        class="btn btn-dark float-end"
                        href="{{ route('admin.hospital.create') }}"
                    >
                        Add New Hospital
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL.</th>
                                        <th scope="col">Hospital Name</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th sorted="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=(($page-1)*$per_page)+1; @endphp
                                    @foreach($hospitals as $hospital )
                                    <tr>
                                        <td class="" scope="row">{{$sl ++}}</td>
                                        <td>
                                            <a
                                                class="text-primary fw-bold"
                                                href="{{route('admin.hospital.show', $hospital->id )}}"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Click to see Details"
                                            >
                                                {{$hospital->hospital_name}}
                                            </a>
                                        </td>
                                        <td>{{$hospital->mobile_phone}}</td>
                                        <td>{{$hospital->email}}</td>
                                        <td>
                                            @if($hospital->is_activated == 1)
                                            <span class="badge bg-success"
                                                >Active</span
                                            >
                                            @else
                                            <span class="badge bg-danger"
                                                >Inactive</span
                                            >
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                class="btn icon btn-outline-danger"
                                                href="{{route('admin.hospital.edit', $hospital->id)}}"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Edit"
                                            >
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a
                                                class="btn icon btn-outline-info"
                                                href="{{route('admin.assign.doctor',$hospital->id) }}"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Assign Doctor"
                                            >
                                                <i
                                                    class="fas fa fa-id-card-alt"
                                                ></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $hospitals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection @section('script')

<script type="text/javascript">
        /*::::::::::::::::::::::::::::::
            Laravel Session Messages shown by toastr.js
            ::::::::::::::::::::::::::::::::::*/

            @if (Session:: has('message'))
            var type = "{{ Session::get('messageType') }}";
            switch (type) {
                case 'success':
                Toastify({
                        text: "{{ Session::get('message') }}",
                        duration: 3000,
                        close:true,
                        gravity:"top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    break;
                case 'error':
                Toastify({
                        text: "{{ Session::get('message') }}",
                        duration: 3000,
                        close:true,
                        gravity:"top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    break;
            }
            @endif
    /*::::::::::::::::::::::::::::::
                Laravel Session Messages shown by toastr.js
                ::::::::::::::::::::::::::::::::::*/
</script>

@endsection
