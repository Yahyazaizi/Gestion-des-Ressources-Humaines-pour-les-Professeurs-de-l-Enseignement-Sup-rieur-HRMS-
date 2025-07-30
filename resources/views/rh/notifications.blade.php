
@extends('layouts.app')

@section('content')
@include('components.private.header')
@include('components.private.sidebar')

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --warning: #f8961e;
        --danger: #f72585;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --white: #ffffff;
        --dark-blue: #1a237e;
    }

    .container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    h1 {
        color: var(--dark-blue);
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }

    .filter-form {
        background-color: #f8fafc;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .form-control {
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        padding: 0.6rem 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    .btn-primary {
        background-color: var(--primary);
        border: none;
        border-radius: 6px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 1.5rem;
    }

    .table thead th {
        background-color: var(--primary);
        color: white;
        font-weight: 600;
        padding: 1rem;
        border: none;
    }

    .table tbody tr {
        transition: all 0.2s;
    }

    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
        transform: translateX(5px);
    }

    .table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .alert-warning {
        background-color: rgba(248, 150, 30, 0.1);
        border-left: 4px solid var(--warning);
        color: var(--dark);
        border-radius: 6px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .page-link {
        color: var(--primary);
        border: 1px solid #e2e8f0;
        padding: 0.5rem 1rem;
        margin: 0 3px;
        border-radius: 6px;
        transition: all 0.3s;
    }

    .page-link:hover {
        color: var(--secondary);
        background-color: #f8fafc;
        border-color: #e2e8f0;
    }

    .badge-grade {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        background-color: var(--primary-light);
        color: white;
    }

    .badge-echelon {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        background-color: var(--success);
        color: white;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .filter-form .row > div {
            margin-bottom: 1rem;
        }

        .table {
            display: block;
            overflow-x: auto;
        }

        .table thead {
            display: none;
        }

        .table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
        }

        .table tbody tr:hover {
            transform: none;
        }

        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
            padding: 0.5rem 1rem;
        }

        .table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--primary);
            margin-right: 1rem;
        }
    }
</style>

<div class="container">
    <h1>
        <i class="fas fa-bell"></i> الإشعارات
    </h1>

    <!-- فلترة حسب السنة والموظف -->
    <form action="{{ route('notifications.index') }}" method="GET" class="filter-form">
        <div class="row">
            <div class="col-md-4">
                <label for="year" class="form-label">السنة</label>
                <input type="number" name="year" id="year" class="form-control"
                    value="{{ request('year', date('Y')) }}" min="2000" max="2100">
            </div>

            <div class="col-md-6">
                <label for="employee_id" class="form-label">الموظف</label>
                <select name="employee_id" id="employee_id" class="form-control select2">
                    <option value="">-- جميع الموظفين --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->NOM_ET_PRENOM }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter"></i> فلترة
                </button>
            </div>
        </div>
    </form>

    <!-- عرض الإشعارات -->
    @if($notifications->count())
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>الموظف</th>
                        <th>الدرجة القديمة</th>
                        <th>الدرجة الجديدة</th>
                        <th>الإشعار</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td data-label="الموظف">
                                <strong>{{ $notification->employee->NOM_ET_PRENOM ?? '-' }}</strong>
                            </td>
                            <td data-label="الدرجة القديمة">
                                <span class="badge-grade">{{ $notification->ancien_grade }}</span>
                                <span class="badge-echelon">{{ $notification->ancien_echelon }}</span>
                            </td>
                            <td data-label="الدرجة الجديدة">
                                <span class="badge-grade">{{ $notification->nouveau_grade }}</span>
                                <span class="badge-echelon">{{ $notification->nouveau_echelon }}</span>
                            </td>
                            <td data-label="الإشعار">
                                <div class="notification-message">
                                    {{ $notification->message }}
                                </div>
                            </td>
                            <td data-label="التاريخ">
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($notification->date_changement)->format('d/m/Y H:i') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center py-3">
            <i class="fas fa-exclamation-circle me-2"></i> لا توجد إشعارات مطابقة للمعايير المحددة.
        </div>
    @endif

    <!-- روابط التنقل بين الصفحات -->
    @if ($notifications instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="d-flex justify-content-center mt-4">
            {{ $notifications->links() }}
        </div>
    @endif
</div>

<!-- Add Select2 for better select inputs -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "اختر موظف",
            allowClear: true,
            width: '100%'
        });

        // Add animation to table rows
        $('table tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });
</script>
@endsection
