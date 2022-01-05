@extends('hospital/layout/master')
@section('content')


<!-- main and page heading before -->
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Table</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Table</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>



        <!-- Basic Tables start -->
        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Table with outer spacing</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {{auth('hospital')->user()->id}}
                                {{auth('hospital')->user()->hospital_name}}


                                <!-- {{auth('hospital')->user()->created_at->isoFormat('hh:mm a')}} -->

                                <p class="card-text">Using the most basic table up, here’s how
                                    <code>.table</code>-based tables look in Bootstrap. You can use any example
                                    of below table for your table and it can be use with any type of bootstrap
                                    tables.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Basic Tables end -->

        

    @endsection
