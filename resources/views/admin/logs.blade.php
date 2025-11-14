@extends('layouts.admin_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Historique des actions administrateur</h2>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><strong>Logs enregistrés ({{ $logs->count() }})</strong></span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Admin</th>
                            <th>Action</th>
                            <th>Model</th>
                            <th>ID</th>
                            <th>Détails</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->created_at }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $log->admin->name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $log->action }}</span>
                                </td>
                                <td>{{ $log->model }}</td>
                                <td>{{ $log->model_id }}</td>
                                <td>
                                    <pre class="bg-light p-2 rounded" style="white-space: pre-wrap;">
{{ $log->details }}
                                    </pre>
                                </td>
                            </tr>
                        @endforeach

                        @if ($logs->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun log enregistré.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });
    });
</script>
@endsection
