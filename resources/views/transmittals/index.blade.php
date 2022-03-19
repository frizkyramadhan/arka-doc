@extends('layouts.main')

@section('container')
  <section class="section">
    <div class="section-header">
      <h1>{{ $title }}</h1>
      <div class="section-header-button">
        <a href="{{ url('transmittals/create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i> Add
          New</a>
        @can('admin')
          <a href="{{ url('transmittals/trash') }}" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i>
            Trash</a>
        @endcan
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>{{ $subtitle }}</h4>
            </div>
            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
              @endif
              <div class="table-responsive">
                <table class="table table-striped table-hover table-condensed" id="transmittal_dt" width=100%>
                  <thead>
                    <tr>
                      <th class="text-center" width="8%">#</th>
                      <th>Receipt No</th>
                      <th>Date</th>
                      <th>To</th>
                      <th>Attn</th>
                      <th class="text-center">Status</th>
                      <th class="text-center" width="20%">Action</th>
                    </tr>
                  </thead>
                  {{-- <tbody>
                    @foreach ($transmittals as $transmittal)
                      <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $transmittal->receipt_full_no }}</td>
                        <td>{{ date('d-M-Y', strtotime($transmittal->receipt_date)) }}</td>
                        <td>
                          @if ($transmittal->project_id == null)
                            {{ $transmittal->to }}
                          @else
                            {{ $transmittal->project->project_code }}
                          @endif
                        </td>
                        <td>{{ $transmittal->attn }}</td>
                        <td class="text-center">
                          @if ($transmittal->status == 'published')
                            <span class="badge badge-warning">{{ $transmittal->status }}</span>
                          @elseif ($transmittal->status == 'sent')
                            <span class="badge badge-info">{{ $transmittal->status }}</span>
                          @elseif ($transmittal->status == 'closed')
                            <span class="badge badge-success">{{ $transmittal->status }}</span>
                          @endif
                        </td>
                        <td class="text-center">
                          <a href="" class="btn btn-icon btn-info" title="Send" data-toggle="modal"
                            data-target="#exampleModal-{{ $transmittal->id }}"><i class="fas fa-paper-plane"></i></a>
                          <a href="{{ url('transmittals/' . $transmittal->id) }}" class="btn btn-icon btn-primary"
                            title="Detail"><i class="fas fa-info-circle"></i></a>
                          <a href="{{ url('transmittals/' . $transmittal->id . '/edit') }}" title="Edit"
                            class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                          <form action="{{ url('transmittals/' . $transmittal->id) }}" method="post"
                            onsubmit="return confirm('Are you sure want to delete this data?')" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-icon btn-danger" title="Delete"><i class="fas fa-times"></i></button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody> --}}
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- modal section --}}
  {{-- @foreach ($transmittals as $transmittal)
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal-{{ $transmittal->id }}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">#{{ $transmittal->receipt_full_no }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
              <label for="inputAddress2">Address 2</label>
              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach --}}

  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
  <script>
    $(function() {
      var table = $("#transmittal_dt").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('transmittals.list') }}",
          // data: function(d) {
          //   d.search = $('input[type="search"]').val()
          // }
        },
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false,
            className: 'text-center'
          },
          {
            data: 'receipt_full_no',
            name: 'receipt_full_no'
          },
          {
            data: 'receipt_date',
            name: 'receipt_date'
          },
          {
            data: 'to',
            name: 'to'
          },
          {
            data: 'attn',
            name: 'attn'
          },
          {
            data: 'status',
            name: 'status',
            className: 'text-center'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            className: 'text-center'
          },
        ],
        fixedHeader: true,
      });
    });
  </script>
@endsection
