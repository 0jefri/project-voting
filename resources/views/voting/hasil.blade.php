@extends('layouts.app')

@section('title', 'Halaman Hasil Voting')

@section('content')
  <div class="container mt-4">
    <div class="row">
    <div class="col-md-8">
      <div class="card shadow-sm p-4 mb-4">
      <h2 class="text-center mb-4">📊 Hasil Voting</h2>
      <div style="height: 400px;">
        <canvas id="hasilVotingChart"></canvas>
      </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm p-4">
      <h3 class="text-center mb-3">Detail Suara</h3>
      <div class="table-responsive">
        <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
          <th>Kandidat</th>
          <th>Suara</th>
          <th>Persentase</th>
          </tr>
        </thead>
        <tbody>
          @foreach($hasilVoting as $item)
        <tr>
        <td>
        {{ $item->kandidat->ketua->name }}<br>
        <small class="text-muted">{{ $item->kandidat->wakilKetua->name }}</small>
        </td>
        <td>{{ $item->total_suara }}</td>
        <td>
        @if($totalSuara > 0)
      {{ number_format(($item->total_suara / $totalSuara) * 100, 1) }}%
    @else
    0%
  @endif
        </td>
        </tr>
      @endforeach
          <tr class="table-info">
          <td><strong>Total</strong></td>
          <td colspan="2"><strong>{{ $totalSuara }} suara</strong></td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>
  </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('hasilVotingChart').getContext('2d');

    const data = {
      labels: @json($labels),
      datasets: [{
        data: @json($data),
        backgroundColor: @json($colors),
        hoverOffset: 4
      }]
    };

    const config = {
      type: 'doughnut',
      data: data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          },
          title: {
            display: true,
            text: 'Persentase Suara Kandidat'
          }
        }
      },
    };

    new Chart(ctx, config);
  });
</script>