@extends('admin.layout')

@section('title', 'Raporlama')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Raporlama</h1>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Günlük Benzersiz Ziyaretçi Sayısı</h5>
            </div>
            <div class="card-body">
                <canvas id="visitorChart" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Günlük Arama Butonuna Tıklama (Benzersiz IP)</h5>
            </div>
            <div class="card-body">
                <canvas id="searchClickChart" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Siteye Girenler</h5>
                <div class="d-flex gap-2">
                    <input type="date" id="visitorsDateFrom" class="form-control form-control-sm" style="width: auto;">
                    <input type="date" id="visitorsDateTo" class="form-control form-control-sm" style="width: auto;">
                    <button type="button" id="visitorsFilter" class="btn btn-sm btn-primary">Filtrele</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="visitorsTable" class="table table-sm table-hover mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IP</th>
                                <th>User-Agent</th>
                                <th>Tarih</th>
                                <th>URL</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Servis Arama/Detay Butonuna Tıklayanlar</h5>
                <div class="d-flex gap-2">
                    <input type="date" id="serviceClicksDateFrom" class="form-control form-control-sm" style="width: auto;">
                    <input type="date" id="serviceClicksDateTo" class="form-control form-control-sm" style="width: auto;">
                    <button type="button" id="serviceClicksFilter" class="btn btn-sm btn-primary">Filtrele</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="serviceClicksTable" class="table table-sm table-hover mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Servis</th>
                                <th>Buton</th>
                                <th>IP</th>
                                <th>User-Agent</th>
                                <th>Tarih</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Genel Arama Butonuna Tıklayanlar</h5>
                <div class="d-flex gap-2">
                    <input type="date" id="searchClicksDateFrom" class="form-control form-control-sm" style="width: auto;">
                    <input type="date" id="searchClicksDateTo" class="form-control form-control-sm" style="width: auto;">
                    <button type="button" id="searchClicksFilter" class="btn btn-sm btn-primary">Filtrele</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="searchClicksTable" class="table table-sm table-hover mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IP</th>
                                <th>User-Agent</th>
                                <th>Tarih</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const visitorData = @json($visitorStats);
    const searchData = @json($searchStats);

    // Visitor Chart
    new Chart(document.getElementById('visitorChart'), {
        type: 'line',
        data: {
            labels: visitorData.map(d => d.date),
            datasets: [{
                label: 'Benzersiz Ziyaretçi',
                data: visitorData.map(d => d.unique),
                borderColor: '#1e3a5f',
                backgroundColor: 'rgba(30, 58, 95, 0.1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Search Click Chart
    new Chart(document.getElementById('searchClickChart'), {
        type: 'bar',
        data: {
            labels: searchData.map(d => d.date),
            datasets: [{
                label: 'Benzersiz Tıklama',
                data: searchData.map(d => d.unique),
                backgroundColor: '#198754'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Visitors DataTable
    const visitorsTable = $('#visitorsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.reports.visitors") }}',
            data: function(d) {
                const from = document.getElementById('visitorsDateFrom').value;
                const to = document.getElementById('visitorsDateTo').value;
                if (from) d.date_from = from;
                if (to) d.date_to = to;
            }
        },
        columns: [
            { data: 'id', width: '50px' },
            { data: 'ip', width: '130px' },
            { data: 'user_agent' },
            { data: 'visited_at', width: '130px' },
            { data: 'url' }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json'
        }
    });

    document.getElementById('visitorsFilter').addEventListener('click', function() {
        visitorsTable.ajax.reload();
    });

    // Search Clicks DataTable
    const searchClicksTable = $('#searchClicksTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.reports.search-clicks") }}',
            data: function(d) {
                const from = document.getElementById('searchClicksDateFrom').value;
                const to = document.getElementById('searchClicksDateTo').value;
                if (from) d.date_from = from;
                if (to) d.date_to = to;
            }
        },
        columns: [
            { data: 'id', width: '50px' },
            { data: 'ip', width: '130px' },
            { data: 'user_agent' },
            { data: 'clicked_at', width: '130px' }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json'
        }
    });

    document.getElementById('searchClicksFilter').addEventListener('click', function() {
        searchClicksTable.ajax.reload();
    });

    // Service Clicks DataTable
    const serviceClicksTable = $('#serviceClicksTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.reports.service-clicks") }}',
            data: function(d) {
                const from = document.getElementById('serviceClicksDateFrom').value;
                const to = document.getElementById('serviceClicksDateTo').value;
                if (from) d.date_from = from;
                if (to) d.date_to = to;
            }
        },
        columns: [
            { data: 'id', width: '50px' },
            { data: 'service_title' },
            { data: 'button_type', width: '80px' },
            { data: 'ip', width: '130px' },
            { data: 'user_agent' },
            { data: 'clicked_at', width: '130px' }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json'
        }
    });

    document.getElementById('serviceClicksFilter').addEventListener('click', function() {
        serviceClicksTable.ajax.reload();
    });
});
</script>
@endpush
