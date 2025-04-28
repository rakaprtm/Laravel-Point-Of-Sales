@extends('layouts.main')
@section('title', 'DASHBOARD')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - RESTO🍔RASI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .card-img-top {
      height: 100px;
      object-fit: cover;
    }
    .rounded-20 {
      border-radius: 20px;
    }
  </style>
</head>
<body class="">
  <div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <span style="color: white;"  class="me-2">{{ auth()->user()->name }}</span>
      </div>
    </div>

    <!-- Product Summary Cards -->
    <div class="row mb-4">
      <div class="col-md-3 mb-3">
        <div class="card shadow rounded-20 text-center p-3">
          <h6>Total Products</h6>
          <h4>{{ $totalProducts }}</h4>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card shadow rounded-20 text-center p-3">
          <h6>Total Orders</h6>
          <h4>{{ $totalOrders }}</h4>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card shadow rounded-20 text-center p-3">
          <h6>Total Sales</h6>
          <h4>Rp{{ number_format($totalSales, 0, ',', '.') }}</h4>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card shadow rounded-20 text-center p-3">
          <h6>Orders Today</h6>
          <h4>{{ $todayOrders }}</h4>
        </div>
      </div>
    </div>

    <!-- Charts -->
    <div class="row mb-4">
      <div class="col-md-6 mb-3">
        <div class="card shadow rounded-20 p-3">
          <h6 class="fw-bold mb-3">Top 5 Best Selling Menu</h6>
<canvas id="bestSellingProductsChart"></canvas>

        </div>
      </div>

      <div class="col-md-6 mb-3">
        <div class="card shadow rounded-20 p-3">
          <h6 class="fw-bold mb-3">Income & Expenses</h6>
          <canvas id="incomeExpenseChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    const bestSellingProductsCtx = document.getElementById('bestSellingProductsChart').getContext('2d');
const bestSellingProductsChart = new Chart(bestSellingProductsCtx, {
  type: 'bar',
  data: {
    labels: @json($bestSellingProducts->pluck('product.product_name')),
    datasets: [{
      label: 'Total Sold',
      data: @json($bestSellingProducts->pluck('total_qty')),
      backgroundColor: '#0d6efd'
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


    const incomeExpenseCtx = document.getElementById('incomeExpenseChart').getContext('2d');
    const incomeExpenseChart = new Chart(incomeExpenseCtx, {
      type: 'bar',
      data: {
        labels: @json($incomeExpense['labels']),
        datasets: [
          {
            label: 'Income',
            data: @json($incomeExpense['income']),
            backgroundColor: '#198754'
          },
          {
            label: 'Expenses',
            data: @json($incomeExpense['expenses']),
            backgroundColor: '#dc3545'
          }
        ]
      },
      options: { responsive: true }
    });
  </script>
</body>
</html>
@endsection
