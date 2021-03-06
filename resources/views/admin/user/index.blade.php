@extends('admin.layouts.admin')

@section('title')
    <title>{{ trans('me.admin') }}</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ trans('me.users_table') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ trans('me.full_name') }}</th>
                                    <th scope="col">{{ trans('me.email') }}</th>
                                    <th scope="col">{{ trans('me.user_name') }}</th>
                                    <th scope="col">{{ trans('me.role') }}</th>
                                    <th scope="col">{{ trans('me.status') }}</th>
                                    <th scope="col">{{ trans('me.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <th>{{ ++$index }}</th>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->status ? trans('me.block') : trans('me.un_block') }}</td>
                                        <td>
                                            <form action="{{ route('admin.update', ['id' => $user->id]) }}" method="post"
                                                class="d-inline" onsubmit="return confirm('{{ trans('me.block') }}?')">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="{{ config('constants.block') }}" name="status">
                                                <button class="btn btn-success m-2" id="block-{{ $user->id }}">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.update', ['id' => $user->id]) }}" method="post"
                                                class="d-inline" onsubmit="return confirm('{{ trans('me.un_block') }}?')">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="{{ config('constants.unblock') }}" name="status">
                                                <button class="btn btn-danger m-2" id="unblock-{{ $user->id }}">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
