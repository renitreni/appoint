@extends('layouts.app')

@section('title')
    Appointment Overview
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-3">
                    <a href="{{ route('appointment.create') }}" class="btn text-white btn-success">
                        <i class="fa fa-plus"></i> Add Service
                    </a>
                </div>
                <div class="col-12 overflow-scroll">
                    <table id="appointment-table" class="table table-responsive" style="width:100%" nowrap></table>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Set Role</h5>
                        <button @click="myModal.hide()" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="saveRole()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const e = new Vue({
            el: '#app',
            data: {
                dt: null,
                myModal: null,
                overview: {
                    role_name: null
                },
            },
            methods: {
                saveRole() {
                    var $this = this;
                    axios.post('{{ route('assign.role') }}', this.overview).then(function (params) {
                        $this.dt.draw()();
                    });
                    $this.myModal.hide();
                }
            },
            mounted() {
                var $this = this;

                $this.dt = $('#appointment-table').DataTable({
                    serverSide: true,
                    "autoWidth": false,
                    ajax: {
                        url: '{{ route('appointment.table') }}',
                        type: 'POST'
                    },
                    order: [0, 'desc'],
                    columns: [
                        {
                            data: function (value) {
                                return '<a href="' + value.appoint_link + '" class="btn btn-sm btn-info">' +
                                    '<i class="fas fa-calendar"></i>' +
                                    '</a>';
                            },
                            name: 'id',
                            title: 'Actions'
                        },
                        {
                            data: 'name',
                            title: 'Service Name'
                        },
                        {
                            data: 'created_at_display',
                            name: 'created_at',
                            title: 'Date Created'
                        },
                    ],
                    "drawCallback": function (settings) {
                        $('tbody').on('click', 'tr', function () {
                            $this.overview = $this.dt.row(this).data();
                        });

                        $this.myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                            keyboard: false
                        });

                        $('.roleModal').click(function () {
                            $this.myModal.show()
                        });
                    }
                });
            }
        });

    </script>
@endsection
